<?php

namespace App\apps\Util\AbstractMVC;
use PDO;

abstract class AbstractDatabase
{
    protected PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    abstract function getTable();
    abstract function getModel();


    function getUser($userid ,$email){
        $model = $this->getModel();

        if (!empty( $this->pdo)){
            $user =  $this->pdo->prepare("SELECT * FROM `users` WHERE userid = :userid OR mail = :mail");
            $user->bindValue(":userid", $userid);
            $user->bindValue(":mail", $email);
            $user->execute();
            $user->setFetchMode(PDO::FETCH_CLASS, $model);
            $userdata = $user->fetch();

        }
        return $userdata;
    }
}