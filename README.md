# CollectionType

This package provides type-safe collections in PHP, allowing you to manage collections of a specific object type. It enforces runtime type safety by ensuring that only instances of the defined class can be added to the collection. This makes it easier to work with strongly-typed collections and ensures data integrity throughout your application.

## Installation

You can install the package via Composer:

```bash
composer require rayblair/collection-type
```

## Usage

Here’s an example demonstrating how to use the `CollectionType` class with a custom object type:

### Define a Custom Type

First, create a class to define the objects you want to store in the collection. In this example, we define a `FooType` class with `id` and `name` properties.

```php
class FooType
{
    public function __construct(public int $id, public string $name)
    {}
}
```

### Create a Type-Safe Collection

Now, create a collection class that extends `CollectionType` and specify the object type it will hold. In this case, `FooCollection` is defined to hold `FooType` objects.

```php
class FooCollection extends CollectionType
{
    public $type = FooType::class;
}
```

### Adding Items to the Collection

Once your collection is set up, you can start adding items to it. The collection will automatically validate that each item is of the correct type.

```php
$collection = new FooCollection();

$collection[] = ['id' => 1, 'name' => 'Ray'];
$collection[] = ['id' => 2, 'name' => 'Bob'];
$collection[] = ['id' => 3, 'name' => 'Alice'];

print_r($collection->toArray());
```

### Output:

```php
[
    ['id' => 1, 'name' => 'Ray'],
    ['id' => 2, 'name' => 'Bob'],
    ['id' => 3, 'name' => 'Alice'],
]
```

## Handling Invalid Data

The `CollectionType` class enforces strict type safety, so invalid data will result in errors.

### Example 1: Invalid Type

If you try to add an item where the `id` is not an integer, a `TypeError` will be thrown.

```php
$collection = new FooCollection();

// This will throw a TypeError because the 'id' should be an integer.
$collection[] = ['id' => '4', 'name' => 'Dave'];
```

### Example 2: Missing Parameters

If you omit required parameters, such as `id`, an `ArgumentCountError` will be thrown.

```php
$collection = new FooCollection();

// This will throw an ArgumentCountError because the 'id' is missing.
$collection[] = ['name' => 'Gary'];
```

## Testing

To run the test suite and ensure everything is working as expected, use:

```bash
composer test
```

## Changelog

For details on recent changes and updates, please see the [CHANGELOG](CHANGELOG.md).

## Contributing

We welcome contributions! For details on how to contribute, please refer to our [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) guidelines.

## Security Vulnerabilities

If you discover any security-related issues, please review our [security policy](../../security/policy) for instructions on how to report vulnerabilities.

## Credits

-   [Ray Blair](https://github.com/rayblair)
-   [All Contributors](../../contributors)

## License

This package is open-source and licensed under the MIT License. For more information, please see the [LICENSE file](LICENSE.md).
