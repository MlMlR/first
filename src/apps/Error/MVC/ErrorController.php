<?php

namespace App\apps\Error\MVC;

use App\apps\Util\AbstractMVC\AbstractController;

class ErrorController extends AbstractController
{
    public function errorPage()
    {
        $this->pageload("Error", "errorPage", []);
    }
}