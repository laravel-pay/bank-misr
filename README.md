# This is my package bank-misr

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-pay/bank-misr.svg?style=flat-square)](https://packagist.org/packages/laravel-pay/bank-misr)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-pay/bank-misr.svg?style=flat-square)](https://packagist.org/packages/laravel-pay/bank-misr)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require laravel-pay/bank-misr
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="bank-misr-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="bank-misr-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="bank-misr-views"
```

## Usage

```php
$bankMisr = new LaravelPay\BankMisr();
echo $bankMisr->echoPhrase('Hello, LaravelPay!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
