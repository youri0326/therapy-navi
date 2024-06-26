
resource "aws_iam_role" "default" {
  name               = var.name
  assume_role_policy = data.aws_iam_policy_document.assume_role.json
}

/* IAM Role TrustPolicies --identifierに関連付け-- */
data "aws_iam_policy_document" "assume_role" {
  statement {
    actions = ["sts:AssumeRole"]

    principals {
      type        = "Service"
      identifiers = [var.identifier]
    }
  }
}

/* IAM Role Defenition */
resource "aws_iam_policy" "default" {
  name   = var.name
  policy = var.policy
}

/* Attach IAM Policy to IAM Role */
resource "aws_iam_role_policy_attachment" "default" {
  role       = aws_iam_role.default.name
  policy_arn = aws_iam_policy.default.arn
}


/* 以下、使用方法不明 */
# data "aws_iam_policy_document" "ecs_task_role_policy_document" {
#   statement {
#     effect = "Allow"

#     actions = [
#       "logs:DescribeLogStreams",
#       "logs:CreateLogGroup",
#       "logs:CreateLogStream",
#       "logs:PutLogEvents"
#     ]

#     resources = ["*"]
#   }
# }
