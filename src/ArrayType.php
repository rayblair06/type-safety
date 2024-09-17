<?php

declare(strict_types=1);

namespace Rayblair\ArrayType;

use ArgumentCountError;
use ArrayObject;
use TypeError;

/**
 * Abstract class to manage a array of a specific type.
 * Enforces runtime type safety by ensuring that only instances of the specified type can be added.
 */
abstract class ArrayType extends ArrayObject
{
    /**
     * The fully qualified class name of the objects this array can store.
     * Must be defined in subclasses to enable type validation.
     *
     * @var string|null
     */
    public $type = null;

    /**
     * Adds an item to the array at the given index after validating and converting it to the defined type.
     * The value is treated as constructor arguments to create an instance of the defined type.
     *
     * @param  mixed  $index   Optional index at which to set the value. If null, appends the value.
     * @param  mixed  $newval  An array of arguments used to instantiate the object of the defined type.
     *
     * @throws ArgumentCountError If the provided arguments don't match the constructor's signature.
     * @throws TypeError If object instantiation fails or if $newval is of an invalid type.
     */
    public function offsetSet($index, $newval): void
    {
        $newval = new $this->type(...$newval);

        parent::offsetSet($index, $newval);
    }

    /**
     * Appends an item to the array after validating and converting it to the defined type.
     * The value is treated as constructor arguments to create an instance of the defined type.
     *
     * @param  mixed  $value  An array of arguments used to instantiate the object of the defined type.
     *
     * @throws ArgumentCountError If the provided arguments don't match the constructor's signature.
     * @throws TypeError If object instantiation fails or if $value is of an invalid type.
     */
    public function append($value): void
    {
        $value = new $this->type(...$value);

        parent::append($value);
    }

    /**
     * Converts the array to an array, where each entry is an associative array representing
     * the properties of an object in the array.
     *
     * @return array An array of associative arrays, each corresponding to an object in the array.
     */
    public function toArray(): array
    {
        $array = [];

        foreach ($this as $object) {
            $array[] = get_object_vars($object); // Extract object properties into an associative array
        }

        return $array;
    }
}
