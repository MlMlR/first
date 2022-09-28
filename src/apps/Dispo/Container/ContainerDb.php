<?php

namespace App\apps\Dispo\Container;

use PDO;
use PDOException;

class ContainerDb
{
    public string $servername = "db";
    public string $username = "root";
    public string $password = "root";
    public string $dbname = "main";



    public function addToDb($container, $size, $owner, $containerType, $containerPosition)
    {
        {
            $query = "INSERT INTO container_management (code, size, owner, type, position) 
                      VALUES (:container , :size, :owner, :type, :position)";
            try
            {
                $conn = new PDO("mysql:host=$this->servername;dbname=$$this->dbname", $this->username, $this->password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                // use exec() because no results are returned
                $stmt = $conn->prepare($query);
                $stmt->bindValue(":container", $container);
                $stmt->bindValue(":size", $size);
                $stmt->bindValue(":owner", $owner);
                $stmt->bindValue(":type", $containerType);
                $stmt->bindValue(":position", $containerPosition);
                if(!$stmt->execute()){
                    echo $conn->errorInfo();
                    return false;
                }

                echo "<p><mark>". $container ." was added!</mark></p>";
            } catch(PDOException $e) {
                echo $query . "<br>" . $e->getMessage();
            }

            $conn = null;

        }
    }
}