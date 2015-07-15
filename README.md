# 如何开发一个 PHP+Mysql 的 Docker 化应用

目标：基于典型的 LAMP 技术栈，用 Docker 镜像的方式搭建一个 Linux+Apache+MySQL+PHP 的应用 。本项目代码维护在 [DaoCloud/php-apache-mysql-sample](https://github.com/DaoCloud/php-apache-mysql-sample) 项目中。

> 本次基础镜像使用位于 [Docker Hub](https://github.com/docker-library/official-images/blob/master/library/php) 的 PHP 官方镜像。

### 创建 PHP 应用容器

首先，选择官方的 PHP 镜像作为项目的基础镜像。

```
FROM daocloud.io/php:5.6-apache
```
> 因所有镜像均位于境外服务器，为了确保所有示例能正常运行，DaoCloud 提供了一套境内[镜像源]()，并与[官方源]()保持同步。

接着，用官方 PHP 镜像内置命令`docker-php-ext-install`安装 PHP 的 MySQL 扩展依赖。

```
RUN docker-php-ext-install pdo_mysql
```

* 依赖包安装通过`docker-php-ext-install`安装，如果依赖包需要配置参数则通过`docker-php-ext-configure`命令。具体用法请参考：[PHP 镜像说明](https://registry.hub.docker.com/_/php/)。
* 安装 pdo_mysql PHP 扩展

然后，将代码复制到目标目录。

```
COPY . /var/www/html/
```

* 因为基础镜像内已经声明了暴露端口和启动命令，此处可以省略。

至此，包含 PHP 应用的 Docker 容器已经准备好了。PHP 代码中访问数据库所需的参数，是通过读取环境变量的方式声明的。

```
$serverName =   env("MYSQL_PORT_3306_TCP_ADDR", "localhost");
$databaseName = env("MYSQL_INSTANCE_NAME", "homestead");
$username =     env("MYSQL_USERNAME", "homestead");
$password =     env("MYSQL_PASSWORD", "secret");

/**
 * 获取环境变量
 * @param $key
 * @param null $default
 * @return null|string
 */
function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    return $value;
}
```

* 这样做是因为在 Docker 化应用开发的最佳实践中，通常将有状态的数据类服务放在另一个容器内运行，并通过容器特有的绑定机制将应用容器与数据容器动态的连接在一起。

### 绑定 MySQL 数据容器（本地）
首先，需要创建一个 MySQL 容器。

```
docker run --name some-mysql -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql:tag
```

之后，通过 Docker 容器间的`link`机制，便可将 MySQL 的默认端口 (3306) 暴露给应用容器。
```
docker run --name some-app --link some-mysql:mysql -d app-that-uses-mysql
```
> MySQL 容器的具体用法请参考：[MySQL 镜像说明]()。

### 绑定 MySQL 数据服务（云端）

比起本地创建，在云端创建和绑定 MySQL 数据服务会更简单。

「截图」