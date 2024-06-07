resource "aws_route53_zone" "therapy-navi-host-zone" {
  name    = "therapy-navi.xyz"
  comment = "therapy-navi.xyz host zone"
}

resource "aws_route53_record" "therapy-navi-host-zone-record" {
  zone_id = aws_route53_zone.therapy-navi-host-zone.zone_id
  name    = aws_route53_zone.therapy-navi-host-zone.name
  type    = "A"

  alias {
    name                   = aws_lb.therapy-navi-alb.dns_name
    zone_id                = aws_lb.therapy-navi-alb.zone_id
    evaluate_target_health = true
  }
}


# # フロントエンド用
# resource "aws_route53_zone" "therapy-navi-zone" {
#   name = "therapy-naviapp.com"
#   tags = {
#     "therapy-navi" = "therapy-naviapp.com" 
#   }
# }

# resource "aws_route53_record" "therapy-navi-zone-record" {
#   zone_id = aws_route53_zone.therapy-navi-zone.id
#   name = aws_route53_zone.therapy-navi-zone.name
#   type = "A"

#   alias {
#     name = aws_lb.therapy-navi-alb.dns_name
#     zone_id = aws_lb.therapy-navi-alb.zone_id
#     evaluate_target_health = true
#   }
# }