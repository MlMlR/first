<?php

namespace App\apps\PhotoAlbum\MVC;

use App\apps\PhotoAlbum\AlbumDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class AlbumController extends AbstractController
{

    private AlbumDatabase $albumDatabase;

    public function __construct(AlbumDatabase $albumDatabase)
    {
        $this->albumDatabase = $albumDatabase;
    }

    public function displayAlbums()
    {
        $userid = $_SESSION["userid"];
        $alben = $this->albumDatabase->getAlben($userid);

        $this->pageload("PhotoAlbum", "displayAlbums",[
            'alben' => $alben
        ]);
    }

    public function album()
    {
        $id = $_GET["id"];
        $album = $this->albumDatabase->getAlbum($id);

        $this->pageload("PhotoAlbum", "album",[
            "album" => $album
        ]);
    }

    public function albumSettings()
    {
        $id = $_GET["id"];
        $album = $this->albumDatabase->getAlbum($id);
        $error = null;

        if (!empty($_FILES))
        {
            if ($_FILES['albumcover']['type'] == "image/jpeg" OR "image/png" OR "image/gif")
            {
                $upload_dir = __DIR__ . "../../../../uploadFiles/";
                $uploadfilename = basename($_FILES['albumcover']['name']);
                $newFileName = $_SESSION['userid'] . $id . ".png";

                if (move_uploaded_file($_FILES['albumcover']['tmp_name'], $upload_dir . $newFileName))
                {
                    $this->albumDatabase->updateAlbumCover($id, $newFileName);
                    $error = "Image uploaded";
                } else{
                    $error = "for fucks sake, it workn't";
                }
            }else{
                $error = "for fucks sake, try an image";

            }

        }

        $this->pageload("PhotoAlbum", "albumSettings",[
            "album" => $album,
            "error" => $error
        ]);
    }

    public function AjaxNewAlbumFunction()
    {
        $userid = $_SESSION["userid"];
        $albumname = $_POST['albumname'];
        $albumdescription = $_POST['albumdescription'];

        $this->albumDatabase->newAlbum($userid, $albumname, $albumdescription);
    }

    public function AjaxPageFotoAlben()
    {
        $alben = $this->albumDatabase->getAlben($_SESSION["userid"]);

        $this->pageload("PhotoAlbum", "AjaxPhotoAlben", [
            'alben' => $alben
        ]);
    }

    public function AjaxNewAlbumSettingsFunction()
    {
        $albumid = $_POST["albumid"];
        $albumname = $_POST['albumname'];
        $albumdescription = $_POST['albumdescription'];

        $this->albumDatabase->updateAlbumSettings($albumid, $albumname, $albumdescription);

    }

    public function AjaxAlbumSettingsPage()
    {
        $this->pageload("PhotoAlbum", "AjaxAlbumSettingsForm", []);
    }



}