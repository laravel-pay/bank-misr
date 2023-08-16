<?php

namespace LaravelPay\BankMisr;

use Exception;
use Illuminate\Support\Facades\Http;
use LaravelPay\BankMisr\Common\Contracts\RequiredFields;
use LaravelPay\BankMisr\Common\Traits\HasHandelRedirects;
use LaravelPay\BankMisr\Common\Traits\HasRequiredFields;

class BankMisr implements RequiredFields
{
    use HasHandelRedirects;
    use HasRequiredFields;

    private string $api;

    private string $checkout_ur;

    private $merchant_id;

    private $merchant_password;

    private $merchent_name;

    private $amount;

    private $currency;

    private $order_id;

    private $description;

    private $error_response;

    public function __construct()
    {
        $this->api = config('payment-bank-misr.urls.api');
        $this->checkout_url = config('payment-bank-misr.urls.checkout');

        $this->merchant_id = config('payment-bank-misr.merchant.id');
        $this->merchant_password = config('payment-bank-misr.merchant.password');
        $this->merchent_name = config('payment-bank-misr.merchant.name');
        $this->currency = config('payment-bank-misr.currency');

        $this->handelRedirects();
    }

    public function requiredFields(): array
    {
        return [
            'merchant_id' => $this->merchant_id,
            'merchant_password' => $this->merchant_password,
            'merchent_name' => $this->merchent_name,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'order_id' => $this->order_id,
            'success_url' => $this->success_url,
            'fail_url' => $this->fail_url,
        ];
    }

    public function setOrderId($id): self
    {
        $this->order_id = $id;

        return $this;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @throws Exception
     */
    private function generateSession(): bool|string
    {
        $this->requiredFieldsShouldExist();

        $request = Http::withBasicAuth('merchant.'.$this->merchant_id, $this->merchant_password)
            ->post($this->api."/merchant/{$this->merchant_id}/session", [
                'apiOperation' => 'CREATE_CHECKOUT_SESSION',
                'interaction' => [
                    'operation' => 'PURCHASE',
                    'returnUrl' => $this->success_url,
                ],
                'order' => [
                    'id' => $this->order_id,
                    'amount' => $this->amount,
                    'currency' => $this->currency,
                    'description' => $this->description,
                ],
            ]);

        $data = $request->json();

        if (! $request->successful()) {
            $this->error_response = $data;

            return false;
        }

        if (! isset($data['result'], $data['session'], $data['successIndicator'])) {
            $this->error_response = $data;

            return false;
        }

        if ($data['result'] != 'SUCCESS') {
            $this->error_response = $data;

            return false;
        }

        return $data['session']['id'];
    }

    /**
     * @throws Exception
     */
    public function getForm(): bool|string
    {
        $session_id = $this->generateSession();

        if (! $session_id) {
            throw new Exception('Error while generating session: '.json_encode($this->error_response));
        }

        return view('bank-misr::form', [
            'session_id' => $session_id,
            'checkout_url' => $this->checkout_url,
            'merchant_name' => $this->merchent_name,
            'fail_url' => $this->fail_url,
        ])->render();
    }
}
