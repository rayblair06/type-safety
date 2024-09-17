<?php

declare(strict_types=1);

namespace Rayblair\ArrayType;

/**
 * Class to manage specific types.
 * Enforces runtime type safety by ensuring that only instances of the specified type can be added.
 */
class Type
{
    public const STRING = 'string';
    public const INTEGER = 'integer';
    public const FLOAT = 'float';
    public const BOOLEAN = 'boolean';
    public const ARRAY = 'array';
    public const OBJECT = 'object';
}
