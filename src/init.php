<?php
require_once "autoloader.php";
use App\apps\Util\Container;

$Container = new Container();

function html(string $str): string
{
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
