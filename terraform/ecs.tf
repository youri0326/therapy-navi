/* クラスター */
resource "aws_ecs_cluster" "therapy-navi-ecs-cluster" {
  name = "therapy-navi-ecs-cluster"
}


/* フロント側 */

/* タスク定義 */
resource "aws_ecs_task_definition" "therapy-navi-task" {
  /*タスク名のプレフィックス(頭文字)を決めるもの*/
  family                   = "therapy-navi-task"
  cpu                      = "512"
  memory                   = "1024"
  network_mode             = "awsvpc"
  requires_compatibilities = ["FARGATE"]


  #要チェック
  /*稼働するコンテナ(サーバ)の内容を定義する(Json形式)*/
  container_definitions    = file("./tasks/therapy-navi-app-definition.json")


   #要チェック
  execution_role_arn       = module.ecs_task_execution_role.iam_role_arn
}

/* サービス定義 */
resource "aws_ecs_service" "therapy-navi-ecs-service" {
  name                              = "therapy-navi-ecs-service"
  cluster                           = aws_ecs_cluster.therapy-navi-ecs-cluster.arn
  task_definition                   = "${aws_ecs_task_definition.therapy-navi-task.family}:${max("${aws_ecs_task_definition.therapy-navi-task.revision}", "${data.aws_ecs_task_definition.therapy-navi-task.revision}")}"
  desired_count                     = 1
  launch_type                       = "FARGATE"
  platform_version                  = "1.3.0"
  health_check_grace_period_seconds = 600

  network_configuration {
    assign_public_ip = true
    security_groups = [
      aws_security_group.therapy-navi-ecs-sg.id
    ]
    subnets = [
      aws_subnet.therapy-navi-1a.id,
      aws_subnet.therapy-navi-1c.id
    ]
  }

  load_balancer {
    target_group_arn = aws_lb_target_group.therapy-navi-alb-tg.arn
    container_name   = "frontend-container"
    container_port   = "80"
  }
}


/* バック側 */

/* タスク定義 */
resource "aws_ecs_task_definition" "therapy-navi-backend-task" {
  family                   = "therapy-navi-backend-task"
  cpu                      = "256"
  memory                   = "512"
  network_mode             = "awsvpc"
  requires_compatibilities = ["FARGATE"]
  container_definitions    = file("./tasks/therapy-navi_backend_definition.json")
  execution_role_arn       = module.ecs_task_execution_role.iam_role_arn
}

/* サービス定義 */
resource "aws_ecs_service" "therapy-navi-backend-ecs-service" {
  name                              = "therapy-navi-backend-ecs-service"
  cluster                           = aws_ecs_cluster.therapy-navi-ecs-cluster.arn
  task_definition                   = "${aws_ecs_task_definition.therapy-navi-backend-task.family}:${max("${aws_ecs_task_definition.therapy-navi-backend-task.revision}", "${data.aws_ecs_task_definition.therapy-navi-backend-task.revision}")}"
  desired_count                     = 1
  launch_type                       = "FARGATE"
  platform_version                  = "1.3.0"
  health_check_grace_period_seconds = 600

  network_configuration {
    assign_public_ip = true
    security_groups = [
      aws_security_group.therapy-navi-ecs-sg.id
    ]
    subnets = [
      aws_subnet.therapy-navi-backend-1a.id,
      aws_subnet.therapy-navi-backend-1c.id
    ]
  }

  load_balancer {
    target_group_arn = aws_lb_target_group.therapy-navi-alb-backend-tg.arn
    container_name   = "backend-container"
    container_port   = "3000"
  }
}

/* データベース作成用タスク */
resource "aws_ecs_task_definition" "db-create" {
  family                   = "therapy-navi-db-create"
  container_definitions    = file("./tasks/therapy-navi_db_create_definition.json")
  requires_compatibilities = ["FARGATE"]
  network_mode             = "awsvpc"
  cpu                      = "256"
  memory                   = "512"
  execution_role_arn       = module.ecs_task_execution_role.iam_role_arn
}

/* マイグレーション用タスク */
resource "aws_ecs_task_definition" "db-migrate" {
  family                   = "therapy-navi-db-migrate"
  container_definitions    = file("./tasks/therapy-navi_db_migrate_definition.json")
  requires_compatibilities = ["FARGATE"]
  network_mode             = "awsvpc"
  cpu                      = "256"
  memory                   = "512"
  execution_role_arn       = module.ecs_task_execution_role.iam_role_arn
}

/* シードデータ作成用タスク */
resource "aws_ecs_task_definition" "db-seed" {
  family                   = "therapy-navi-db-seed"
  container_definitions    = file("./tasks/therapy-navi_db_seed_definition.json")
  requires_compatibilities = ["FARGATE"]
  network_mode             = "awsvpc"
  cpu                      = "256"
  memory                   = "512"
  execution_role_arn       = module.ecs_task_execution_role.iam_role_arn
}

/* ファミリーを指定するだけで、そのファミリーの最新のACTIVEリビジョンを見つけることができる */
data "aws_ecs_task_definition" "therapy-navi-task" {
  depends_on      = [aws_ecs_task_definition.therapy-navi-task]
  task_definition = aws_ecs_task_definition.therapy-navi-task.family
}
data "aws_ecs_task_definition" "therapy-navi-backend-task" {
  depends_on      = [aws_ecs_task_definition.therapy-navi-backend-task]
  task_definition = aws_ecs_task_definition.therapy-navi-backend-task.family
}


/* 以下、書き換え不要 */
data "aws_iam_policy" "ecs_task_execution_role_policy" {
  arn = "arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy"
}

data "aws_iam_policy_document" "ecs_task_execution" {
  source_json = data.aws_iam_policy.ecs_task_execution_role_policy.policy

  statement {
    effect    = "Allow"
    actions   = ["ssm:GetParameters", "kms:Decrypt"]
    resources = ["*"]
  }
}

module "ecs_task_execution_role" {
  source     = "./iam_role"
  name       = "ecs-task-execution"
  identifier = "ecs-tasks.amazonaws.com"
  policy     = data.aws_iam_policy_document.ecs_task_execution.json
}
