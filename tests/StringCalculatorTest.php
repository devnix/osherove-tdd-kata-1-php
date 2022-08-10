<?php

declare(strict_types=1);

namespace App\Tests;

use App\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }

    /**
     * @test
     */
    public function for_an_empty_string_it_should_return_zero(): void
    {
        $this->assertSame(0, $this->stringCalculator->add(''));
    }

    /**
     * @test
     */
    public function it_should_return_the_same_number_if_one_number_is_passed(): void
    {
        $this->assertSame(1, $this->stringCalculator->add('1'));
        $this->assertSame(75, $this->stringCalculator->add('75'));
        $this->assertSame(999, $this->stringCalculator->add('999'));
    }

    /**
     * @test
     */
    public function it_should_sum_if_two_numbers_are_passed(): void
    {
        $this->assertSame(3, $this->stringCalculator->add('1,2'));
        $this->assertSame(666, $this->stringCalculator->add('555,111'));
    }

    /**
     * @test
     */
    public function it_should_allow_to_pass_any_amount_of_parameters(): void
    {
        $this->assertSame(4, $this->stringCalculator->add('1,1,2'));
        $this->assertSame(12, $this->stringCalculator->add('1,1,2,3,5'));
        $this->assertSame(20, $this->stringCalculator->add('1,1,2,3,5,8'));
        $this->assertSame(33, $this->stringCalculator->add('1,1,2,3,5,8,13'));
    }
}
