
#AエリアのPublic NWで使用するPulic IPの定義
resource "aws_eip" "therapy-navi-ngw-a-eip" {
  vpc        = true
  depends_on = [aws_internet_gateway.therapy-navi-igw]

  tags = {
    Name = "therapy-navi-ngw-a-eip"
  }
}

#CエリアのPublic NWで使用するPulic IPの定義
resource "aws_eip" "therapy-navi-ngw-c-eip" {
  vpc        = true
  depends_on = [aws_internet_gateway.therapy-navi-igw]

  tags = {
    Name = "therapy-navi-ngw-c-eip"
  }
}