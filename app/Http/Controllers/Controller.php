<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CountryColor;
use App\Models\BookingProduct;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function processStripe($price,$booking){
        \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JHzEGI12ZmR225jgcGfjm25u1RsPopaeB4x2Z6E32SsCaTGQQMB0GAFbBdEaHZLLBHBYAvEsOZjhf1CkooC9bTR00rh2Iytpz'));

        header('Content-Type: application/json');
        $YOUR_DOMAIN = env('APP_URL', "https://uktraveltest.prodevs.io/");

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => [
                'card',
            ],
            'line_items' => [[
                'price' => $price,
                'quantity' => 1
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'booking/stripe/success?b='.encrypt_decrypt('encrypt',$booking->id),
            'cancel_url' => $YOUR_DOMAIN . 'booking/stripe/failed?b='.encrypt_decrypt('encrypt',$booking->id),
        ]);

        return $checkout_session;
    }

    function checkSession($booking_product){
        \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JHzEGI12ZmR225jgcGfjm25u1RsPopaeB4x2Z6E32SsCaTGQQMB0GAFbBdEaHZLLBHBYAvEsOZjhf1CkooC9bTR00rh2Iytpz'));

        header('Content-Type: application/json');

        $checkout_session = \Stripe\Checkout\Session::retrieve($booking_product->stripe_session);

        return $checkout_session;

    }

    public function processPaystack(array $request = [])
    {
        
        $url = "https://api.paystack.co/transaction/initialize";
           
            $fields_string = http_build_query($request);
           
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " .env('PAYSTACK_SECRET_KEY', 'sk_test_a888f85236f4da1b0bd204ad8f8c96b6e010a7e9'),
                "Cache-Control: application/json",
            ));
            
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
            //execute post
            $response = curl_exec($ch);
            
          $server_output = json_decode($response);
          
         return $server_output->data->authorization_url;
            
        
    }

    public function processFL(array $request = [])
    {
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY',"FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/payments");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        try {
            $server_output = json_decode($server_output);
            //dd($server_output);
            return $server_output->data->link;
        }catch (\Exception $e){
            dd(json_decode($server_output));
        }
    }

    public function processVAS(array $request = [])
    {
        unset($request['subaccounts']);
        unset($request['currency']);

        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'X-API-Key: '.env('VASTECHKEY');
//        dd($headr);
        curl_setopt($ch, CURLOPT_URL, "https://vastech.sevas.live/vastech/api/v1/ubank");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);

        return $server_output->data;
    }

    function bank($country)
    {
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY', "FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/banks/" .$country);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);

        return $server_output->data;
    }

    function account_name_($bank,$account_no)
    {
        $ch = curl_init();
        $request['account_number'] =$account_no;
        $request['account_bank'] =$bank;
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY',"FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/accounts/resolve");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);
        //dd($server_output);
        return $server_output;
    }

    function getPaystackData($booking,$price,$transaction_ref,$price_pound = null, $card_type = null)
    {
       
    
        if ($booking->country_travelling_from_id == 156 && $card_type == 1) {
            $price = $price * 100;
            $data = [
                //
                "email" => $booking->email,
                "reference" => $transaction_ref,
                "amount" => $price,
                "currency" => "NGN",
                "callback_url" => env('APP_URL', 'http://127.0.0.1:8000/') . "payment/paystack/confirmation",
            ];

        } else {
            $price_usd = $price_pound * 100;
            $data = [
                "email" => $booking->email,
                "reference" => $transaction_ref,
                "amount" => $price_usd,
                "currency" => "USD",
                "callback_url" => env('APP_URL', 'http://127.0.0.1:8000/') . "payment/paystack/confirmation",
            ];
        }

        return $data;
    }
    
    function getFlutterwaveData($booking,$price,$transaction_ref,$price_pound = null, $card_type = null){

        if ($booking->country_travelling_from_id == 156 && $card_type == 1) {
            $data = [
                //
                "tx_ref" => $transaction_ref,
                "amount" => $price,
                "currency" => "NGN",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];

        } else {
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $price_pound,
                "currency" => "USD",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "payment/confirmation",
                "customer" => [
                    'email' => $booking->email,
                    'phonenumber' => $booking->phone_no,
                    'name' => $booking->first_name . " " . $booking->last_name
                ],
                "customizations" => [
                    "title" => "UK Covid Testing Booking"
                ]
            ];
        }

        return $data;
    }

    function getVasTechData($booking,$price,$transaction_ref,$price_pound = null, $card_type = null){
        if ($booking->country_travelling_from_id == 156 && $card_type == 1) {
            $data = [
                "transactionRef" => $transaction_ref,
                "amount" => $price,
                "approvedCurrency" => "566",
                "channel" => "WEB",
                "currency" => "NGN",
                "clientAppId" => "831553",
                "clientId" => "238588",
                "mobileNumber"=> "07039448968",
                "paymentTypeId" => 2,
                "redirectURL" => env("VASTECH_URL"),
                "paymentDescription" =>  "TravelTestGlobal Covid Testing Booking"

            ];
            }else{
            $data = [
                "transactionRef" => $transaction_ref,
                "amount" => $price_pound,
                "current" => "GBP",
                "approvedCurrency" => "826",
                "channel" => "WEB",
                "clientAppId" => "831553",
                "clientId" => "238588",
                "mobileNumber"=> "07039448968",
                "paymentTypeId" => 2,
                "redirectURL" => env("VASTECH_URL"),
                "paymentDescription" =>  "TravelTestGlobal Covid Testing Booking"

            ];
        }

        return $data;
    }

    function processFlutterwaveVoucherData($price,$transaction_ref, $country, $agent_id){

        $agent= User::where('id', $agent_id)->first();

        if ($country == "NG") {

            $data = [
                //
                "tx_ref" => $transaction_ref,
                "amount" => $price,
                "currency" => "NGN",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "voucher/payment/confirmation",
                "customer" => [
                    'email' => $agent->email,
                    'phonenumber' => $agent->phone_no,
                    'name' => $agent->first_name . " " . $agent->last_name
                ],
                "customizations" => [
                    "title" => "Traveltestglobal Voucher payment"
                ]
            ];

        } else {

            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $price,
                "currency" => "USD",
                "redirect_url" => env('APP_URL', "https://uktraveltest.prodevs.io/") . "voucher/payment/confirmation",
                "customer" => [
                    'email' => $agent->email,
                    'phonenumber' => $agent->phone_no,
                    'name' => $agent->first_name . " " . $agent->last_name
                ],
                "customizations" => [
                    "title" => "Traveltestglobal Voucher payment"
                ]
            ];

        }

        return $data;
    }

    function processPaystackVoucherData($price,$transaction_ref, $country, $agent_id)
    {
        $agent= User::where('id', $agent_id)->first();
    
        if ($country == "NG") {
            $price = $price * 100;
            $data = [
                //
                "email" => $agent->email,
                "reference" => $transaction_ref,
                "amount" => $price,
                "currency" => "NGN",
                "callback_url" => env('APP_URL', 'http://127.0.0.1:8000/') . "voucher/payment/confirmation",
            ];

        } else {
            $price_usd = $price * 100;
            $data = [
                "email" => $agent->email,
                "reference" => $transaction_ref,
                "amount" => $price_usd,
                "currency" => "USD",
                "callback_url" => env('APP_URL', 'http://127.0.0.1:8000/') . "voucher/payment/confirmation",
            ];
        }

        return $data;
    }

    function sendData($booking)
    {
       
        //ethnicity
        if ($booking->ethnicity == 1) {
            $ethnic = "white_other";
        } elseif ($booking->ethnicity == 2) {
            $ethnic = "other_mixed";
        } elseif ($booking->ethnicity == 3) {
            $ethnic = "other_mixed";
        } elseif ($booking->ethnicity == 4) {
            $ethnic = "black_other";
        } elseif ($booking->ethnicity == 5) {
            $ethnic = "Other_mixed";
        }
       
        //transportation means
        // if ($booking->method_of_transportation == 1) {
        //     $transport = "Airline";
        // } elseif ($booking->method_of_transportation == 2) {
        //     $transport = "Vessel";
        // } elseif ($booking->method_of_transportation == 3) {
        //     $transport = "Train";
        // } elseif ($booking->method_of_transportation == 4) {
        //     $transport = "Road Vehicle";
        // } elseif ($booking->method_of_transportation == 5) {
        //     $transport = "Others";
        // }

        $color_code = CountryColor::where('country_id',$booking->country_travelling_from_id)->first();
        if($color_code == null)
        {
            $c_type = "Amber";
        }else{
             $c_type = (optional($color_code->color)->name) ? optional($color_code->color)->name : "Amber";
        }
      
        $data_send["test_kit_properties"] = [
            'first_name' => $booking->first_name,
            'last_name' => $booking->last_name,
            'birth_date' => Carbon::parse($booking->dob)->format('Y-m-d'),
            'sex' => ($booking->sex == 1) ? "Male" : "Female",
            'ethnicity' => $ethnic,
            "email" => $booking->email,
            'vaccine_type' => ($booking->vaccination_type) ? $booking->vaccination_type : "n/a",
            "mobile" => $booking->phone_no,
            "arrival_in_uk" => Carbon::parse($booking->arrival_date)->toDateString(),
            "country_from" => $booking->travelingFrom->name,
            "nhs_number" => $booking->nhs_number,
            "departure_from_abroad_date" => Carbon::parse($booking->departure_date)->format('Y-m-d'),
            "flight_number" => $booking->transport_no,
            "passport" => $booking->document_id,
            'vaccination_status' => $booking->vaccination_status,
            "address_line_1" => $booking->isolation_address,
            "city" => $booking->isolation_town,
            "postcode" => $booking->isolation_postal_code,
            "country_type" => $c_type,
            "countries_travelled" => ($booking->travelingFrom) ? optional($booking->travelingFrom)->name: "Nigeria"
        ];

        if ($booking->vaccination_type && $booking->vaccination_type != "n/a") {
            $data_send["test_kit_properties"]["vaccination_date"] = Carbon::parse($booking->vaccination_date)->toDateString();
        }

        $data_send["shipping_address_attributes"] =
            [
                "line_1" => $booking->isolation_address,
                "city" => $booking->isolation_town,
                "postcode" => $booking->isolation_postal_code
            ];

        // $data_send['external_reference'] = "booking_".$booking->id;
        $data_send['product'] = optional(optional($booking->product)->product)->name;

        
        $booking_products = BookingProduct::where('booking_id', $booking->id)->get();

        // dd($booking_products);
        $code = [];
        $z = 0;
        $y = 0;
        $i = 0;
        ini_set('max_execution_time', 300);
        foreach($booking_products as $booking_product)
        {
            $z = $z + $booking_product->quantity;
        }
          
            while($y < $z){
                $data_send['external_reference'] = "booking_".$booking->id."_".$y;
                $i++;
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://portal.ukhealthtesting.com/api/partner_orders");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,
                    http_build_query($data_send));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $response = curl_exec($ch);
        
                curl_close($ch);
                dd($response);
                $data_response = json_decode($response);
                $code[] = $data_response->reference;
                $y++;
                
               
            }
         
       
        $formatted_data = json_encode($code);

        return $formatted_data;

    }

    function sendSMS($message = "", array $phone_numbers = [], int $forceSendDND = 4)
    {
       try {
          
             $numbersToString = "";
             foreach ($phone_numbers as $number) {
                if(strlen($number) == 11){
                   $remove = ltrim($number, "0");
                   //Remove leading zero
                  $number_ = '234' . $remove;
                }
                else{
                   $number_ = str_replace("+" , "", $number);
                }
    
                $numbersToString .= $number_ . ',';
             }
    
             $api_token = env("SMS_TOKEN", "FMvbeUayBAfg5lcrimO6Hhd1Jz3qJAjL2W8OiNESYL8BfCgPOMv2mm3S3N7F");
             $message = $message;
             $sender_name = env("SMS_SENDER_NAME", "Traveltest");
             $recipients = $numbersToString;
             $forcednd = $forceSendDND;
    
    
             $data = array("api_token" => $api_token, "body" => $message, "from" => $sender_name, "to" => $recipients, "dnd" => $forcednd);
             $data_string = json_encode($data);
             $ch = curl_init('https://www.bulksmsnigeria.com/api/v1/sms/create');
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
             $result = curl_exec($ch);
             $res_array = json_decode($result);
   
             if (isset($res_array->data) && $res_array->data->status != "success") {
                return [
                   'status' => false,
                   'msg' => $res_array->data->message,
                ];
             } else {
                return [
                   'status' => true,
                   'msg' => "SMS sent successfully!",
                ];
             }
          
       } catch (Exception $e) {
          logger($e->getMessage());
         
          return [
             'status' => false,
             'msg' => "An SMS error occurred",
          ];
       }
    }
}
