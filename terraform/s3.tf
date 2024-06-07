/*
アカウントID、Jsonポリシーを使用した場合
*/
resource "aws_s3_bucket" "therapy-navi-log" {
  bucket = "therapy-navi-s3-bucket-for-images"
  force_destroy = true
  lifecycle_rule {
    enabled = true
    expiration {
      days = "180"
    }
  }
  tags = {
    Name = "therapy-navi-s3-bucket-for-images"
  }

}
resource "aws_s3_bucket_policy" "therapy-navi-log" {
  bucket = aws_s3_bucket.therapy-navi-log.id
  policy = data.aws_iam_policy_document.therapy-navi-log.json
}

data "aws_iam_policy_document" "therapy-navi-log" {
  statement {
    effect    = "Allow"
    actions   = ["s3:PutObject"]
    resources = ["arn:aws:s3:::${aws_s3_bucket.therapy-navi-log.id}/*"]
    principals {
      type        = "AWS"
      identifiers = [var.aws_account_id]
    }
  }
}

variable "aws_account_id" {}

/*
aclを使用したシンプルな場合
*/

# resource "aws_s3_bucket" "therapy-navi-s3-bucket" {
#   bucket = "therapy-navi-s3-bucket-for-images"
#   acl    = "public-read"

#   tags = {
#     Name = "therapy-navi-s3-bucket-for-images"
#   }
# }

# resource "aws_s3_bucket" "therapy-navi-alb-log" {
#   bucket = "therapy-navi-alb-log"

#   lifecycle_rule {
#     enabled = true

#     expiration {
#       days = "180"
#     }
#   }
# }