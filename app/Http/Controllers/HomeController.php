<?php

namespace App\Http\Controllers;

use App\Mail\BookingCreation;
use App\Mail\VendorReceipt;
use App\Models\Booking;
use App\Models\BookingProduct;
use App\Models\Country;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;

class HomeController extends Controller
{
    public function booking()
    {
        $countries = Country::all();
        $products = Product::all();
        $vendors = Vendor::all();

        return view('homepage.booking')->with(compact('countries', 'products', 'vendors'));
    }

    public function login()
    {
        if (auth()->check()) {
            return redirect()->to('/dashboard');
        }
        return view('homepage.login');
    }

    public function post_login(Request $request)
    {
        $this->validate($request, [
            'email' => "required",
            'password' => "required"
        ]);

        $request_data = $request->all();
        unset($request_data['_token']);
        if (auth()->attempt($request_data)) {

            if (auth()->user()->type == 0) {
                if (auth()->user()->verified == 0) {
                    session()->flash('alert-danger', 'Account not verified, Kindly check your email to verify your account.');
                    auth()->logout();
                    return back();
                }
            }
            return redirect()->to('/dashboard');
        }

        session()->flash('alert-danger', 'Login Incorrect, Kindly check your username/password.');
        return back();


    }

    public function post_booking(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'ethnicity' => 'required',
            'vaccination_status' => 'required',
            'phone_no' => 'required',
            'email' => 'required',
            'address_1' => 'required',
            'home_town' => 'required',
            'post_code' => 'required',
            'home_country_id' => 'required',
            'isolation_address' => 'required',
            'isolation_town' => 'required',
            'isolation_postal_code' => 'required',
            'isolation_country_id' => 'required',
            'document_id' => 'required',
            'arrival_date' => 'required',
            'country_travelling_from_id' => 'required',
            'city_from' => 'required',
            'departure_date' => 'required',
            'last_day_travel' => 'required',
            'method_of_transportation' => 'required',
            'transport_no' => 'required',
            'consent' => 'required'
        ]);
        $sub_account = [];

        $request_data = $request->all();

        unset($request_data['_token']);

        $transaction_ref = uniqid('booking_') . rand(10000, 999999);

        if (isset($request_data['ref'])) {
            $user = User::where('referal_code', $request_data['ref'])->first();

            if ($user) {
                $request_data['referral_code'] = $request_data['ref'];
                $request_data['user_id'] = $user->id;
                if ($user->flutterwave_key) {
                    $sub_account[] = $user->flutterwave_key;
                }
            }
        }

        unset($request_data['ref']);

        $request_data['transaction_ref'] = $transaction_ref;

        $booking = Booking::create($request_data);
        $vendor_products = VendorProduct::where('vendor_id', $request->vendor_id)->where('product_id', $request->product_id)->first();

        $booking_product = BookingProduct::create([
            'booking_id' => $booking->id,
            'product_id' => $request->product_id,
            'vendor_id' => $request->vendor_id,
            'vendor_product_id' => $vendor_products->id,
            'price' => $vendor_products->price
        ]);
        //send an email
        try {
            $message = "
            Hi " . $request->first_name . ",
            
            Thank you for choosing to book with us. To complete your booking, you will need to make payment.<br/><br/>Kindly click the button below to make payment<br/><br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "make/payment/" . $transaction_ref . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Make Payment
                  </a>
                  
                  <br/><br/>
                  Thank you.
            ";
            Mail::to($booking->email)->send(new BookingCreation($message));
        } catch (\Exception $e) {

        }

        //check by country
        if($request->home_country_id == 81 ){
            // naira to ghanian cedis 
            $convert_amount = $booking_product->price * 0.014;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "GHS",
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
        }elseif($request->home_country_id == 156){
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $booking_product->price,
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
        }elseif($request->home_country_id == 210){
            // naira to tanzanian cedis 
            $convert_amount = $booking_product->price * 5.56;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "TZS",
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
        }elseif($request->home_country_id == 110){
            // naira to kenyan shillings
            $convert_amount = $booking_product->price * 0.26;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "KES",
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
        }elseif($request->home_country_id == 197){
            // naira to south african rand
            $convert_amount = $booking_product->price * 28.12;
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $convert_amount,
                "currency" => "ZAR",
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
        }else{
            $data = [
                "tx_ref" => $transaction_ref,
                "amount" => $booking_product->price,
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
        }
        //redirect to payment page
        

        if (!empty($sub_account)) {
            $data['subaccounts'] = $sub_account;
        }

        $redirect_url = $this->processFL($data);

        return redirect()->to($redirect_url);

    }

