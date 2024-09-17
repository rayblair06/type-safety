<?php

namespace Rayblair\ArrayType\Tests\Classes;

/**
 * Represents a FooType entity with an ID and a name.
 * This class encapsulates FooType data for use across different parts of the application.
 */
class FooType
{
    /**
     * Initializes a new FooType instance.
     *
     * @param  int     $id    The unique identifier for this FooType.
     * @param  string  $name  The name associated with this FooType.
     */
    public function __construct(public int $id, public string $name)
    {
        // ...
    }
}
