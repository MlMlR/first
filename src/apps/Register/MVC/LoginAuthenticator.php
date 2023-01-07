<?php

namespace App\apps\Register\MVC;

use App\apps\User\UserDatabase;

class LoginAuthenticator
{

    public function __construct()
    {
    }

    public function checkLogin($password, $hash): bool
    {

             if (password_verify($password, $hash))
             {
                 return true;
             }
         return false;
    }
}