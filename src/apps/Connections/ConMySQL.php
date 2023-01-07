<?php

namespace App\apps\Connections;

use PDO;

class ConMySQL
{

    public function conToMySQL1(): PDO
    {

        $servername = "db";
        $username = "root";
        $password = "root";
        $dbname = "main";
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }


}