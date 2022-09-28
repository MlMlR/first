<?php

namespace App\apps\User\MVC;




use App\apps\User\UserDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class UserController extends AbstractController {

    private UserDatabase $userDatabase;

    public function __construct(UserDatabase $userDatabase){

        $this->userDatabase = $userDatabase;
    }

    public function allUsers(){
        $users = $this->userDatabase->getUsers();

        $this->pageload("User", "users", [
            'users' => $users
        ]);
    }

    public function userprofile(){
        $userid = $_GET["userid"];
        $mail = $_GET["mail"];
        $user = $this->userDatabase->getUser($userid, $mail);

        $this->pageload("User", "user",[
            "user" => $user
        ]);
    }

    public function userDashboard()
    {
        if ($_SESSION['login'])
        {
        $this->pageload("User", "userDashboard", []);
        }
        else
        {
            echo '<script> window.location="/?App=Register"; </script>';

        }
    }
}