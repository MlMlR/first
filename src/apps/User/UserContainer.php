<?php

namespace App\apps\User;

require_once '../../init.php';


use App\apps\Connections\ConMySQL;
use PDO;




class UserContainer
{


    function setPDO(): PDO
    {
        $con = new ConMySQL();
        return $con->conToMySQL1();
    }


    public function setUserDB(): UserDatabase
    {
        return new UserDatabase($this->setPDO());
    }
}