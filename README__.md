# This is my package bank-misr

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-pay/bank-misr.svg?style=flat-square)](https://packagist.org/packages/laravel-pay/bank-misr)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-pay/bank-misr.svg?style=flat-square)](https://packagist.org/packages/laravel-pay/bank-misr)

Bank Misr Documentation can be found here
<a href="https://banquemisr.gateway.mastercard.com/api/documentation/integrationGuidelines/supportedFeatures/testAndGoLive.html?locale=en_US">https://banquemisr.gateway.mastercard.com/api/documentation/integrationGuidelines/supportedFeatures/testAndGoLive.html?locale=en_US <a/>

## Installation

You can install the package via composer:

```bash
composer require laravel-pay/bank-misr
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="bank-misr-config"
```

This is the contents of the published config file:

```php
return [
    "merchant" => [
        "id" => env("BANK_MISR_MERCHANT_ID"),
        "password" => env("BANK_MISR_MERCHANT_PASSWORD"),
        "name" => env("BANK_MISR_MERCHANT_NAME"),
    ],
    "currency" => "EGP",

    "success_url" => env("BANK_MISR_SUCCESS_URL"),
    "fail_url" => env("BANK_MISR_FAIL_URL"),
];

```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="bank-misr-views"
```

## Usage

```php
Route::get("/" , function(){
    $form = BankMisr::setOrderId(11111)
        ->setSuccessUrl("success")
        ->setFailUrl("fail")
        ->setAmount(100.12)
        ->setDescription("test")
        ->getForm();

    return view("welcome" , [
        "form" => $form
    ]);
});


Route::get("/success" , function(){
    dd("success" , request()->all());
})->name("success");

Route::get("/fail" , function(){
    dd("fail" , request()->all());
})->name("fail");
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
