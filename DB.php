<?php

require('./Helper.php');

class DB
{
    protected $pdo;

    function __construct()
    {
        $serverName = env("MYSQL_PORT_3306_TCP_ADDR", "localhost");
        $databaseName = env("MYSQL_INSTANCE_NAME", "homestead");
        $username = env("MYSQL_USERNAME", "homestead");
        $password = env("MYSQL_PASSWORD", "secret");

        try {
            $this->pdo = new PDO("mysql:host=$serverName;dbname=$databaseName", $username, $password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 检测数据库是否存在表
            $isInstall = $this->pdo->query("SHOW TABLES like 'contacts';")
                ->rowCount();

            if (!$isInstall) {
                $sql = "
            CREATE TABLE contacts (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NOT NULL )
            ";
                $this->pdo->exec($sql);

                $sqlData = "
        INSERT INTO `contacts` VALUES ('1', 'John', '188888888');
        INSERT INTO `contacts` VALUES ('2', 'Bob', '166666666');
        INSERT INTO `contacts` VALUES ('3', 'Zoe', '155555555');
        ";
                $this->pdo->exec($sqlData);
            }


        } catch (PDOException $e) {
            echo "数据库链接失败: " . $e->getMessage();
            die();
        }
    }

    public function all()
    {
        return $this->pdo->query('SELECT * from contacts')
            ->fetchAll();
    }

    public function find($id)
    {
        return $this->pdo->query("SELECT * from contacts WHERE id = $id ")
            ->fetch();
    }

    public function remove($id)
    {
        return $this->pdo->exec("DELETE from contacts WHERE id = $id ");
    }

    public function add($name, $phone)
    {
        $sql = "INSERT INTO contacts ( name , phone ) VALUES ('$name','$phone')";

        return $this->pdo->exec($sql);
    }
}
