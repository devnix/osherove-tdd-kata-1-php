<?php

declare(strict_types=1);

namespace App;

use Traversable;

final class StringCalculator
{
    private const DELIMITERS = [
        ',',
        "\n",
    ];

    public function add(string $numbers): int
    {
        $listOfNumbers = iterator_to_array($this->parseNumbers($numbers));

        $this->assertAllNumbersArePositive($listOfNumbers);

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
     * @return Traversable<int>
     */
    private function parseNumbers(string $numbers): Traversable
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
    private function getDelimiters(string $input): array
    {
        $customDelimiter = $this->parseDelimiterHeader($input);

        if (null !== $customDelimiter) {
            return [$customDelimiter];
        }

        return self::DELIMITERS;
    }

    private function assertAllNumbersArePositive(array $numbers): void
    {
        $negativeNumbers = [];

        foreach ($numbers as $number) {
            if (0 > $number) {
                $negativeNumbers[] = $number;
            }
        }

        if ([] !== $negativeNumbers) {
            throw new \RuntimeException(
                sprintf('negatives not allowed %s', implode(' ', $negativeNumbers))
            );
        }
    }
}