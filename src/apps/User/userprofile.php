<?php

include_once __DIR__ . "/../../header.php";
include_once __DIR__ . "/../../init.php";

$router = $Container->build('router');
echo"<h1 id='users'>User</h1>";

$router->add("userController", "userprofile");

