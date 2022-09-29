<?php

session_start();
var_dump($_SESSION);
echo "<br>";
var_dump(session_id());
echo "<br>";
var_dump($_COOKIE);

require_once "header.php";
require_once "init.php";



$router = $Container->build("router");

if (empty($_GET["App"])){
    $request = "Home";
} else {
    $request = $_GET["App"];
}

switch ($request)
{
    case "Home":
        echo
        $router->add("homeController", "home");
        break;
    case "Users":
        $router->add("userController", "allUsers");
        break;
    case "UserDashboard":
        $router->add("userController", "userDashboard");
        break;
    case "User":
        $router->add("userController", "userprofile");
        break;
    case "Register":
        $router->add("registerController", "action");
        break;
    case "Logout":
        $router->add("registerController", "logout");
        break;
    case "PhotoAlbum":
        $router->add("AlbumController", "displayAlbum");
        break;
    default:
        $router->add("errorController", "errorPage");
}

include "footer.php";
