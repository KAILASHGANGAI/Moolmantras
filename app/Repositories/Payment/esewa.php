<?php
namespace App\Repositories\Payment;

use Illuminate\Support\Facades\Http;
use Exception;

class Esewa implements PaymentGatewayInterface
{
    public $inquiry;
    public $amount;
    public $base_url;
    public $purchase_order_id;
    public $purchase_order_name;

    public function __construct()
    {
        $this->base_url = env('APP_DEBUG') ? 'https://uat.esewa.com.np/epay/' : 'https://epay.esewa.com.np/api/epay/';
    }

    /**
     * Function to perform some logic before payment process
     * @param float $amount The amount to pay
     * @param string $return_url The URL to return to after payment
     * @param int|string $purchase_order_id The purchase order ID
     * @param string $purchase_order_name The purchase order name
     * @return mixed
     */
    public function pay(float $amount, string $return_url, $purchase_order_id, string $purchase_order_name)
    {
        $this->purchase_order_id = $purchase_order_id;
        $this->purchase_order_name = $purchase_order_name;
        return $this->initiate($amount, $return_url);
    }

    /**
     * Initiate Payment Gateway Transaction
     * @param float $amount The amount requested for payment transaction
     * @param string $return_url The redirect URL after payment transaction
     * @param array|null $arguments Additional dataset
     * @return void
     */
    public function initiate(float $amount, string $return_url, ?array $arguments = null)
    {
        $this->amount = env('APP_DEBUG') ? 100 : $amount;
        $process_url = $this->base_url . 'main'; // /v2/form/';
        $tuid = now()->timestamp;
        $merchant_id = env('ESEWA_MERCHANT_ID');
        $message = "total_amount=$amount,transaction_uuid=$tuid,product_code=$merchant_id";
        $s = hash_hmac('sha256', $message, env('ESEWA_SECRET_KEY'), true);
        $signature = base64_encode($s);
        $data = [
            "amount" => $amount,
            "failure_url" => url('/'),
            "product_delivery_charge" => "0",
            "product_service_charge" => "0",    
            "product_code" => "EPAYTEST",
            "signature" => $signature,
            "signed_field_names" => "total_amount,transaction_uuid,product_code",
            "success_url" => $return_url,
            "tax_amount" => "0",
            "total_amount" => $amount,
            "transaction_uuid" =>  $tuid
        ];
   # dd($data);
        // Generate form from attributes
        $htmlForm = '<form method="POST" action="' . $process_url . '" id="esewa-form">';

        foreach ($data as $name => $value) {
            $htmlForm .= sprintf('<input name="%s" type="hidden" value="%s">', $name, $value);
        }

        $htmlForm .= '</form><script type="text/javascript">document.getElementById("esewa-form").submit();</script>';
      #  dd($htmlForm);
        // Output the form
        echo $htmlForm;
    }

    /**
     * Success status of payment transaction 
     * @param array $inquiry Payment transaction response
     * @param array|null $arguments Additional dataset
     * @return bool
     */
    public function isSuccess(array $inquiry, ?array $arguments = null): bool
    {
        return ($inquiry['status'] ?? null) == 'COMPLETE';
    }

    /**
     * Requested amount to be registered
     * @param array $inquiry Payment transaction response
     * @param array|null $arguments Additional dataset
     * @return float
     */
    public function requestedAmount(array $inquiry, ?array $arguments = null): float
    {
        return $inquiry['total_amount'];
    }

    /**
     * Payment status lookup request
     * @param mixed $transaction_id Code provided by payment gateway vendor to uniquely identify payment transaction 
     * @param array|null $arguments Additional dataset
     * @return array
     * @throws Exception if total_amount is not provided in arguments
     */
    public function inquiry($transaction_id, ?array $arguments = null): array
    {
        $process_url = $this->base_url . 'transaction/status/';
        $total_amount = $arguments['total_amount'] ?? null;
        if (!is_null($total_amount)) {
            $payload = [
                'product_code' => env('ESEWA_MERCHANT_ID'),
                'transaction_uuid' => $transaction_id,
                'total_amount' => $total_amount
            ];
            $response = Http::get($process_url, $payload);
            $this->inquiry = json_decode($response->body(), true);
            return $this->inquiry;
        } else {
            throw new Exception('total_amount is required');
        }
    }
}
