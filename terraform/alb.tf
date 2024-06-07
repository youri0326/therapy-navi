/* alb */
resource "aws_lb" "therapy-navi-alb" {
  name                       = "therapy-navi-alb"

  /*LBの種目：ALBを選択*/
  load_balancer_type         = "application"

  /*内部NW向けの場合 True、インターネット向けの場合 False*/
  internal                   = false

  /*削除保護の有効*/
  idle_timeout               = 60

  /*削除保護の有効*/
  enable_deletion_protection = false

  /*所属サブネットの指定*/
  subnets = [
    /*インターネット向けなのでパブリックサブネットを指定*/
    aws_subnet.therapy-navi-public-a.id,
    aws_subnet.therapy-navi-public-c.id
  ]
  /*
    アクセスログの設定
  */
  access_logs {
    bucket  = aws_s3_bucket.therapy-navi-log.id
    prefix  = "therapy-navi-log"
    enabled = true
  }
  /*
   セキュリティグループの指定(security_group.tfから佐那省)
    書式
      module.モジュール名.security_group_id
      ※security_group_id：.security_group/output.tfで指定したoutput名
  */
  security_groups = [
    module.http_sg.security_group_id,
    module.https_sg.security_group_id,
  ]

  tags = {
    Name = "therapy-navi-alb"
  }
}

/* listener */
resource "aws_lb_listener" "alb-http-listener" {
  load_balancer_arn = aws_lb.therapy-navi-alb.arn

  #NWの外からリクエストを受け付ける(HTTPの)ポート番号
  port              = "80"
  #NWの外からリクエストを受け付ける(HTTPの)プロトコル
  protocol          = "HTTP"

  #HTTPをHTTPSに統一(SSL化対応)
  default_action {
    type = "redirect"

    redirect {
      port        = "443"
      protocol    = "HTTPS"
      status_code = "HTTP_301"
    }
  }
}
resource "aws_lb_listener" "alb-https-listener" {
  load_balancer_arn = aws_lb.therapy-navi-alb.arn

  #NWの外からリクエストを受け付ける(HTTPSの)ポート番号
  port              = "443"

  #NWの外からリクエストを受け付ける(HTTPSの)プロトコル
  protocol          = "HTTPS"

  #SSL証明のARNを指定(acm.tf参照)
  certificate_arn   = aws_acm_certificate.therapy-navi-acm.arn

  #次回ここから!!!!

  default_action {
    target_group_arn = aws_lb_target_group.therapy-navi-alb-tg.arn
    type             = "forward"
  }
}

/* target-group */
resource "aws_lb_target_group" "therapy-navi-alb-tg" {
  name        = "therapy-navi-alb-tg"
  target_type = "ip"
  vpc_id      = aws_vpc.therapy-navi-vpc.id
  port        = 80
  protocol    = "HTTP"

  health_check {
    enabled             = true
    path                = "/"
    healthy_threshold   = 2
    unhealthy_threshold = 2
    timeout             = 120
    interval            = 150
    matcher             = 200
    port                = 80
    protocol            = "HTTP"
  }
  depends_on = [aws_lb.therapy-navi-alb]
}

output "alb_dns_name" {
  value = aws_lb.therapy-navi-alb.dns_name
}