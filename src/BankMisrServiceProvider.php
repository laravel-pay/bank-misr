<?php

namespace LaravelPay\BankMisr;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BankMisrServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('bank-misr')
            ->hasConfigFile('payment-bank-misr')
            ->hasTranslations()
            ->hasViews('bank-misr');
    }
}
