<?php

session_start();


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
        $router->add("homeController", "home");
        break;

    case "crateMill":
        $router->add("crateController", "viewCrateMill");
        break;

    case "crates":
        $router->add("crateController", "crates");
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

    case "PhotoAlbums":
        $router->add("AlbumController", "displayAlbums");
        break;

    case "Album":
        $router->add("AlbumController", "album");
        break;

    case "AlbumSettings":
        $router->add("AlbumController", "albumSettings");
        break;

    case "AlbumSettings-update":
        $router->add("AlbumController", "AjaxNewAlbumSettingsFunction");
        $router->add("AlbumController", "AjaxAlbumSettingsForm");
        break;

    case "Alben-newAlbum":
        $router->add("AlbumController", "AjaxNewAlbumFunction");
        $router->add("AlbumController", "AjaxPageFotoAlben");
        break;

    default:
        $router->add("errorController", "errorPage");
}

require_once "footer.php";
