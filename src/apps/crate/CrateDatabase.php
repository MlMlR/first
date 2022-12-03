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

    function getCrates($ordering = 'code', $sort = 'ASC'){
        $model = $this->getModel();
        if (!empty( $this->pdo)){
            $query = "SELECT * FROM `container_management` ORDER BY $ordering $sort";
            $crates =  $this->pdo->prepare($query);
            $crates->execute();
            $crates->setFetchMode(PDO::FETCH_CLASS, $model);
            $cratedata = $crates->fetchAll();
            return $cratedata;
        }
        return false;
    }

    function getCrate($code){
        $model = $this->getModel();

        if (!empty( $this->pdo)){
            $crate =  $this->pdo->prepare("SELECT * FROM `container_management` WHERE code = :code");
            $crate->bindValue(":code", $code);
            $crate->execute();
            $crate->setFetchMode(PDO::FETCH_CLASS, $model);
            $cratedata = $crate->fetch();
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

    public function updateCrate($value, $column, $code)
    {
        if (!empty( $this->pdo)){
            $query ="UPDATE container_management SET $column = :value WHERE code = :code LIMIT 1";
            $stmt =  $this->pdo->prepare($query);
            $stmt->bindValue(":value", $value);
            $stmt->bindValue(":code", $code);
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