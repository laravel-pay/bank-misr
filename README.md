## Bank Misr (EGYPT)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-pay/bank-misr.svg?style=flat-square)](https://packagist.org/packages/laravel-pay/bank-misr)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-pay/bank-misr/master.svg?style=flat-square)](https://travis-ci.org/laravel-pay/bank-misr)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-pay/bank-misr.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-pay/bank-misr)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-pay/bank-misr/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-pay/bank-misr/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-pay/bank-misr.svg?style=flat-square)](https://packagist.org/packages/laravel-pay/bank-misr)

Bank Misr (EGYPT) driver for the Laravel Pay package.

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

<a href="https://banquemisr.gateway.mastercard.com/api/documentation/integrationGuidelines/supportedFeatures/testAndGoLive.html?locale=en_US">DOCS<a/>

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

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [elsayed85](https://github.com/elsayed85)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
