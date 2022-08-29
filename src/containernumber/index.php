
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Containerterminal1</title>
    <link rel="stylesheet" href="/src/containernumber/ContainerStyle.css">
</head>

<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once('Container.php');
$servername = "db";
$username = "root";
$password = "root";
$dbname = "main";
?>


<header>
    <nav class="topnav">
        <a href="/">Home</a>
        <a href="/src/snake/index.html">snake</a>
        <a class="active" href="index.php">Container</a>
    </nav>
</header>



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
                    <label for="nr">Container Nr.</label>
                    <br>
                    <input type="text" id="nr" name="nr" placeholder="DIDU-060005 3" >
                    <br>
                    <label for="size">Size</label>
                    <br>
                    <input type="number" id="size" name="size" value="33" >
                    <br>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>


            <?php
            if(isset($_POST['nr'])){
                $size = $_POST['size'];
                $nr = $_POST['nr'];
                $patterns = array('/ /', '/-/', '/_/', '/,/', '/:/');
                $nr = preg_replace($patterns, "", $nr);
                $container = substr($nr,0, 11);

                if(Container::hasValidCode($container))
                {
                    Container::addToDb($container, $size);
                }else {
                    echo "<p><mark>". $nr ." is <b>not</b> a valid BIC Code!</mark></p>";
                }
            }
            ?>
            <hr>
            <div>
                <h2>Create Container</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="owner">Owner (3 letter code)</label>
                    <br>
                    <input type="text" id="owner" name="owner" pattern="[A-Za-z]{3}" placeholder="BDUE" required>
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
                    $owner = strtoupper($_POST['owner']);
                    $size = $_POST['size'];
                    $container =  Container::numberGenerator($owner);
                    Container::addToDb($container, $size);
                }

                ?>
            </div>

        </div>



        <div class="col-3" id="stockList">
            <h2>In Stock</h2>

            <?php
            class TableRows extends RecursiveIteratorIterator {
                function __construct($it) {
                    parent::__construct($it, self::LEAVES_ONLY);
                }

                function current() {
                    return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
                }

                function beginChildren() {
                    echo "<tr>";
                }

                function endChildren() {
                    echo "</tr>" . "\n";
                }
            }
            echo "<table style='border: solid 1px black;'>";
            echo "<tr><th>Container</th><th>Size</th></tr>";

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
