<?php

namespace App\apps\Util\AbstractMVC;
abstract class AbstractController {

    public function pageload($dir, $view, $variablen){

        extract($variablen);
        require_once __DIR__ . "/../../$dir/MVC/Views/$view.php";
    }
}