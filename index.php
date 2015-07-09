<?php
/**
 * User: yeting
 * Date: 15/7/9
 * Time: 下午4:10
 */
$serverName = env("DB_HOST", "localhost");
$databaseName = env("DB_DATABASE", "homestead");
$username = env("DB_USERNAME", "homestead");
$password = env("DB_PASSWORD", "secret");


try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "数据库链接成功";
} catch (PDOException $e) {
    echo "数据库链接失败: " . $e->getMessage();
}

function env($key, $default = null)
{
    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    return $value;
}