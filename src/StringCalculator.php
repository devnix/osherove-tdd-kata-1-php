<?php

declare(strict_types=1);

namespace App;

final class StringCalculator
{
    public function add(string $numbers): int
    {
        if ('' === $numbers) {
            return 0;
        }

        return (int)$numbers;
    }
}