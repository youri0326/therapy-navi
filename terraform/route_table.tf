/* 

パブリックサブネットのルートテーブル

*/
/* ルートテーブルの定義 */
resource "aws_route_table" "public-route-table" {
  /* VPCの指定 */
  vpc_id = aws_vpc.therapy-navi-vpc.id
  
  tags = {
    Name = "public-route-table"
  }
}
/* ルートテーブルに登録するルート情報 */
resource "aws_route" "public-route" {
  /* ルートテーブルの指定 */
  route_table_id         = aws_route_table.public-route-table.id

  /* ターゲットの指定 */
  gateway_id             = aws_internet_gateway.therapy-navi-igw.id
  
  /* 送信先の指定 */
  destination_cidr_block = "0.0.0.0/0"
}

/* パブリックサブネットaとルートテーブルの紐づけ */
resource "aws_route_table_association" "public-a" {
  route_table_id = aws_route_table.public-route-table.id
  subnet_id      = aws_subnet.therapy-navi-public-a.id
}

/* パブリックサブネットcとルートテーブルの紐づけ */
resource "aws_route_table_association" "public-c" {
  route_table_id = aws_route_table.public-route-table.id
  subnet_id      = aws_subnet.therapy-navi-public-c.id
}

/* 

リージョンa
プライベートECSサブネットのルートテーブル

*/
/* ルートテーブルの定義 */
resource "aws_route_table" "private-a-ecs-route-table" {
  /* VPCの指定 */
  vpc_id = aws_vpc.therapy-navi-vpc.id
  
  tags = {
    Name = "private-a-ecs-route-table"
  }
}
/* ルートテーブルに登録するルート情報 */
resource "aws_route" "private-a-ecs-route" {
  /* ルートテーブルの指定 */
  route_table_id         = aws_route_table.private-a-ecs-route-table.id

  /* ターゲットの指定 */
  nat_gateway_id         = aws_nat_gateway.therapy-navi-ngw-a.id
  
  /* 送信先の指定 */
  destination_cidr_block = "0.0.0.0/0"
}

/* プライベートECSサブネットaとルートテーブルの紐づけ */
resource "aws_route_table_association" "private-a-ecs" {
  route_table_id = aws_route_table.private-a-ecs-route-table.id
  subnet_id      = aws_subnet.therapy-navi-private-a-ecs.id
}

/* 

リージョンc
プライベートECSサブネットのルートテーブル

*/
/* ルートテーブルの定義 */
resource "aws_route_table" "private-c-ecs-route-table" {
  /* VPCの指定 */
  vpc_id = aws_vpc.therapy-navi-vpc.id
  
  tags = {
    Name = "private-c-ecs-route-table"
  }
}
/* ルートテーブルに登録するルート情報 */
resource "aws_route" "private-c-ecs-route" {
  /* ルートテーブルの指定 */
  route_table_id         = aws_route_table.private-c-ecs-route-table.id

  /* ターゲットの指定 */
  nat_gateway_id         = aws_nat_gateway.therapy-navi-ngw-c.id
  
  /* 送信先の指定 */
  destination_cidr_block = "0.0.0.0/0"
}

/* プライベートECSサブネットaとルートテーブルの紐づけ */
resource "aws_route_table_association" "private-c-ecs" {
  route_table_id = aws_route_table.private-c-ecs-route-table.id
  subnet_id      = aws_subnet.therapy-navi-private-c-ecs.id
}
