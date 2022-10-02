<?php

namespace App\apps\crate\MVC;

use App\apps\crate\CrateDatabase;
use App\apps\Util\AbstractMVC\AbstractController;

class CrateController extends AbstractController
{

    private CrateDatabase $crateDatabase;

    public function __construct(CrateDatabase $crateDatabase){

        $this->crateDatabase = $crateDatabase;
    }
    public function viewCrateMill(){

        $message = null;
        if(isset($_POST['submitCast']))
        {
            $owner = ($_POST['owner']);
            $size = $_POST['size'];
            $crateType = $_POST["type"];
            $cratePosition = "crate mill";
            $owner = trim($owner);
            if(strpos($owner, " "))
            {
                $arr = explode(" ",strtoupper($owner));
                $ownerCode = substr($arr[0],0,2);
                $ownerCode .= substr($arr[1],0,1);
            } else {
                $ownerCode = substr(strtoupper($owner), 0, 3);
            }
            $crate = $this->codeGenerator($ownerCode);
            $this->crateDatabase->newCrate($crate, $size, $owner, $crateType, $cratePosition);
            $message = "crate will be constructed";
        }

        $this->pageload("crate", "crateMill", [
            'message' => $message
        ]);
    }

    public function crates()
    {
        $message = null;

        if(isset($_POST['submitCreate'])){
            $size = $_POST['size'];
            $code = $_POST['code'];
            $owner = $_POST['owner'];
            $crateType = $_POST['type'];
            $cratePosition = $_POST['position'];
            $patterns = array('/ /', '/-/', '/_/', '/,/', '/:/');
            $code = preg_replace($patterns, "", $code);
            $crate = substr($code,0, 11);

            if($this->hasValidCode($crate))
            {
                $this->crateDatabase->newCrate($crate, $size, $owner, $crateType, $cratePosition);
                $message = "<p><mark>". $crate ." was added</mark></p>";
            }else {
                $message = "<p><mark>". $crate ." is <b>not</b> a valid BIC Code!</mark></p>";
            }
        }
        $crates = $this->crateDatabase->getCrates();
        $this->pageload("crate", "crates", [
            'crates' => $crates,
            'message' => $message
        ]);
    }

    public function hasValidCode($nr): bool
    {
        $patterns = array('/ /', '/-/', '/_/', '/,/', '/:/');
        $nr = preg_replace($patterns, "", $nr);

        if (strlen($nr) < 11){return false;}

        $values = "0123456789#ABCDEFGHIJK#LMNOPQRSTU#VWXYZ";


        $characters = str_split($nr);

        $total = 0;

        for ($i = 0; $i < 10; $i++) {
            $x = strpos($values, $characters[$i]);
            echo $x . "<br>";
            $x = $x * (2 ** $i);
            $total += $x;
        }


        echo $nr . "<br>";
        $check = $total%11;
        if ($check == 10) {
            $check = 0;
        }

        echo $check . "<br>";

        if ($check == $characters[10]) {
            return true;
        }
        return false;
    }

    public function codeGenerator($owner) :string
    {
        $owner .= "U";
        $owner .= mt_rand(100000,999999);
        $values = "0123456789#ABCDEFGHIJK#LMNOPQRSTU#VWXYZ";
        $characters = str_split($owner);

        $total = 0;

        for ($i = 0; $i <= 9; $i++) {
            $x = strpos($values, $characters[$i],0);
            $x = $x * (2 ** $i);
            $total += $x;
        }
        $checkDigit = $total % 11;
        if($checkDigit > 9)
        {
            $checkDigit = 0;
        }
        $owner .= $checkDigit;
        return $owner;
    }
}