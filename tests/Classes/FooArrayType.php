<?php

namespace Rayblair\ArrayType\Tests\Classes;

use Rayblair\ArrayType\ArrayType;

/**
 * A specialized array for managing FooType objects.
 * Ensures strict type safety by only allowing instances of FooType.
 */
class FooArrayType extends ArrayType
{
    /**
     * Specifies the type of objects this array can contain.
     * Only FooType instances are permitted.
     *
     * @var string
     */
    public $type = FooType::class;
}
