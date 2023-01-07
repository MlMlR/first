<?php

namespace App\apps\truck\MVC;

use App\apps\Util\AbstractMVC\AbstractController;

class TruckController extends AbstractController
{

    public function play()
    {
        $this->pageload("truck", "game", []);
    }
}
{

}