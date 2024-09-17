# Type Safety

**Type Safety** is a PHP package that enforces strict type safety when working with mixed arrays and variables. It provides an `ArrayType` class for defining strongly-typed arrays, along with a helper method to validate primitive types, object instances, and basic arrays at runtime. By ensuring that only instances of the specified type can be added to variables or arrays, this package helps maintain strong typing throughout your application, improving data integrity and supporting static analysis to reduce type ambiguity.

## Installation

You can install the package via Composer:

```bash
composer require rayblair/type-safety
```

## Usage

Below are some examples demonstrating how to use the `Type Safety` package for type-checking variables and creating type-safe arrays.

### Type Checking for Variables

The `type()` function ensures that a variable matches a specific type. If the type doesn't match, a `TypeError` is thrown.

#### Example Usage:

```php
// Class Type Checking
$classInstance = new FooType(1, 'Ray');
$classInstance = type($classInstance, FooType::class);

// String Type Checking
$string = 'Foo';
$string = type($string, Type::STRING);

// Integer Type Checking
$integer = 1;
$integer = type($integer, Type::INTEGER);

// Float Type Checking
$float = 1.23;
$float = type($float, Type::FLOAT);

// Boolean Type Checking
$boolean = true;
$boolean = type($boolean, Type::BOOLEAN);

// Array Type Checking
$array = [1, 2, 3, 4];
$array = type($array, Type::ARRAY);
```

### Creating Type-Safe Arrays

You can also create arrays that enforce type safety for their elements. In this example, we'll demonstrate how to create a custom object and ensure the array only holds instances of that object.

#### Step 1: Define a Class

First, define a class to represent the objects you want to store in the array. For example, we'll define a `FooType` class with `id` and `name` properties.

```php
class FooType
{
    public function __construct(public int $id, public string $name)
    {}
}
```

#### Step 2: Define a Type-Safe Array

Next, extend the `ArrayType` class and specify the object type that the array will contain. In this case, we define a `FooArrayType` class that will hold `FooType` objects.

```php
class FooArrayType extends ArrayType
{
    public $type = FooType::class;
}
```

#### Step 3: Adding Items to the Array

Once your type-safe array is set up, you can add items to it. The array will automatically validate that each item matches the defined type.

```php
$array = new FooArrayType();

$array[] = ['id' => 1, 'name' => 'Ray'];
$array[] = ['id' => 2, 'name' => 'Bob'];
$array[] = ['id' => 3, 'name' => 'Alice'];

print_r($array->toArray());
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

The `ArrayType` class enforces strict type safety, which means that any invalid data will trigger exceptions.

### Example 1: Invalid Type

If you attempt to add an item where the `id` is not an integer, a `TypeError` will be thrown.

```php
$array = new FooArrayType();

// This will throw a TypeError because 'id' should be an integer.
$array[] = ['id' => '4', 'name' => 'Dave'];
```

### Example 2: Missing Parameters

If you omit a required parameter, such as `id`, an `ArgumentCountError` will be thrown.

```php
$array = new FooArrayType();

// This will throw an ArgumentCountError because 'id' is missing.
$array[] = ['name' => 'Gary'];
```

## Testing

To run the test suite and ensure everything is working as expected, use the following command:

```bash
composer test
```

## Changelog

For details on recent changes and updates, please refer to the [CHANGELOG](CHANGELOG.md).

## Contributing

We welcome contributions! Please refer to our [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) guidelines for more information.

## Security Vulnerabilities

If you discover any security-related issues, please review our [security policy](../../security/policy) for instructions on how to report vulnerabilities.

## Credits

-   [Ray Blair](https://github.com/rayblair)
-   [All Contributors](../../contributors)

## License

This package is open-source and licensed under the MIT License. For more information, please see the [LICENSE file](LICENSE.md).
