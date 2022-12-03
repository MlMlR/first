<?php

namespace App\apps\AdventOfCode\MVC;

use App\apps\Util\AbstractMVC\AbstractController;

class AdventofCodeController extends AbstractController
{

    public function showResult()
    {
        $input = $this->day3b();
//        $this->pageload("AdventOfCode", "advent", [
//
//        ]);
    }

    public function day3b(){
        $input = file(__DIR__ . "/Input2022/day03_2022.txt", FILE_IGNORE_NEW_LINES);
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