resource "aws_db_parameter_group" "therapy-navi-db-parameter" {
  name   = "kb-db-parameter"
  family = "mysql5.7"

  parameter {
    name  = "character_set_database"
    value = "utf8mb4"
  }

  parameter {
    name  = "character_set_client"
    value = "utf8mb4"
  }

  parameter {
    name  = "character_set_connection"
    value = "utf8mb4"
  }

  parameter {
    name  = "character_set_results"
    value = "utf8mb4"
  }

  parameter {
    name  = "character_set_server"
    value = "utf8mb4"
  }
}

resource "aws_db_instance" "therapy-navi-db" {
  allocated_storage       = 20
  instance_class          = "db.t3.micro"
  engine                  = "mariadb"
  engine_version          = "10.11.6"
  storage_type            = "gp2"
  name                    = "therapyNavi-db"
  username                = var.aws_db_user
  password                = var.aws_db_password
  backup_retention_period = 7
  copy_tags_to_snapshot   = true
  max_allocated_storage   = 200
  skip_final_snapshot     = true
  port                    = 3306
  vpc_security_group_ids  = [module.rds-sg.security_group_id]
  parameter_group_name = aws_db_parameter_group.therapy-navi-parameter.name
  db_subnet_group_name    = aws_db_subnet_group.therapy-navi-rds-subnet-group.name

  lifecycle {
    prevent_destroy = false
    # パスワードが変更されていても、Terraform では無視する（初期パスワードで再設定されないようにする）
    ignore_changes = ["password"]
  }
}

#ここから  ←gitignore 環境変数の適用など考えて設定する
variable "aws_db_name" {}
variable "aws_db_user" {}
variable "aws_db_password" {}