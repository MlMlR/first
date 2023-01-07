<?php
include "../../header.php";
echo"<h1 >Dispo</h1>";


use App\apps\Dispo\Vehicle\Truck;
use App\apps\Util\Logger;

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once './Vehicle/Truck.php';
include_once('./../Util/Logger.php');

$man =new Truck();

$man->setHp(1001);


echo $man->getHp();
echo "<br>";
$man->swear();
echo "<br>";

echo Logger::getDate();
include "../../footer.php";
