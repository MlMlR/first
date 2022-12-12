<?php

namespace App\apps\AdventOfCode\MVC;

use App\apps\Util\AbstractMVC\AbstractController;

class AdventofCodeController extends AbstractController
{

    public function showResult()
    {
        $this->day11();
    }
    //20 rounds

    public function day11()
    {
        $starttime = microtime(true);
        $input = file(__DIR__ . "/Input2022/day11_2022.txt", FILE_IGNORE_NEW_LINES);

        $testnumbers = array(13, 7, 19, 2, 5, 3, 11, 17);
        $mod = 13*7*19*2*5*3*11*17;
        $modt = 23*19*13*17;
        $tetestnumbers = array(23, 19, 13, 17);
        $monkeys = array();
        $throws = array();
        for ($i = 0; $i < 8;$i++)
        {
            $startingline = $i*7;

            $items = substr($input[$startingline+1],18);
            $n = explode(",",$items);
            foreach ($n as $item){
                $monkeys[$i][] = intval($item);
            }
        }
        //Monkey 3:
        //  Starting items: 74
        //  Operation: new = old + 3
        //  Test: divisible by 17
        //    If true: throw to monkey 0
        //    If false: throw to monkey 1

        //number of rounds
        for($j = 0; $j < 10000; $j++)
        {
            echo "round: ".$j."<br>";

            //number of monkeys
            for ($i = 0; $i < 8;$i++)
            {
                echo "monkey: ".$i." has ".count($monkeys[$i])." items<br>";
                $startingline = $i*7;
                $testnumber = $testnumbers[$i];

                foreach($monkeys[$i] as $item)
                {
//                    if ($i == 0){           //for tet input
//                        $item *= 19;
//                    } elseif ($i == 1){
//                        $item += 6;
//                    } elseif ($i == 2){
//                        $item = $item*$item;
//                    } elseif ($i == 3){
//                        $item += 3;
//                    }
                    if ($i == 0){
                        $item *= 17;
                    } elseif ($i == 1){
                        $item += 8;
                    } elseif ($i == 2){
                        $item += 6;
                    } elseif ($i == 3){
                        $item *= 19;
                    } elseif ($i == 4){
                        $item += 7;
                    } elseif ($i == 5){
                        $item = $item*$item;
                    } elseif ($i == 6){
                        $item += 1;
                    } elseif ($i == 7){
                        $item += 2;
                    }
                    $item %= $mod;

                    if($item % $testnumber === 0)
                    {
                        $recieverline = explode(" ", $input[$startingline + 4]);
                    }
                    else
                    {
                        $recieverline = explode(" ", $input[$startingline + 5]);
                    }
                    $reciever = $recieverline[9];
                    echo " to".$reciever;
                    $monkeys[$reciever][]= $item;
                }
                while (count($monkeys[$i])>0){
                    $throws[$i]++;
                    array_pop($monkeys[$i]);
                }
                echo "<br>";
            }
        }
        foreach ($monkeys as $m){
            var_dump($m);
            echo"<br>";
        }
        foreach ($throws as $t){
            echo $t."<br>";
        }
        echo"res; ". 120377 *148916 ."<br>";

        $endtime = microtime(true);
        echo "starttime; ". $starttime ."<br>";
        echo "endtime; ". $endtime ."<br>";
        echo "time; ". $endtime-$starttime ."<br>";
    }



