
/* 

ECS のセキュリティのモジュール設定

*/

module "ecs-sg-http" {
  source      = "./security_group"
  name        = "ecs-sg-http"
  vpc_id      = aws_vpc.therapy-navi-vpc.id
  port        = 80
  cidr_blocks = [aws_vpc.therapy-navi-vpc.cidr_block]
}

/* 

ALB のセキュリティのモジュール設定

*/
module "alb-sg-http" {
  source      = "./security_group"
  name        = "alb-sg-http"
  vpc_id      = aws_vpc.therapy-navi-vpc.id
  port        = 80
  cidr_blocks = ["0.0.0.0/0"]
}
module "alb-sg-https" {
  source      = "./security_group"
  name        = "alb-sg-https"
  vpc_id      = aws_vpc.therapy-navi-vpc.id
  port        = 443
  cidr_blocks = ["0.0.0.0/0"]
}


/* 

RDS のセキュリティのモジュール設定

*/
module "rds-sg" {
  source      = "./security_group"
  name        = "rds-sg"
  vpc_id      = aws_vpc.therapy-navi-vpc.id
  port        = 3306
  cidr_blocks = ["0.0.0.0/0"]
  source_security_group_id = module.ecs-sg-http.security_group_id
}




#以下削除
/* security group for RDS */
# resource "aws_security_group" "codecraft-rds-sg" {
#   description = "RDS security group for codecraft"
#   name        = "codecraft-rds-sg"
#   vpc_id      = aws_vpc.therapy-navi-vpc.id
# }

# /* security group for ALB */
# resource "aws_security_group" "codecraft-alb-sg" {
#   description = "ALB security group for codecraft"
#   name        = "codecraft-alb-sg"
#   vpc_id      = aws_vpc.therapy-navi-vpc.id
# }

# /* security group for ECS */
# resource "aws_security_group" "codecraft-ecs-sg" {
#   description = "ECS security group for codecraft"
#   name        = "codecraft-ecs-sg"
#   vpc_id      = aws_vpc.therapy-navi-vpc.id
# }