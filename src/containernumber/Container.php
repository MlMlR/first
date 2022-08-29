<?php


class Container
{

    public static function hasValidCode($nr): bool
    {
        $patterns = array('/ /', '/-/', '/_/', '/,/', '/:/');
        $nr = preg_replace($patterns, "", $nr);

        if (strlen($nr) < 11){return false;}

        $values = "0123456789#ABCDEFGHIJK#LMNOPQRSTU#VWXYZ";


        $characters = str_split($nr);

        $total = 0;

        for ($i = 0; $i <= 9; $i++) {
            $x = strpos($values, $characters[$i]);
            $x = $x * (2 ** $i);
            $total += $x;
        }


        $check = $total - (11 * floor($total / 11));
        if ($check == 10) {
            $check = 0;
        }


        if ($check == $characters[10]) {
            return true;
        }
        return false;

    }

    public static function addToDb($container, $size)
    {
        $servername = "db";
        $username = "root";
        $password = "root";
        $dbname = "main";
        {
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "INSERT INTO container_management (code, size) VALUES (:container , :size)";

                // use exec() because no results are returned
                $stmt = $conn->prepare($query);
                $stmt->bindValue(":container", $container);
                $stmt->bindValue(":size", $size);
                if(!$stmt->execute()){
                    echo $conn->errorInfo();
                    return false;
                }

                echo "<p><mark>". $container ." was added!</mark></p>";
            } catch(PDOException $e) {
                echo $query . "<br>" . $e->getMessage();
            }

            $conn = null;

        }
    }


    public static function numberGenerator($owner) :string
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