        public function day10(){
        $input = file(__DIR__ . "/Input2022/day10_2022.txt", FILE_IGNORE_NEW_LINES);

        //It seems like the X register controls the horizontal position of a sprite. Specifically,
        // the sprite is 3 pixels wide, and the X register sets the horizontal position of the middle of that sprite.
        // (In this system, there is no such thing as "vertical position": if the sprite's horizontal position puts its
        // pixels where the CRT is currently drawing, then those pixels will be drawn.)
        //You count the pixels on the CRT: 40 wide and 6 high. This CRT screen draws the top row of pixels left-to-right,
        // then the row below that, and so on. The left-most pixel in each row is in position 0, and the right-most pixel
        // in each row is in position 39.
        //Like the CPU, the CRT is tied closely to the clock circuit: the CRT draws a single pixel during each cycle.
        // Representing each pixel of the screen as a #, here are the cycles during which the first and last pixel in each row are drawn:
        //
        //Cycle   1 -> ######################################## <- Cycle  40
        //Cycle  41 -> ######################################## <- Cycle  80
        //Cycle  81 -> ######################################## <- Cycle 120
        //Cycle 121 -> ######################################## <- Cycle 160
        //Cycle 161 -> ######################################## <- Cycle 200
        //Cycle 201 -> ######################################## <- Cycle 240

        //So, by carefully timing the CPU instructions and the CRT drawing operations, you should be able to determine whether
        // the sprite is visible the instant each pixel is drawn. If the sprite is positioned such that one of its three pixels
        // is the pixel currently being drawn, the screen produces a lit pixel (#); otherwise, the screen leaves the pixel dark (.).

        $spritePositionX = 1;
        $cycles = 0;
        $TotalSignalStrength = 0;

        foreach($input as $line) {
            $line = trim($line);
            $line = explode(" ", $line);
            $command = $line[0];
            $value = intval($line[1]);
            if ($command == "addx") {
                if($spritePositionX-1 <= ($cycles%40) &&
                    $spritePositionX+1 >= ($cycles%40))
                {
                    echo "####";
                } else {
                    echo ". . ";
                }
                $cycles++;
                if ($cycles % 40 == 0){
                    echo "<br>";
                }
                if($spritePositionX-1 <= ($cycles%40) &&
                    $spritePositionX+1 >= ($cycles%40))
                {
                    echo "####";
                } else {
                    echo ". . ";
                }
                $cycles++;
                if ($cycles % 40 == 0){
                    echo "<br>";
                }
                $spritePositionX += $value;
            }
            if ($command == "noop"){
                if($spritePositionX-1 <= ($cycles%40) &&
                    $spritePositionX+1 >= ($cycles%40))
                {
                    echo "####";
                } else {
                    echo ". . ";
                }
                $cycles++;
                if ($cycles % 40 == 0){
                    echo "<br>";
                }
            }
        }
    }

    private function day9()
    {
        $input = file(__DIR__ . "/Input2022/test.txt", FILE_IGNORE_NEW_LINES);
        $positions = ["0,0"];
        // test should be 36
        $h = [
            "x" => 0,
            "y" => 0
        ];

        $t = [
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0],
            ["x" => 0, "y" => 0]
        ];

