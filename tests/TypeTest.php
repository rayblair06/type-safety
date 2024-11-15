<?php

namespace Rayblair\ArrayType\Tests;

use PHPUnit\Framework\TestCase;
use Rayblair\ArrayType\Tests\Classes\FooType;
use Rayblair\ArrayType\Type;
use stdClass;
use TypeError;

class TypeTest extends TestCase
{
    /**
     * @test
     * Verifies that a FooType can be created and type checked.
     * Ensures that the class object is properly instantisated and matches our expected type
     */
    public function it_can_create_class_type()
    {
        $class = new FooType(1, 'Ray');

        $class = type($class, FooType::class);

        $this->assertInstanceOf(FooType::class, $class);
    }

    /**
     * @test
     * Verifies that a string variable can be created and type checked.
     * Ensures that the string variable is properly created and matches our expected type
     */
    public function it_can_create_string_type()
    {
        $string = 'Foo';

        $string = type($string, Type::STRING);

        $this->assertIsString(
            $string,
        );
    }

    /**
     * @test
     * Verifies that a integer variable can be created and type checked.
     * Ensures that the integer variable is properly created and matches our expected type
     */
    public function it_can_create_integer_type()
    {
        $integer = 1;

        $integer = type($integer, Type::INTEGER);

        $this->assertIsInt(
            $integer,
        );
    }

    /**
     * @test
     * Verifies that a float variable can be created and type checked.
     * Ensures that the float variable is properly created and matches our expected type
     */
    public function it_can_create_float_type()
    {
        $float = 1.23;

        $float = type($float, Type::FLOAT);

        $this->assertIsFloat(
            $float,
        );
    }

    /**
     * @test
     * Verifies that a boolean variable can be created and type checked.
     * Ensures that the boolean variable is properly created and matches our expected type
     */
    public function it_can_create_boolean_type()
    {
        $boolean = true;

        $boolean = type($boolean, Type::BOOLEAN);

        $this->assertIsBool(
            $boolean,
        );
    }

    /**
     * @test
     * Verifies that a array variable can be created and type checked.
     * Ensures that the array variable is properly created and matches our expected type
     */
    public function it_can_create_array_type()
    {
        $array = [1,2,3,4];

        $array = type($array, Type::ARRAY);

        $this->assertIsArray(
            $array,
        );
    }

    /**
     * @test
     * Verifies that a object variable can be created and type checked.
     * Ensures that the object variable is properly created and matches our expected type
     */
    // public function it_can_create_object_type()
    // {
    //     $variable = new stdClass([1,2,3,4]);

    //     $variable = type($variable, Type::OBJECT);

    //     $this->assertIsObject(
    //         $variable,
    //     );
    // }

    /**
     * @test
     * Verifies that a TypeError is thrown when an object is populated
     * with values of incorrect type (e.g., FooType).
     */
    public function it_throws_class_type_error()
    {
        $this->expectException(TypeError::class);

        $variable = new stdClass(['id' => 1, 'name' => 'Ray']);

        $variable = type($variable, FooType::class);
    }

    /**
     * @test
     * Verifies that a TypeError is thrown when a 'string' variable is populated
     * with values of incorrect type (e.g., integer).
     */
    public function it_throws_class_string_error()
    {
        $this->expectException(TypeError::class);

        $variable = 1;

        $variable = type($variable, Type::STRING);
    }

    /**
      * @test
      * Verifies that a TypeError is thrown when a 'integer' variable is populated
      * with values of incorrect type (e.g., string).
      */
    public function it_throws_class_integer_error()
    {
        $this->expectException(TypeError::class);

        $variable = 'Foo';

        $variable = type($variable, Type::INTEGER);
    }

    /**
      * @test
      * Verifies that a TypeError is thrown when a 'float' variable is populated
      * with values of incorrect type (e.g., string).
      */
    public function it_throws_class_float_error()
    {
        $this->expectException(TypeError::class);

        $variable = 'Foo';

        $variable = type($variable, Type::FLOAT);
    }

    /**
      * @test
      * Verifies that a TypeError is thrown when a 'boolean' variable is populated
      * with values of incorrect type (e.g., string).
      */
    public function it_throws_class_boolean_error()
    {
        $this->expectException(TypeError::class);

        $variable = 'true';

        $variable = type($variable, Type::BOOLEAN);
    }

    /**
      * @test
      * Verifies that a TypeError is thrown when a 'array' variable is populated
      * with values of incorrect type (e.g., string).
      */
    public function it_throws_class_array_error()
    {
        $this->expectException(TypeError::class);

        $variable = 'foo';

        $variable = type($variable, Type::ARRAY);
    }

    /**
      * @test
      * Verifies that a TypeError is thrown when a 'object' variable is populated
      * with values of incorrect type (e.g., string).
      */
    public function it_throws_class_object_error()
    {
        $this->expectException(TypeError::class);

        $variable = 'foo';

        $variable = type($variable, Type::OBJECT);
    }
}
