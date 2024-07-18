<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ToyyibPayController extends Controller
{
    public function paymentPage()
    {
        return view('index');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            // Client = from GuzzleHTTP
            // execute this command below for CA Certificate
            // curl -o cacert.pem https://curl.se/ca/cacert.pem
            $client = new Client([
                'verify' => storage_path('certificates/cacert.pem'), // Path to the downloaded CA certificates
            ]);

            // send data to ToyyibPay through API
            $response = $client->post('https://dev.toyyibpay.com/index.php/api/createBill', [
                'form_params' => [
                    'userSecretKey' => env('TOYYIBPAY_API_KEY'), // set the API key on the .env file
                    'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE'), // set the category code on the .env file
                    'billName' => 'Car Rental WXX123',
                    'billDescription' => 'Car Rental WXX123 On Sunday',
                    'billPriceSetting' => 1,
                    'billPayorInfo' => 1,
                    'billAmount' => $request->amount * 100,
                    'billReturnUrl' => route('callBack'),
                    'billCallbackUrl' => route('callBack'),
                    'billExternalReferenceNo' => 'AFR341DFI',
                    'billTo' => $request->name,
                    'billEmail' => $request->email,
                    'billPhone' => $request->phone,
                    'billSplitPayment' => 0,
                    'billSplitPaymentArgs' => '',
                    'billPaymentChannel' => '2',
                    'billContentEmail' => 'Thank you for purchasing our product!',
                    'billChargeToCustomer' => 1,
                ],
            ]);

            // received data in JSON format
            $data = json_decode($response->getBody(), true);

            // for log purpose
            Log::info('ToyyibPay response: ', $data);

            if (isset($data[0]['BillCode'])) {
                return redirect('https://dev.toyyibpay.com/' . $data[0]['BillCode']);
            } else {
                Log::error('Error initiating payment: ', $data);
                return back()->withErrors(['msg' => 'Error initiating payment.']);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Error initiating payment. Please try again later.']);
        }
    }

    public function callBack(Request $request)
    {
        // Handle the callback here. Validate the payment and update the order status.
        $billCode = $request->billcode;
        $status_id = $request->status_id;

        // Handle status id
        // if ($status_id == 1) {
        
        // } else {
        //  
        // }

        return view('payment-status', ['status_id' => $status_id]);
    }
}
