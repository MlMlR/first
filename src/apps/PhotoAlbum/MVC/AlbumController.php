<?php

namespace App\apps\PhotoAlbum\MVC;

use App\apps\PhotoAlbum\AlbumDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class AlbumController extends AbstractController
{

    private AlbumDatabase $albumDatabase;

    public function __construct(AlbumDatabase $albumDatabase){

        $this->albumDatabase = $albumDatabase;
    }

    public function displayAlbum()
    {
        $userid = $_SESSION["userid"];
        $alben = $this->albumDatabase->getAlben($userid);
        $this->pageload("PhotoAlbum", "displayAlbum",[
            'alben' => $alben
        ]);
    }
}