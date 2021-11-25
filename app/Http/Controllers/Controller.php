<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CountryColor;
use App\Models\BookingProduct;
use App\Models\VendorProduct;
use App\Models\VoucherPayment;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Stripe;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getDamhealthToken()
    {
         ///  ---------------  Get Bearer Token  -----------  ///
         $request = [
            "client_id" => "4e0fc3ff-7256-478b-9434-c6df9df9db0c",
            "client_secret" =>"b7ed19139aa984f4e8a1084cef5b32677d1ed2d66645df061485d58d77af27bab000c6a6f5eca5b8052d496ff1f9dcf7a8d6e94132519db56000b7e91c7c9853"
        ];

            $data_string = json_encode($request);

            $url = "https://partner-api-dev.dam-health.com/v1/api/authenticate";

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));

            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result);
            $bearer = $response->token->value;
            ///  --------------------   End of get bearer token   -----------------   ///
            return $bearer;
    }

    function getDamHealthLocations($bearer)
    {
        ///  -----------------  Get Location list  -----------  ///
        $request2 = [

            "query" => "query GetLocations {damhealth_locations {availability isactive locationid name address rooms { name roomid } } }"
            
            ];

        $data_string2 = json_encode($request2);

        // dump($data_string2);
        // exit();
        $ch2 = curl_init('https://partner-api-dev.dam-health.com/v1/graphql');

        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $data_string2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $bearer"));

        $result_p = curl_exec($ch2);
        curl_close($ch2);
        ///    --------------------    end of get product list   -----------------   ///
        
        return $result_p;
    }

    function getDamHealthProducts($bearer)
    {
       ///  -------------------   Get Product list   --------------   ///
       $getArrayProduct = [

        "query" => "query GetProducts { damhealth_products { locationids itemcode name price productid priceandavailabilitybylocation type} }"
      
        ];

        $encodedArray = json_encode($getArrayProduct);

        $ch3 = curl_init('https://partner-api-dev.dam-health.com/v1/graphql');

        curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch3, CURLOPT_POSTFIELDS,  $encodedArray);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $bearer"));
    
        $result_3 = curl_exec($ch3);
        curl_close($ch3);
        ///   --------------------    end of get product list   -----------------  ///
            
        return $result_3;
    }

    function GetDamHealthCode($booking)
    {
        $bproduct= BookingProduct::where('booking_id',$booking->id)->first();
        $product = VendorProduct::where('id', $bproduct->vendor_product_id)->first();

        $locationid = $booking->dam_location;
        $getroom = json_decode($booking->dam_room);
        $getAddress = json_decode($booking->dam_address);
        $city = $getAddress->city;
        $address =  $getAddress->address;
        $country =  $getAddress->country;
        $postalcode =  $getAddress->postcode;
        $room = $getroom->roomid;
        $dam_product_id = $product->walk_product_id;
        $bookdate = $booking->created_at->format('Y-m-d');
        $durateStart = $booking->arrival_date->format('Y-m-d') ."T8:00:00";
        $durateEnd = $booking->arrival_date->format('Y-m-d') ."T17:00:00";
        $dob = $booking->dob->format('Y-m-d');
        
        //ethnicity
        if ($booking->ethnicity == 1) {
            $ethnic = "white";
        } elseif ($booking->ethnicity == 2) {
            $ethnic = "asian";
        } elseif ($booking->ethnicity == 3) {
            $ethnic = "mixed";
        } elseif ($booking->ethnicity == 4) {
            $ethnic = "black";
        } elseif ($booking->ethnicity == 5) {
            $ethnic = "Other_mixed";
        }

        if ($booking->sex == 1) {
            $sex = "male";
        } else{
            $sex = "female";
        }

       

        
         ///  ------------  Create  a New Booking ----------   ///
         $bearer = $this->getDamhealthToken();

         $object = [ "object" => ["locationid"=> $locationid,"roomid"=>  $room,"durationstart"=> $durateStart,"durationend"=> $durateEnd,"bookingdate"=> $bookdate,"comments"=> "","bookingproducts"=> [ "data"=> [ ["productid"=> $dam_product_id ] ] ],"bookingnotes"=> [ "data"=> [ "note"=> ""] ],"patient"=> ["data"=> ["address"=> [ ["address"=> $address,"city"=>  $city,"state"=> $booking->isolation_town,"postcode"=> "$postalcode","country"=> $country]],"firstname"=> $booking->first_name,"lastname"=> $booking->first_name,"dob"=> $dob,"gender"=> $sex, "email"=> $booking->email,"mobilenumber"=> $booking->phone_no,"passportnumber"=> "123456789","ethnicity"=> $ethnic,"religion"=> null,"occupation"=> null,"company"=> null,"comments"=> null,"customattributes"=> null,"receiveemail"=> true, "receivesms"=> true,"promotionalmarketing"=> true] ] ] ];
       
         // $object = json_encode($object);
  
         $getArrayBooking = [
 
             "query" => 'mutation CreateBooking( $object: damhealth_bookings_insert_input!) { insert_damhealth_bookings_one(object: $object) {bookingid} }',
             "variables" => $object
             
         ];
        
         $encoded_booking_data = json_encode($getArrayBooking);
        
         $b = curl_init('https://partner-api-dev.dam-health.com/v1/graphql');
 
         curl_setopt($b, CURLOPT_CUSTOMREQUEST, "POST");
         curl_setopt($b, CURLOPT_POSTFIELDS,   $encoded_booking_data);
         curl_setopt($b, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($b, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $bearer"));
         
         $result_book = curl_exec($b);
         curl_close($b);
         $dam_booking = json_decode($result_book);

         $code = array();

         $code[] = $dam_booking->data->insert_damhealth_bookings_one->bookingid;
     
        $formatted_data = json_encode($code);

        return $formatted_data;
    }

    function processStripe($stripeToken,$booking_id){

        $booking = Booking::where('id', $booking_id)->first();
        $product = BookingProduct::where('booking_id',$booking_id)->first();

        $username =  $booking->first_name." ".$booking->last_name;
        $item = $product->product->name;
        $quantity = $product->quantity;

      
       
        if($product->currency == 'NGN'){

            \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JP5BAG2gr81fV6sIYtifddnR0KZ3e8Y2eqPQEoWBe6nCBWfqs9nR9fhScQwd0JakZ1u6BA3fm7igEUVKOLaSKmL006KZ7Ekac'));

            $stripe_charge = Stripe\Charge::create ([
                    "amount" => $product->charged_amount * 100,
                    "currency" => "NGN",
                    "source" => $stripeToken,
                    "description" => "Payment for $quantity x $item by $username ." 
            ]);
             
        }else{

            \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JP5BAG2gr81fV6sIYtifddnR0KZ3e8Y2eqPQEoWBe6nCBWfqs9nR9fhScQwd0JakZ1u6BA3fm7igEUVKOLaSKmL006KZ7Ekac'));

            $stripe_charge = Stripe\Charge::create ([
                    "amount" => $product->price_pounds * 100,
                    "currency" => "USD",
                    "source" => $stripeToken,
                    "description" => "Payment for $quantity x $item by $username ." 
            ]);
          
        }
         
        $data = ["data" => $stripe_charge];

        return  json_encode($data);
    }

    function processVoucherStripe($stripeToken,$id){

        $v_pay = VoucherPayment::where('id', $id)->first();
       

        $username =  $v_pay->user->first_name." ".$v_pay->user->last_name;
        $item = $v_pay->product->name;
        $quantity = $v_pay->quantity;

        

      
       
        if($v_pay->currency == 'NG'){

            \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JP5BAG2gr81fV6sIYtifddnR0KZ3e8Y2eqPQEoWBe6nCBWfqs9nR9fhScQwd0JakZ1u6BA3fm7igEUVKOLaSKmL006KZ7Ekac'));

            $stripe_charge = Stripe\Charge::create ([
                    "amount" => $v_pay->charged_amount * 100,
                    "currency" => "NGN",
                    "source" => $stripeToken,
                    "description" => "Payment for $quantity x $item by $username ." 
            ]);
             
        }else{

            \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JP5BAG2gr81fV6sIYtifddnR0KZ3e8Y2eqPQEoWBe6nCBWfqs9nR9fhScQwd0JakZ1u6BA3fm7igEUVKOLaSKmL006KZ7Ekac'));

            $stripe_charge = Stripe\Charge::create ([
                    "amount" => $v_pay->charged_amount * 100,
                    "currency" => "USD",
                    "source" => $stripeToken,
                    "description" => "Payment for $quantity x $item by $username ." 
            ]);
          
        }
         
        $data = ["data" => $stripe_charge];

        return  json_encode($data);
    }

    function checkSession($booking_product){
        \Stripe\Stripe::setApiKey(env('Stripe_Key','sk_test_51JrhodAxurgPUhdw4h7s1RzWGxbobEC38K1LjNWVI6gH7rdQMNYYkNXfSQbYF78weVxoIwWwvqXdSRBz6qJZCT9M00771V820w'));

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
            // dd($server_output);
            return $server_output->data->link;
        }catch (\Exception $e){
            dd(json_decode($server_output));
        }
    }

    public function processVAS(array $request = [])
    {
        unset($request['subaccounts']);
        unset($request['currency']);
     

        //    dd($request);
        // dd($request,env('VASTECHKEY', '8317dc390aca4e482bf8d2ae06f4d3cfdf3ed402c5afd7f8d0bc257dea4842d9'));

        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'X-API-Key: '.env('VASTECHKEY', '47489e67e05cd615c22298f826391ae0a0d8f124941f7a02a86e7c79ce558743');
        //dd($headr);
        curl_setopt($ch, CURLOPT_URL, env('VASTECH_URL', 'https://dashboard.smartpay.ng/api/v1/ubank'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        // dd( $server_output, $request );
        $server_output = json_decode($server_output);
  
        return $server_output->data;
    }

    function confirm_vas($url, $txRef){
       
   
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'X-API-Key: '.env('VASTECHKEY', '47489e67e05cd615c22298f826391ae0a0d8f124941f7a02a86e7c79ce558743');


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            json_encode(['transactionRef'=> $txRef ,"clientId"=> 333117])
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        curl_close($ch);
   
        return $response;

        
    }

    function getVasTechVoucherData($amount, $transaction_ref, $country, $agent_id){
        if (auth()->user()->country == "NG" ) {
            //50 naira minium pay
            $data = [
                "transactionRef" => $transaction_ref,
                "amount" => round($amount,0),
                "approvedCurrency" => "566",
                "channel" => "WEB",
                "currency" => "NGN",
                "clientAppId" => env('VASTECH_CLIENT_APP_ID', '568412'),
                "clientId" => env('VASTECH_CLIENT_ID', '333117'),
                "mobileNumber"=> "+442080872262",
                "paymentTypeId" => 2,
                "redirectURL" =>  env('APP_URL', "http://127.0.0.1:8000/") . "voucher/payment/confirmation",
                "paymentDescription" =>  "TravelTestGlobal Voucher Payment"

            ];
        }else{
            //5 dollar  minium pay
            $data = [
                "transactionRef" => $transaction_ref,
                "amount" => round($amount, 0),
                "currency" => "USD",
                "approvedCurrency" => "840",
                "channel" => "WEB",
                "clientAppId" => env('VASTECH_CLIENT_APP_ID', '568412'),
                "clientId" => env('VASTECH_CLIENT_ID', '333117'),
                "mobileNumber"=>  "+442080872262",
                "paymentTypeId" => 4,
                "redirectURL" =>  env('APP_URL', "http://127.0.0.1:8000/") . "voucher/payment/confirmation",
                "paymentDescription" =>  "TravelTestGlobal Voucher Payment"

            ];
        }

        return $data;
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
            //50 naira minium pay
            $data = [
                "transactionRef" => $transaction_ref,
                "amount" => $price,
                "approvedCurrency" => "566",
                "channel" => "WEB",
                "currency" => "NGN",
                "clientAppId" => env('VASTECH_CLIENT_APP_ID', '568412'),
                "clientId" => env('VASTECH_CLIENT_ID', '333117'),
                "mobileNumber"=> $booking->phone_no,
                "paymentTypeId" => 2,
                "redirectURL" =>  env('APP_URL', "http://127.0.0.1:8000/") . "payment/vas/confirmation",
                "paymentDescription" =>  "TravelTestGlobal Covid Testing Booking"

            ];
        }else{
            //5 dollar  minium pay
            $data = [
                "transactionRef" => $transaction_ref,
                "amount" => $price_pound,
                "currency" => "USD",
                "approvedCurrency" => "840",
                "channel" => "WEB",
                "clientAppId" => env('VASTECH_CLIENT_APP_ID', '568412'),
                "clientId" => env('VASTECH_CLIENT_ID', '333117'),
                "mobileNumber"=>  $booking->phone_no,
                "paymentTypeId" => 4,
                "redirectURL" =>  env('APP_URL', "http://127.0.0.1:8000/") . "payment/vas/confirmation",
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

        if($booking->test_kit != null){
            //test json format to array passed as barcode
            $data_send["barcode"] = json_decode($booking->test_kit);

        }

        $booking_products = BookingProduct::where('booking_id', $booking->id)->get();

        // dd($booking_products);
        $code = [];
        $acr = [];
        $external =[];
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
                $external[] = "booking_".$booking->id."_".$y;
                $i++;
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://portal.ukhealthtesting.com/api/partner_orders");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_send));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $response = curl_exec($ch);
        
                curl_close($ch);
                
                $data_response = json_decode($response);
                $code[] = $data_response->reference;
                
                $y++;
                
                if($data_response->acr != null)
                {
                    $acr[] = $data_response->acr;
                }
              
            }
         
        $ukht_data["ukht_id"] = json_encode($external);
       //getting antigen certificate number
        if($data_response->acr != null)
        {
            $ukht_data["certificate_no"] =  json_encode($acr);
          
        }
    
        $final_book = Booking::where('id', $booking->id);
        $final_book->update($ukht_data);
      
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