        foreach ($input as $line) {
            $directions = explode(" ", $line);
            echo $line."<br>";
            for ($j = 0; $j < $directions[1]; $j++) {
                switch ($directions[0]) {
                    case "R":
                        $t[0]["x"]++;
                        break;
                    case "L":
                        $t[0]["x"]--;
                        break;
                    case "U":
                        $t[0]["y"]--;
                        break;
                    case "D":
                        $t[0]["y"]++;
                        break;
                    default:
                        echo "error";
                }
                for($i=1; $i < 10; $i++){
                    if (abs($t[$i]["y"] - $t[$i-1]["y"]) > 1 &&
                        $t[$i]["x"] - $t[$i-1]["x"] == 0)
                    {
                        echo " y ".$i." ";
                        $t[$i]["y"] = ($t[$i-1]["y"] + $t[$i]["y"])/2;
                    }
                    elseif (abs($t[$i]["x"] - $t[$i-1]["x"]) > 1 &&
                        $t[$i]["y"] - $t[$i-1]["y"] == 0)
                    {
                        $t[$i]["x"] = ($t[$i-1]["x"] + $t[$i]["x"])/2;
                        echo " x ".$i." ";
                    }
                    elseif (abs($t[$i]["x"] - $t[$i-1]["x"]) > 1 &&
                        abs($t[$i]["y"] - $t[$i-1]["y"]) == 1)
                    {
                        $t[$i]["x"] = $t[$i-1]["x"];
                        $t[$i]["y"] = ($t[$i]["y"] + $t[$i-1]["y"])/2;
                        echo " xy ".$i." ";
                    }
                    elseif (abs($t[$i]["y"] - $t[$i-1]["y"]) > 1 &&
                        abs($t[$i]["x"] - $t[$i-1]["x"]) == 1)
                    {
                        echo " yx ".$i." ";
                        $t[$i]["y"] = $t[$i-1]["y"];
                        $t[$i]["x"] = ($t[$i]["x"] + $t[$i-1]["x"])/2;
                    }
                }
                $positions[] = implode(",", $t[9]);

                echo "<br>";
            }
        }
        $uniques = array_unique($positions);
        echo count($uniques)."<br>";
        var_dump($uniques);
    }

    public function day8()
    {
        $input = file(__DIR__ . "/Input2022/day08_2022.txt", FILE_IGNORE_NEW_LINES);
        $count = -4;
        $forest = [];
        foreach ($input as $r) {
            $forest[] = str_split($r);
        }
        $count += count($forest[0]) * 2;
        $count += count($forest) * 2;
        $bestTree = 0;
        for ($row = 1; $row <= count($forest) - 2; $row++) {
            for ($col = 1; $col <= count($forest[0]) - 2; $col++) {
                $value = $forest[$row][$col];
                //echo "$value is checked<br>";
                $n = 0;
                for ($i = $row - 1; $i >= 0; $i--) {
                    $n++;
                    if ($forest[$i][$col] >= $value) {
                        break;
                    }
                }
                //echo "n: ".$n."<br>";

                $w = 0;
                for ($i = $col - 1; $i >= 0; $i--) {
                    $w++;
                    if ($forest[$row][$i] >= $value) {
                        break;
                    }
                }
                //echo "w: ".$w."<br>";

                $e = 0;
                for ($i = $col + 1; $i < count($forest[0]); $i++) {
                    $e++;
                    if ($forest[$row][$i] >= $value) {
                        break;
                    }
                }
                //echo "e: ".$e."<br>";

                $s = 0;
                for ($i = $row + 1; $i < count($forest); $i++) {
                    $s++;
                    if ($forest[$i][$col] >= $value) {
                        break;
                    }
                }
                //echo "s: ".$s."<br>";

                $view = $n * $w * $e * $s;

                if ($view > $bestTree) {
                    $bestTree = $view;
                }
                //echo "v is: ".$view."<br>";
            }
        }
        echo "best view is: " . $bestTree;
    }

    public function day7()
    {
        //$arr["key"] = "value";
        $input = file(__DIR__ . "/Input2022/day07_2022.txt", FILE_IGNORE_NEW_LINES);
        $dirctories = [
            '/' => 0
        ];
        $currentdir = [];

        foreach ($input as $line) {
            $comand = explode(" ", $line);
            //var_dump($comand);
            //echo "<br>";
            if ($comand[1] == "cd") {
                if ($comand[2] == "/") {
                    $currentdir = ["/"];
                } else if ($comand[2] == "..") {
                    array_pop($currentdir);
                } else {
                    $currentdir[] = $comand[2];
                    $path = implode("__", $currentdir);
                    if (!array_key_exists($path, $dirctories)) {
                        $dirctories[$path] = 0;
                    }

                }
            } elseif ($comand[0] == "dir" || $comand[0] == "$" || $comand[0] == "ls") {
                echo "";
            } else {
                $path = implode("__", $currentdir);
                $path .= "--";
                $path .= $comand[1];
                if (!array_key_exists($path, $dirctories)) {
                    $dirctories[$path] = 0;
                    $coppie = $currentdir;
                    while (count($coppie) > 0) {
                        $path = implode("__", $coppie);
                        $dirctories[$path] += intval($comand[0]);
                        array_pop($coppie);
                    }
                }
            }
        }
        $sumlevel1 = 42143088;
        $possible = [];
        foreach ($dirctories as $key => $value) {
            if ($sumlevel1 - $value < 40000000) {
                $possible[$key] = $value;
            }
        }
        rsort($possible);

        foreach ($possible as $key => $value) {
            echo $key . "__________" . $value . "<br>";
        }

    }

    public function day6()
    {
        echo "2472<br>";
        $input = file(__DIR__ . "/Input2022/day06_2022.txt", FILE_IGNORE_NEW_LINES);
        $str = $input[0];
        for ($i = 0; $i < strlen($str) - 14; $i++) {
            if (strlen(count_chars(substr($str, $i, 14), 3)) == 14) {
                echo $i + 14;
                echo "<br>";
            }
        }
    }

    public function old()
    {
        $draw = [38, 54, 68, 93, 72, 12, 33, 8, 98, 88, 21, 91, 53, 61, 26, 36, 18, 80, 73, 47, 3, 5, 55, 92, 67, 52, 25, 40, 56, 95, 9, 62, 30, 31, 85, 65, 14, 2, 78, 75, 15, 39, 87, 27, 58, 42, 60, 32, 41, 83, 51, 77, 10, 66, 70, 4, 37, 6, 89, 23, 16, 49, 48, 63, 94, 97, 86, 64, 74, 82, 7, 0, 11, 71, 44, 43, 50, 69, 45, 81, 20, 28, 46, 79, 90, 34, 35, 96, 99, 59, 1, 76, 22, 24, 17, 57, 13, 19, 84, 29
        ];
        $input = file(__DIR__ . "/input_2021/day04.txt", FILE_IGNORE_NEW_LINES);
        $boards = [];
        $board = 0;
        for ($i = 0; $i < count($input); $i++) {
            if (empty($input[$i])) {
                $board++;
            } else {
                $z = explode(" ", str_replace("  ", " ", $input[$i]));
                if ($z[0] == "") {
                    array_shift($z);
                }
                $boards[$board][] = $z;
            }

        }
        foreach ($boards as $board) {
            $this->drawBingoBoard($board);
            echo "<br>";

        }
    }

    public function drawBingoBoard($board)
    {
        foreach ($board as $row) {
            foreach ($row as $field) {
                echo $field . ", ";
            }
            echo "<br>";
        }
    }

    public function day5()
    {

//        [M]     [W] [M]
//        [L] [Q] [S] [C] [R]
//        [Q] [F] [F] [T] [N] [S]
//        [N]     [V] [V] [H] [L] [J] [D]
//        [D] [D] [W] [P] [G] [R] [D] [F]
//        [T] [T] [M] [G] [G] [Q] [N] [W] [L]
//        [Z] [H] [F] [J] [D] [Z] [S] [H] [Q]
//        [B] [V] [B] [T] [W] [V] [Z] [Z] [M]
//         1   2   3   4   5   6   7   8   9

        $stack = array(
            ["placeholder"],
            ["B", "Z", "T"],
            ["T", "H", "T", "D", "N"],
            ["B", "F", "M", "D"],
            ["T", "J", "G", "W", "V", "Q", "L"],
            ["W", "D", "G", "P", "V", "F", "Q", "M"],
            ["V", "Z", "Q", "G", "H", "F", "S"],
            ["Z", "S", "N", "R", "L", "T", "C", "W"],
            ["Z", "H", "W", "D", "J", "N", "R", "M"],
            ["M", "Q", "L", "F", "D", "S"],
        );

        $input = file(__DIR__ . "/Input2022/day05_2022.txt", FILE_IGNORE_NEW_LINES);
//        move 1 from 7 to 4
        // not RTWZSGHFV

        $r = 0;
        foreach ($stack as $pile) {
            foreach ($pile as $container) {
                echo $container . ", ";
                $r++;
            }
            echo "<br>";
        }
        echo "<br>start moving<br><br>";


        foreach ($input as $moves) {
            $split = explode(" ", $moves);
            $amount = $split[1];
            $from = $split[3];
            $to = $split[5];

            echo "<br>move " . $amount . " containers from pile " . $from . " to pile " . $to . "<br>";

            for ($i = 0; $i < $amount; $i++) {
                $stack[0][] = array_pop($stack[$from]);
            }
            for ($i = 0; $i < $amount; $i++) {
                $stack[$to][] = array_pop($stack[0]);
            }

            foreach ($stack as $pile) {
                foreach ($pile as $container) {
                    echo $container . ", ";
                    $t++;
                }
                echo "<br>";
            }
        }
    }

    public function day4()
    {
        $input = file(__DIR__ . "/Input2022/day04_2022.txt", FILE_IGNORE_NEW_LINES);
        $counter = 0;
        $overlapingSquares = [];
        for ($i = 0; $i < count($input); $i++) {
            $elves = explode(",", $input[$i]);
            $elve1Sqrs = explode("-", $elves[0]);
            $elve2Sqrs = explode("-", $elves[1]);
            $smal = max($elve1Sqrs[0], $elve2Sqrs[0]);
            $big = min($elve1Sqrs[1], $elve2Sqrs[1]);

            if (($big >= $smal)) {
                $counter++;
            }
        }
        echo $counter;
    }

    public function day3b()
    {
        $input = [3, 3];
//        $input = file(__DIR__ . "/Input2022/day03_2022.txt", FILE_IGNORE_NEW_LINES);


        $score = 0;
        $array0 = [];
        $array1 = [];
        $array2 = [];
        for ($i = 0; $i < count($input); $i++) {
            if ($i % 3 == 0) {
                $array0[] = $input[$i];
            } elseif ($i % 3 == 1) {
                $array1[] = $input[$i];
            } elseif ($i % 3 == 2) {
                $array2[] = $input[$i];
            }
        }

        for ($j = 0; $j < count($array0); $j++) {
            $commonCharacter = "";
            $backpack0 = $array0[$j];
            $backpack1 = $array1[$j];
            $backpack2 = $array2[$j];
            echo $backpack0;
            echo "<br>";
            echo $backpack1;
            echo "<br>";
            echo $backpack2;
            echo "<br>";

            for ($k = 0; $k < strlen($backpack0); $k++) {
                for ($l = 0; $l < strlen($backpack1); $l++) {
                    if ($backpack0[$k] == $backpack1[$l]) {
                        for ($m = 0; $m < strlen($backpack2); $m++) {
                            if ($backpack1[$l] == $backpack2[$m]) {
                                $commonCharacter .= $backpack2[$m];
                            }
                        }
                    }
                }
            }
            echo $commonCharacter[0];
            echo "<br>";
            if (ord($commonCharacter[0]) < 91) {
                $score += ord($commonCharacter[0]) - 38;
                echo ord($commonCharacter[0]) - 38;
                echo "<br>";

            } else {
                $score += ord($commonCharacter[0]) - 96;
                echo ord($commonCharacter[0]) - 96;
                echo "<br>";
            }
            $commonCharacter = "";
            echo $score;
            echo "<br>";


        }
        echo $score;
        return $score;
    }

    public function level2AdventOfCode(): int
    {
        $inputDay2 = file(__DIR__ . "/Input2022/day02_2022.txt", FILE_IGNORE_NEW_LINES);
        $scoreDay2 = 0;
        foreach ($inputDay2 as $line) {
            //1 for Rock, 2 for Paper , and 3 for Scissors
            //A for Rock, B for Paper, and C for Scissors
            // X lose, Y draw,  Z win
            if ($line === "A Y") {
                $scoreDay2 += 4;
            } elseif ($line === "B Y") {
                $scoreDay2 += 5;
            } elseif ($line === "C Y") {
                $scoreDay2 += 6;
            } elseif ($line === "A X") {
                $scoreDay2 += 3;
            } elseif ($line === "B X") {
                $scoreDay2 += 1;
            } elseif ($line === "C X") {
                $scoreDay2 += 2;
            } elseif ($line === "A Z") {
                $scoreDay2 += 8;
            } elseif ($line === "B Z") {
                $scoreDay2 += 9;
            } elseif ($line === "C Z") {
                $scoreDay2 += 7;
            }
        }
        return $scoreDay2;
    }

    public function level1AdventOfCode()
    {
        $inputDay1 = file(__DIR__ . "/Input2022/day01_2022.txt", FILE_IGNORE_NEW_LINES);
        $level1Result1 = 70116;
        $caloriesPerElf = [];
        $maxDay1 = 0;
        $currentDay1 = 0;
        foreach ($inputDay1 as $line) {
            if (empty($line)) {

                $caloriesPerElf[] = $currentDay1;
                if ($currentDay1 > $maxDay1) {
                    $maxDay1 = $currentDay1;
                    $currentDay1 = 0;
                    //echo $maxDay1;
                    echo "<br>";
                } else {
                    $currentDay1 = 0;
                }
            } else {
                $currentDay1 += intval($line);
            }
        }
        echo $maxDay1;
        rsort($caloriesPerElf);
        var_dump($caloriesPerElf);
        echo "<br>";
        echo $caloriesPerElf[0] + $caloriesPerElf[1] + $caloriesPerElf[2];
    }

    private function lookUp($forest, int $row, int $col, int $value): bool
    {
        $r = 0;
        for ($i = $row - 1; $i >= 0; $i--) {
            $r++;
            if ($forest[$i][$col] >= $value) {
                return $r;
            }
        }
        return $r;
    }

    private function lookLeft($forest, int $row, int $col, int $value): bool
    {
        $r = 0;
        for ($i = $col - 1; $i >= 0; $i--) {
            $r++;
            if ($forest[$row][$i] >= $value) {
                return $r;
            }
        }
        return $r;
    }

    /*Lowercase item types a through z have priorities 1 through 26.
    Uppercase item types A through Z have priorities 27 through 52.*/
