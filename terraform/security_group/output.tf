/* 
  モジュールから呼び出す際のoutput名(security_group_id)を指定
*/
output "security_group_id" {
  /*
  「module.モジュール名.security_group_id」によって
  セキュリティグループのID(aws_security_group.default.id)にアクセス可能
  */
  value = aws_security_group.default.id
}