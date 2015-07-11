# php-apache-mysql-sample
PHP Docker化连接 mysql 数据库示例代码

##sample地址
http://yeting-php-apache-mysql-sample.daoapp.io/

##Dockerfile
```
FROM php:5.6-apache
#官方PHP Apache 镜像

RUN docker-php-ext-install pdo_mysql
#docker-php-ext-install 为官方 PHP 镜像内置命令，用于安装 PHP 扩展依赖
#pdo_mysql 为 PHP 连接 mysql 扩展

COPY . /var/www/html/
＃/var/www/html/ 为 apache 目录
```
