<?php

// config for LaravelPay/BankMisr
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
