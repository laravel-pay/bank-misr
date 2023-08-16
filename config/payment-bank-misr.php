<?php

// config for LaravelPay/BankMisr
return [
    'urls' => [
        'api' => 'https://banquemisr.gateway.mastercard.com/api/rest/version/62',
        'checkout' => 'https://banquemisr.gateway.mastercard.com/static/checkout/checkout.min.js',
    ],
    'merchant' => [
        'id' => env('BANK_MISR_MERCHANT_ID'),
        'password' => env('BANK_MISR_MERCHANT_PASSWORD'),
        'name' => env('BANK_MISR_MERCHANT_NAME'),
    ],
    'currency' => 'EGP',

    'success_url' => env('BANK_MISR_SUCCESS_URL'),
    'fail_url' => env('BANK_MISR_FAIL_URL'),
];
