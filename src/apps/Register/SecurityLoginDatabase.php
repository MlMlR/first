<?php

namespace App\apps\Register;

use App\apps\Register\MVC\SecurityLoginModel;
use App\apps\Util\AbstractMVC\AbstractDatabase;

class SecurityLoginDatabase extends AbstractDatabase
{

    function getTable(): string
    {
        return "securitytokens";
    }


    function getModel(): string
    {
        return SecurityLoginModel::class;
    }

    function newStayIn($userid, $identifier, $securitytoken){
        if (!empty( $this->pdo)){
            $stmt =  $this->pdo->prepare("INSERT INTO `securitytokens` ('userid', 'identifier' ,'securitytoken')" .
                " VALUES (:userid,:identifier, :securitytoken)");
            $stmt->bindValue(":userid", $userid);
            $stmt->bindValue(":identifier", $identifier);
            $stmt->bindValue(":securitytoken", $securitytoken);
            var_dump($this->pdo);
            echo $userid . "<br>";
            echo $identifier . "<br>";
            echo $securitytoken . "<br>";

            $stmt->execute();
            echo "fuck";

        }
    }
}