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

    /**
     * @test
     */
    public function it_should_return_the_same_number_if_one_number_is_passed(): void
    {
        $stringCalculator = new StringCalculator();
        $this->assertSame(1, $stringCalculator->add('1'));
        $this->assertSame(75, $stringCalculator->add('75'));
        $this->assertSame(999, $stringCalculator->add('999'));
    }

    /**
     * @test
     */
    public function it_should_sum_if_two_numbers_are_passed(): void
    {
        $stringCalculator = new StringCalculator();
        $this->assertSame(3, $stringCalculator->add('1,2'));
        $this->assertSame(666, $stringCalculator->add('555,111'));
    }

    /**
     * @test
     */
    public function it_should_allow_to_pass_any_amount_of_parameters(): void
    {
        $stringCalculator = new StringCalculator();
        $this->assertSame(4, $stringCalculator->add('1,1,2'));
        $this->assertSame(12, $stringCalculator->add('1,1,2,3,5'));
        $this->assertSame(20, $stringCalculator->add('1,1,2,3,5,8'));
        $this->assertSame(33, $stringCalculator->add('1,1,2,3,5,8,13'));
    }
}
