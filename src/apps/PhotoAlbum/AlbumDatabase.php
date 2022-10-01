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

        if (!empty( $this->pdo))
        {
            $stmt =  $this->pdo->prepare("SELECT * FROM `photoalben` WHERE userid = :userid");
            $stmt->bindValue(":userid", $userid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
            $albumsdata = $stmt->fetchall();
            return $albumsdata;
        }
        return false;
    }

    public function getAlbum($albumid)
    {
        $model = $this->getModel();

        if (!empty( $this->pdo)){
            $album =  $this->pdo->prepare("SELECT * FROM `photoalben` WHERE albumid = :albumid");
            $album->bindValue(":albumid", $albumid);
            $album->execute();
            $album->setFetchMode(PDO::FETCH_CLASS, $model);
            $albumdata = $album->fetch();
            return $albumdata;

        }
        return false;
    }

    function newAlbum($userid, $albumname, $albumdescription)
    {
        if (!empty( $this->pdo))
        {
            $stmt =  $this->pdo->prepare("INSERT INTO `photoalben` (userid, albumname, albumdescription)" .
                " VALUES (:userid, :albumname,:albumdescription)");
            $stmt->bindValue(":userid", $userid);
            $stmt->bindValue(":albumname", $albumname);
            $stmt->bindValue(":albumdescription", $albumdescription);
            $stmt->execute();
        }
    }

    function updateAlbumSettings($albumid, $albumname, $albumdescription)
    {
        if (!empty( $this->pdo))
        {

            $stmt =  $this->pdo->prepare("UPDATE `photoalben` SET albumname = :albumname, albumdescription = :albumdescription WHERE albumid = :albumid");
        $stmt->bindValue(":albumname", $albumname);
        $stmt->bindValue(":albumdescription", $albumdescription);
        $stmt->bindValue(":albumid", $albumid);
        $stmt->execute();
        }
    }

    function updateAlbumCover ($albumid, $albumcover)
    {
        if (!empty( $this->pdo))
        {
            $stmt =  $this->pdo->prepare("UPDATE `photoalben` SET albumcover = :albumcover WHERE albumid = :albumid");
            $stmt->bindValue(":albumcover", $albumcover);
            $stmt->bindValue(":albumid", $albumid);
            $stmt->execute();
        }

    }
}