<?php

$data = explode(PHP_EOL, file_get_contents('./data.txt'));

// Part 1
$lastValue = null;
$valuesIncreased = array_filter($data, function($value) use (&$lastValue){
    $valueHasIncreased = ($lastValue && $value > $lastValue);
    $lastValue = $value;
    return $valueHasIncreased;
});

echo nl2br("Number of increased values \n");
echo count($valuesIncreased);

// Part 2
$previousWindow = [];
$currentWindow = [];
$increasedWindows = 0;
foreach($data as $key => $measurement) {
    $currentWindow = array_slice($data, $key, 3, true);
    if(count($currentWindow) != 3) break;

    if($previousWindow && $currentWindow && array_sum($currentWindow) > array_sum($previousWindow)){
        $increasedWindows++;
    }

    $previousWindow = $currentWindow;
};

echo nl2br("\n Number of increased chunks of 3 data-points \n");
echo $increasedWindows;