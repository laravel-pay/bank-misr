<?php

namespace LaravelPay\BankMisr\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelPay\BankMisr\BankMisr
 */
class BankMisr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelPay\BankMisr\BankMisr::class;
    }
}
