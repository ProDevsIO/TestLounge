<?php

namespace App\Http\Controllers;

use App\Helpers\BookingConfirmationService;
use App\Helpers\BookingService;
use App\Helpers\UserShare;
use App\Mail\BookingCreation;
use App\Mail\VendorReceipt;
use App\Models\Booking;
use App\Models\Pages;
use App\Models\BookingProduct;
use App\Models\Country;
use App\Models\SupportedCountries;
use App\Models\CountryColor;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\PoundTransaction;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\Voucher;
use App\Models\VoucherProduct;
use App\Models\VoucherCount;
use App\Models\VoucherGenerate;
use App\Models\VoucherPayment;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PDF;
use Stripe;

class HomeController extends Controller
{

    public $bookingService;
    public $bookConfirmationService;

    public function __construct()
    {
        $this->bookingService = new BookingService;
        $this->bookConfirmationService = new BookingConfirmationService;
    }

    public function home()
    {
        $scountries = SupportedCountries::whereNotIn('country_id',[224, 156])->get();

        $display_countries = SupportedCountries::whereNotNull('image')->inRandomOrder()->limit(1)->get();



        return view('homepage.home')->with(compact('scountries'));
    }

    public function booking(Request $request)
    {

        $countries = Country::all();
        $products = Product::all();
        $vendors = Vendor::all();
        $user = "";

        $carts_count = Cart::where('ip', session()->get('ip'))->count();

        $cart = Cart::where('ip', session()->get('ip'))->first();
        $vproduct = VendorProduct::where('id', $cart->vendor_product_id)->first();



        if(!is_null($vproduct->walk_product_id))
        {

            $bearer = $this->getDamhealthToken();
            $getlocation = $this->getDamHealthLocations($bearer);
            $location = json_decode($getlocation);

                    if(!isset($location->errors))
                    {
                        $locations = $location->data->damhealth_locations;

                    }else{
                        $locations = null;
                    }

            $walkin = $vproduct->walk_product_id;
        }else{
            $walkin = null;
            $locations = null;
        }

        if ($request->ref) {
            $user = User::where('referal_code', $request->ref)->first();
        }


        return view('homepage.booking')->with(compact('countries', 'products', 'vendors', 'user','carts_count', 'cart','locations','walkin'));
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
                session()->flash('alert-danger', "Your profile is currently under review and will be activated shortly by our Admin. To Facilitate this process, Kindly contact INFO@TRAVELTestSLTD.COM");
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
            'phone_no' => 'required',
            'email' => 'required',
            'isolation_address' => 'required',
            'isolation_town' => 'required',
            'isolation_postal_code' => 'required',
            'isolation_country_id' => 'required',
            'arrival_date' => 'required',
            'country_travelling_from_id' => 'required',
            'departure_date' => 'required',
            
        ]);

        if($request->test_location)
        {
            $dam_data = json_decode($request->test_location['0']);
        }

        $request->vendor_id = 3;
        $test_kit = [];

    //    if($request->email != $request->verify_email)
    //    {
    //     session()->flash('alert-danger', "Please you have provided two different emails, the emails must match in order to make booking");
    //     return back()->withInput();
    //    }

        $request_data = $request->all();

        if(!$request->hidden_phone){
            $request->hidden_phone = $request_data['phone_no'];
        }

        unset($request_data['phone_no']);
        $request_data['phone_no'] = $request->hidden_phone;
        unset($request_data['hidden_phone']);
        unset($request_data['phone_full']);
        unset($request_data['verify_email']);
        unset($request_data['test_location']);
        if($request->test_location)
        {
            $request_data['dam_location'] = $dam_data->location;
            $request_data['dam_address'] = $dam_data->address;
            $request_data['dam_room'] = $dam_data->room;
        }





        if($request->voucher != null){
            $voucher = VoucherGenerate::where(['voucher' => $request->voucher, 'status' => 0] )->first();

            if($voucher != null)
            {
                if($voucher->email == null)
                {
                    session()->flash('alert-danger', "Sorry to inform you, but this voucher has not been assigned to anybody");
                    return back()->withInput();
                }

                if($voucher->email != $request_data['email'])
                {

                    session()->flash('alert-danger', "Sorry to inform you, but this voucher has been assigned to somebody else");
                    return back()->withInput();
                }

               if($voucher->quantity == 0)
               {
                    session()->flash('alert-danger', "Sorry to inform you, but the quota for this voucher has been used up");
                    return back()->withInput();
               }

               $cart_item = Cart::where('ip', session()->get('ip'))->first();

               unset($request_data['_token']);

               $transaction_ref = uniqid('booking_') . rand(10000, 999999);
               $external_ref =  $request->voucher;

               if (isset($request_data['ref'])) {
                    $request_data = $this->bookingService->getSubAccountsByRefCode($request_data['ref'])
                    ->processRequestData($request_data);
                }

                unset($request_data['ref']);
                unset($request_data['voucher']);

                if($voucher->voucherCount->product_id != 15 )
                {
                    for($n = 0; $n < $voucher->quantity; $n++)
                    {
                        $Test_kit[] = $request->{'test_kit'.$n};
                        unset($request_data['test_kit'.$n]);
                    }
                    // encode the Testkit in json format
                    $test_kit = json_encode($test_kit);

                    $request_data['test_kit'] = $test_kit;
                }


                $request_data['transaction_ref'] = $transaction_ref;
                $request_data['external_reference'] = $external_ref;

                unset($request_data['payment_method']);

                $redirect_url = $this->voucherProcessing($request_data);

                return redirect()->to($redirect_url);


            }else{
                session()->flash('alert-danger', "This voucher code has been used. Kindly reach out to an Agent to provide a new one.");
                return back()->withInput();
            }
        }

        // $carts = Cart::where('ip', session()->get('ip'))->get();

        // if ($carts->count() == 0) {
        //     session()->flash('alert-danger', "Kindly select a product and add to your cart");
        //     return back()->withInput();
        // }



        unset($request_data['_token']);
        if($request->payment_method == "vastech"){
            $transaction_ref = rand(100000, 999999);
        }elseif($request->payment_method == "paystack"){
            //paystack doesnt allow underscrore in their reference
            $transaction_ref = uniqid('pay-') . rand(10000, 999999);
        }else{
            $transaction_ref = uniqid('booking_') . rand(10000, 999999);
        }

        $external_ref = 'REF' . rand(10000, 99999);

        if (isset($request_data['ref'])) {
            $request_data_ = $this->bookingService->getSubAccountsByRefCode($request_data['ref']);
            $request_data['subaccounts'] = $request_data_->sub_accounts;
            $request_data["referral_code"] = $request_data_->referral_code;
            $request_data["user_id"] = $request_data_->user_id;
        }

        unset($request_data['ref']);


        $request_data['transaction_ref'] = $transaction_ref;
        $request_data['external_reference'] = $external_ref;

        $vendor_products = VendorProduct::where('id',  $request_data['vproduct'])->first();

        $request_data['vendor_id']  = $vendor_products->vendor_id;

        unset($request_data['payment_method']);
        unset($request_data['vproduct']);

        $price = $price_pounds = 0;
