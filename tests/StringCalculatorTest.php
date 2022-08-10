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

    /**
     * @test
     */
    public function it_should_allow_to_handle_new_lines_between_numbers_as_separator(): void
    {
         $this->assertSame(6, $this->stringCalculator->add("1\n2,3"));
         $this->assertSame(6, $this->stringCalculator->add("1,2\n3"));
         $this->assertSame(10, $this->stringCalculator->add("1,2\n3,4"));
    }

    /**
     * @test
     */
    public function it_should_support_parsing_defined_delimiters_in_a_header(): void
    {
         $this->assertSame(3, $this->stringCalculator->add("//;\n1;2"));
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_a_negative_number_is_passed_and_which_one_was(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('negatives not allowed -2');
        $this->stringCalculator->add("1,-2");
    }

    /**
     * @test
     */
    public function if_there_is_more_than_one_negative_number_they_should_all_be_in_the_exception(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('negatives not allowed -1 -2 -4');
        $this->stringCalculator->add("-1,-2, 3,-4");
    }

    /**
     * @test
     */
    public function it_should_have_a_method_to_count_how_many_times_add_was_invoked(): void
    {
        $this->assertEquals(0, $this->stringCalculator->getCalledCount());
        $this->stringCalculator->add('');
        $this->stringCalculator->add('');
        $this->assertEquals(2, $this->stringCalculator->getCalledCount());
        $this->stringCalculator->add('1,1');
        $this->assertEquals(3, $this->stringCalculator->getCalledCount());
    }

    /**
     * @test
     */
    public function it_should_ignore_numbers_bigger_than_1000(): void
    {
        $this->assertSame(2, $this->stringCalculator->add('2,1001'));
        $this->assertSame(3, $this->stringCalculator->add('1,2,1001'));
    }
}
