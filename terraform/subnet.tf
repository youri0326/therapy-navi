
# ap-northeast-1aのサブネット情報
resource "aws_subnet" "therapy-navi-public-a" {
  vpc_id                  = aws_vpc.therapy-navi-vpc.id
  cidr_block              = "10.0.0.0/24"
  availability_zone       = "ap-northeast-1a"
  map_public_ip_on_launch = true

  tags = {
    Name = "therapy-navi-public-a"
  }
}

resource "aws_subnet" "therapy-navi-private-a-ecs" {
  vpc_id                  = aws_vpc.therapy-navi-vpc.id
  cidr_block              = "10.0.1.0/24"
  availability_zone       = "ap-northeast-1a"
  map_public_ip_on_launch = true

  tags = {
    Name = "therapy-navi-private-a-ecs"
  }
}

resource "aws_subnet" "therapy-navi-private-a-db" {
  vpc_id                  = aws_vpc.therapy-navi-vpc.id
  cidr_block              = "10.0.2.0/24"
  availability_zone       = "ap-northeast-1a"
  map_public_ip_on_launch = true

  tags = {
    Name = "therapy-navi-private-a-db"
  }
}


# ap-northeast-1cのサブネット情報
resource "aws_subnet" "therapy-navi-public-c" {
  vpc_id                  = aws_vpc.therapy-navi-vpc.id
  cidr_block              = "10.0.3.0/24"
  availability_zone       = "ap-northeast-1c"
  map_public_ip_on_launch = true

  tags = {
    Name = "therapy-navi-public-c"
  }
}
resource "aws_subnet" "therapy-navi-private-c-ecs" {
  vpc_id                  = aws_vpc.therapy-navi-vpc.id
  cidr_block              = "10.0.4.0/24"
  availability_zone       = "ap-northeast-1c"
  map_public_ip_on_launch = true

  tags = {
    Name = "therapy-navi-private-c-ecs"
  }
}

resource "aws_subnet" "therapy-navi-private-c-db" {
  vpc_id                  = aws_vpc.therapy-navi-vpc.id
  cidr_block              = "10.0.5.0/24"
  availability_zone       = "ap-northeast-1c"
  map_public_ip_on_launch = true

  tags = {
    Name = "therapy-navi-private-c-db"
  }
}

resource "aws_db_subnet_group" "therapy-navi-rds-subnet-group" {
  name        = "therapy-navi-rds-subnet-group"
  description = "rds subnet for therapy-navi"
  subnet_ids  = [aws_subnet.therapy-navi-private-a-db.id, aws_subnet.therapy-navi-private-c-db.id]
}