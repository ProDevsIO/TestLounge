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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;

class HomeController extends Controller
{
    public function booking(Request $request)
    {
        $countries = Country::all();
        $products = Product::all();
        $vendors = Vendor::all();
        $user = "";

        if($request->ref){
            $user = User::where('referal_code',$request->ref)->first();
        }


        return view('homepage.booking')->with(compact('countries', 'products', 'vendors','user'));
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

            //account verified before login
            if (auth()->user()->type == 2) {
                if (auth()->user()->verified == 0) {
                    session()->flash('alert-danger', 'Account not verified, Kindly check your email to verify your account.');
                    auth()->logout();
                    return back();
                }
            }

            //To restrict access as per admin 
            if (auth()->user()->status == 0) {
                session()->flash('alert-danger', "Your profile is currently under review and will be activated shortly by our Admin. To Facilitate this process, Kindly contact INFO@UKTRAVELTESTS.CO.UK");
                auth()->logout();
                return back();
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

        $request->vendor_id = 3;



        if (empty($request->product_id)) {
            session()->flash('alert-danger', "Kindly select a product");
            return back()->withInput();
        }

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

        $price = 0;
        $product_id[] = $request->product_id;
        foreach ($product_id as $r_product) {

            $vendor_products = VendorProduct::where('vendor_id', 3)->where('product_id', $r_product)->first();

            BookingProduct::create([
                'booking_id' => $booking->id,
                'product_id' => $r_product,
                'vendor_id' => $request->vendor_id,
                'vendor_product_id' => $vendor_products->id,
                'price' => $vendor_products->price
            ]);

            $price = $price + $vendor_products->price;
        }


        //send an email
        try {
            $message = "
                Hi " . $request->first_name . ",
                
                Thank you for choosing to book with us. To complete your booking, you will need to make payment.<br/><br/>Kindly click the button below to make payment<br/><br/>
                For More Information and Guidelines on the UK Travel Testing Process, click <a href='https://uktraveltest.prodevs.io/#popular' >Here</a> <br>
                <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "make/payment/" . $transaction_ref . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                       Make Payment
                      </a>
                      
                      <br/><br/>
                      Thank you.
                ";
            Mail::to($booking->email)->send(new BookingCreation($message));
        } catch (\Exception $e) {

        }


        if ($request->country_travelling_from_id == 81) {
            // naira to ghanian cedis
            $convert_amount = $price * 0.014;
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
        } elseif ($request->country_travelling_from_id == 156) {
            $data = [
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
        } elseif ($request->country_travelling_from_id == 210) {
            // naira to tanzanian cedis
            $convert_amount = $price * 5.56;
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
        } elseif ($request->country_travelling_from_id == 110) {
            // naira to kenyan shillings
            $convert_amount = $price * 0.26;
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
        } elseif ($request->country_travelling_from_id == 197) {
            // naira to south african rand
            $convert_amount = $price * 0.036;
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
        } else {
            $data = [
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
        }

        //redirect to payment page
        if (!empty($sub_account)) {
            $data['subaccounts'] = ["id" => $sub_account ];
        }

         BookingProduct::where('booking_id',$booking->id)->update([
            'charged_amount' => $data['amount'],'currency' => $data['currency']
        ]);


        $redirect_url = $this->processFL($data);

        return redirect()->to($redirect_url);

    }

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
                    if ($user->percentage_split != null) {
                        $pecentage = $user->percentage_split;
                    } else {
                        $defaultpercent = Setting::where('id', '2')->first();
                        $pecentage = $defaultpercent->value;
                    }


                    $cost_booking = $booking_product->price;

                    $amount_credit = ($cost_booking * ($pecentage / 100));


                    Transaction::create([
                        'amount' => $amount_credit,
                        'booking_id' => $booking->id,
                        'user_id' => $user->id,
                        'cost_config' => $cost_booking,
                        'pecentage_config' => $pecentage
                    ]);

                    $total_amount = $user->wallet_balance + $amount_credit;

                    User::where('id', $booking->user_id)->update([
                        'wallet_balance' => $total_amount
                    ]);
                }


                $code = "RUKHT" . rand(1000000, 9999999);



//                try {
//                    $message = "
//            Hi " . $request->first_name . ",
//
//            Thank you for booking with us, Here is your code " . $code . ". You are to use this code in your travel form.
//
//                  <br/><br/>
//                  Thank you.
//            ";
//                    Mail::to($booking->email)->send(new BookingCreation($message));
//                } catch (\Exception $e) {
//
//                }
                //send the receipt to the vendor

                if ($booking_product) {
                    try {

                        // Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from " . optional($booking_product->vendor)->name, optional($booking_product->vendor)->email,$code));
                        Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests" , optional($booking_product->vendor)->email,$code));


                    } catch (\Exception $e) {

                    }
                }

                $booking->update([
                    'vendor_id' => 3,
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


    function sendData($booking)
    {
        //ethnicity
        if ($booking->ethnicity == 0) {
            $ethnic = "white";
        } elseif ($booking->ethnicity == 1) {
            $ethnic = "Mixed/Muti Ethnic group";
        } elseif ($booking->ethnicity == 2) {
            $ethnic = "Asain/Asian British";
        } elseif ($booking->ethnicity == 3) {
            $ethnic = "Black";
        } elseif ($booking->ethnicity == 4) {
            $ethnic = "Others";
        }

        //transportation means
        if ($booking->method_of_transportation == 1) {
            $transport = "Airline";
        } elseif ($booking->method_of_transportation == 2) {
            $transport = "Vessel";
        } elseif ($booking->method_of_transportation == 3) {
            $transport = "Train";
        } elseif ($booking->method_of_transportation == 4) {
            $transport = "Road Vehicle";
        } elseif ($booking->method_of_transportation == 5) {
            $transport = "Others";
        }

        $data_send = ['first_name' => $booking->first_name,
            'last_name' => $booking->last_name,
            'dob' => [
                'day' => Carbon::parse($booking->dob)->day,
                'month' => Carbon::parse($booking->dob)->month,
                'year' => Carbon::parse($booking->dob)->year,
            ],
            'sex' => $booking->sex,
            'vaccination_status' => $booking->vaccination_status,
            'ethnicity' => $ethnic,
            "nhs_number" => $booking->nhs_number,
            "document_id" => $booking->document_id,
            "uk_post_code" => $booking->post_code,
            "uk_address" => $booking->address_1,
            "uk_city" => $booking->home_town,
            "departure_date" => Carbon::parse($booking->departure_date)->toDateString(),
            "country_travelled_from" => $booking->travelingFrom->name,
            "city_travelled_from" => $booking->city_from,
            "type_of_transport" => $transport,
            "coach_number" => $booking->transport_no,
            "email" => $booking->email,
            "phone" => $booking->phone_no
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://renwicktech.co.uk/api/v1/sterling/booking");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($data_send));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $data_response = json_decode($response);

        return $data_response->reference_number;
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
            'company' => 'required',
            'password' => 'required'

        ]);

        $request_data = $request->all();

        $referral = $this->randomStr(6);

        $request_data['referal_code'] = $referral;
        $request_data['password'] = Hash::make($request_data['password']);
        $request_data['type'] = 2;
        $request_data['status'] = 0;

        $user = User::create($request_data);


        try {
            $message = "
            Hi " . $request->first_name . ",
            
            Thank you for your interest to register as an Agent with UKTravel Tests,<br/><br/>Kindly click the button below<br/><br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Continue Registration
                  </a>
                  
                  <br/><br/>
                  Thank you.
                  <br/><br/>
                UKTravelsTeam
            ";
            Mail::to($request->email)->send(new BookingCreation($message, "Registration"));
        } catch (\Exception $e) {

        }

        session()->flash('alert-success', "Thank you for your registration, kindly click the link sent to your email to continue your registration");

        return back();


    }

    public function testEmail()
    {
//        dd(Hash::make('william'));
        $booking = Booking::where('id',51)->first();
        $booking_product = BookingProduct::where('booking_id',$booking->id)->first();
        $code= "sdsbdjksds";

        if ($booking_product) {


                Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from " . optional($booking_product->vendor)->name, optional($booking_product->vendor)->email,$code));


        }

//        $referral = $user->referal_code;
//
//        $message = "
//            Hi " . $user->first_name . ",
//
//            Thank you for registering as an agent. To continue your registration, <br/><br/>Kindly click the button below<br/> <br/>
//            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
//                   Continue Registration
//                  </a>
//
//                  <br/><br/>
//                  Thank you.
//            ";

//        Mail::to($user->email)->send(new BookingCreation($message, "Registration"));
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

    public function agent_activate($id)
    {
        User::where('id', $id)->update([
            'status' => 1
        ]);
        $user = User::where('id', $id)->first();
        //send an email
        try {
            $message = "Congratulations!,<br>
            Your application to join the Agent network of the UKTravelTests Platform has been approved.<br><br>
            You can now log in to your portal to complete your profile and set up your account. <br><br>
            You will find your dedicated customer booking link on your portal <br><br>
            Thank you for joining the  UKTravelTests network!<br><br>

            UKTravelsTeam
            ";
            Mail::to($user->email)->send(new BookingCreation($message));
        } catch (\Exception $e) {

        }

        return back();
    }

    public function agent_percent($id)
    {
        $user_id = $id;
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('admin.percent')->with(compact('user'));
    }

    public function UpdatePercent(Request $request, $id)
    {
        // dd($id);

        $this->validate($request, [
            'amount' => "required",
        ]);

        User::where('id', $id)->update([
            'percentage_split' => $request->amount
        ]);

        $user = User::where('id', $id)->first();

        //check for flutter wave key
        if ($user->flutterwave_key != null) {
            //flutterwave subaccount update
            //this is where the subaccounf or flutterwave should be added
        }

        session()->flash('alert-success', "Percentage has been updated successfully");

        return redirect()->to('/users');

    }

    public function agent_deactivate($id)
    {

        User::where('id', $id)->update([
            'status' => 0
        ]);
        $user = User::where('id', $id)->first();
        //send an email
        try {
            $message = "Dear Network Partner,<br><br>

            Please be informed that your account has been temporarily deactivated.,<br><br>
            
            You will no longer be able to access your Agent portal , you will also not recieve any of the Agent benefits during the time of deactivation.<br><br>
            
            Do kindly reach out to the UKtravel Test Desk for more information on how to get back on the network.<br><br>

            UKTravelsTeam
            ";
            Mail::to($user->email)->send(new BookingCreation($message));
        } catch (\Exception $e) {

        }

        return back();
    }

    public function products()
    {
        $products = Product::all();
        return view('homepage.products')->with(compact('products'));
    }

    public function check_price($vendor_id)
    {
        $vendor_products = VendorProduct::where('vendor_id', $vendor_id)->get();
        $product = [];
        foreach ($vendor_products as $vproduct) {

            $product[] = [
                'name' => $vproduct->product->name,
                'price' => "£" . number_format($vproduct->price_pounds, 0),
                'product_id' => $vproduct->product_id
            ];
        }
        return $product;
    }

    public function check_product_price($nationality)
    {
        $vendor_products = VendorProduct::where('vendor_id', 3)->get();
        $product = [];
        foreach ($vendor_products as $vproduct) {
            $price = "£" . number_format($vproduct->price_pounds, 0);

            if ($nationality == 81) {
                // naira to ghanian cedis
                $price = "GH₵" . number_format($vproduct->price * 0.014, 0);
            } elseif ($nationality == 156) {
                $price = "₦" . number_format($vproduct->price, 0);
            } elseif ($nationality == 210) {
                // naira to tanzanian cedis
                $price = "TZS" . number_format($vproduct->price * 5.64, 0);
            } elseif ($nationality == 110) {
                $price = "KES" . number_format($vproduct->price * 0.26, 0);
            } elseif ($nationality == 197) {
                // naira to south african rand
                $price = "ZAR" . number_format($vproduct->price * 0.036, 0);
            }

            $product[] = [
                'name' => $vproduct->product->name,
                'price' => $price,
                'product_id' => $vproduct->product_id
            ];
        }
        return $product;
    }

    public function product_descript($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        $description = $product->description;
        return $description;
    }

    public function product_to_vendors($product_id, $nationality)
    {
        //if nationality is nigeria
        if ($nationality == 156) {
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach ($vendor_products as $vproduct) {

                $product[] = [
                    'name' => $vproduct->vendor->name,
                    'price' => "N" . number_format($vproduct->price, 0),
                    'vendor_id' => $vproduct->vendor_id
                ];
            }
            //if nationality is ghana
        } elseif ($nationality == 81) {
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach ($vendor_products as $vproduct) {

                $product[] = [
                    'name' => $vproduct->vendor->name,
                    'price' => "GH" . number_format(($vproduct->price * 0.014), 0),
                    'vendor_id' => $vproduct->vendor_id
                ];
            }
            //if nationality is KENYA
        } elseif ($nationality == 110) {
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach ($vendor_products as $vproduct) {

                $product[] = [
                    'name' => $vproduct->vendor->name,
                    'price' => "KE" . number_format(($vproduct->price * 0.26), 0),
                    'vendor_id' => $vproduct->vendor_id
                ];
            }
            //if nationality is Tanzania
        } elseif ($nationality == 210) {
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach ($vendor_products as $vproduct) {

                $product[] = [
                    'name' => $vproduct->vendor->name,
                    'price' => "TZS" . number_format(($vproduct->price * 5.56), 0),
                    'vendor_id' => $vproduct->vendor_id
                ];
            }
            //if nationality is south africa
        } elseif ($nationality == 197) {
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach ($vendor_products as $vproduct) {

                $product[] = [
                    'name' => $vproduct->vendor->name,
                    'price' => "ZAR" . number_format(($vproduct->price * 0.036), 0),
                    'vendor_id' => $vproduct->vendor_id
                ];
            }
            //if nationality is pounds
        } else {
            $vendor_products = VendorProduct::where('product_id', $product_id)->get();
            $product = [];
            foreach ($vendor_products as $vproduct) {
                $product[] = [
                    'name' => $vproduct->vendor->name,
                    'price' => "£" . $vproduct->price_pounds,
                    'vendor_id' => $vproduct->vendor_id
                ];
            }
        }

        return $product;
    }

    public function pricing()
    {
        $products = Product::all();
        $vendors = Vendor::where('id', '3')->get();
        return view('homepage.pricing')->with(compact('products', 'vendors'));
    }

    public function webhook_receiver(Request $request)
    {
        Log::info($request->all());
    }

    public function forgot_password()
    {
        return view('homepage.forgot_password');
    }

    public function reset_password(Request $request)
    {
        $people = User::where("email", $request->email)->first();
        $type = "client";
        if (!$people) {
            session()->flash("alert-danger", "Email doesn't exist");
            return back();
        }

        try {

            $message = "Dear " . $people->first_name . ",<br><br>

            Kindly click this link to reset your password : <a href='" . env('APP_URL') . 'reset/password/' . encrypt_decrypt('encrypt', $people->id) . "/" . encrypt_decrypt("encrypt", $people->email) . "'>Reset Password</a>,<br><br>
          
            UKTravelsTeam
            ";
            Mail::to($people->email)->send(new BookingCreation($message, "Password Reset"));
        } catch (\Exception $e) {

        }

        session()->flash("alert-success", "Reset password link has been sent to your email");
        return back();
    }

    public function c_password($id, $email)
    {
        $email = encrypt_decrypt("decrypt", $email);
        $people = User::where("email", $email)->first();
        if (!$people) {
            session()->flash("alert-danger", "Email doesn't exist");
            return redirect()->to('/forgot/password');
        }
        return view('homepage.change_password')->with(compact('email'));

    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'password' => "required|confirmed"
        ]);
        $email = $request->id;


        $password = Hash::make($request->password);

        $people = User::where("email", $email)->first();


        if (!$people) {
            session()->flash("alert-danger", "Email doesn't exist");
            return redirect()->to('/forgot/password');
        } else {
            $people->update([
                'password' => $password
            ]);
        }

        session()->flash('alert-success', "Password has been changed successfully.Kindly Login");
        return redirect()->to('/login');
    }

    public function testing()
    {
        $booking = Booking::first();
        $message = "
                Hi,
                
                Thank you for choosing to book with us. To complete your booking, you will need to make payment.<br/><br/>Kindly click the button below to make payment<br/><br/>
                For More Information and Guidelines on the UK Travel Testing Process, click <a href='https://uktraveltest.prodevs.io/#popular' >Here</a> <br>
                <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "make/payment/'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                       Make Payment
                      </a>
                      
                      <br/><br/>
                      Thank you.
                ";
        Mail::to($booking->email)->send(new BookingCreation($message));
    }


    public function country_bank($country)
    {
        $banks = $this->bank($country);

        usort($banks, function ($a, $b) {
            return $b->name < $a->name;
        });

        return $banks;

    }

    public function account_name($bank, $account_no)
    {
        $account_name = $this->account_name_($bank, $account_no);
        return (isset($account_name->data->account_name) ? $account_name->data->account_name : "");

    }

    public function next_steps(){
        return view('homepage.next_steps');
    }
}
