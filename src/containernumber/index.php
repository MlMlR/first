
<link rel="stylesheet" href="../style/style.css">


<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once('../autoloader.php');
include_once('../header.php');
echo "<br>";
echo "<br>";
use App\apps\Dispo\Container\ContainerDb;
use App\apps\Util\TableRows;

$servername = "db";
$username = "root";
$password = "root";
$dbname = "main";
?>



<div class="container">
    <div class="row">
        <div class="col mb-4">
            <h1>Containerterminal</h1>
        </div>
    </div>



    <div class="row">
        <div id="add" class="col-3">
            <div>
                <h2>Add Container</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="nr">Container Nr.</label><br>
                    <input type="text" id="nr" name="nr" placeholder="DIDU-060005 3" ><br>
                    <label for="type">Type</label><br>
                    <select  id="type" name="type" >
                        <option>Dry Storage</option>
                        <option>ISO Tank</option>
                        <option>Open Top</option>
                        <option>Special Purpose</option>
                    </select><br>
                    <label for="size">Size</label><br>
                    <input type="number" id="size" name="size" value="33" ><br>
                    <label for="position">Position</label><br>
                    <select  id="position" name="position" >
                        <option>Dürrenäsch</option>
                        <option>on Road</option>
                        <option>Singapore</option>
                        <option>Helsinki</option>
                    </select><br>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>


            <?php
            if(isset($_POST['nr'])){
                $size = $_POST['size'];
                $nr = $_POST['nr'];
                $owner = "Bertschi";
                $containerType = $_POST['type'];
                $containerPosition = $_POST['position'];
                $patterns = array('/ /', '/-/', '/_/', '/,/', '/:/');
                $nr = preg_replace($patterns, "", $nr);
                $container = substr($nr,0, 11);

                if(Container::hasValidCode($container))
                {
                    $pdo = new ContainerDb();
                    $pdo->addToDb($container, $size, $owner, $containerType, $containerPosition );
                }else {
                    echo "<p><mark>". $nr ." is <b>not</b> a valid BIC Code!</mark></p>";
                }
            }
            ?>
            <hr>
            <div>
                <h2>Container Factory</h2>
                <h3>Build Container</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="owner">Owner</label>
                    <br>
                    <input type="text" id="owner" name="owner" placeholder="Bertschi Dürenäsch" required>
                    <br>
                    <label for="type">Type</label>
                    <br>
                    <select  id="type" name="type" >
                        <option>Dry Storage</option>
                        <option>ISO Tank</option>
                        <option>Open Top</option>
                        <option>Special Purpose</option>
                    </select>
                    <br>
                    <label for="size">Size</label>
                    <br>
                    <input type="number" id="size" name="size" value="33" >
                    <br>
                    <input type="submit" value="Submit" name="submit">
                </form>
                <?php

                if(isset($_POST['owner']))
                {
                    $owner = ($_POST['owner']);
                    $size = $_POST['size'];
                    $containerType = $_POST["type"];
                    $containerPosition = "Container Factory";
                    $ownerCode = "";
                    $owner = trim($owner);
                    if(strpos($owner, " "))
                    {
                        $arr = explode(" ",strtoupper($owner));
                        $ownerCode .= substr($arr[0],0,2);
                        $ownerCode .= substr($arr[1],0,1);
                    } else {
                        $ownerCode .= substr(strtoupper($owner), 0, 3);
                    }

                    $container =  Container::numberGenerator($ownerCode);
                    Container::addToDb($container, $size, $owner, $containerType, $containerPosition );
                }

                ?>
            </div>

        </div>



        <div class="col-6" id="stockList">
            <h2>In Stock</h2>

            <?php

            echo "<table style='border: solid 1px black;'>";
            echo "<tr><th>Container</th><th>Size</th><th>Owner</th><th>Type</th><th>Position</th></tr>";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM container_management LIMIT 101");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                    echo $v;
                }
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;

            ?>
        </div>



    </div>
</div>


<footer></footer>
</body>
</html>
