<?php

namespace App\apps\Util;

use App\apps\Connections\ConMySQL;
use App\apps\crate\CrateDatabase;
use App\apps\crate\MVC\CrateController;
use App\apps\Error\MVC\ErrorController;
use App\apps\Home\MVC\HomeController;
use App\apps\PhotoAlbum\AlbumDatabase;
use App\apps\PhotoAlbum\MVC\AlbumController;
use App\apps\PHPMailer\Exception;
use App\apps\PHPMailer\PHPMailer;
use App\apps\PHPMailer\SMTP;
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
            'AlbumController' => function()
            {
                return new AlbumController($this->build("Albumdatabase"));
            },
            'Albumdatabase' => function()
            {
                return new AlbumDatabase($this->build('pdo'));
            },
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
            'crateController' => function()
            {
                return new CrateController($this->build("crateDatabase"));
            },
            'crateDatabase' => function()
            {
                return new CrateDatabase($this->build('pdo'));
            },
            'registerController' => function()
            {
                return new RegisterController(
                    $this->build("userDatabase"),
                    $this->build("loginAuthenticator"),
                    $this->build("exception"),
                    $this->build("PHPMailer"),
                    $this->build("SMTP")
                );
            },
            'securityLoginDatabase' => function()
            {
                return new SecurityLoginDatabase($this->build('pdo'));
            },
            'loginAuthenticator' => function()
            {
                return new LoginAuthenticator();
            },
            'exception' => function()
            {
                return new Exception();
            },
            'PHPMailer' => function()
            {
                return new PHPMailer();
            },
            'SMTP' => function()
            {
                return new SMTP();
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
