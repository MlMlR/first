<?php

namespace App\apps\Home\MVC;

use App\apps\Home\HomeDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class HomeController extends AbstractController
{
    public function __construct()
    {
    }

    public function home()
    {
        $this->pageload("Home", "home",[]);
    }
}