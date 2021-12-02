<?php

$input = explode(PHP_EOL, file_get_contents('./input.txt'));

// Part 1

$horizontalPosition = 0;
$verticalPosition = 0;
$move = function ($direction, $amount) use (&$horizontalPosition, &$verticalPosition){
    switch ($direction) {
        case 'forward';
            $horizontalPosition += $amount;
            break;
        case 'down';
            $verticalPosition  += $amount;
            break;
        case 'up';
            $verticalPosition  -= $amount;
            break;
    }
};

foreach ($input as $movement) {
    list($direction, $amount) = explode(' ', $movement);
    $move($direction, $amount);
};

echo nl2br("Horizontal position \n");
echo $horizontalPosition;

echo nl2br("\n vertical position \n");
echo $verticalPosition;

echo nl2br("\n Multiply of horizontal and vertical position \n");
echo $horizontalPosition * $verticalPosition;


// Part 2

