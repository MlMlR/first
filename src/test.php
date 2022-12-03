<?php

xxx();
function xxx()
{
    $inputDay1 = file(__DIR__ . "/apps/AdventOfCode/MVC/Input2022/day01_2022.txt", FILE_IGNORE_NEW_LINES);
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