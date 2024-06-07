#IGW(インターネットゲートウェイ)の定義
resource "aws_internet_gateway" "therapy-navi-igw" {
  vpc_id = aws_vpc.therapy-navi-vpc.id

  tags = {
    Name = "therapy-navi-igw"
  }
}