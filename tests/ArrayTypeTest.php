<?php

namespace Rayblair\ArrayType\Tests;

use ArgumentCountError;
use PHPUnit\Framework\TestCase;
use Rayblair\ArrayType\Tests\Classes\FooArrayType;
use TypeError;

class ArrayTypeTest extends TestCase
{
    /**
     * @test
     * Verifies that a FooArrayType can be created and populated with valid objects.
     * Ensures that the array properly stores and returns data as an array of associative arrays.
     */
    public function it_can_create_array()
    {
        $array = new FooArrayType();

        $array[] = ['id' => 1, 'name' => 'Ray'];
        $array[] = ['id' => 2, 'name' => 'Bob'];
        $array[] = ['id' => 3, 'name' => 'Alice'];

        $this->assertEquals([
            ['id' => 1, 'name' => 'Ray'],
            ['id' => 2, 'name' => 'Bob'],
            ['id' => 3, 'name' => 'Alice'],
        ], $array->toArray());
    }

    /**
     * @test
     * Verifies that an ArgumentCountError is thrown when a FooArrayType
     * is populated with invalid arguments for object instantiation (e.g., missing parameters).
     */
    public function it_throws_argument_count_error()
    {
        $this->expectException(ArgumentCountError::class);

        $array = new FooArrayType();

        $array[] = ['id' => 1, 'name' => 'Ray'];
        $array[] = ['id' => 2, 'name' => 'Bob'];
        $array[] = ['id' => 3, 'name' => 'Alice'];

        // This should throw an error due to missing the 'id' parameter.
        $array[] = ['name' => 'Alice'];
    }

    /**
     * @test
     * Verifies that a TypeError is thrown when a FooArrayType is populated
     * with values of incorrect types (e.g., non-integer IDs).
     */
    public function it_throws_type_error()
    {
        $this->expectException(TypeError::class);

        $array = new FooArrayType();

        // This should throw an error due to the ID being a string instead of an integer.
        $array[] = ['id' => '1', 'name' => 'Ray'];
        $array[] = ['id' => '2', 'name' => 'Bob'];
        $array[] = ['id' => '3', 'name' => 'Alice'];
    }
}
