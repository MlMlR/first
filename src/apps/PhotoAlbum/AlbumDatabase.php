<?php

namespace App\apps\PhotoAlbum;

use App\apps\PhotoAlbum\MVC\AlbumModel;
use App\apps\Util\AbstractMVC\AbstractDatabase;
use PDO;

class AlbumDatabase extends AbstractDatabase
{
    function getTable(): string
    {
        return "photoalben";
    }

    function getModel()
    {
        return AlbumModel::class;
    }

    public function getAlben($userid){

        $model = $this->getModel();

        if (!empty( $this->pdo)){
            $stmt =  $this->pdo->prepare("SELECT * FROM `photoalben` WHERE userid = :userid");
            $stmt->bindValue(":userid", $userid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
            $albumdata = $stmt->fetchall();
            return $albumdata;
        }
        return false;
    }

}