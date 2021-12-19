<?php

namespace App;

use function PHPUnit\Framework\throwException;

class EngineDiagnostics
{
    private int $diagnosticsValueLength = 12;

    private string $rawDiagnosticsData;

    private array $diagnosticsData;

    private string $gammaRate;

    private string $epsilonRate;

    public function __construct(string $diagnosticsFilePath)
    {
        $this->readDiagnosticsFile($diagnosticsFilePath);
        $this->parseRawDiagnosticsData();
        $this->calculateGammaEpsilonRates();
    }

    private function readDiagnosticsFile(string $filePath): self
    {
        $this->rawDiagnosticsData = file_get_contents($filePath);

        return $this;
    }

    private function parseRawDiagnosticsData(): self
    {
        if(!$this->rawDiagnosticsData){
            throwException(new \Exception("No raw diagnostics data available. Read diagnostics file fist before parsing it."));
        }

        $this->diagnosticsData = explode(PHP_EOL, $this->rawDiagnosticsData);

        return $this;
    }

    /**
     * Determine most common bit in the corresponding position of all numbers in the diagnostic report
     * This makes the gamma rate
     */
    public function calculateGammaEpsilonRates(): self
    {
        $gammaRate = [];
        $epsilonRate = [];
        $bitCountPerPosition = [];
        $position = 0;

        while($position < $this->diagnosticsValueLength)
        {
            $bitCountPerPosition[$position] = [0 => 0, 1 => 0];
            foreach($this->diagnosticsData as $diagnosticsData){
                $bit = substr($diagnosticsData, $position, 1);
                $bitCountPerPosition[$position][$bit]++;
            }

            // Use te most common bit to set the Gamma rate
            // Use the most uncommon bit to set the Epsilon rate
            if($bitCountPerPosition[$position][0] > $bitCountPerPosition[$position][1]) {
                // 0 is the most common bit
                $gammaRate[] = 0;
                $epsilonRate[] = 1;
            } else {
                // 1 is the most common bit
                $gammaRate[] = 1;
                $epsilonRate[] = 0;
            }

            $position++;
        }

        $this->gammaRate = implode($gammaRate);
        $this->epsilonRate = implode($epsilonRate);

        return $this;
    }

    public function calculateOxygenGeneratorRating(): self
    {
        return $this;
    }

    public function CalculateCO2ScrubberRating(): self
    {
        return $this;
    }

    public function getGammaRate(): string
    {
        return $this->gammaRate;
    }

    public function getEpsilonRate(): string
    {
        return $this->epsilonRate;
    }

    public function getPowerConsumption(): int
    {
        return bindec($this->gammaRate) * bindec($this->epsilonRate);
    }

}