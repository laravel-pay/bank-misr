<?php

namespace LaravelPay\BankMisr;

use Exception;
use Illuminate\Support\Facades\Http;
use LaravelPay\BankMisr\Common\Contracts\RequiredFields;
use LaravelPay\BankMisr\Common\Traits\HasRequiredFields;

class BankMisr implements RequiredFields
{
    use HasRequiredFields;

    private string $api = "https://banquemisr.gateway.mastercard.com/api/rest/version/62";
    private string $checkout_url = "https://banquemisr.gateway.mastercard.com/static/checkout/checkout.min.js";
    private string $merchant_id;
    private string $merchant_password;
    private string $merchent_name;
    private float $amount;
    private string $currency;
    private string $order_id;
    private string $description;
    private string $success_url;
    private string $fail_url;

    public function __construct()
    {
        $this->merchant_id = config("payment-bank-misr.merchant.id");
        $this->merchant_password = config("payment-bank-misr.merchant.password");
        $this->merchent_name = config("payment-bank-misr.merchant.name");

        $this->currency = config("payment-bank-misr.currency");
        $this->success_url = config("payment-bank-misr.success_url");
        $this->fail_url = config("payment-bank-misr.fail_url");
    }

    function requiredFields(): array
    {
        return [
            "merchant_id" => $this->merchant_id,
            "merchant_password" => $this->merchant_password,
            "merchent_name" => $this->merchent_name,
            "amount" => $this->amount,
            "currency" => $this->currency,
            "order_id" => $this->order_id,
            "success_url" => $this->success_url,
            "fail_url" => $this->fail_url,
        ];
    }

    public function setOrderId($id) : self
    {
        $this->order_id = $id;
        return $this;
    }

    public function setAmount($amount) : self
    {
        $this->amount = $amount;
        return $this;
    }

    public function setSuccessUrl($url) : self
    {
        $this->success_url = $url;
        return $this;
    }

    public function setFailUrl($url) : self
    {
        $this->fail_url = $url;
        return $this;
    }

    public function setDescription($description) : self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @throws Exception
     */
    private function generateSession() : bool|string
    {
        $this->requiredFieldsShouldExist();

        $request = Http::withBasicAuth("merchant." . $this->merchant_id, $this->merchant_password)
            ->post($this->api . "/merchant/{$this->merchant_id}/session", [
                "apiOperation" => "CREATE_CHECKOUT_SESSION",
                "interaction" => [
                    "operation" => "PURCHASE",
                    "returnUrl" => $this->success_url,
                ],
                "order" => [
                    "id" => $this->order_id,
                    "amount" => $this->amount,
                    "currency" => $this->currency,
                    "description" => $this->description,
                ],
            ]);

        if(!$request->successful()){
            return false;
        }

        $data = $request->json();

        if(!isset($data['result'] , $data['session'] , $data['successIndicator'])){
            return false;
        }

        if($data['result'] != "SUCCESS"){
            return false;
        }

        return $data["session"]["id"];
    }


    /**
     * @throws Exception
     */
    public function getForm() : bool|string
    {
        $session_id = $this->generateSession();

        if (!$session_id) {
            return false;
        }

        return view("payment-bank-misr::form", [
            "session_id" => $session_id,
            "checkout_url" => $this->checkout_url,
            "merchant_name" => $this->merchent_name,
            "fail_url" => $this->fail_url,
        ])->render();
    }
}
