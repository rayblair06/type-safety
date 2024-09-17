<?php

declare(strict_types=1);

namespace Rayblair\ArrayType;

use ArgumentCountError;
use ArrayObject;
use TypeError;

/**
 * Abstract class to manage an array of a specific type.
 * Enforces runtime type safety by ensuring that only instances of the specified type can be added.
 */
abstract class ArrayType extends ArrayObject
{
    /**
     * The fully qualified class name of the objects this array can store.
     * Must be defined in subclasses to enable type validation.
     *
     * @var class-string<object>
     */
    protected $type;

    /**
     * Initializes the array with validated object instances.
     *
     * @param object[]|null $arrayValues An array of instances of the specified type.
     *
     * @throws TypeError If any element is not an instance of the expected type.
     */
    public function __construct(?array $arrayValues = null)
    {
        if (!isset($this->type)) {
            throw new TypeError('The $type property must be set in a subclass.');
        }

        if ($arrayValues !== null) {
            foreach ($arrayValues as $value) {                
                parent::append($value);
            }
        }
    }

    /**
     * Sets an item in the array at the given index after validating and converting it to the defined type.
     *
     * @param mixed $index Optional index at which to set the value. If null, appends the value.
     * @param array $newval An array of arguments used to instantiate the object of the defined type.
     *
     * @throws ArgumentCountError If the provided arguments don't match the constructor's signature.
     * @throws TypeError If object instantiation fails or if $newval is of an invalid type.
     */
    public function offsetSet(mixed $index, mixed $newval): void
    {
        $newval = $this->createInstance($newval);

        parent::offsetSet($index, $newval);
    }

    /**
     * Appends an item to the array after validating and converting it to the defined type.
     *
     * @param array $value An array of arguments used to instantiate the object of the defined type.
     *
     * @throws ArgumentCountError If the provided arguments don't match the constructor's signature.
     * @throws TypeError If object instantiation fails or if $value is of an invalid type.
     */
    public function append(mixed $value): void
    {
        $value = $this->createInstance($value);

        parent::append($value);
    }

    /**
     * Converts the array into an array of associative arrays representing object properties.
     *
     * @return array An array of associative arrays, each corresponding to an object in the array.
     */
    public function toArray(): array
    {
        return array_map(function($object) {
            return get_object_vars($object);
        }, (array) $this);
    }

    /**
     * Validates if the given value is an instance of the defined type.
     *
     * @param object $object The object to validate.
     *
     * @throws TypeError If the object is not of the expected type.
     */
    protected function validateType(object $object): void
    {
        if (!($object instanceof $this->type)) {
            throw new TypeError(sprintf(
                'Expected instance of %s, got %s.',
                $this->type,
                get_debug_type($object)
            ));
        }
    }

    /**
     * Creates an instance of the defined type using the provided arguments.
     *
     * @param array $args Arguments for the constructor of the defined type.
     *
     * @return object The newly created instance.
     *
     * @throws ArgumentCountError If instantiation fails due to incorrect arguments.
     * @throws TypeError If the created instance is of an incorrect type.
     */
    protected function createInstance(array $args): object
    {
        if (!is_array($args)) {
            throw new TypeError(sprintf(
                'Expected an array of constructor arguments, got %s.',
                get_debug_type($args)
            ));
        }

        $instance = new $this->type(...$args);
        
        $this->validateType($instance);

        return $instance;
    }
}