// dd($request_data);
        $booking = Booking::create($request_data);

            $product_id =  $vendor_products->product_id;

            BookingProduct::create([
                'booking_id' => $booking->id,
                'product_id' => $vendor_products->product_id,
                'vendor_id' => $vendor_products->vendor_id,
                'vendor_product_id' => $vendor_products->id,
                'price' => $vendor_products->price ,
                'price_pounds' => $vendor_products->price_pounds ,
                'vendor_cost_price' => $vendor_products->cost_price,
                'quantity' => 1
            ]);

            $price = $price + $vendor_products->price;
            $price_pounds = $price_pounds + $vendor_products->price_pounds;

        //send an email
        // try {
        //     $message = "
        //         Hi " . $request->first_name . ",

        //         Thank you for choosing to book with us. To complete your booking, you will need to make payment.<br/><br/>Kindly click the button below to make payment<br/><br/>
        //         For More Information and Guidelines on the UK Travel Testing Process, click <a href='https://uktravelTest.prodevs.io/#popular' >Here</a> <br>
        //      <br/>
        //         <a href='" . env('APP_URL', "https://uktravelTest.prodevs.io/") . "make/payment/" . $transaction_ref . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
        //                Make Payment
        //               </a>
        //               <br/>
        //               <p style='color: red'>
        //              *** If you have made payment, you will receive your receipt shortly. <br/>

        //                 If you are yet to make payment or need to reprocess a failed payment you can click below to continue to the payment page ***
        //                 </p>


        //               <br/><br/>
        //               Thank you.
        //         ";
        //     Mail::to($booking->email)->send(new BookingCreation($message));
        // } catch (\Exception $e) {
        // }

        // if($request->payment_method == "vastech"){
        //     $data = $this->getVasTechData($booking, $price, $transaction_ref, $price_pounds, $request['card_type']);
        // }elseif($request->payment_method == "paystack"){

        //     $data = $this->getPaystackData($booking, $price, $transaction_ref, $price_pounds, $request['card_type']);

        // }else {
        //     $data = $this->getFlutterwaveData($booking, $price, $transaction_ref, $price_pounds, $request['card_type']);
        // }


        //deactivating subaccount
        // if (!empty($sub_accounts = $this->bookingService->sub_accounts)) {
        //     $data['subaccounts'] = $sub_accounts;
        // }

        // if($request->payment_method == "paystack"){
        //     $paystackNerf = $data['amount'] / 100;
        //     BookingProduct::where('booking_id', $booking->id)->update([
        //         'charged_amount' =>  $paystackNerf, 'currency' => $data['currency']
        //     ]);
        // }else{
        //     BookingProduct::where('booking_id', $booking->id)->update([
        //         'charged_amount' => $data['amount'], 'currency' => $data['currency']
        //     ]);
        // }


        if ($request->payment_method == "stripe") {

            $redirect_url = '/stripe/process/'.$booking->id.'/booking';

        } else {
            if($request->payment_method == "vastech"){
                $redirect_url = $this->processVas($data);
            } elseif($request->payment_method == "paystack"){

                $redirect_url = $this->processPaystack($data);

            }else {
                $redirect_url = $this->processFL($data);
            }

        }

        return redirect()->to($redirect_url);
    }

    function confirm_flutterwave($url,$txRef){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "txref=" . $txRef . "&SECKEY=" . env('RAVE_SECRET_KEY', 'FLWSECK_test-516babb36b12f7f60ae0a118dcc9482a-X')
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);
        return $response;
    }

    function return_stripe_popup($id,$type = null)
    {
      if($type == "booking")
      {
        $product = BookingProduct::where('booking_id',$id)->first();
        if($product->currency == 'NGN'){
            $amount = '???'.$product->charged_amount;
        }else{
            $amount = '$'.$product->price_pounds;
        }
        }else{
            $product = VoucherPayment::where('id',$id)->first();
            if($product->currency == 'NG'){
                $amount = '???'.$product->charged_amount;
            }else{
                $amount = '$'.$product->price_pounds;
            }
        }

        // dd($product->currency);
        return view('homepage.stripe_popup')->with(compact('amount','id','type'));
    }

    function confirm_paystack($txRef){

        $curl = curl_init();
        $url = "https://api.paystack.co/transaction/verify/$txRef";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ". env('PAYSTACK_SECRET_KEY', 'sk_test_a888f85236f4da1b0bd204ad8f8c96b6e010a7e9'),
            "Cache-Control: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
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



    public function payment_confirmation(Request $request,$type = null)
    {

        if (env('APP_ENV', "LIVE") == "LIVE") {
            $url = "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify";
        } else {
            $url = "https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify";
        }


        $request_data = $request->all();



        if($type == "vas"){
            $txRef = $request->transactionRef;
            $url = "https://dashboard.smartpay.ng/api/v1/tstatus?transactionRef=".$txRef;
            $response = $this->confirm_vas($url,$txRef);
            $data_response = json_decode($response);

        }elseif($type == "paystack")
        {
            $txRef = $request->trxref;

            $response = $this->confirm_paystack($txRef);
            $data_response = json_decode($response);

        }elseif($type == "stripe"){

            $booking = Booking::where('id', $request->id)->first();
            $txRef = $booking->transaction_ref;
            $response = $this->processStripe($request->stripeToken, $request->id);


        }
        else{
            $txRef = $request->tx_ref;
            $response = $this->confirm_flutterwave($url,$txRef);

        }

        $data_response = json_decode($response);


        if (isset($data_response->data->status) && ($data_response->data->status == "successful" || $data_response->data->status == "APPROVED" || $data_response->data->status == "success" ||  $data_response->data->status == "succeeded" )) {

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

                                //for international transaction in dollars(please the pounds was converted to dollars)
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
                                    $descript = 1;
                                    BookingConfirmationService::processPoundTransaction(
                                        $superAgent,
                                        $booking->id,
                                        $super_agent_amount_credit,
                                        $cost_booking,
                                        $super_agent_percentage,
                                        $descript
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
                                    $descript = 1;
                                    BookingConfirmationService::processNairaTransaction(
                                        $superAgent,
                                        $booking->id,
                                        $super_agent_amount_credit,
                                        $cost_booking,
                                        $super_agent_percentage,
                                        $descript
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
                    //$booking->room signifies dam health data
                    if(!$booking->dam_room == null)
                    {
                        $code = $this->GetDamHealthCode($booking);
                    }else{
                        $code = $this->sendData($booking);
                    }
                } catch (\Exception $e) {
                 dd($e);
                    if($type == "paystack"){

                        $booking->update([
                            'mode_of_payment' => 4,
                            'transaction_ref' => $txRef,
                            'status' => 1
                        ]);

                    } elseif($type == "vas"){

                        $booking->update([
                            'mode_of_payment' => 5,
                            'transaction_ref' => $txRef,
                            'status' => 1
                        ]);
                    }elseif($type == "stripe"){

                        $booking->update([
                            'mode_of_payment' => 2,
                            'transaction_ref' => $txRef,
                            'status' => 1
                        ]);
                    }else{
                        $booking->update([
                            'mode_of_payment' => 1,
                            'transaction_ref' => $txRef,
                            'status' => 1
                        ]);
                    }

                    return redirect()->to('/booking/code/failed?b=' . $txRef);
                }


                foreach ($booking_products as $booking_product) {
                    try {

                        if($booking_product->product_id == 2 || $booking_product->product_id == 10)
                        {
                            $message = "
                            Dear " . $booking->first_name . ",<br><br>

                            Thank you for booking with us.<br><br>
                             If you are getting this email, it means you have bought The Unvaccinated Day 8 Mandatory Test or The Unvaccinated Day 2 & Day 8 Mandatory Tests.<br/><br/>

                            Your purchase would be for one of the following reasons:<br><br>

                            1. You are Unvaccinated or Not Fully Vaccinated. Read more <a href='https://www.gov.uk/guidance/travel-to-england-from-another-country-during-coronavirus-covid-19#check-if-you-qualify-as-fully-vaccinated'>here</a><br><br>
                            2. The Vaccination you got is not approved by the UK. Read more <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a><br><br>
                            3. You are Fully Vaccinated but unable to show an approved COVID-19 proof of vaccination before your travel.
                            Read more about the approved proof of vaccination  <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a><br><br>

                            If you are fully vaccinated under an approved vaccination programme accepted in the UK (check if your vaccination is approved <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a>). <br><br>

                            We have a no-refund policy as indicated before your purchase.<br><br>

                            <a href='https://www.surveymonkey.com/r/PQQNWV7'>Kindly click here give us your feedback </a><br><br>

                                  <br/><br/>
                                  Thank you.
                                  <br/><br/>
                                TravelTestsltd Team
                            ";
                            Mail::to($booking->email)->send(new BookingCreation($message, "Guidelines for purchasing a Tests for the Unvaccinated/ Partially Vaccinated "));
                        }

                    } catch (\Exception $e) {
                     dd($e);
                    }

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
                                $yes = Mail::to(["$booking->email", "$getUser->email"])->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                            } elseif ($getUser->copy_receipt == 0) {
                                $no = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                            }
                        } else {
                            //referral code doesnt exist
                            $maybe = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                        }

                    } catch (\Exception $e) {
                     dd($e);
                    }


                }

                if (!empty($booking->phone_no)) {

                    $decode = implode(", ", json_decode($code));

                    $smsMessage = " Hi $booking->first_name  $booking->last_name .Thank you for choosing to book with us at TravelTestGlobal.Your Booking Reference:- " . $decode . ". Test Provider:- " . $booking_product->vendor->name . ".Thank you";
                    $sms = $this->sendSMS($smsMessage, [$booking->phone_no], 4);

                }

                //update wiith transaction code

                if($type == "paystack"){
                    $data_save =[
                        'mode_of_payment' => 4,
                        'transaction_ref' => $txRef,
                        'status' => 1,
                        'booking_code' => $code
                    ];

                    $booking->update($data_save);

                } elseif($type == "vas"){

                    $booking->update([
                        'mode_of_payment' => 5,
                        'transaction_ref' => $txRef,
                        'status' => 1,
                        'booking_code' => $code
                    ]);
                }elseif($type == "stripe"){

                    $booking->update([
                        'mode_of_payment' => 2,
                        'transaction_ref' => $txRef,
                        'status' => 1,
                        'booking_code' => $code
                    ]);
                }else{
                    $booking->update([
                        'mode_of_payment' => 1,
                        'transaction_ref' => $txRef,
                        'status' => 1,
                        'booking_code' => $code
                    ]);
                }

                //to remove items from cart
                $cart = Cart::where('ip', session()->get('ip'))->delete();
            }
            //to remove items from cart
            $cart = Cart::where('ip', session()->get('ip'))->delete();

            return redirect()->to('/booking/success?b=' . $txRef);
        }

        try {

                $message = "

                Items in your shopping cart are still waiting. Do you need help to complete your order?
                Click here to see a video on ???How to Book a Test???

                If you need further support, Contact us:<br><br>
                <a href='Info@traveltestltd.com'>Info@traveltestltd.com</a> <br>

                Phone Nos: <br>
                Nigeria:???+2347060466084  <br>
                UAE: +971544119013, +971563784904  <br>
                UK:???+447436875938  <br>

                <a href='https://www.surveymonkey.com/r/PQQNWV7'>Kindly Click here give us your feedback </a><br><br>

                      <br/><br/>
                      Thank you.
                      <br/><br/>
                    TravelTestsltd Team
                ";
                Mail::to($booking->email)->send(new BookingCreation($message, "Incomplete Order"));

        } catch (\Exception $e) {
         dd($e);
        }

        return redirect()->to('/booking/failed?b=' . $txRef);
    }


    public function booking_success(Request $request)
    {
        // dd($request->b);
        $booking = Booking::where('transaction_ref', $request->b)->first();

        return view('homepage.success')->with(compact('booking'));
    }

    public function booking_failed(Request $request)
    {
        $booking = Booking::where('transaction_ref', $request->b)->first();

        return view('homepage.failed')->with(compact('booking'));
    }

    public function voucher_option($voucher)
    {
        return view('homepage.v_option')->with(compact('voucher'));
    }
    public function voucher_booking($voucher, $walk = null)
    {


        $countries = Country::all();
        $products = Product::all();
        $vendors = Vendor::all();
        $user = "";

        $carts_count = Cart::where('ip', session()->get('ip'))->count();
        $voucher = VoucherGenerate::where('voucher', $voucher)->first();

        if($walk == 'yes')
        {
            $vproduct = VendorProduct::where('product_id', $voucher->voucherCount->product_id)
                                     ->where('vendor_id', 4)->first();
            if($vproduct != null){


                if(!is_null($vproduct->walk_product_id))
                {

                    $bearer = $this->getDamhealthToken();

                    $getlocation = $this->getDamHealthLocations($bearer);
                    $location = json_decode($getlocation);

                                if(!isset($location->errors))
                                {
                                    $locations = $location->data->damhealth_locations;
                                }else{
                                    $locations = null;
                                }

                    $walkin = $vproduct->walk_product_id;
                }else{
                    $walkin = null;
                    $locations = null;
                }
            } else{
                $walkin = null;
                $locations = null;
            }
        }else{
            $walkin = null;
            $locations = null;
        }

        return view('homepage.booking')->with(compact('countries', 'products', 'vendors', 'user','carts_count', 'voucher', 'locations','walkin'));

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

    public function register_test(){
        if(!isset($_GET['type'])){
            return redirect()->to('/');
        }
        return view('homepage.test');
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
            Hi " . $request->first_name . ",<br><br>

            Thank you for your interest to register as an Agent with TravelTestsltd.<br/><br/>
            Your profile is currently under review and will be activated shortly by our Admin. <br><br>
            To facilitate this process, Kindly contact <a href='https://info@travelTestsltd.com'>INFO@TRAVELTestSLTD.COM</a>
                  <br/><br/>
                  Thank you.
                  <br/><br/>
                TravelTestsltd Team
            ";
            Mail::to($request->email)->send(new BookingCreation($message, "Agent Registration"));
        } catch (\Exception $e) {

        }

        try {

            $message2 = "
            Hi Admin,<br/>

            We would like to inform you that a new SuperAgent has registered with TravelTestsltd.<br/><br/>
            Name: " . $request->first_name . " " . $request->last_name . " <br/>
            Phone: " . $request->phone_no . "<br/>
            Email: " . $request->email . "<br/>
            Company Name: " . $request->company . "<br/>
            <br/>Kindly click the button below to login and review<br/><br/>
            <a href='" . env('APP_URL', "https://uktravelTest.prodevs.io/login") . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Go to Login
                  </a>

                  <br/><br/>
                  Thank you.
                  <br/><br/>
                TravelTestsltd Team
            ";
            Mail::to(['itunu.akinware@medburymedicals.com','john.aigbonohan@medburymedicals.com'])->send(new BookingCreation($message2, "New Superagent Registration"));
        } catch (\Exception $e) {
        }


        session()->flash('alert-success', "Thank you for your registration, Your profile is currently under review and will be activated shortly by our Admin.");

        return back();
    }

    public function TestEmail()
    {
        dd(encrypt_decrypt('encrypt', "165"));
        $booking = Booking::where('id', 51)->first();
        $booking_product = BookingProduct::where('booking_id', $booking->id)->first();
        $code = "sdsbdjksds";

        if ($booking_product) {


            Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from " . optional($booking_product->vendor)->name, optional($booking_product->vendor)->email, $code));
        }
    }


    public function sub_verify_account($referral_code, $user)
    {

        $user = User::where('id', $user)->where('referal_code', $referral_code)->first();
        $countries = Country::all();
        if ($user && $user->verified == 0) {
            return view('users.sub_agents.continue_registration')->with(compact('user','countries'));
        } else {
            session()->flash('alert-success', "Kindly login into your account");
            return redirect()->to('/login');
        }
    }

    public function super_verify_account($referral_code, $user)
    {

        $user = User::where('id', $user)->where('referal_code', $referral_code)->first();

        if ($user && $user->verified == 0) {

            $user->update([
                'verified' => '1'
            ]);

        } else {
            session()->flash('alert-success', "Kindly login into your account");
            return redirect()->to('/login');
        }
    }


    public function complete_registration(Request $request){

        $this->validate($request, [
            'phone_no' => 'required',
            'password' => 'required',
            'company' => 'required',
            'platform_name' => 'required',
            'director' => 'required',
            'file' => 'file|mimes:csv,txt,xlx,xls,pdf|max:2048',
            'certified' => 'required'
        ]);

        $request_data = $request->all();

        $request_data['status'] = 1;
        $request_data['verified'] = '1';

        if ($request->file) {

            $certificate = time() . '.' . $request->file->extension();

            $request->file->move(public_path('img/certificate'), $certificate);

            $request_data['c_o_i'] = "/img/certificate/" . $certificate;
        }
        unset($request_data['user_id']);
        unset($request_data['_token']);
        unset($request_data['file']);

        unset($request_data['password']);

        $request_data['password'] = bcrypt($request->password);

        User::where('id',$request->user_id)->update($request_data);
        $user =  User::where('id',$request->user_id)->first();


        try {

            $message2 = "
            Hi Admin,<br/>

            We would like to inform you that a Subagent has completed registraion with TravelTestsltd.<br/><br/>
            Name: " . $user->first_name . " " . $user->last_name . " <br/>
            Phone: " . $user->phone_no . "<br/>
            Email: " . $user->email . "<br/>
            Company Name: " . $user->company . "<br/>
            <br/>Kindly click the button below to login and review<br/><br/>
            <a href='" . env('APP_URL', "https://uktravelTest.prodevs.io/login") . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Go to Login
                  </a>

                  <br/><br/>
                  Thank you.
                  <br/><br/>
                TravelTestsltd Team
            ";
            Mail::to(['itunu.akinware@medburymedicals.com','john.aigbonohan@medburymedicals.com'])->send(new BookingCreation($message2, "New Subagent Registration"));

        } catch (\Exception $e) {
        }

        session()->flash('alert-success', "Thank you for completing your profile. Your can now login to your account.");

        return redirect()->to('/login');
    }

    public function about()
    {

        return view('homepage.about');
    }

    public function contact()
    {

        return view('homepage.contact');
    }

    public function faq()
    {

        return view('homepage.faq');
    }

    public function terms()
    {

        return view('homepage.terms');
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
        $referral = $user->referal_code;

        //send an email
        try {
            if($user->main_agent_share_raw == null)
            {
                $message = "Congratulations!,<br><br>
                Your application to join the Agent network of the TravelTestsltd Platform has been approved.<br><br>
                You can now log in to your portal to complete your profile and set up your account. <br><br>
                You will find your dedicated customer booking link on your portal <br><br>
                Kindly click the button below<br/><br/>
                        <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "super/continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                        Continue Registration
                       </a>

                              <br/><br/>
                Thank you for joining the  TravelTestsltd network!<br><br>

                TravelTestsltd Team
                ";
            }else{

                $message = "Congratulations!,<br><br>
                Your application to join the Agent network of the TravelTestsltd Platform has been approved.<br><br>
                You can now log in to your portal to complete your profile and set up your account. <br><br>
                Kindly find your login details below:<br><br>
                Email: $user->email<br><br>

                You will find your dedicated customer booking link on your portal <br><br>
                Kindly click the button below<br/><br/>
                        <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "sub/continue/registration/" . $referral . "/" . $user->id . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                        Continue Registration
                       </a>

                              <br/><br/>

                Thank you for joining the  TravelTestsltd network!<br><br>

                TravelTestsltd Team
                ";

            }

            Mail::to($user->email)->send(new BookingCreation($message, 'Agent Activation'));
        } catch (\Exception $e) {
            dd($e);
        }

        return back();
    }

    public function agent_percent($id)
    {
        $user_id = $id;
        $user = User::where('id', $id)->first();
        // dd($user);
        $settings = Setting::where('id', 2)->first();
        return view('admin.percent')->with(compact('user', 'settings'));
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

            Do kindly reach out to the TravelTestsltd  Desk for more information on how to get back on the network.<br><br>

            TravelTestsltd Team
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
            $products = $products->where('product_id', 1)->get();
        } elseif ($type == "Amber_uv") {
            $products = $products->whereIn('product_id', [2, 4, 3, 10, 15, 24])->get();
        } elseif ($type == "Red") {
            $products = $products->where('product_id', 5)->get();
        } elseif ($type == "UK") {
            $faq = 0;
            $products = [];
        }
        $setting = Setting::first();
        return view('homepage.addProducts')->with(compact('products', 'faq', 'type', 'setting'));
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

            //check again
            $check_at_all = Cart::where([
                'ip' => $ip
            ])->count();

            if ($check_at_all > 0) {
                $data = [
                    "message" => "Please complete one booking at a time. You can book more products and packages as required",
                    "btn_text" => "Add from cart",
                    "btn_color" => "white",
                    "color" => "#1E50A0",
                    "error" => "yes"
                ];
            } else {

                $cart__= Cart::create([
                    'ip' => $ip,
                    'quantity' => 1,
                    'vendor_product_id' => $v_product->id
                ]);


                $data = [
                    "message" => "Added $product to cart.",
                    "btn_text" => "Remove from cart",
                    "btn_color" => "white",
                    "color" => "#1E50A0",
                     "error" => "no",
                    "cart_id" => $cart__->id
                ];
            }
        } else {

            Cart::where([
                'ip' => $ip,
                'vendor_product_id' => $v_product->id
            ])->delete();

            $data = [
                "message" => "Removed $product from cart.",
                "btn_text" => "Add to Cart",
                "btn_color" => "#1E50A0",
                "color" => "white",
                "error" => "no"
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
                'price' => "??" . number_format($vproduct->price_pounds, 0),
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
            $price = "??" . number_format($vproduct->price_pounds, 0);

            if ($nationality == 81) {
                $price = "GH???" . number_format($vproduct->price * 0.014, 0);
            }
            if ($nationality == 156) {
                $price = "???" . number_format($vproduct->price, 0);
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
                    'price' => "??" . $vproduct->price_pounds,
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

             TravelTestsltd
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

    public function Testing()
    {
        $booking = Booking::first();
        $message = "
                Hi,

                Thank you for choosing to book with us. To complete your booking, you will need to make payment.<br/><br/>Kindly click the button below to make payment<br/><br/>
                For More Information and Guidelines on the UK Travel Testing Process, click <a href='https://uktraveltest.prodevs.io/#popular' >Here</a> <br>
                <a href='" . env('APP_URL', "https://uktraveltests.prodevs.io/") . "make/payment/'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
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

    public function success_stripe(Request $request, $booking_id)
    {
        // if (!$request->b) {
        //     return redirect()->to('/');
        // }


        $booking = Booking::where('id', $booking_id)->first();

        dd($stripe_charge, $product->charged_amount);



        $txRef = $booking->transaction_ref;


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

                            //for international transaction in dollars(please the pounds was converted to dollars)
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
                                $descript = 1;
                                BookingConfirmationService::processPoundTransaction(
                                    $superAgent,
                                    $booking->id,
                                    $super_agent_amount_credit,
                                    $cost_booking,
                                    $super_agent_percentage,
                                    $descript
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
                                $descript = 1;
                                BookingConfirmationService::processNairaTransaction(
                                    $superAgent,
                                    $booking->id,
                                    $super_agent_amount_credit,
                                    $cost_booking,
                                    $super_agent_percentage,
                                    $descript
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
                //generation of ttluk number
                $code = "TTLUK" . rand(1000000, 9999999);

            } catch (\Exception $e) {
                dd($e);

                    $booking->update([
                        'vendor_id' => 3,
                        'mode_of_payment' => 2,
                        'transaction_ref' => $txRef,
                        'status' => 1
                    ]);

                return redirect()->to('/booking/code/failed?b=' . $txRef);
            }

            foreach ($booking_products as $booking_product) {
                try {

                    if($booking_product->product_id == 2 || $booking_product->product_id == 10)
                    {
                        $message = "
                        Dear " . $booking->first_name . ",<br><br>

                        Thank you for booking with us.<br><br>
                         If you are getting this email, it means you have bought The Unvaccinated Day 8 Mandatory Test or The Unvaccinated Day 2 & Day 8 Mandatory Tests.<br/><br/>

                        Your purchase would be for one of the following reasons:<br><br>

                        1. You are Unvaccinated or Not Fully Vaccinated. Read more <a href='https://www.gov.uk/guidance/travel-to-england-from-another-country-during-coronavirus-covid-19#check-if-you-qualify-as-fully-vaccinated'>here</a><br><br>
                        2. The Vaccination you got is not approved by the UK. Read more <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a><br><br>
                        3. You are Fully Vaccinated but unable to show an approved COVID-19 proof of vaccination before your travel.
                        Read more about the approved proof of vaccination  <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a><br><br>

                        If you are fully vaccinated under an approved vaccination programme accepted in the UK (check if your vaccination is approved <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a>)
                        but were unable to show the approved COVID-19 proof of vaccination before your travel you might be eligible for a partial refund. <br><br>

                        We have a no-refund policy as indicated before your purchase.<br><br>

                        <a href='https://www.surveymonkey.com/r/PQQNWV7'>Kindly click here give us your feedback </a><br><br>

                              <br/><br/>
                              Thank you.
                              <br/><br/>
                            TravelTestsltd Team
                        ";
                        Mail::to($booking->email)->send(new BookingCreation($message, "Guidelines for purchasing a Tests for the Unvaccinated/ Partially Vaccinated "));
                    }

                } catch (\Exception $e) {
                 dd($e);
                }

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
                            $yes = Mail::to(["$booking->email", "$getUser->email"])->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                        } elseif ($getUser->copy_receipt == 0) {
                            $no = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                        }
                    } else {
                        //referral code doesnt exist
                        $maybe = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                    }

                } catch (\Exception $e) {
                 dd($e);
                }


            }

            if (!empty($booking->phone_no)) {

                $decode = implode(", ", json_decode($code));

                $smsMessage = " Hi $booking->first_name  $booking->last_name .Thank you for choosing to book with us at TravelTestGlobal.Your Booking Reference:- " . $decode . ". Test Provider:- " . $booking_product->vendor->name . ".Thank you";
                $sms = $this->sendSMS($smsMessage, [$booking->phone_no], 4);

            }

            //update wiith transaction code


                $booking->update([
                    'vendor_id' => 3,
                    'mode_of_payment' => 2,
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

    public function view_uk($id)
    {

        if($id == "united-kingdom-1")
        {
            $countries = Country::all();

            return view('homepage.uk_page')->with(compact('countries'));
        }else{
            $countries = Country::where('slug_name', $id)->first();
            $scountry = SupportedCountries::where('country_id', $countries->id)->first();


            if(!is_null($scountry))
            {
                return view('homepage.country_decision_page')->with(compact('countries'));
            }else{
                Abort(404);
            }

        }

    }


    public function view_travel_details($id, $action)
    {

            $countries = SupportedCountries::where('country_id', $id)->first();
            $pages = Pages::all();
            return view('homepage.travel_details')->with(compact('countries', 'action','pages'));

    }


    public function voucherProcessing(array $request_data ){

        $price = $price_pounds = 0;


        $voucher =  VoucherGenerate::where(['voucher' => $request_data['external_reference'], 'status' => 0])->first();
        $referer = User::where('id', $voucher->agent)->first();
        $request_data['referral_code'] = $referer->referal_code;
        $request_data['user_id'] = $voucher->agent;


        $booking = Booking::create($request_data);


       if($voucher != null){
            $product_id = $voucher->voucherCount->product_id;

            $vendor_products = VendorProduct::where('vendor_id', 3)->where('product_id', $product_id)->first();

            BookingProduct::create([
                'booking_id' => $booking->id,
                'product_id' => $product_id,
                'vendor_id' => $vendor_products->vendor_id,
                'vendor_product_id' => $vendor_products->id,
                'price' => ($vendor_products->price * $voucher->quantity),
                'price_pounds' => ($vendor_products->price_pounds * $voucher->quantity),
                'vendor_cost_price' => ($vendor_products->cost_price * $voucher->quantity),
                'quantity' => $voucher->quantity
            ]);

            $price = $price + ($vendor_products->price * $voucher->quantity);
            $price_pounds = $price_pounds + ($vendor_products->price_pounds * $voucher->quantity);

            if($voucher->user->country == 'NG')
            {
              $currency = 'NGN';
              $charged = $price;
            }else{
                $currency = 'USD';
                $charged = $price_pounds;
            }

            BookingProduct::where('booking_id', $booking->id)->update([
                'charged_amount' => $charged, 'currency' => $currency
            ]);
        }



        $txRef =  $request_data['transaction_ref'];

        if ($booking->status != 1) {

            $booking_products = BookingProduct::where('booking_id', $booking->id)->get();


            try {

                if(!$booking->room == null)
                {
                    $code = $this->GetDamHealthCode($booking);
                }else{
                    $code = $this->sendData($booking);
                }
                $voucher->update([
                        'quantity' => 0,
                        'status' =>1
                ]);

            } catch (\Exception $e) {

                $booking->update([
                    'vendor_id' => 3,
                    'mode_of_payment' => 3,
                    'transaction_ref' => $txRef,
                    'status' => 1
                ]);

                $redirect = '/booking/code/failed?b=' . $txRef;
                return $redirect;
            }

            //send receipt
            foreach ($booking_products as $booking_product) {
                try {
                    //check if a referral code exist
                    if ($booking->referral_code != null) {
                        //use the referral code to find the user
                        $getUser = User::where('referal_code', $booking->referral_code)->first();

                        //check the status set by the copy receipt
                        //if 1 :copy the agent else if 0: send normally
                        if ($getUser->copy_receipt == 1) {
                            $yes = Mail::to(["$booking->email", "$getUser->email"])->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                        } elseif ($getUser->copy_receipt == 0) {
                            $no = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                        }
                    } else {
                        //referral code doesnt exist
                        $maybe = Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from TravelTestsGlobal", optional($booking_product->vendor)->email, $code));
                    }
                } catch (\Exception $e) {
                }
            }

            //day 2 and 8 disclaimer
            foreach ($booking_products as $booking_product) {
                try {

                    if($booking_product->product_id == 2 || $booking_product->product_id == 10)
                    {
                        $message = "
                        Dear " . $booking->first_name . ",<br><br>

                        Thank you for booking with us.<br><br>
                         If you are getting this email, it means you have bought The Unvaccinated Day 8 Mandatory Test or The Unvaccinated Day 2 & Day 8 Mandatory Tests.<br/><br/>

                        Your purchase would be for one of the following reasons:<br><br>

                        1. You are Unvaccinated or Not Fully Vaccinated. Read more <a href='https://www.gov.uk/guidance/travel-to-england-from-another-country-during-coronavirus-covid-19#check-if-you-qualify-as-fully-vaccinated'>here</a><br><br>
                        2. The Vaccination you got is not approved by the UK. Read more <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a><br><br>
                        3. You are Fully Vaccinated but unable to show an approved COVID-19 proof of vaccination before your travel.
                        Read more about the approved proof of vaccination  <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a><br><br>

                        If you are fully vaccinated under an approved vaccination programme accepted in the UK (check if your vaccination is approved <a href='https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination'>here</a>)
                        but were unable to show the approved COVID-19 proof of vaccination before your travel you might be eligible for a partial refund. <br><br>

                        We have a no-refund policy as indicated before your purchase.<br><br>

                        <a href='https://www.surveymonkey.com/r/PQQNWV7'>Kindly click here give us your feedback </a><br><br>


                              <br/><br/>
                              Thank you.
                              <br/><br/>
                            TravelTestsltd Team
                        ";
                        Mail::to($booking->email)->send(new BookingCreation($message, "Guidelines for purchasing a Tests for the Unvaccinated/ Partially Vaccinated "));
                    }

                } catch (\Exception $e) {
                 dd($e);
                }

            }

            //customer feed back mail
            foreach ($booking_products as $booking_product) {
                try {

                        $message = "Hi " . $booking->first_name . ",<br><br>
                            Thank you for booking your test with Travel Test Global.<br><br>
                            If you ordered a home testing service, have you received your test kits?  <br>
                            <a href='https://docs.google.com/forms/u/1/d/1X2f1Jhd5k6UgnM_dK88pUTXHVW43hT4By_QaLMu4pnM/edit'> Yes</a> or  <a href='https://docs.google.com/forms/u/1/d/1X2f1Jhd5k6UgnM_dK88pUTXHVW43hT4By_QaLMu4pnM/edit'>No </a>  <br><br>

                            If you ordered the in-clinic service, have you received details about the clinic appointment for your test? <br>
                            <a href='https://docs.google.com/forms/u/1/d/1X2f1Jhd5k6UgnM_dK88pUTXHVW43hT4By_QaLMu4pnM/edit'>Yes</a> or  <a href='https://docs.google.com/forms/u/1/d/1X2f1Jhd5k6UgnM_dK88pUTXHVW43hT4By_QaLMu4pnM/edit'>No </a> <br><br>

                            We value your feedback. Please click here to tell us how we are doing.<a href='https://docs.google.com/forms/d/e/1FAIpQLScPxT051YcrGm3AzAM4bb2q5fh4ZL-xNm6QXOfyTzdL5LLf8w/viewform'> Click here </a><br>

                            If you require further support, please contact us using the details shown below. <br><br>

                            Contact Us <br>
                            <a href='Info@traveltestltd.com'>Info@traveltestltd.com</a> <br>
                            <a href='https://www.traveltestsltd.com'> www.traveltestsltd.com</a> <br><br>

                            United Kingdom <br>
                            WhatsApp: +447742999786  <br><br>

                            United Arab Emirates <br>
                            Mobile & WhatsApp: +971544119013, +971563784904 <br><br>

                            Nigeria <br>
                            Mobile & WhatsApp: +2347060466084

                            <br/><br/>
                            Thank you.
                            <br/><br/>
                            TravelTestsltd Team
                        ";
                        Mail::to($booking->email)->send(new BookingCreation($message, "Guidelines for purchasing a Tests for the Unvaccinated/ Partially Vaccinated "));


                } catch (\Exception $e) {
                 dd($e);
                }

            }

            if (!empty($booking->phone_no)) {

                $decode = implode(", ", json_decode($code));

                $smsMessage = " Hi $booking->first_name  $booking->last_name .Thank you for choosing to book with us at TravelTestGlobal.Your Booking Reference:- " . $decode . ". Test Provider:- " . $booking_product->vendor->name . ".Thank you";
                $sms = $this->sendSMS($smsMessage, [$booking->phone_no], 4);

            }

            //update wiith transaction code
            $booking->update([
                'vendor_id' => 3,
                'mode_of_payment' => 3,
                'transaction_ref' => $txRef,
                'status' => 1,
                'booking_code' => $code
            ]);
            $redirect =  '/booking/success?b=' . $txRef;
            return $redirect;

        }

        $redirect ='/booking/success?b=' . $txRef;
        return $redirect;

    }

    public function view_green()
    {
        $countries = CountryColor::where('color_id', 1)->get();
        $type = "GREEN";

        return view('homepage.typecountries')->with(compact('type', 'countries'));
    }

    public function view_amber()
    {
        $countries = CountryColor::where('color_id', 2)->get();
        $type = "AMBER";

        return view('homepage.typecountries')->with(compact('type', 'countries'));
    }

    public function view_red()
    {
        $countries = CountryColor::where('color_id', 3)->get();
        $type = "RED";

        return view('homepage.typecountries')->with(compact('type', 'countries'));
    }

    public function view_single_product($slug)
    {

        $product = Product::where('slug', $slug)->first();
        $products = product::all();
        $vproducts = VendorProduct::where('product_id', optional($product)->id)->orderby('id', 'desc')->take(1)->get();
        $countries = Country::all();
        $sproducts = VendorProduct::where('product_id',  optional($product)->id)->first();

        return view('homepage.single_product')->with(compact('vproducts','sproducts','products','product', 'countries'));

    }

    public function getdamtimeslot(Request $request,$location,$room,$product)
    {
        // dd($request->from);
        // dd(Carbon::now());
        $date = Carbon::createFromFormat('m/d/Y', $request->from)->format('Y-m-d');

        $bearer = $this->getDamhealthToken();

        $time_slots = $this->getDamHealthtime($bearer,$location, $room, $product, $date);
        $slots = json_decode($time_slots);
        $get_slots = $slots->availableSlots;

        $time = [];
        foreach ($get_slots as $slot) {
            $seperate_start = explode('T', $slot->starttime);
            $seperate_end = explode('T', $slot->endtime);

            $time[] = [
                'name' => "$seperate_start[1] - $seperate_end[1]",
            ];
        }

        return $time;
    }

    public function getdamlocate($product)
    {
        $bearer = $this->getDamhealthToken();
        $getlocation = $this->getDamHealthLocations($bearer);
        $location = json_decode($getlocation);

                if(!isset($location->errors))
                {
                    $locations = $location->data->damhealth_locations;

                }else{
                    $locations = null;
                }

            $locate = [];

            foreach($locations as $location)
            {
                $data = [
                    'location' => $location->locationid,
                    'address' => json_encode($location->address),
                    'room' => json_encode($location->rooms['0'])
                ];
                $locate[] = [
                    'array' => json_encode($data),
                    'name' => $location->name,
                ];
            }

        return $locate;
    }

    public function test()
    {
      // ---- DAM HEALTH INTEGRATION TEST ON DIFFERENT END POINT COMPILED TOGETHER ---- //


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
        ///    --------------------    end of get product list   -----------------   ///

        // curl_close($ch2);
        // dd($result_p);
        // dump(json_decode($result_p));

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
        ///   --------------------    end of get product list   -----------------  ///


        ///  ------------  Create  a new Booking ----------   ///


        $object = [ "object" => ["locationid"=> 10037,"roomid"=> 10244,"durationstart"=> "2021-10-24T12:00:00","durationend"=> "2021-10-24T12:10:00","bookingdate"=> "2021-10-24","comments"=> "","bookingproducts"=> [ "data"=> [ ["productid"=> 10002 ] ] ],"bookingnotes"=> [ "data"=> [ "note"=> ""] ],"patient"=> ["data"=> ["address"=> [ ["address"=> "57 , Churchdown Lane","city"=> "Gloucester","state"=> "England","postcode"=> "GL3 3QJ","country"=> "United Kingdom"]],"firstname"=> "John","lastname"=> "Snow","dob"=> "1954-10-26","gender"=> "male", "email"=> "dew@thrones.com","mobilenumber"=> "+2547776332546","passportnumber"=> "123456789","ethnicity"=> "asian","religion"=> null,"occupation"=> null,"company"=> null,"comments"=> null,"customattributes"=> null,"receiveemail"=> true, "receivesms"=> true,"promotionalmarketing"=> true] ] ] ];

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


         ///  ------------  End a new Booking Creation ----------   ///

        ///  --------------  Availability api  --------------------  ///

        $variable =  ["locationid" => 10002, "roomid" => 10009, "productid" => 10278, "bookingdate"=> "2021-09-01"] ;

        $x = curl_init();

        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = "Authorization: Bearer $bearer";
        //dd($headr);
        curl_setopt($x, CURLOPT_URL, 'https://partner-api-dev.dam-health.com/v1/api/availability');
        curl_setopt($x, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($x, CURLOPT_POST, 1);
        curl_setopt($x, CURLOPT_POSTFIELDS, json_encode($variable));
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);

        // curl_setopt($x, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($x, CURLOPT_POSTFIELDS,   $encoded_booking_data);
        // curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($x, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $bearer"));

        $result_x = curl_exec($x);

        ///  --------------  End Availability api  --------------------  ///

        // dump(json_decode($result_p), json_decode($result _3));
        dd($bearer,json_decode($result_p), json_decode($result_3), json_decode($result_book), json_decode( $result_x));
    }

    public function walkIn()
    {
        $vproducts = VendorProduct::where('vendor_id', 4)->get();

        return view('homepage.walk_in')->with(compact('vproducts'));
    }

    public function viewCountryProducts($country)
    {

        $countries = Country::where('slug_name', $country)->first();
        $product = Product::where('country_id', $countries->id)->pluck('id')->toArray();
        $products = VendorProduct::whereIn('product_id',$product)->get();
        return view('homepage.viewCountryProducts')->with(compact('products'));
    }

    public function slugify()
    {
        $countries = Country::all();

        foreach($countries as $country)
        {
            $name = $country->nicename;
            $slug = Str::slug($name);

            if ($country->wherenotnull('slug_name')->orwhere('slug_name',$slug)->exists()) {
                $max = $country->whereName($name)->latest('id')->skip(1)->value('slug_name');
                if (isset($max[-1]) && is_numeric($max[-1])) {

                    return preg_replace_callback('/(\d+)$/', function($mathces) {
                        return $mathces[1] + 1;
                    }, $max);
                }
                $slug = "{$slug}-1";
            }
            dump($slug);
            Country::where('id',$country->id)->update(['slug_name' => $slug]);
        }
    }

  



}
