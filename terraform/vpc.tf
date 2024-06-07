#VPC(ネットワーク)の定義
resource "aws_vpc" "therapy-navi-vpc" {
  cidr_block           = "10.0.0.0/16"
  enable_dns_support   = true
  enable_dns_hostnames = true

  tags = {
    Name = "therapy-navi-vpc"
  }
}