<?php

namespace App\apps\crate;

use App\apps\crate\MVC\CrateModel;
use App\apps\Util\AbstractMVC\AbstractDatabase;
use PDO;

class CrateDatabase extends AbstractDatabase
{

    function getTable()
    {
        return "container_management";
    }

    function getModel()
    {
        return CrateModel::class;
    }

    function getCrates(){
        $model = $this->getModel();
        if (!empty( $this->pdo)){
            $crates =  $this->pdo->prepare("SELECT * FROM `container_management`");
            $crates->execute();
            $crates->setFetchMode(PDO::FETCH_CLASS, $model);
            $cratedata = $crates->fetchAll();
            return $cratedata;
        }
        return false;
    }

    function newCrate($code, $size, $owner, $crateType, $cratePosition){
        if (!empty( $this->pdo)){
            $stmt =  $this->pdo->prepare("INSERT INTO container_management (code, size, owner, type, position) 
                      VALUES (:code , :size, :owner, :type, :position)");
            $stmt->bindValue(":code", $code);
            $stmt->bindValue(":size", $size);
            $stmt->bindValue(":owner", $owner);
            $stmt->bindValue(":type", $crateType);
            $stmt->bindValue(":position", $cratePosition);
            $stmt->execute();
        }
    }

    function deleteCrate($code){
        if (!empty( $this->pdo)){
            $stmt =  $this->pdo->prepare("DELETE FROM `container_management` WHERE `code` = :code");
            $stmt->bindValue(":code", $code);
            $stmt->execute();
        }
    }
}