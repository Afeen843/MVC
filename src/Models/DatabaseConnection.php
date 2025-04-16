<?php

namespace App\Models;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static ?PDO $pdo = null;
    private string $dns;
    private string $username;
    private string $password;

    public function __construct($dns,$username,$password)
    {
        $this->dns = $dns;
        $this->username = $username;
        $this->password = $password;
        $this->connection();
    }

    public function connection():void
    {
        try {
            if (self::$pdo == null) {
                DatabaseConnection::$pdo = new PDO($this->dns, $this->username, $this->password);
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance(): PDO
    {
        return self::$pdo;
    }

}