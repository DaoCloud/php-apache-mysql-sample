# php-apache-mysql-sample

Docker 化 PHP 连接 mysql 数据库示例代码

## sample 地址

http://yeting-php-apache-mysql-sample.daoapp.io/

## Dockerfile

```
# 使用官方 PHP-Apache 镜像
FROM php:5.6-apache

# docker-php-ext-install 为官方 PHP 镜像内置命令，用于安装 PHP 扩展依赖
# pdo_mysql 为 PHP 连接 mysql 扩展
RUN docker-php-ext-install pdo_mysql

# /var/www/html/ 为 apache 目录
COPY . /var/www/html/
```
