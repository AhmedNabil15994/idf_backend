<?php

namespace Modules\Transaction\Services;
use IlluminateAgnostic\Str\Support\Carbon;
use Modules\Donations\Entities\RecurringDonation;

class MyFatoorahRecurringPaymentService
{
    //Test
    const API_KEY = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
    //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token


    protected $paymentMode = 'test_mode';
    protected $test_mode = 1;
    protected $whitelabled = true;
    protected $paymentUrl = "https://apitest.myfatoorah.com";
    protected $apiKey = '';

    public function __construct()
    {
        $config_mode = config('services.payment_gateway.my_fatoorah.payment_mode');

        if ($config_mode == 'live_mode') {
            $this->paymentMode = 'live_mode';
            $this->test_mode = 0;
            $this->test_mode = false;
            $this->paymentUrl = "https://api.myfatoorah.com";
            $this->apiKey = config('services.payment_gateway.my_fatoorah.' . $this->paymentMode . '.API_KEY_RECURRING') ?? self::API_KEY;
        } else {
            $this->apiKey = config('services.payment_gateway.my_fatoorah.' . $this->paymentMode . '.API_KEY_RECURRING') ?? self::API_KEY;
        }
    }

    public function send($transaction, $type, $payment = 'knet', $userToken = '')
    {

        $user = auth()->user();
        $url = $this->paymentUrls($type);

        $postFields = [
            "CustomerName" => $user->name,
            'DisplayCurrencyIso' => 'KWD',
            'MobileCountryCode' => "965",
            "CustomerMobile" => $user->mobile,
            "CustomerEmail" => $user->email,
            "InvoiceValue" => $transaction->total,
            'CallBackUrl' => $url['success'],
            'ErrorUrl' => $url['failed'],
            // "Language" => "EN",
            "Language" =>  locale(),
        ];

        if($transaction instanceof RecurringDonation){
            $type = $transaction->time_period;
            $postFields['PaymentMethodId'] = 2;
            $postFields['RecurringModel'] = [
                "RecurringType" => ucfirst($transaction->time_period),
                "Iteration" => $transaction->retry_count,
                "RetryCount" => 5
            ];
        }

        $curl = curl_init($this->paymentUrl.'/v2/ExecutePayment');
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postFields),
            CURLOPT_HTTPHEADER => array("Authorization: Bearer $this->apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }
        $requestLog = [
            'url' => $this->paymentUrl.'/v2/ExecutePayment',
            'method' => 'POST',
            'headers' => ["Authorization: Bearer $this->apiKey", 'Content-Type: application/json'],
            'postFields' => $postFields,
        ];

        \Illuminate\Support\Facades\Log::info('Payment Request:', $requestLog);

        $response = json_decode($response);
        $transaction->update([
            'pending_response' => $response->Data,
            'RecurringId' => $response->Data->RecurringId,
        ]);

        return $response->Data->PaymentURL;

    }

    public function GetPaymentStatus($Key , $KeyType){

        $postFields = [
            'Key'     => $Key,
            'KeyType' => $KeyType
        ];

        $curl = curl_init($this->paymentUrl.'/v2/getPaymentStatus');
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $this->apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        $response = json_decode($response);
        return $response->Data;
    }

    public function delete($donation){

        $postFields = [
            'recurringId'     => $donation->RecurringId,
        ];

        $curl = curl_init("$this->paymentUrl/v2/CancelRecurringPayment?recurringId=$donation->RecurringId");
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $this->apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);

        if ($error) {
            die("Error: $error");
        }

        $response = json_decode($response);
        $donation->delete();
        return $response->Data;
    }


    public function cancel($donation){

        $postFields = [
            'recurringId'     => $donation->RecurringId,
        ];

        $curl = curl_init("$this->paymentUrl/v2/CancelRecurringPayment?recurringId=$donation->RecurringId");
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $this->apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);

//        if ($error) {
//            die("Error: $error");
//        }

        $response = json_decode($response);
//        $donation->delete();
        return $response->Data;
    }
    public function paymentUrls($type)
    {
        switch ($type) {
            default:
                $url['success'] = route('frontend.recurring-donations.payment.success');
                $url['failed'] = route('frontend.recurring-donations.payment.failed');
                break;
        }

        return $url;
    }

    //------------------------------------------------------------------------------
    /*
     * Handle Endpoint Errors Function
     */

    private function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }

    /* -------------------------------------------------------------------------- */
}

