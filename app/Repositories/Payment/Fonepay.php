<?php
namespace App\Repositories\Payment;
use Illuminate\Support\Facades\Http;
use Exception;

class Fonepay implements PaymentGatewayInterface
{
    public $inquiry;
    public $amount;
    public $base_url;
    public $purchase_order_id;
    public $purchase_order_name;

    public function __construct()
    {
        $this->base_url = env('APP_DEBUG') ? 'https://dev-clientapi.fonepay.com/' : 'https://clientapi.fonepay.com/';
    }

    /**
     *
     * Function to perform some logic before payment process
     */
    public function pay(float $amount, $return_url, $purchase_order_id, $purchase_order_name)
    {
        $this->purchase_order_id = $purchase_order_id;
        $this->purchase_order_name = $purchase_order_name;
        return $this->initiate($amount, $return_url);
    }

    /**
     *
     * Initiate Payment Gateway Transaction
     * @param float amount : Amount requested for payment transaction
     * @param return_url : Redirect url after payment transaction
     * @param array arguments : Additional dataset
     *
     */
    public function initiate(float $amount, $return_url, ?array $arguments = null)
    {
        $this->amount = env('APP_DEBUG') ? 1000 : $amount;
        $process_url = $this->base_url . 'api/merchantRequest';
        $sharedSecretKey  = env('FONEPAY_SECRET_KEY');
        $merchant_id = env('FONEPAY_MERCHANT_ID');
        $RU = $return_url; // Return URL
        $PID = $merchant_id; // Merchant Code, Defined by fonepay system
        $PRN = $this->purchase_order_id; //Product Reference Number, need to send by merchant
        $AMT = $this->amount; // Payable Amount
        $CRN = 'NPR';
        $DT =  date('m/d/Y');
        $R1 = $this->purchase_order_name; // Additional Info 1
        $R2 = 'additional info'; //title(); // Additional Info 2
        $MD = 'P'; // P - Payment
        $DV = hash_hmac('sha512', $PID . ',' . $MD . ',' . $PRN . ',' . $AMT . ',' . $CRN . ',' . $DT . ',' . $R1 . ',' . $R2 . ',' . $RU, $sharedSecretKey);

        $data = [
            'RU' => $RU,
            'PID' => $PID,
            'PRN' => $PRN,
            'AMT' => $AMT,
            'CRN' => $CRN,
            'DT' => $DT,
            'R1' => $R1,
            'R2' => $R2,
            'MD' => $MD,
            'DV' => $DV,
        ];
// dd($data);
        // generate form from attributes
        $htmlForm = '<form method="POST" action="' . ($process_url) . '" id="esewa-form">';

        foreach ($data as $name => $value) :
            $htmlForm .= sprintf('<input name="%s" type="hidden" value="%s">', $name, $value);
        endforeach;

        $htmlForm .= '</form><script type="text/javascript">document.getElementById("esewa-form").submit();</script>';

        // output the form
        echo $htmlForm;
    }

    /**
     *
     * Success status of payment transaction 
     * @param array inquiry : Payment transaction response
     * @param array arguments : Additional dataset
     * @return bool 
     *
     */
    public function isSuccess(array $inquiry, ?array $arguments = null): bool
    {
        return ($inquiry['success'] ?? null) == 'true';
    }

    /**
     *
     * Requested amount to be registered
     * @param array inquiry : Payment transaction response
     * @param array arguments : Additional dataset
     * @return float 
     *
     */
    public function requestedAmount(array $inquiry, ?array $arguments = null): float
    {
        return $inquiry['amount'];
    }

    /**
     *
     * Payment status lookup request
     * @param mixed transaction_id : Code provided by payment gateway vendor to uniquely identify payment transaction 
     * @param array arguments : Additional dataset
     * @return array 
     *
     */
    public function inquiry($transaction_id, ?array $arguments = null) : array
    {
        $process_url = $this->base_url . 'api/merchantRequest/verificationMerchant';
        $sharedSecretKey  = env('FONEPAY_SECRET_KEY');
        $PID = env('FONEPAY_MERCHANT_ID');
        $UID = $transaction_id;
        $PRN = $arguments['PRN'] ?? '';
        $BID = $arguments['BID'] ?? '';
        $R_AMT = $arguments['R_AMT'] ?? '';

        $data =[

            'PRN' => $PRN,

            'PID' => $PID,

            'BID' => $BID,

            'AMT' => $R_AMT, // original payment amount

            'UID' => $UID,

            'DV' => hash_hmac('sha512', $PID . ',' . $R_AMT . ',' . $PRN . ',' . $BID . ',' . $UID, $sharedSecretKey),

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $process_url . '?' . http_build_query($data));

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseXML = curl_exec($ch);

        // Load XML string
        $response = simplexml_load_string($responseXML);

        // Convert XML to JSON and then to array
        return json_decode(json_encode($response), true);
    }
}