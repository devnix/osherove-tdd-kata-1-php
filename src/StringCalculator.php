<?php

declare(strict_types=1);

namespace App;

final class StringCalculator
{
    public function add(string $numbers): int
    {
        $listOfNumbers = $this->parseNumbers($numbers);

        $lastResult = 0;
        foreach ($listOfNumbers as $number) {
            $lastResult += $number;
        }

        return $lastResult;
    }

    private function toInt(string $number): int
    {
        return (int) $number;
    }

    /**
     * @param string $numbers
     *
     * @return iterable<int>
     */
    public function parseNumbers(string $numbers): iterable
    {
        $listOfNumbers = explode(',', $numbers);

        foreach ($listOfNumbers as $number) {
            yield $this->toInt($number);
        }

        return $listOfNumbers;
    }
}