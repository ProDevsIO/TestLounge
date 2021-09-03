<?php

namespace App\Http\Controllers;

use App\Helpers\BookingConfirmationService;
use App\Helpers\BookingService;
use App\Helpers\UserShare;
use App\Mail\BookingCreation;
use App\Mail\VendorReceipt;
use App\Models\Booking;
use App\Models\BookingProduct;
use App\Models\Country;
use App\Models\CountryColor;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\PoundTransaction;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;

class HomeController extends Controller
{

    public $bookingService;
    public $bookConfirmationService;

    public function __construct()
    {
        $this->bookingService = new BookingService;
        $this->bookConfirmationService = new BookingConfirmationService;
    }

    public function booking(Request $request)
    {

        $countries = Country::all();
        $products = Product::all();
        $vendors = Vendor::all();
        $user = "";

        if ($request->ref) {
            $user = User::where('referal_code', $request->ref)->first();
        }


        return view('homepage.booking')->with(compact('countries', 'products', 'vendors', 'user'));
    }

    public function booking2(Request $request)
    {

        $countries = Country::all();
        $products = Product::all();
        $vendors = Vendor::all();
        $user = "";

        if ($request->ref) {
            $user = User::where('referal_code', $request->ref)->first();
        }


        return view('homepage.booking2')->with(compact('countries', 'products', 'vendors', 'user'));
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
                session()->flash('alert-danger', "Your profile is currently under review and will be activated shortly by our Admin. To Facilitate this process, Kindly contact INFO@TRAVELTESTSLTD.COM");
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
            'departure_date' => 'required',
            'last_day_travel' => 'required',
            'transport_no' => 'required',
            'consent' => 'required'
        ]);


        $request->vendor_id = 3;

        // if (empty($request->product_id)) {
        //     session()->flash('alert-danger', "Kindly select a product");
        //     return back()->withInput();
        // }
        $carts = Cart::where('ip', session()->get('ip'))->get();
        $request_data = $request->all();

        unset($request_data['_token']);

        $transaction_ref = uniqid('booking_') . rand(10000, 999999);
        $external_ref = 'REF' . rand(10000, 99999);

        if (isset($request_data['ref'])) {
            $request_data = $this->bookingService->getSubAccountsByRefCode($request_data['ref'])
                ->processRequestData($request_data);
        }
        unset($request_data['ref']);


        $request_data['transaction_ref'] = $transaction_ref;
        $request_data['external_reference'] = $external_ref;
        $request_data['vaccination_date'] = Carbon::parse($request->vaccination_date);
        $request_data['last_day_travel'] = Carbon::parse($request->last_day_travel);

        unset($request_data['payment_method']);

        $price = $price_pounds = 0;
        $booking = Booking::create($request_data);
        foreach ($carts as $cart) {
            $product_id = $cart->vendorProduct->product_id;


            $vendor_products = VendorProduct::where('vendor_id', 3)->where('product_id', $product_id)->first();

            BookingProduct::create([
                'booking_id' => $booking->id,
                'product_id' => $product_id,
                'vendor_id' => $vendor_products->vendor_id,
                'vendor_product_id' => $vendor_products->id,
                'price' => ($vendor_products->price * $cart->quantity),
                'price_pounds' => ($vendor_products->price_pounds * $cart->quantity),
                'vendor_cost_price' => ($vendor_products->cost_price * $cart->quantity),
                'quantity' => $cart->quantity
            ]);

            $price = $price + ($vendor_products->price * $cart->quantity);
            $price_pounds = $price_pounds + ($vendor_products->price_pounds * $cart->quantity);
        }


        // $price = $price_pounds = 0;
        // $product_id[] = $request->product_id;
        // foreach ($product_id as $r_product) {

        //     $vendor_products = VendorProduct::where('vendor_id', 3)->where('product_id', $r_product)->first();

        //     BookingProduct::create([
        //         'booking_id' => $booking->id,
        //         'product_id' => $r_product,
        //         'vendor_id' => $request->vendor_id,
        //         'vendor_product_id' => $vendor_products->id,
        //         'price' => $vendor_products->price,
        //         'price_pounds' => $vendor_products->price_pounds,
        //         'vendor_cost_price' => $vendor_products->cost_price
        //     ]);

        //     $price = $price + $vendor_products->price;
        //     $price_pounds = $price_pounds + $vendor_products->price_pounds;
        // }

        //send an email
        try {
            $message = "
                Hi " . $request->first_name . ",

                Thank you for choosing to book with us. To complete your booking, you will need to make payment.<br/><br/>Kindly click the button below to make payment<br/><br/>
                For More Information and Guidelines on the UK Travel Testing Process, click <a href='https://uktraveltest.prodevs.io/#popular' >Here</a> <br>
             <br/>
                <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "make/payment/" . $transaction_ref . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                       Make Payment
                      </a>
                      <br/>
                      <p style='color: red'>
                     *** If you have made payment, you will receive your receipt shortly. <br/>

                        If you are yet to make payment or need to reprocess a failed payment you can click below to continue to the payment page ***
                        </p>


                      <br/><br/>
                      Thank you.
                ";
            Mail::to($booking->email)->send(new BookingCreation($message));
        } catch (\Exception $e) {
        }

        $data = $this->getFlutterwaveData($booking, $price, $transaction_ref, $price_pounds, $request['card_type']);

        //redirect to payment page
        if (!empty($sub_accounts = $this->bookingService->sub_accounts)) {
            $data['subaccounts'] = $sub_accounts;
        }

        BookingProduct::where('booking_id', $booking->id)->update([
            'charged_amount' => $data['amount'], 'currency' => $data['currency']
        ]);


        $vendor_products = VendorProduct::where('vendor_id', 3)->where('product_id', $request->product_id)->first();

        if ($request->payment_method == "stripe") {
            $response = $this->processStripe($vendor_products->price_stripe, $booking);
            $redirect_url = $response->url;

            BookingProduct::where('booking_id', $booking->id)->update([
                'stripe_intent' => $response->payment_intent,
                'stripe_session' => $response->id
            ]);

            Booking::where('id', $booking->id)->update([
                'stripe_intent' => $response->payment_intent,
                'stripe_session' => $response->id
            ]);
        } else {

            $redirect_url = $this->processFL($data);
        }

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
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "txref=" . $txRef . "&SECKEY=" . env('RAVE_SECRET_KEY', 'FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X')
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $data_response = json_decode($response);

        if (isset($data_response->data->status) && $data_response->data->status == "successful") {

            $booking = Booking::where('transaction_ref', $txRef)->first();


            if ($booking->status != 1) {

                $booking_products = BookingProduct::where('booking_id', $booking->id)->get();

                foreach ($booking_products as $booking_product) {
                    if ($booking->user_id) {
                        try {
                            DB::beginTransaction();

                            $userService = new UserShare;
                            $user = User::where('id', $booking->user_id)->first();
                            $agent_share = $userService->myShare($user);
                            $share_data = $userService->calculateMainAgentShare($user->main_agent_share_raw, $agent_share);

                            $agent_percentage = $share_data["sub_agent_share"];

                            $cost_booking = $booking_product->price;


                            if ($booking->card_type == null || $booking->card_type == 2) {

                                //for international transaction in pounds
                                $cost_booking = $booking_product->price_pounds;
                                $agent_amount_credit = ($cost_booking * ($agent_percentage / 100));


                                BookingConfirmationService::processPoundTransaction(
                                    $user,
                                    $booking->id,
                                    $agent_amount_credit,
                                    $cost_booking,
                                    $agent_percentage
                                );

                                if (!empty($superAgent = $user->superAgent)) {
                                    $super_agent_percentage = $share_data["main_agent_share_percent"];
                                    $super_agent_amount_credit = ($cost_booking * ($super_agent_percentage / 100));

                                    BookingConfirmationService::processPoundTransaction(
                                        $superAgent,
                                        $booking->id,
                                        $super_agent_amount_credit,
                                        $cost_booking,
                                        $super_agent_percentage
                                    );
                                }
                            } elseif ($booking->card_type == 1) {
                                //for local transaction in naira
                                $cost_booking = $booking_product->price;

                                $agent_amount_credit = ($cost_booking * ($agent_percentage / 100));

                                BookingConfirmationService::processNairaTransaction(
                                    $user,
                                    $booking->id,
                                    $agent_amount_credit,
                                    $cost_booking,
                                    $agent_percentage
                                );

                                if (!empty($superAgent = $user->superAgent)) {
                                    $super_agent_percentage = $share_data["main_agent_share_percent"];
                                    $super_agent_amount_credit = ($cost_booking * ($super_agent_percentage / 100));

                                    BookingConfirmationService::processNairaTransaction(
                                        $superAgent,
                                        $booking->id,
                                        $super_agent_amount_credit,
                                        $cost_booking,
                                        $super_agent_percentage
                                    );
                                }
                            }
                            DB::commit();
                        } catch (\Exception $e) {
                            logger("An error occured while confirming payments", $request->all());
                            DB::rollBack();
                        }
                    }
                }


                try {

                    $code = $this->sendData($booking);
                } catch (\Exception $e) {

                    $booking->update([
                        'vendor_id' => 3,
                        'mode_of_payment' => 1,
                        'transaction_ref' => $txRef,
                        'status' => 1
                    ]);

                    return redirect()->to('/booking/code/failed?b=' . $txRef);
                }


                foreach ($booking_products as $booking_product) {
                    try {
                        //check if a referral code exist
                        if ($booking->referral_code != null) {
                            //use the referral code to find the user
                            $getUser = User::where('referal_code', $booking->referral_code)->first();

                            //check the status set by the copy receipt
                            //if 1 :copy the agent else if 0: send normally
                            if ($getUser->copy_receipt == 1) {
                                $yes = Mail::to(["$booking->email", "$getUser->email"])->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
                            } elseif ($getUser->copy_receipt == 0) {
                                $no = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
                            }
                        } else {
                            //referral code doesnt exist
                            $maybe = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
                        }
                    } catch (\Exception $e) {
                    }
                }
                if (!empty($booking->phone_no)) {

                    $decode = implode(", ", json_decode($code));

                    $smsMessage = " Hi $booking->first_name  $booking->last_name .Thank you for choosing to book with us at TraveltestGlobal.Your Booking Reference:- " . $decode . ". Test Provider:- " . $booking_product->vendor->name . ".Thank you";
                    $sms = $this->sendSMS($smsMessage, [$booking->phone_no], 4);

                }

                //update wiith transaction code
                $booking->update([
                    'vendor_id' => 3,
                    'mode_of_payment' => 1,
                    'transaction_ref' => $txRef,
                    'status' => 1,
                    'booking_code' => $code
                ]);

                //to remove items from cart
                $cart = Cart::where('ip', session()->get('ip'))->delete();
            }
            //to remove items from cart
            $cart = Cart::where('ip', session()->get('ip'))->delete();

            return redirect()->to('/booking/success?b=' . $txRef);
        }
        // dd('not checking', $data_response);
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

    public function p_make_payment(Request $request, $booking_ref)
    {
        $this->validate($request, [
            'payment_method' => 'required'
        ]);

        $booking = Booking::where('transaction_ref', $booking_ref)->first();

        $booking_product = BookingProduct::where('booking_id', $booking->id)->first();


        $vendor_products = VendorProduct::where('vendor_id', 3)->where('product_id', $booking_product->product_id)->first();

        if ($request->payment_method == "stripe") {
            $response = $this->processStripe($vendor_products->price_stripe, $booking);
            $redirect_url = $response->url;

            BookingProduct::where('booking_id', $booking->id)->update([
                'stripe_intent' => $response->payment_intent,
                'stripe_session' => $response->id
            ]);

            Booking::where('id', $booking->id)->update([
                'stripe_intent' => $response->payment_intent,
                'stripe_session' => $response->id
            ]);
        } else {
            $booking_product = BookingProduct::where('booking_id', $booking->id)->first();
            $booking = Booking::where('id', $booking->id)->first();
            $price = $booking_product->price;

            $price_pounds = $vendor_products->price_pounds;

            $data = $this->getFlutterwaveData($booking, $price, $booking_ref, $price_pounds, $booking->card_type);
            $redirect_url = $this->processFL($data);
        }

        return redirect()->to($redirect_url);
    }

    public function make_payment($booking_ref)
    {
        $booking = Booking::where('transaction_ref', $booking_ref)->first();

        if ($booking->status == 1) {
            return redirect()->to('/booking/success?b=' . $booking_ref);
        }

        return view('homepage.make_payment')->with(compact('booking'));
    }


    public function register_agent()
    {
        $countries = Country::all();
        return view('homepage.register')->with(compact('countries'));
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'phone_no' => 'required',
            'company' => 'required',
            'password' => 'required',
            'platform_name' => 'required',
            'director' => 'required',
            'file' => 'file|mimes:csv,txt,xlx,xls,pdf|max:2048',
            'certified' => 'required',

        ]);

        $request_data = $request->all();

        $referral = generateReferralCode(6);

        $request_data['referal_code'] = $referral;
        $request_data['password'] = Hash::make($request_data['password']);
        $request_data['type'] = 2;
        $request_data['status'] = 0;

        if ($request->file) {

            $certificate = time() . '.' . $request->file->extension();

            $request->file->move(public_path('img/certificate'), $certificate);

            $request_data['c_o_i'] = "/img/certificate/" . $certificate;
        }
        $user = User::create($request_data);
        try {
            $message = "
            Hi " . $request->first_name . ",

            Thank you for your interest to register as an Agent with Traveltestsltd,<br/><br/>Kindly click the button below<br/><br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Continue Registration
                  </a>

                  <br/><br/>
                  Thank you.
                  <br/><br/>
                Traveltestsltd Team
            ";
            Mail::to($request->email)->send(new BookingCreation($message, "Agent Registration"));
        } catch (\Exception $e) {
        }

        try {

            $message2 = "
            Hi Admin,<br/>

            We would like to inform you that a new Agent has registered with Traveltestsltd.<br/><br/>
            Name: " . $request->first_name . " " . $request->last_name . " <br/>
            Phone: " . $request->phone_no . "<br/>
            Email: " . $request->email . "<br/>
            Company Name: " . $request->company . "<br/>
            <br/>Kindly click the button below to login and review<br/><br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/login") . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Go to Login
                  </a>

                  <br/><br/>
                  Thank you.
                  <br/><br/>
                Traveltestsltd Team
            ";
            Mail::to(['itunu.akinware@medburymedicals.com', 'ola.2@hotmail.com'])->send(new BookingCreation($message2, "New Agent Registration"));
        } catch (\Exception $e) {
        }


        session()->flash('alert-success', "Thank you for your registration, kindly click the link sent to your email to continue your registration");

        return back();
    }

    public function testEmail()
    {
        dd(encrypt_decrypt('encrypt', "165"));
        $booking = Booking::where('id', 51)->first();
        $booking_product = BookingProduct::where('booking_id', $booking->id)->first();
        $code = "sdsbdjksds";

        if ($booking_product) {


            Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from " . optional($booking_product->vendor)->name, optional($booking_product->vendor)->email, $code));
        }
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
            Your application to join the Agent network of the Traveltestsltd Platform has been approved.<br><br>
            You can now log in to your portal to complete your profile and set up your account. <br><br>
            You will find your dedicated customer booking link on your portal <br><br>
            Thank you for joining the  Traveltestsltd network!<br><br>

            Traveltestsltd Team
            ";
            Mail::to($user->email)->send(new BookingCreation($message, 'Agent Activation'));
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

            Do kindly reach out to the Traveltestsltd  Desk for more information on how to get back on the network.<br><br>

            Traveltestsltd Team
            ";
            Mail::to($user->email)->send(new BookingCreation($message, 'Agent Deactivation'));
        } catch (\Exception $e) {
        }

        return back();
    }

    public function products()
    {
        $products = Product::all();
        return view('homepage.products')->with(compact('products'));
    }

    public function viewProducts($type)
    {
        $faq = 1;
        $products = VendorProduct::where('vendor_id', 3);
        if ($type == "all") {
            $faq = 0;
            $products = $products->get();
        } elseif ($type == "Green") {
            $products = $products->where('product_id', 1)->get();
        } elseif ($type == "Amber_v") {
            $products = $products->whereIn('product_id', [2, 10])->get();

        } elseif ($type == "Amber_uv") {
            $products = $products->whereIn('product_id', [2, 4, 3, 10])->get();
        } elseif ($type == "Red") {
            $products = $products->where('product_id', 5)->get();
        } elseif ($type == "UK") {
            $faq = 0;
            $products = [];
        }
        return view('homepage.addProducts')->with(compact('products', 'faq', 'type'));
    }

    public function viewCart()
    {
        $carts = Cart::where('ip', myIP())->get();
        $cartSum = 0;
        foreach ($carts as $cart) {

            $cartSum = $cartSum + ($cart->vendorProduct->price_pounds * $cart->quantity);
        }

        return view('homepage.cart')->with(compact('carts', 'cartSum'));
    }

    public function addToCart($p_id, $v_id)
    {
        $ip = myIP();
        $v_product = VendorProduct::where([
            'product_id' => $p_id,
            'vendor_id' => $v_id
        ])->first();

        $check = Cart::where([
            'ip' => $ip,
            'vendor_product_id' => $v_product->id
        ])->count();

        $product = $v_product->product->name;
        if ($check == 0) {

            Cart::create([
                'ip' => $ip,
                'quantity' => 1,
                'vendor_product_id' => $v_product->id
            ]);


            $data = [
                "message" => "Added $product to cart.",
                "btn_text" => "Remove from cart",
                "btn_color" => "white",
                "color" => "#1E50A0"
            ];
        } else {

            Cart::where([
                'ip' => $ip,
                'vendor_product_id' => $v_product->id
            ])->delete();

            $data = [
                "message" => "Removed $product from cart.",
                "btn_text" => "Add to Cart",
                "btn_color" => "#1E50A0",
                "color" => "white"
            ];
            // return "$product has already been added to cart.";
        }
        $data["cart_items"] = Cart::where('ip', $ip)->count();
        return response()->json($data);
    }

    public function updateCart($id, $quantity)
    {
        $singleCart = Cart::findorfail($id);
        $singleCart->update(['quantity' => $quantity]);
        $singleCart->refresh();

        $cartSum = 0;
        $carts = Cart::where('ip', myIP())->get();
        foreach ($carts as $cart) {
            $cartSum = $cartSum + ($cart->vendorProduct->price_pounds * $cart->quantity);
        }

        return response()->json([
            "message" => "Quantity has been updated",
            "item_total" => number_format($singleCart->quantity * $singleCart->vendorProduct->price_pounds, 2),
            "total_price" => number_format($cartSum, 2)
        ]);
    }

    public function deleteCart($id)
    {
        $carts = Cart::where('id', $id)->first();

        $carts->delete();

        session()->flash("alert-success", "Item removed from ");
        return back();
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
                $price = "GH₵" . number_format($vproduct->price * 0.014, 0);
            }
            if ($nationality == 156) {
                $price = "₦" . number_format($vproduct->price, 0);
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

             Traveltestsltd
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

    public function country_query($id)
    {
        $query = CountryColor::where('country_id', $id)->first();
        if ($query == null) {
            return "No color code available for this country";
        } else {
            $color = $query->color->name;
            return "The country selected is $color";
        }
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

    public function next_steps()
    {
        return view('homepage.next_steps');
    }

    public function code_failed(Request $request)
    {
        $booking = Booking::where('transaction_ref', $request->b)->first();
        return view('homepage.code_failed')->with(compact('booking'));
    }

    public function success_stripe(Request $request)
    {
        if (!$request->b) {
            return redirect()->to('/');
        }
        $txRef = "stripe_" . rand(10000000, 99929302399);

        $booking_id = encrypt_decrypt('decrypt', $request->b);
        $booking = Booking::where('id', $booking_id)->first();


        if ($booking->status != 1) {
            $booking_product = BookingProduct::where('booking_id', $booking->id)->first();

            if (!$booking_product->stripe_session) {
                return redirect()->to('/booking/stripe/failed?b=' . $request->b);
            }

            $checkout_session = $this->checkSession($booking_product);

            if ($checkout_session->payment_status != "paid") {

                return redirect()->to('/booking/stripe/failed?b=' . $request->b);
            }


            if ($booking->user_id) {
                try {
                    DB::beginTransaction();
                    $user = User::where('id', $booking->user_id)->first();
                    if ($user->percentage_split != null) {
                        $pecentage = $user->percentage_split;
                    } else {
                        $defaultpercent = Setting::where('id', '2')->first();
                        $pecentage = $defaultpercent->value;
                    }

                    if ($user->country != null) {

                        $cost_booking = $booking_product->price_pounds;

                        $amount_credit = ($cost_booking * ($pecentage / 100));


                        PoundTransaction::create([
                            'amount' => $amount_credit,
                            'booking_id' => $booking->id,
                            'user_id' => $user->id,
                            'cost_config' => $cost_booking,
                            'pecentage_config' => $pecentage,
                            'type' => "1"
                        ]);


                        $transactions = Transaction::where('type', "1")->where('user_id', $user->id)->sum('amount');

                        $total_amount = $user->pounds_wallet_balance + $amount_credit;

                        User::where('id', $booking->user_id)->update([
                            'pounds_wallet_balance' => $total_amount,
                            'total_credit_pounds' => $transactions
                        ]);
                    }


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }

            $vendor_p = VendorProduct::where('product_id', $booking_product->product_id)->where('vendor_id', 3)->first();

            $booking_product->update([
                'charged_amount' => $vendor_p->price_pounds,
                'currency' => "GBP"
            ]);

            try {
                $code = $this->sendData($booking);
            } catch (\Exception $e) {

                $booking->update([
                    'vendor_id' => 3,
                    'mode_of_payment' => 2,
                    'transaction_ref' => $txRef,
                    'status' => 1
                ]);

                return redirect()->to('/booking/code/failed?b=' . $txRef);
            }

            if ($booking_product) {
                try {
                    //check if a referral code exist
                    if ($booking->referral_code != null) {
                        //use the referral code to find the user
                        $getUser = User::where('referal_code', $booking->referral_code)->first();

                        //check the status set by the copy receipt
                        //if 1 :copy the agent else if 0: send normally
                        if ($getUser->copy_receipt == 1) {
                            Mail::to(["$booking->email", "$getUser->email"])->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
                        } elseif ($getUser->copy_receipt == 0) {
                            Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
                        }
                    } else {
                        //referral code doesnt exist
                        Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
                    }
                } catch (\Exception $e) {
                }
            }

            $booking->update([
                'vendor_id' => 3,
                'mode_of_payment' => 2,
                'transaction_ref' => $txRef,
                'status' => 1,
                'booking_code' => $code
            ]);
        }


        return redirect()->to('/booking/success?b=' . $txRef);
    }

    public function success_failed(Request $request)
    {
        if (!$request->b) {
            return redirect()->to('/');
        }
        $txRef = "stripe_" . rand(10000000, 99929302399);
        $booking_id = encrypt_decrypt('decrypt', $request->b);
        $booking = Booking::where('id', $booking_id)->first();

        if (!$booking->transaction_ref) {
            $booking->update([
                'transaction_ref' => $txRef
            ]);
        } else {
            $txRef = $booking->transaction_ref;
        }


        return redirect()->to('/booking/failed?b=' . $txRef);
    }

    public function view_uk()
    {
        return view('homepage.uk_page');
    }
}
