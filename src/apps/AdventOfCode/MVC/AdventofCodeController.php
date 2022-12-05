<?php

namespace App\apps\AdventOfCode\MVC;

use App\apps\Util\AbstractMVC\AbstractController;

class AdventofCodeController extends AbstractController
{

    public function showResult()
    {
        $this->old();
    }

    public function old()
    {
        $draw = [38,54,68,93,72,12,33,8,98,88,21,91,53,61,26,36,18,80,73,47,3,5,55,92,67,52,25,40,56,95,9,62,30,31,85,65,14,2,78,75,15,39,87,27,58,42,60,32,41,83,51,77,10,66,70,4,37,6,89,23,16,49,48,63,94,97,86,64,74,82,7,0,11,71,44,43,50,69,45,81,20,28,46,79,90,34,35,96,99,59,1,76,22,24,17,57,13,19,84,29
        ];
        $input = file(__DIR__ . "/input_2021/day04.txt", FILE_IGNORE_NEW_LINES);
        $boards = [];
        $board = 0;
        for ($i = 0; $i < count($input); $i++) {
            if (empty($input[$i])){
                $board++;
            } else {
                $z = explode(" ",str_replace("  ", " ", $input[$i]));
                if ($z[0] == ""){
                    array_shift($z);
                }
                $boards[$board][] = $z;
            }

        }
        foreach( $boards as $board){
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

    public function day5(){

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
        foreach($stack as $pile){
            foreach ($pile as $container){
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

            echo "<br>move " . $amount . " containers from pile " . $from ." to pile " . $to . "<br>";

            for ( $i = 0; $i < $amount; $i++){
                $stack[0][] = array_pop($stack[$from]);
            }
            for ( $i = 0; $i < $amount; $i++){
                $stack[$to][] = array_pop($stack[0]);
            }

            foreach($stack as $pile){
                foreach ($pile as $container){
                    echo $container . ", ";
                    $t++;
                }
                echo "<br>";
            }
        }
    }



    public function day4(){
        $input = file(__DIR__ . "/Input2022/day04_2022.txt", FILE_IGNORE_NEW_LINES);
        $counter = 0;
        $overlapingSquares = [];
        for ( $i=0; $i<count($input); $i++){
            $elves = explode( ",",$input[$i]);
            $elve1Sqrs = explode("-", $elves[0]);
            $elve2Sqrs = explode("-", $elves[1]);
            $smal = max($elve1Sqrs[0],$elve2Sqrs[0]);
            $big = min($elve1Sqrs[1],$elve2Sqrs[1]);

            if (($big>=$smal)){
           $counter++;
            }
        }
        echo $counter;
    }



    public function day3b(){
        $input = [3,3];
//        $input = file(__DIR__ . "/Input2022/day03_2022.txt", FILE_IGNORE_NEW_LINES);


        $score = 0;
        $array0 = [];
        $array1 = [];
        $array2 = [];
        for ( $i = 0; $i < count($input);$i ++){
            if ($i%3 ==0){
                $array0[] = $input[$i];
            } elseif ($i%3 ==1){
                $array1[] = $input[$i];
            } elseif ($i%3 ==2){
                $array2[] = $input[$i];
            }
        }

        for ($j = 0 ; $j < count($array0); $j++) {
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
            if ( ord($commonCharacter[0])< 91){
                $score += ord($commonCharacter[0])-38;
                echo ord($commonCharacter[0])-38;
                echo "<br>";

            } else {
                $score += ord($commonCharacter[0])-96;
                echo ord($commonCharacter[0])-96;
                echo "<br>";
            }
            $commonCharacter = "";
            echo $score;
            echo "<br>";


        }
        echo $score;
        return $score;
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

    public function level2AdventOfCode(): int
    {
        $inputDay2 = file(__DIR__ . "/Input2022/day02_2022.txt", FILE_IGNORE_NEW_LINES);
        $scoreDay2 = 0;
        foreach ($inputDay2 as $line) {
            //1 for Rock, 2 for Paper , and 3 for Scissors
            //A for Rock, B for Paper, and C for Scissors
            // X lose, Y draw,  Z win
            if($line ==="A Y"){
                $scoreDay2 +=4;
            }
            elseif($line ==="B Y"){
                $scoreDay2 +=5;
            }
            elseif($line ==="C Y"){
                $scoreDay2 +=6;
            }
            elseif($line ==="A X"){
                $scoreDay2 +=3;
            }
            elseif($line ==="B X"){
                $scoreDay2 +=1;
            }
            elseif($line ==="C X"){
                $scoreDay2 +=2;
            }
            elseif($line ==="A Z"){
                $scoreDay2 +=8;
            }
            elseif($line ==="B Z"){
                $scoreDay2 +=9;
            }
            elseif($line ==="C Z"){
                $scoreDay2 +=7;
            }
        }
        return $scoreDay2;
    }

    public function level1AdventOfCode()
    {
        $inputDay1 = file(__DIR__ . "/Input2022/day01_2022.txt", FILE_IGNORE_NEW_LINES);
        $level1Result1 = 70116;
        $caloriesPerElf =[];
        $maxDay1 = 0;
        $currentDay1 = 0;
        foreach($inputDay1 as $line) {
            if(empty($line)){

                $caloriesPerElf[] = $currentDay1;
                if ($currentDay1 > $maxDay1){
                    $maxDay1 = $currentDay1;
                    $currentDay1 = 0;
                    //echo $maxDay1;
                    echo "<br>";
                }else{
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


}