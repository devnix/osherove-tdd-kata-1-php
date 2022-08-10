<?php

declare(strict_types=1);

namespace App;

final class StringCalculator
{
    private const DELIMITERS = [
        ',',
        "\n",
    ];
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
        $result = (int) $number;

        if (0 > $result) {
            throw new \RuntimeException(sprintf('negatives not allowed %s', $result));
        }

        return $result;
    }

    /**
     * @param string $numbers
     *
     * @return iterable<int>
     */
    private function parseNumbers(string $numbers): iterable
    {
        $delimiters = $this->getDelimiters($numbers);

        $appendingNumber = '';

        foreach (str_split($numbers) as $character) {
            if (in_array($character, $delimiters, true)) {
                $currentNumber = $appendingNumber;
                $appendingNumber = '';
                yield $this->toInt($currentNumber);
                continue;
            }

            $appendingNumber .= $character;
        }

        yield $this->toInt($appendingNumber);
    }

    private function hasDelimiterHeader(string $input): bool
    {
        return str_starts_with($input, '//');
    }

    private function parseDelimiterHeader(string $input): ?string
    {
        if (!$this->hasDelimiterHeader($input)) {
            return null;
        }

        // Supposing that delimiters are 1 char long
        return substr($input, 2, 1);
    }

    /**
     * @param string $input
     *
     * @return array<string>
     */
    public function getDelimiters(string $input): array
    {
        $customDelimiter = $this->parseDelimiterHeader($input);

        if (null !== $customDelimiter) {
            return [$customDelimiter];
        }

        return self::DELIMITERS;
    }
}