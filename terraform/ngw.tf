
#AエリアのPublic NWのNAT GWの設定
resource "aws_nat_gateway" "therapy-navi-ngw-a" {
  #NAT変換で使用するelastic IP(public ip)の指定 
  allocation_id = aws_eip.therapy-navi-ngw-a-eip.id

  #subnet(Cエリアのpublicサブネットを指定)
  subnet_id     = aws_subnet.therapy-navi-public-a.id

  #IGWの指定
  depends_on    = [aws_internet_gateway.therapy-navi-igw]

  tags = {
    Name = "therapy-navi-ngw-a"
  }
}

#CエリアのPublic NWのNAT GWの設定
resource "aws_nat_gateway" "therapy-navi-ngw-c" {
  #NAT変換で使用するelastic IP(public ipの指定
  allocation_id = aws_eip.therapy-navi-ngw-c-eip.id

  #subnet(Cエリアのpublicサブネットを指定)
  subnet_id     = aws_subnet.therapy-navi-public-c.id

  #IGWの指定
  depends_on    = [aws_internet_gateway.therapy-navi-igw]

  tags = {
    Name = "therapy-navi-ngw-c"
  }
}