<?php

namespace Rayblair\CollectionType\Tests;

use ArgumentCountError;
use PHPUnit\Framework\TestCase;
use Rayblair\CollectionType\Tests\Classes\FooCollection;
use TypeError;

class CollectionTest extends TestCase
{
    /**
     * @test
     * Verifies that a FooCollection can be created and populated with valid objects.
     * Ensures that the collection properly stores and returns data as an array of associative arrays.
     */
    public function it_can_create_collection()
    {
        $collection = new FooCollection();

        $collection[] = ['id' => 1, 'name' => 'Ray'];
        $collection[] = ['id' => 2, 'name' => 'Bob'];
        $collection[] = ['id' => 3, 'name' => 'Alice'];

        $this->assertEquals([
            ['id' => 1, 'name' => 'Ray'],
            ['id' => 2, 'name' => 'Bob'],
            ['id' => 3, 'name' => 'Alice'],
        ], $collection->toArray());
    }

    /**
     * @test
     * Verifies that an ArgumentCountError is thrown when a FooCollection
     * is populated with invalid arguments for object instantiation (e.g., missing parameters).
     */
    public function it_throws_argument_count_error()
    {
        $this->expectException(ArgumentCountError::class);

        $collection = new FooCollection();

        $collection[] = ['id' => 1, 'name' => 'Ray'];
        $collection[] = ['id' => 2, 'name' => 'Bob'];
        $collection[] = ['id' => 3, 'name' => 'Alice'];

        // This should throw an error due to missing the 'id' parameter.
        $collection[] = ['name' => 'Alice'];
    }

    /**
     * @test
     * Verifies that a TypeError is thrown when a FooCollection is populated
     * with values of incorrect types (e.g., non-integer IDs).
     */
    public function it_throws_type_error()
    {
        $this->expectException(TypeError::class);

        $collection = new FooCollection();

        // This should throw an error due to the ID being a string instead of an integer.
        $collection[] = ['id' => '1', 'name' => 'Ray'];
        $collection[] = ['id' => '2', 'name' => 'Bob'];
        $collection[] = ['id' => '3', 'name' => 'Alice'];
    }
}