//    public function day3(): int
//    {
//        $chars = "";
//        $score = 0;
//        $input = file(__DIR__ . "/Input2022/day03_2022.txt", FILE_IGNORE_NEW_LINES);
//        foreach ($input as $line){
//            $h =intval((strlen($line)/2));
//            $fh = substr($line,0,$h);
//            echo $fh;
//            echo "<br>";
//            $sh = substr($line,$h);
//            echo $sh;
//            echo "<br>";
//            for ($i = 0; $i < strlen($fh); $i++){
//                for ($j = 0; $j < strlen($sh); $j++){
//                    if(ord($fh[$i]) == ord($sh[$j])){
//                        $chars .= $fh[$i];
//                    }
//                }
//            }
//            if ( ord($chars[0])< 91){
//                $score += ord($chars[0])-38;
//                echo ord($chars[0])-38;
//                echo "<br>";
//            } else {
//                $score += ord($chars[0])-96;
//                echo ord($chars[0])-96;
//                echo "<br>";
//            }
//            echo $chars;
//            echo "<br>";
//            $chars = "";
//        }
//        echo $score;
//        return "tt";
//    }

    private function lookRight(array $forest, int $row, int $col, int $value): bool
    {
        $r = 0;
        for ($i = $col + 1; $i < count($forest[0]); $i++) {
            $r++;
            if ($forest[$row][$i] >= $value) {
                return $r;
            }
        }
        return $r;
    }

    private function lookDown(array $forest, int $row, int $col, int $value): bool
    {
        $r = 0;
        for ($i = $row + 1; $i < count($forest); $i++) {
            $r++;
            if ($forest[$i][$col] >= $value) {
                return $r;
            }
        }
        return $r;
    }


}