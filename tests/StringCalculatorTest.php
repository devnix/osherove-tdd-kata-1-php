<?php

declare(strict_types=1);

namespace App\Tests;

use App\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function for_an_empty_string_it_should_return_zero(): void
    {
        $stringCalculator = new StringCalculator();
        $this->assertSame(0, $stringCalculator->add(''));
    }
}
