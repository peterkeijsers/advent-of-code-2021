<?php

require __DIR__ . '/vendor/autoload.php';

$engineDiagnostics = New App\EngineDiagnostics(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');
echo $engineDiagnostics->getGammaRate();
echo "\n";
echo $engineDiagnostics->getEpsilonRate();
echo "\n";
echo $engineDiagnostics->getPowerConsumption();
