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
    private function parseNumbers(string $numbers): iterable
    {
        $appendingNumber = '';

        foreach (str_split($numbers) as $character) {
            if ($character === ',' || $character === "\n") {
                $currentNumber = $appendingNumber;
                $appendingNumber = '';
                yield $this->toInt($currentNumber);
                continue;
            }

            $appendingNumber .= $character;
        }

        yield $this->toInt($appendingNumber);
    }
}