//https://uktraveltest.test/payment/confirmation?status=cancelled&tx_ref=booking_60ed2341abc31588840
    public function payment_confirmation(Request $request)
    {

        if (env('APP_ENV', "LIVE") == "LIVE") {
            $url = "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify";
        } else {
            $url = "https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify";
        }

        $request_data = $request->all();

        $txRef = $request->tx_ref;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "txref=" . $txRef . "&SECKEY=" . env('RAVE_SECRET_KEY', 'FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $data_response = json_decode($response);


        if (isset($data_response->data->status) && $data_response->data->status == "successful") {
            $booking = Booking::where('transaction_ref', $txRef)->first();
            if ($booking->status != 1) {
                $booking_product = BookingProduct::where('booking_id', $booking->id)->first();

                if ($booking->user_id) {
                    $user = User::where('id', $booking->user_id)->first();

                    $pecentage = Setting::where('id', '2')->first();


                    $cost_booking = $booking_product->price;

                    $amount_credit = ($cost_booking * ($pecentage->value / 100));


                    Transaction::create([
                        'amount' => $amount_credit,
                        'booking_id' => $booking->id,
                        'user_id' => $user->id,
                        'cost_config' => $cost_booking,
                        'pecentage_config' => $pecentage->value
                    ]);

                    $total_amount = $user->wallet_balance + $amount_credit;

                    User::where('id', $booking->user_id)->update([
                        'wallet_balance' => $total_amount
                    ]);
                }

                $code = "PEXPO" . rand(40000, 1000000);



                try {
                    $message = "
            Hi " . $request->first_name . ",
            
            Thank you for booking with us, Here is your code " . $code . ". You are to use this code in your travel form. 
                  
                  <br/><br/>
                  Thank you.
            ";
                    Mail::to($booking->email)->send(new BookingCreation($message));
                } catch (\Exception $e) {

                }

                //send the receipt to the vendor

                if ($booking_product) {
//                    try {

                    Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from " . optional($booking_product->vendor)->name, optional($booking_product->vendor)->email));

//                    } catch (\Exception $e) {
//
//                    }
                }

                $booking->update([
                    'mode_of_payment' => 1,
                    'transaction_ref' => $txRef,
                    'status' => 1,
                    'booking_code' => $code
                ]);


            }


            return redirect()->to('/booking/success?b=' . $txRef);
        }

        return redirect()->to('/booking/failed?b=' . $txRef);
    }

    public function booking_success(Request $request)
    {
        $booking = Booking::where('transaction_ref', $request->b)->first();

        return view('homepage.success')->with(compact('booking'));
    }

    public function booking_failed(Request $request)
    {
        $booking = Booking::where('transaction_ref', $request->b)->first();

        return view('homepage.failed')->with(compact('booking'));
    }

    public function make_payment($booking_ref)
    {
        $transaction_ref = $booking_ref;
        $booking = Booking::where('transaction_ref', $booking_ref)->first();

        $setting = Setting::where('name', 'amount')->first();
        //redirect to payment page
        $data = [
            "tx_ref" => $transaction_ref,
            "amount" => $setting->value,
            "currency" => "NGN",
            "redirect_url" => "https://uktraveltest.test/payment/confirmation",
            "customer" => [
                'email' => $booking->email,
                'phonenumber' => $booking->phone_no,
                'name' => $booking->first_name . " " . $booking->last_name
            ],
            "customizations" => [
                "title" => "UK Covid Testing Booking"
            ]
        ];

        $sub_account = [];

        if ($booking->user_id) {
            $user = User::where('id', $booking->user_id)->first();

            if ($user) {
                if ($user->flutterwave_key) {
                    $sub_account[] = $user->flutterwave_key;
                }
            }
        }

        if (!empty($sub_account)) {
            $data['subaccounts'] = $sub_account;
        }

        $redirect_url = $this->processFL($data);

        return redirect()->to($redirect_url);
    }

    public function register_agent()
    {
        return view('homepage.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'phone_no' => 'required',
            'password' => 'required'
        ]);

        $request_data = $request->all();

        $referral = $this->randomStr(6);

        $request_data['referal_code'] = $referral;
        $request_data['password'] = Hash::make($request_data['password']);
        $request_data['type'] = 2;

        $user = User::create($request_data);


        try {
            $message = "
            Hi " . $request->first_name . ",
            
            Thank you for registering as an agent. To continue your registration,<br/><br/>Kindly click the button below<br/><br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Continue Registration
                  </a>
                  
                  <br/><br/>
                  Thank you.
            ";
            Mail::to($request->email)->send(new BookingCreation($message, "Registration"));
        } catch (\Exception $e) {

        }

        session()->flash('alert-success', "Thank you for your registration, kindly click the link sent to your email to continue your registration");

        return back();


    }

    public function testEmail()
    {
        dd(Hash::make('william'));
        $user = User::where('email', "williamnwogbo@gmail.com")->first();

        $referral = $user->referal_code;

        $message = "
            Hi " . $user->first_name . ",
            
            Thank you for registering as an agent. To continue your registration, <br/><br/>Kindly click the button below<br/> <br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Continue Registration
                  </a>
                  
                  <br/><br/>
                  Thank you.
            ";

        Mail::to($user->email)->send(new BookingCreation($message, "Registration"));
    }

    public function randomStr($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    public function verify_account($referral_code, $user)
    {

        $user = User::where('id', $user)->where('referal_code', $referral_code)->first();

        if ($user && $user->verified == 0) {
            $user->update([
                'verified' => '1'
            ]);

            session()->flash('alert-success', "Account has been verified. Kindly login into your account");

            return redirect()->to('/login');
        } else {
            session()->flash('alert-success', "Kindly login into your account");
            return redirect()->to('/login');
        }
    }

    public function about()
    {
        return view('homepage.about');
    }
    public function pick()
    {
       
        return view('homepage.medpick');
    }

    public function products()
    {
        $products = Product::all();
        return view('homepage.products')->with(compact('products'));
    }

    public function check_price($vendor_id, $product_id)
    {
        $vendor_product = VendorProduct::where('vendor_id', $vendor_id)->where('product_id', $product_id)->first();

        return $vendor_product;
    }
    public function product_to_vendors($product_id, $nationality){
        //if nationality is nigeria
        if($nationality == 156){
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach($vendor_products as $vproduct ){
               
                $product[] = [
                        'name' => $vproduct->vendor->name,
                        'price' => "N ".$vproduct->price,
                        'vendor_id' => $vproduct->vendor_id
                ];
            }
             //if nationality is ghana
        }elseif($nationality == 81){
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach($vendor_products as $vproduct ){
               
                $product[] = [
                        'name' => $vproduct->vendor->name,
                        'price' => "GH ".$vproduct->price * 0.014,
                        'vendor_id' => $vproduct->vendor_id
                ];
            }
        //if nationality is KENYA
        }elseif($nationality == 110){
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach($vendor_products as $vproduct ){
               
                $product[] = [
                        'name' => $vproduct->vendor->name,
                        'price' => "KE ".$vproduct->price * 0.26,
                        'vendor_id' => $vproduct->vendor_id
                ];
            }
         //if nationality is Tanzania
        }elseif($nationality == 210){
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach($vendor_products as $vproduct ){
               
                $product[] = [
                        'name' => $vproduct->vendor->name,
                        'price' => "TZS ".$vproduct->price * 5.56,
                        'vendor_id' => $vproduct->vendor_id
                ];
            }
         //if nationality is south africa
        }elseif($nationality == 197){
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach($vendor_products as $vproduct ){
               
                $product[] = [
                        'name' => $vproduct->vendor->name,
                        'price' => "ZAR ".$vproduct->price * 28.12,
                        'vendor_id' => $vproduct->vendor_id
                ];
            }
         //if nationality is pounds
        }else{
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach($vendor_products as $vproduct ){
                $product[] = [
                        'name' => $vproduct->vendor->name,
                        'price' => "£ ".$vproduct->price_pounds,
                        'vendor_id' => $vproduct->vendor_id
                ];
            }
        }
        
        return $product;
    }

    public function pricing()
    {
        $products = Product::all();
        $vendors = Vendor::all();
        return view('homepage.pricing')->with(compact('products','vendors'));
    }

    public function webhook_receiver(Request $request){
        Log::info($request->all());
    }


}
