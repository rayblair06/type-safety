<?php

declare(strict_types=1);

use Rayblair\ArrayType\Type;

if (! function_exists('type')) {
    /**
     * Validates that the provided variable matches the expected type.
     *
     * @param mixed  $variable The variable to check.
     * @param string $type     The expected type (class name or primitive type constant from Type).
     *
     * @return mixed The validated variable.
     *
     * @throws TypeError If the variable does not match the expected type.
     */
    function type(mixed $variable, string $type): mixed
    {
        // Check if the variable is an object (but not stdClass!) and ensure it's an instance of the expected class
        if (is_object($variable) && !$variable instanceof(stdClass::class)) {
            if (! $variable instanceof $type) {
                $actualType = get_class($variable);

                throw new TypeError("Expected instance of {$type}, instance of {$actualType} given.");
            }

            return $variable;
        }

        // Match the expected primitive types using Type constants
        $check = match ($type) {
            Type::STRING => is_string($variable),
            Type::INTEGER => is_int($variable),
            Type::FLOAT => is_float($variable),
            Type::BOOLEAN => is_bool($variable),
            Type::ARRAY => is_array($variable),
            Type::OBJECT => is_object($variable),
            default => throw new TypeError("Unsupported type {$type} specified."),
        };

        // If the type check fails, throw a TypeError
        if (! $check) {
            $actualType = gettype($variable);

            throw new TypeError("Expected type {$type}, {$actualType} given.");
        }

        return $variable;
    }
}
