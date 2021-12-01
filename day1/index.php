<?php

$data = explode(PHP_EOL, file_get_contents('./data.txt'));

$lastValue = null;
$valuesIncreased = array_filter($data, function($value) use (&$lastValue){
    $valueHasIncreased = ($lastValue && $value > $lastValue);
    $lastValue = $value;
    return $valueHasIncreased;
});

echo count($valuesIncreased);