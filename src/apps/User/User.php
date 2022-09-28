<?php

namespace App\apps\User;

include_once __DIR__ ."../../init.php";

use App\apps\Util\AbstractMVC\AbstractModel;

class User extends AbstractModel
{
    public int $userid;
    public int $age;
    public String $firstname;
    public String $lastname;
    public String $username;
    public String $mail;
    public String $password;
    public String $bio;

    public function work()
    {
        echo "gopferdami!! gopferdami!! gopferdami!!";
    }
}