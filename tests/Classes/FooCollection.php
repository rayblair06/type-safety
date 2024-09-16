<?php

namespace Rayblair\CollectionType\Tests\Classes;

use Rayblair\CollectionType\CollectionType;

/**
 * A specialized collection for managing FooType objects.
 * Ensures strict type safety by only allowing instances of FooType.
 */
class FooCollection extends CollectionType
{
    /**
     * Specifies the type of objects this collection can contain.
     * Only FooType instances are permitted.
     *
     * @var string
     */
    public $type = FooType::class;
}
