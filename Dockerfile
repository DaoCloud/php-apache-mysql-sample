# 使用官方 PHP-Apache 镜像
FROM daocloud.io/php:7.1-apache

# /var/www/html/ 为 Apache 目录
COPY . /var/www/html/
