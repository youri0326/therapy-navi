variable "name" {
  type = string
}
variable "vpc_id" {
  type = string
}
variable "port" {
  type = string
}
variable "cidr_blocks" {
  type = list(string)
}
variable "source_security_group_id" {
  type = string
  default = null
}