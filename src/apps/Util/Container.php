<?php

namespace App\apps\Util;

use App\apps\Connections\ConMySQL;
use App\apps\Error\MVC\ErrorController;
use App\apps\Home\MVC\HomeController;
use App\apps\Register\MVC\LoginAuthenticator;
use App\apps\Register\MVC\RegisterController;
use App\apps\Register\SecurityLoginDatabase;
use App\apps\User\MVC\UserController;
use App\apps\User\UserDatabase;

class Container {

    private $classInstances = [];
    private $builds = [];

    public function __construct(){

        $this->builds = array(
            'router' => function()
            {
                return new Router($this->build("container"));
            },
            'container' => function()
            {
                return new Container();
            },
            'errorController' => function()
            {
                return new ErrorController();
            },
            'homeController' => function()
            {
                return new HomeController();
            },
            'userController' => function()
            {
                return new UserController($this->build("userDatabase"));
            },
            'registerController' => function()
            {
                return new RegisterController(
                    $this->build("userDatabase"),
                    $this->build("loginAuthenticator"));
            },
            'securityLoginDatabase' => function()
            {
                return new SecurityLoginDatabase($this->build('pdo'));
            },
            'loginAuthenticator' => function()
            {
                return new LoginAuthenticator();
            },
            'userDatabase' => function()
            {
                return new UserDatabase($this->build('pdo'));
            },
            'pdo' => function()
            {
                $connection = new ConMySQL();
                return $connection->conToMySQL1();
            }
        );
    }


    public function build($objekt){
        if (isset($this->builds[$objekt])){
            if (!empty($this->classInstances[$objekt])){
                return $this->classInstances[$objekt];
            }
            $this->classInstances[$objekt] = $this->builds[$objekt]();
        }

        return $this->classInstances[$objekt];
    }
}
