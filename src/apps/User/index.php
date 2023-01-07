<?php

require_once __DIR__ . "/../../header.php";
require_once __DIR__ . "/../../init.php";

$router = $Container->build('router');
echo"<h1 id='users'>Users</h1>";

$router->add("userController", "allUsers");


include_once __DIR__ . "/../../footer.php";


