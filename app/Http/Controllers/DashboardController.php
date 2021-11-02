<?php

namespace App\Http\Controllers;

use App\Helpers\BookingConfirmationService;
use App\Helpers\BookingService;
use App\Helpers\BarcodeHelper;
use App\Helpers\VoucherDiscountProcess;
use App\Helpers\UserShare;
use App\Mail\BookingCreation;
use App\Mail\VendorReceipt;
use App\Models\Voucher;
use App\Models\VoucherCount;
use App\Models\VoucherGenerate;
use App\Models\VoucherPayment;
use App\Models\VoucherProduct;
use App\Models\Booking;
use App\Models\BookingProduct;
use App\Models\PaymentCode;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\PoundTransaction;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\Color;
use App\Models\Country;
use App\Models\CountryColor;
use App\Models\VoucherDiscount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public $bookingService;
    public $bookConfirmationService;

    public function __construct()
    {
        $this->bookingService = new BookingService;
        $this->bookConfirmationService = new BookingConfirmationService;
    }

    public function dashboard()
    {

        $earned = 0;
        $earnedPounds = 0;
        if (auth()->user()->type == 1) {
            $bookings = Booking::orderby('id', 'desc')->get();
            $pending_booking = Booking::where('status', 0)->count();
            $complete_booking = Booking::where('status', 1)->count();
            $users = User::count();
            $payment_codes = PaymentCode::count();
            $refs = User::wherenotNull('referal_code')->get();
            $sub = User::wherenotNull('main_agent_id')->count();


        } elseif (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = Booking::whereIn('id', $bookings_vendors)->orderby('id', 'desc')->get();
            $pending_booking = Booking::whereIn('id', $bookings_vendors)->where('status', 0)->count();
            $complete_booking = Booking::whereIn('id', $bookings_vendors)->where('status', 1)->count();
            $users = 0;
            $payment_codes = 0;
            $refs = [];
            $sub = 0;

        } else {
            $earned = Transaction::where([
                'user_id' => auth()->user()->id,
                'type' => 2
            ])->sum('amount');

            $earnedPounds = PoundTransaction::where([
                'user_id' => auth()->user()->id,
                'type' => 2
            ])->sum('amount');

            $bookings = Booking::where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc')->get();
            $pending_booking = Booking::where('status', 0)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->count();
            $complete_booking = Booking::where('status', 1)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->count();
            $users = 0;
            $payment_codes = 0;
            $refs = [];
            $sub = user::where('main_agent_id', auth()->user()->id)->count();
        }
        $countries = Country::all();
        return view('admin.dashboard')->with(compact('bookings', 'pending_booking', 'users', 'payment_codes', 'complete_booking', 'refs', 'countries', 'earned', 'earnedPounds','sub'));
    }


    public function pending_booking(Request $request)
    {
        if (auth()->user()->type == "1") {
            $bookings = Booking::where('status', 0)->orderby('id', 'desc');
        } elseif (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = Booking::whereIn('id', $bookings_vendors)->where('status', 0);
        } else {
            $bookings = Booking::where('status', 0)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc');

        }

        if (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = $bookings->whereIn('id', $bookings_vendors);
        }

        if (auth()->user()->type == 1) {
            if ($request->vendor_id) {
                $bookings_vendors = BookingProduct::where('vendor_id', $request->vendor_id)->pluck('booking_id')->toArray();
                $bookings = $bookings->whereIn('id', $bookings_vendors);
            }

            if ($request->user_id) {

                $bookings = $bookings->where('user_id', $request->user_id);
            }

            if ($request->product_id) {
                $start = Carbon::parse($request->start)->startOfDay();
                $end = Carbon::parse($request->end)->endOfDay();

                $product_bookings = BookingProduct::where('product_id', $request->product_id)->wherebetween('created_at', [$start, $end])->pluck('booking_id')->toArray();
                $bookings = $bookings->whereIn('id', $product_bookings);
            }
        }

        if ($request->start) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $bookings = $bookings->wherebetween('created_at', [$start, $end]);
        }


        $bookings = $bookings->get();
        $vendors = Vendor::all();
        $users = User::where('type', "!=", '1')->get();
        $products = Product::all();

        if ($request->export) {
            $fileName = 'exports.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Email', 'PhoneNo', 'Sex', 'DOB', 'Ethnicity', 'Products', 'Home Address', "Isolation Address", "Arrival Date", "Country From", "Departure Date");

            $callback = function () use ($bookings, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($bookings as $booking) {

                    if ($booking->ethnicity == "1") {
                        $row['Ethnicity'] = "White";
                    } elseif ($booking->ethnicity == "2") {
                        $row['Ethnicity'] = "Mixed/Multiple Ethnic groups";
                    } elseif ($booking->ethnicity == "3") {
                        $row['Ethnicity'] = "Asian / Asian British";
                    } elseif ($booking->ethnicity == "4") {
                        $row['Ethnicity'] = "Black / African / Caribbean / Black British";
                    } elseif ($booking->ethnicity == "5") {
                        $row['Ethnicity'] = "Other Ethnic Group";
                    }

                   
                    $p = [];
                    foreach ($booking->products as $product) {
                        $p[] = $product->name;
                    }

                    $row['Name'] = $booking->first_name . " " . $booking->last_name;
                    $row['Email'] = $booking->email;
                    $row['PhoneNo'] = $booking->phone_no;
                    $row['Sex'] = ($booking->sex == 1) ? "Male" : "Female";
                    $row['DOB'] = $booking->dob;
                    $row['Products'] = implode(',', $p);
                    $row['Home Address'] = "Address1: {$booking->address_1}\n
                                        Address2: {$booking->address_2}\n
                                        Home City: {$booking->home_town}\n
                                        Home PostCode: {$booking->post_code}\n";
                                       

                    $row['Isolation Address'] = "Address1: {$booking->isolation_address }\n
                                        Address2: {$booking->isolation_addres2}\n
                                        Home City: {$booking->isolation_town}\n
                                        Home PostCode: {$booking->isolation_postal_code }\n";
                                      

           

                    $row['Arrival Date'] = $booking->arrival_date;

                    $row['Country From'] = $booking->travelingFrom->name;
                    $row['Departure Date'] = $booking->departure_date;
                   

                    fputcsv($file, array($row['Name'], $row['Email'], $row['PhoneNo'], $row['Sex'], $row['DOB'], $row['Ethnicity'], $row['Products'], $row['Home Address'], $row['Isolation Address'], $row['Arrival Date'], $row['Country From'], $row['Departure Date']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return view('admin.pending_booking')->with(compact('bookings', 'products', 'vendors', 'users'));
    }

    public function complete_booking(Request $request)
    {

        $refs = [];
        if (auth()->user()->type == "1") {
            $bookings = Booking::where('status', 1)->orderby('id', 'desc');
            $refs = User::wherenotNull('referal_code')->get();

        } elseif (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = Booking::whereIn('id', $bookings_vendors)->where('status', 1);

        } else {
            $bookings = Booking::where('status', 1)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc');
        }

        if (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = $bookings->whereIn('id', $bookings_vendors);
        }
        $vendorsTotalCost = 0;
        $ven = null;
        if (auth()->user()->type == "1") {
            if ($request->vendor_id) {
                $bookings_vendors = BookingProduct::where('vendor_id', $request->vendor_id)->pluck('booking_id')->toArray();
                $bookings = $bookings->whereIn('id', $bookings_vendors);
                $vendorsTotalCost = $bookings_vendors = BookingProduct::where('vendor_id', $request->vendor_id)->sum('vendor_cost_price');

                $ven = BookingProduct::where('vendor_id', $request->vendor_id)->first();
            }

            if ($request->user_id) {

                $bookings = $bookings->where('user_id', $request->user_id);
            }

            if ($request->product_id) {
                $start = Carbon::parse($request->start)->startOfDay();
                $end = Carbon::parse($request->end)->endOfDay();

                $product_bookings = BookingProduct::where('product_id', $request->product_id)->wherebetween('created_at', [$start, $end])->pluck('booking_id')->toArray();
                $bookings = $bookings->whereIn('id', $product_bookings);
            }
        }


        if ($request->start) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $bookings = $bookings->wherebetween('created_at', [$start, $end]);
        }


        $bookings = $bookings->get();

        $vendors = Vendor::all();
        $users = User::where('type', "!=", '1')->get();
        $products = Product::all();


        if ($request->export) {
            $fileName = 'exports.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Email', 'PhoneNo', 'Sex', 'DOB', 'Ethnicity', 'Products', 'Home Address', "Isolation Address", "Arrival Date", "Country From", "Departure Date", 'Amount');

            $callback = function () use ($bookings, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($bookings as $booking) {

                    if ($booking->ethnicity == "1") {
                        $row['Ethnicity'] = "White";
                    } elseif ($booking->ethnicity == "2") {
                        $row['Ethnicity'] = "Mixed/Multiple Ethnic groups";
                    } elseif ($booking->ethnicity == "3") {
                        $row['Ethnicity'] = "Asian / Asian British";
                    } elseif ($booking->ethnicity == "4") {
                        $row['Ethnicity'] = "Black / African / Caribbean / Black British";
                    } elseif ($booking->ethnicity == "5") {
                        $row['Ethnicity'] = "Other Ethnic Group";
                    }

                   
                    $p = [];
                    foreach ($booking->products as $product) {
                        $p[] = $product->name;
                    }

                    $row['Name'] = $booking->first_name . " " . $booking->last_name;
                    $row['Email'] = $booking->email;
                    $row['PhoneNo'] = $booking->phone_no;
                    $row['Sex'] = ($booking->sex == 1) ? "Male" : "Female";
                    $row['DOB'] = $booking->dob;
                    $row['Products'] = implode(',', $p);
                    $row['Home Address'] = "Address1: {$booking->address_1}\n
                                        Address2: {$booking->address_2}\n
                                        Home City: {$booking->home_town}\n
                                        Home PostCode: {$booking->post_code}\n";
                                       

                    $row['Isolation Address'] = "Address1: {$booking->isolation_address }\n
                                        Address2: {$booking->isolation_addres2}\n
                                        Home City: {$booking->isolation_town}\n
                                        Home PostCode: {$booking->isolation_postal_code }\n";
                                       

                   

                    $row['Arrival Date'] = $booking->arrival_date;

                    $row['Country From'] = $booking->travelingFrom->name;
                    $row['Departure Date'] = $booking->departure_date;
                   $row['Amount'] = optional($booking->product)->currency.number_format(optional($booking->product)->charged_amount,2);
                    

                    fputcsv($file, array($row['Name'], $row['Email'], $row['PhoneNo'], $row['Sex'], $row['DOB'], $row['Ethnicity'], $row['Products'], $row['Home Address'], $row['Isolation Address'], $row['Arrival Date'], $row['Country From'], $row['Departure Date'],$row['Amount']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return view('admin.complete_booking')->with(compact('bookings', 'products', 'vendors', 'users', 'refs', 'ven', 'vendorsTotalCost'));
    }

    public function view_booking($id)
    {
        if (auth()->user()->type != 1) {
            if (!auth()->user()->vendor_id) {
                abort(403);
            }
        }
        if (auth()->user()->vendor_id != 0) {
            $check_vendor = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->where('booking_id', $id)->first();
            if (!$check_vendor) {
                abort(403);
            }
        }

        $booking = Booking::where('id', $id)->first();
        $booking_products = BookingProduct::where('booking_id', $booking->id)->get();
        return view('admin.view_booking')->with(compact('booking', 'booking_products'));
    }

    public function add_test_kit(Request $request)
    {
        //to mnually add the test kits after booking
        
        try{
            DB::beginTransaction();
            $booking_p = BookingProduct::where('id', $request->id)->first();
            $test_kit = array();

            for($n = 0; $n < $booking_p->quantity; $n++)
            {
                $test_kit[] = $request->{'test_kit'.$n};
                
            }

            // encode the testkit in json format
            $test_kit = json_encode($test_kit); 
            
        

            Booking::where('id', $booking_p->booking_id)
            ->update([
                    'test_kit' => $test_kit
            ]);

            DB::commit();
            session()->flash('alert-success', "Successfully added test kit numbers.");
            return back();

        }catch(\Exception $e){
            DB::rollBack();
            session()->flash('alert-danger', "Something went wrong.");
            return back()->withInputs();
        }

    }

    public function view_bookings($id)
    {
        if (auth()->user()->type != 1) {
            if (!auth()->user()->vendor_id) {
                abort(403);
            }
        }
        if (auth()->user()->vendor_id != 0) {
            $check_vendor = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->where('booking_id', $id)->first();
            if (!$check_vendor) {
                abort(403);
            }
        }

        $booking_products = BookingProduct::where('product_id', $id)->get();
        return view('admin.view_bookings')->with(compact('booking_products'));
    }

    public function vendors()
    {
        $vendors = Vendor::all();
        $setting = Setting::first();
        $amount = $setting;
        return view('admin.vendors')->with(compact('vendors','setting','amount'));
    }

    public function add_vendor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Vendor::create([
            'name' => $request->name
        ]);
        session()->flash('alert-success', "Vendor successfully created.");
        return back();
    }

    //deleting an agent
    public function delete_user($users_id)
    {
        $user = User::where('id', $users_id)->first();
        $booking = Booking::where('user_id', $users_id)->update(['user_id' => null]);
        $user->delete();

        session()->flash('alert-success', "Agent deleted successfully.");
        return back();
    }

    public function delete_booking($id)
    {

        BookingProduct::where('booking_id', $id)->delete();
        Booking::where('id', $id)->delete();
        session()->flash('alert-success', "Booking deleted successfully.");
        return back();
    }

    public function generate_booking_code($id)
    {
        //get the booking
        $booking = Booking::where('id', $id)->first();
        $booking_product = BookingProduct::where('booking_id', $booking->id)->first();
        //generate the booking code
        $code = $this->sendData($booking);

       if($code){

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

            $booking->update([
                'booking_code' => $code
            ]);
        
       }

        if($code){
            session()->flash('alert-success', "$code has been generated  as a booking code for $booking->first_name $booking->last_name and sent via email");
        }else{

            session()->flash('alert-danger', "Code could not be generated, please try again.");
        }
        return back();
    }

    public function delete_color($id)
    {

        CountryColor::where('id', $id)->delete();
        session()->flash('alert-success', "Color zone deleted successfully.");
        return back();
    }

    public function users()
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }
        $users = User::orderby('created_at', 'desc')->where('type', 2)->get();
        $active = User::where('status', 1)->count();
        $not_active = User::where('status', 0)->count();
        $setting = Setting::where('id', 2)->first();
        $products = Product::all();
        return view('admin.users')->with(compact('users', 'setting', 'active', 'not_active', 'products'));
    }

    public function admins()
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }
        $users = User::orderby('created_at', 'desc')->where('type', 1)->get();
        $setting = Setting::where('id', 2)->first();

        return view('admin.admins')->with(compact('users', 'setting'));
    }

    public function admin_make($id)
    {

        if (auth()->user()->type == 0) {
            abort(403);
        }

        User::where('id', $id)->update([
            'type' => 1
        ]);

        session()->flash('alert-success', "User has been switched to an admin");
        return back();

    }

    public function agent_make($id)
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }

        User::where('id', $id)->update([
            'type' => 0
        ]);

        session()->flash('alert-success', "User has been switched to an Agent");
        return back();

    }

    public function settings()
    {
        $percentage = Setting::where('id', 2)->first();
        $amount = Setting::where('id', 1)->first();

        return view('admin.settings')->with(compact('amount', 'percentage'));

    }

    public function p_settings(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);


        Setting::where('id', "1")->update([
            'pounds' => $request->amount
        ]);

        $v_products = vendorProduct::all();
        foreach ($v_products as $v_product) {
            $price = $v_product->price_pounds * $request->amount;
            vendorProduct::where('id', $v_product->id)->update(['price' => $price]);
        }

        // Setting::where('id', "1")->update([
        //     'value' => $request->percentage
        // ]);

        session()->flash('alert-success', "Settings has been updated successfully");

        return back();
    }

    public function products()
    {
        $products = Product::all();

        return view('admin.products')->with(compact('products'));
    }

    public function add_product(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            "description" => "required"
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        session()->flash('alert-success', "Product has been added successfully");

        return back();
    }

    public function edit_product(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            "description" => "required"
        ]);

        Product::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        session()->flash('alert-success', "Product has been updated successfully");

        return back();
    }

    public function delete_product($id)
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }

        $booking_products = BookingProduct::where('product_id', $id)->count();

        if ($booking_products == 0) {
            Product::where('id', $id)->delete();
        }

        session()->flash('alert-success', "Product has been deleted successfully");

        return back();
    }

    public function product_vendor($id, $price, $priceStripe, $costPrice)
    {
        $pounds_value = Setting::first();
        VendorProduct::where('id', $id)->update([
            'price' => $price * $pounds_value->pounds,
            'price_pounds' => $price,
            'price_stripe' => $priceStripe,
            'cost_price' => $costPrice
        ]);

        return "success";
    }

    public function user_bank()
    {
        $countries = ["NG" => "Nigeria", "GH" => "Ghana", "KE" => "Kenya", "UG" => "Uganda", "ZA" => "South Africa", "TZ" => "Tanzania"];

//        $banks = $this->bank();
//
//        usort($banks, function ($a, $b) {
//            return $b->name < $a->name;
//        });


        return view('admin.user_bank')->with(compact('countries'));
    }


    public function add_bank(Request $request)
    {

        $this->validate($request, [
            'account_bank',
            'account_no',
            'password'
        ]);


        if (Hash::check($request->password, auth()->user()->password) == false) {
            session()->flash("alert-danger", "Incorrect password provided");
            return back();
        }


        $banks = json_decode($request->bank_array);
        $banks_ = [];
        foreach ($banks as $bank) {
            $banks_[$bank->code] = $bank->name;
        }

        $data_save = [
            'account_bank' => $request->account_bank,
            'account_no' => $request->account_no,
            'country' => $request->country,
            'account_name' => $request->account_name,
            'bank' => (isset($banks_[$request->account_bank]) ? $banks_[$request->account_bank] : "")
        ];


        $settings = Setting::where('id', 2)->first();
        //update flutterwave

        $flutterwave_data = [
            'account_bank' => $request->account_bank,
            'account_number' => $request->account_no,
            'business_name' => auth()->user()->first_name . " " . auth()->user()->last_name,
            'business_email' => auth()->user()->email,
            'business_mobile' => auth()->user()->phone_no,
            'country' => $request->country,
            "split_type" => "percentage",
            "split_value" => (auth()->user()->percentage_split) ? (100 - auth()->user()->percentage_split) / 100 : (100 - $settings->value) / 100
        ];

        if (!auth()->user()->flutterwave_key) {
            $data = $this->addFlutterwave($flutterwave_data);
        } else {
            $data = $this->editFlutterwave($flutterwave_data, auth()->user()->flutterwave_id);

        }
        if (!$data->data) {
            session()->flash("alert-danger", $data->message);
            return back();

        }

        $data_save['flutterwave_key'] = $data->data->subaccount_id;
        $data_save['flutterwave_id'] = $data->data->id;


        User::where('id', auth()->user()->id)->update($data_save);
        session()->flash("alert-success", "Bank has been added successfully");
        return back();

    }

    public function addFlutterwave($data)
    {

        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY', "FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/subaccounts");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);

        return $server_output;

    }

    public function editFlutterwave($data, $flutterwave_id)
    {
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY', "FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/subaccounts/" . $flutterwave_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);

        return $server_output;

    }

    public function send_booking($id)
    {
        session()->flash("alert-danger", "This module is disabled for now. Till we are live");
        return back();
    }


    public function color()
    {
        //get all colors
        $colors = Color::all();
        //get all countries
        $country_id_exclude = CountryColor::pluck('country_id')->toArray();
        $countries = Country::whereNotIn('id', $country_id_exclude)->get();
        $countryzone = CountryColor::all();

        return view('admin.colors')->with(compact('colors', 'countries', 'countryzone'));
    }

    public function edit_color(Request $request, $id)
    {
        CountryColor::where('id', $id)->update([
            'color_id' => $request->color
        ]);
        session()->flash("alert-success", "Color Zone has been updated ");
        return back();

    }

    public function add_color(Request $request)
    {
        $exist = CountryColor::where('country_id', $request->country)->first();

        if ($exist != null) {
            session()->flash("alert-success", "Sorry , this country has already been added.");
            return back();
        } else {
            CountryColor::create([
                'country_id' => $request->country,
                'color_id' => $request->color
            ]);
            session()->flash("alert-success", "New country color zone added");
            return back();
        }

    }


    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->to('/');
    }

    public function change_referral_code(Request $request, $id)
    {
        $this->validate($request, [
            'referal_code' => "required"
        ]);

        $code = str_replace(" ", "_", $request->referal_code);
        $user = User::where('referal_code', $code)->where('id', '!=', $id)->first();

        if ($user) {
            session()->flash("alert-info", "Name already exist. Kindly use another name");
            return back();
        }

        User::where('id', $id)->update([
            'referal_code' => $request->referal_code
        ]);

        session()->flash('alert-success', "Referral code changed successfully");
        return back();
    }


    public function add_referer(Request $request, $id)
    {

        $this->validate($request, [
            'referal_code' => "required"
        ]);

        $user = User::where('referal_code', $request->referal_code)->first();

        $booking = Booking::where('id', $id)->first();
        $booking->update([
            'referral_code' => $request->referal_code,
            'user_id' => $user->id
        ]);

        //add the payment under him

        try {
            DB::beginTransaction();
            $booking_product = BookingProduct::where('booking_id', $id)->first();

            if (isset($user)) {
                if ($user->percentage_split != null) {
                    $pecentage = $user->percentage_split;
                } else {
                    $defaultpercent = Setting::where('id', '2')->first();
                    $pecentage = $defaultpercent->value;
                }
            } else {
                $defaultpercent = Setting::where('id', '2')->first();
                $pecentage = $defaultpercent->value;
            }


            $check = Transaction::where('booking_id', $booking->id)->where('user_id', $user->id)->first();
            if (!$check) {
                $cost_booking = $booking_product->price;

                $amount_credit = ($cost_booking * ($pecentage / 100));


                Transaction::create([
                    'amount' => $amount_credit,
                    'booking_id' => $booking->id,
                    'user_id' => $user->id,
                    'cost_config' => $cost_booking,
                    'pecentage_config' => $pecentage,
                    'type' => "1"
                ]);


                $transactions = Transaction::where('type', "1")->where('user_id', $user->id)->sum('amount');

                $total_amount = $user->wallet_balance + $amount_credit;

                User::where('id', $booking->user_id)->update([
                    'wallet_balance' => $total_amount,
                    'total_credit' => $transactions
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        session()->flash('alert-success', "Referer has been added successfully");
        return back();
    }

    public function edit_email(Request $request)
    {
        $this->validate($request, [
            'email'
        ]);

        $booking = Booking::where('id', $request->id)->first();

        $booking->update([
            'email' => $request->email
        ]);

//        try{
        $reference = $this->sendData($booking);

        $booking->update([
            'email' => $request->email,
            'booking_code' => $reference
        ]);
//        }catch (\Exception $ex){
//
//        }


        session()->flash('alert-success', "Email edited successfully");

        return back();
    }

    public function resend_receipt($id)
    {

        $booking = Booking::where('id', $id)->first();
        $code = $booking->booking_code;
        $booking_product = BookingProduct::where('booking_id', $booking->id)->first();
        try {
            Mail::to($booking->email)->send(new VendorReceipt($booking_product->id, "Receipt from UK Travel Tests", optional($booking_product->vendor)->email, $code));
        } catch (\Exception $e) {

        }

        session()->flash('alert-success', "Receipt has been sent successfully");

        return back();
    }

    public function subagent_report(Request $request)
    {
        $getAgents = User::where('main_agent_id', auth()->user()->id)->orderby('created_at')->get();
        $duePounds = User::where('main_agent_id', auth()->user()->id)->sum('pounds_wallet_balance');
        $dueNaira = User::where('main_agent_id', auth()->user()->id)->sum('wallet_balance');
        $agentsId = array();
        foreach($getAgents as $agent)
        {
            $agentsId[] = $agent->id;
        }


        if ($request->start && $request->end) {
            $start = $request->start;
            $end = $request->end;
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $commission = Transaction::whereIn('user_id', $agentsId)->wherebetween('created_at', [$start, $end])->sum('amount');
            $pcommission = PoundTransaction::whereIn('user_id', $agentsId)->wherebetween('created_at', [$start, $end])->sum('amount');
        }else{
            $start = 1;
            $end = 1;
            $commission = Transaction::whereIn('user_id', $agentsId)->sum('amount');
            $pcommission  = PoundTransaction::whereIn('user_id', $agentsId)->sum('amount');
        }

        $users = $getAgents;

        if ($request->export) {
            $fileName = 'financial_reports.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Referral Code', 'Total C.booking', 'Wallet Balance', 'Account Details');
            $columnMoney = array('Total Revenue(Naira)', 'Total Revenue(Dollar)', 'Amount due(N)', 'Amount due(#)');

            $callback = function () use ($users, $columns, $columnMoney, $dueNaira, $duePounds, $commission, $pcommission) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($users as $user) {

                    $row['Name'] = $user->first_name . " " . $user->last_name;
                    $row['Referral Code'] = $user->referal_code . ", " . $user->email . ", " . $user->phone;
                    $row['Total C.booking'] = $user->cbookings->count();
                    $row['Wallet Balance'] = "N" . number_format($user->wallet_balance, 5);
                    $row['Account Details'] = "Country:" . $user->country . ", " . "Bank:" . $user->bank . "Account No:" . $user->account_no . ", "
                        . "Account Name:" . $user->account_name;


                    fputcsv($file, array($row['Name'], $row['Referral Code'], $row['Total C.booking'], $row['Wallet Balance'], $row['Account Details']));

                }
                fputcsv($file, array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '));

                fputcsv($file, $columnMoney);
                $row['rNaira'] = 'N' . number_format($commission, 5);
                $row['rPound'] = '# ' . number_format($pcommission, 5);
                $row['dueNaira'] = 'N' . number_format($dueNaira, 5);
                $row['duePound'] = '# ' . number_format($duePounds, 5);


                fputcsv($file, array($row['rNaira'], $row['rPound'],$row['dueNaira'],$row['duePound']));
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        return view('admin.subagent_report')->with(compact('duePounds','dueNaira', 'users', 'start', 'end', 'commission', 'pcommission'));

    }

    public function financial_report(Request $request)
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }

        if ($request->start && $request->end) {
            $start = $request->start;
            $end = $request->end;
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();

           

            $total_ngn = 0;
            $total_gbp = 0;
            $vendor_cost_ngn = 0;
            $vendor_cost_dollars = 0;
           
            $checkn = Transaction::where('type', 1)->wherebetween('created_at', [$start, $end])->get();
            $checkb = PoundTransaction::where('type', 1)->wherebetween('created_at', [$start, $end])->get();

            $commission = Transaction::where('type', 1)->wherebetween('created_at', [$start, $end])->sum('amount');
            $pcommission = PoundTransaction::where('type', 1)->wherebetween('created_at', [$start, $end])->sum('amount');
            
            foreach($checkn as $ch){
                // dump($ch->booking_id);
                
                $book_p_n = BookingProduct::where(['booking_id' => $ch->booking_id ,'currency' => 'NGN'])->first();
               
               if($book_p_n != null)
               {
                $total_ngn  = $total_ngn  + $book_p_n->charged_amount;
                $rate = $book_p_n->charged_amount/ ($book_p_n->price ?? 1);
                $vendor_cost_dollars = $vendor_cost_ngn + ($book_p_n->vendor_cost_price * $rate);
               }
               
            }
            // dd($checkn);
            foreach($checkb as $ch){
                // dump( $check->product);
                $book_p_n = BookingProduct::where(['booking_id' => $ch->booking_id ,'currency' => 'USD'])->first();
               if($book_p_n != null)
               {
                $total_gbp  = $total_gbp  + $book_p_n->charged_amount;
                $vendor_cost_dollars = $vendor_cost_dollars + $book_p_n->vendor_cost_price;
               }
               
            }


            // $total_ngn = BookingProduct::where('currency', 'NGN')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            // $vendor_cost_ngn =  BookingProduct::where('currency', 'NGN')->wherebetween('created_at', [$start, $end])->sum('vendor_cost_price');
            // $total_gbp = BookingProduct::where('currency', 'USD')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            // $vendor_cost_dollars =  BookingProduct::where('currency', 'USD')->wherebetween('created_at', [$start, $end])->sum('vendor_cost_price');
            $total_ghs = BookingProduct::where('currency', 'GHS')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_tzs = BookingProduct::where('currency', 'TZS')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_kes = BookingProduct::where('currency', 'KES')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_zar = BookingProduct::where('currency', 'ZAR')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
        } else {
            $start = 1;
            $end = 1;
            $total_ngn = 0;
            $total_gbp = 0;
            $vendor_cost_ngn = 0;
            $vendor_cost_dollars = 0;
            $checkn = Transaction::where('type', 1)->get();
            $checkb = PoundTransaction::where('type', 1)->get();
          
            $commission = Transaction::where('type', 1)->sum('amount');
            $pcommission = PoundTransaction::where('type', 1)->sum('amount');
            foreach($checkn as $ch){
                // dump( $check->product);
                $book_p_n = BookingProduct::where(['booking_id' => $ch->booking_id ,'currency' => 'NGN'])->first();
               if($book_p_n != null)
               {
                $total_ngn  = $total_ngn  + $book_p_n->charged_amount;
                $rate = $book_p_n->price/ ($book_p_n->price_pounds ?? 1);
                $vendor_cost_ngn = $vendor_cost_ngn + ($book_p_n->vendor_cost_price * $rate);
               }
               
            }
           

            foreach($checkb as $ch){
                // dump( $check->product);
                $book_p_n = BookingProduct::where(['booking_id' => $ch->booking_id ,'currency' => 'USD'])->first();
        
               if($book_p_n != null)
               {
                $total_gbp  = $total_gbp  + $book_p_n->charged_amount;
                $vendor_cost_dollars = $vendor_cost_dollars + $book_p_n->vendor_cost_price;
               }
               
            }
          
            // $total_ngn = BookingProduct::where('currency', 'NGN')->sum('charged_amount');
            // $vendor_cost_ngn = BookingProduct::where('currency', 'NGN')->sum('vendor_cost_price');
            // $total_gbp = BookingProduct::where('currency', 'USD')->sum('charged_amount');
            // $vendor_cost_dollars = BookingProduct::where('currency', 'USD')->sum('vendor_cost_price');
            $total_ghs = BookingProduct::where('currency', 'GHS')->sum('charged_amount');
            $total_tzs = BookingProduct::where('currency', 'TZS')->sum('charged_amount');
            $total_kes = BookingProduct::where('currency', 'KES')->sum('charged_amount');
            $total_zar = BookingProduct::where('currency', 'ZAR')->sum('charged_amount');
        }

       
        $p_due_amount = User::sum("pounds_wallet_balance");
        $due_amount = User::sum("wallet_balance");
     
        $discount_commission_n = Voucherpayment::where([
            'status'=> 1,
            'currency' => 'NG'
            ])->where('super_agent_share', '!=', '0' )->sum('super_agent_share');

        $discount_commission_us = Voucherpayment::where(['status'=> 1])
                                    ->where('currency', '!=', 'NG' )
                                    ->sum('super_agent_share');

        $discount_vendorCost_d =   Voucherpayment::where(['status'=> 1])
                                    ->where('currency', '!=', 'NG' )
                                    ->get();

        $discount_vendorCost_n =   Voucherpayment::where(['status'=> 1])
                                    ->where('currency', 'NG' )
                                    ->get();
        $d_vC_n = 0;
        $d_vC_d = 0;
        $d_charged = 0;
        $n_charged = 0;

            foreach( $discount_vendorCost_n as $cost)
            {
                if($cost->transaction_ref != null)
                {
                    $d_vC_n =  $d_vC_n + ($cost->vendors_cost *  $cost->o_price);
                }else{
                    $d_vC_n =  $d_vC_n + (($cost->vendors_cost *  $cost->o_price) * $cost->quantity);
                }
                
            }

            foreach( $discount_vendorCost_n as $cost)
            {
                if($cost->transaction_ref != null)
                {
                    $n_charged=  $n_charged + ($cost->charged_amount);
                }else{
                    $n_charged =  $n_charged + ($cost->charged_amount * $cost->quantity);
                }
                
            }



            foreach( $discount_vendorCost_d as $cost)
            {
                if($cost->transaction_ref != null)
                {
                    $d_vC_d =  $d_vC_n + $cost->vendors_cost ;
                }else{
                    $d_vC_d =  $d_vC_n  + ($cost->vendors_cost *  $cost->quantity);
                }
                
            }

            foreach( $discount_vendorCost_d as $cost)
            {
                if($cost->transaction_ref != null)
                {
                    $d_charged=  $d_charged + ($cost->charged_amount);
                }else{
                    $d_charged =  $d_charged + ($cost->charged_amount * $cost->quantity);
                }
                
            }
        
            $discount_profit_n =  $n_charged -  $d_vC_n;
            $discount_profit_d = $d_charged -  $d_vC_d;

           
        $profit_naira =  $total_ngn - $commission - $vendor_cost_ngn;
        // dd($profit_naira, $total_ngn ,$commission , $vendor_cost_ngn );

        $profit_dollars = $total_gbp - $pcommission - $vendor_cost_dollars;
        // dd(  $profit_dollars ,$total_gbp ,$pcommission ,$vendor_cost_dollars );

        // dd( $profit_dollars, $total_gbp, $pcommission, $vendor_cost_dollars);
        $users = User::where('type', '!=', '1')->whereNotNull('wallet_balance')->orderby('wallet_balance', 'desc')->get();

        if ($request->export) {
            $fileName = 'financial_reports.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Referral Code', 'Total C.booking', 'Wallet Balance', 'Account Details');
            $columnMoney = array('Total Revenue(Naira)', 'Total Revenue(Dollar)', 'Total Revenue(cedis)', 'Total Revenue(TZS)', 'Total Revenue(KES)', 'Total Revenue(ZAR)', 'Amount due(Referrals');

            $callback = function () use ($users, $columns, $columnMoney, $total_ngn, $total_gbp, $total_ghs, $total_tzs, $total_kes, $total_zar, $due_amount) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($users as $user) {

                    $row['Name'] = $user->first_name . " " . $user->last_name;
                    $row['Referral Code'] = $user->referal_code . ", " . $user->email . ", " . $user->phone;
                    $row['Total C.booking'] = $user->cbookings->count();
                    $row['Wallet Balance'] = "N" . number_format($user->wallet_balance, 5);
                    $row['Account Details'] = "Country:" . $user->country . ", " . "Bank:" . $user->bank . "Account No:" . $user->account_no . ", "
                        . "Account Name:" . $user->account_name;


                    fputcsv($file, array($row['Name'], $row['Referral Code'], $row['Total C.booking'], $row['Wallet Balance'], $row['Account Details']));

                }
                fputcsv($file, array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '));

                fputcsv($file, $columnMoney);
                $row['Naira'] = 'N' . number_format($total_ngn, 5);
                $row['Pound'] = '# ' . number_format($total_gbp, 5);
                $row['cedis'] = 'GH' . number_format($total_ghs, 5);
                $row['tzs'] = 'TZS ' . number_format($total_tzs, 5);
                $row['kes'] = 'KES ' . number_format($total_kes, 5);
                $row['zar'] = 'ZAR ' . number_format($total_zar, 5);
                $row['due'] = 'N ' . number_format($due_amount, 5);


                fputcsv($file, array($row['Naira'], $row['Pound'], $row['cedis'], $row['tzs'], $row['kes'], $row['zar'], $row['due']));
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }


        return view('admin.report')->with(compact('total_ngn', 'total_gbp', 'total_ghs', 'total_kes', 'due_amount', 'total_zar', 'total_tzs', 'users', 'start', 'end', 'commission', 'p_due_amount', 'profit_naira', 'profit_dollars', 'pcommission', 'vendor_cost_dollars', 'vendor_cost_ngn', 'discount_commission_n', 'discount_commission_us', 'discount_profit_n', 'discount_profit_d'));

    }

    public function make_pay(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'type' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $user = User::where('id', $request->id)->first();
            $type = $request->type;

            if ($user) {
                if ($type == 1) {
                    if ($user->wallet_balance < $request->amount) {
                        session()->flash("alert-info", "Insufficient Balance.");
                        return back();
                    }
                    Transaction::create([
                        'amount' => $request->amount,
                        'booking_id' => null,
                        'user_id' => $request->id,
                        'type' => "2",
                        'cost_config' => null,
                        'pecentage_config' => null
                    ]);

                    $wallet_balance = $user->wallet_balance - $request->amount;

                    $user->update([
                        'wallet_balance' => $wallet_balance
                    ]);
                } elseif ($type == 2) {

                    if ($user->pounds_wallet_balance < $request->amount) {
                        session()->flash("alert-info", "Insufficient Balance.");
                        return back();
                    }

                    PoundTransaction::create([
                        'amount' => $request->amount,
                        'booking_id' => null,
                        'user_id' => $request->id,
                        'type' => "2",
                        'cost_config' => null,
                        'pecentage_config' => null
                    ]);

                    $wallet_balance = $user->pounnds_wallet_balance - $request->amount;

                    $user->update([
                        'pounds_wallet_balance' => $wallet_balance
                    ]);
                }
                DB::commit();

                session()->flash("alert-success", "Debit Transaction has been recorded");

                try {

                    $message2 = "
                    Hi " . $user->first_name . ",<br/>
                    
                    Your payment has been processed into your bank account.<br/><br/>
                        <br/><br/>
                        Thank you.
                        <br/><br/>
                         Traveltestsltd Team
                    ";
                    Mail::to($user->email)->send(new BookingCreation($message2, "Payment Notification"));


                } catch (\Exception $e) {

                }
                return back();
            }
        } catch (\Exception $e) {

            DB::rollBack();
            session()->flash("alert-danger", "An Error occurred $e");

            return back();
        }

    }

    public function agent_deactivate_name($id)
    {
        User::where('id', $id)->update(['agent_show_name' => 0]);

        session()->flash('alert-success', "Successfully deactivated showing of name on agent referral booking ");

        return back();
    }

    public function agent_activate_name($id)
    {
        User::where('id', $id)->update(['agent_show_name' => 1]);

        session()->flash('alert-success', "Successfully activated showing of name on agent referral booking ");

        return back();
    }

    public function agent_copy_receipt($id)
    {
        //check for status 1 means yes to be copied and 0 means no
        $copied = User::where('id', $id)->first()->copy_receipt;

        if ($copied == 0) {

            User::where('id', $id)->update(['copy_receipt' => 1]);

            session()->flash('alert-success', "Successfully activated this agent to be copied on emailing of receipt for bookings.");

            return back();

        } elseif ($copied == 1) {

            User::where('id', $id)->update(['copy_receipt' => 0]);

            session()->flash('alert-success', "Successfully deactivated this agent to be copied on emailing of receipt for bookings.");

            return back();

        } else {

            session()->flash('alert-danger', "Something went wrong is processing this request");

            return back();
        }

    }

    public function barcode_status($id, $status)
    {
        

        if ($status == 0) {

            User::where('id', $id)->update(['enable_barcode' => 1]);

            session()->flash('alert-success', "Successfully activated this agent's ability to scan barcode.");

            return back();

        } elseif ($status == 1) {

            User::where('id', $id)->update(['enable_barcode' => 0]);

            session()->flash('alert-success', "Successfully deactivated this agents ability to scan barcode.");

            return back();

        } else {

            session()->flash('alert-danger', "Something went wrong is processing this request");

            return back();
        }

    }

    public function agent_view_product()
    {
        $vproducts = VendorProduct::where('vendor_id', 3)->get();

        $user = User::where('id', auth()->user()->id)->first();
        
        if ($user->percentage_split != null) {
            $percentage = $user->percentage_split/100;
        } else {
            $defaultpercent = Setting::where('id', '2')->first();
            $percentage = $defaultpercent->value/100;
        }

        return view('admin.agent_view_product')->with(compact('vproducts','percentage'));
    }

    public function post_agent_buy($product_id, $vendor_id, $quantity)
    {
       
        $product = VendorProduct::where('product_id',$product_id)->where('vendor_id',$vendor_id)->first();

        $user = User::where('id', auth()->user()->id)->first();
        
        $percent_to_charge = 0;
        $sub_percent = 0;
        $super_percent = 0;
        $sub_share = 0;
        $super_share = 0;
        if ($user->percentage_split != null) {

           if($user->superAgent == null)
           {
                $percentage = $user->percentage_split/100;

                $super_percent = $percentage;

           }else{

                // $percentage = $user->percentage_split/100;
                $percentage = (($user->main_agent_share_raw/100) * $user->percentage_split) / 100;
            
                $sub_percent = $percentage;
                $super_percent = $user->percentage_split/100 - $sub_percent;

           }

        } else {
            $defaultpercent = Setting::where('id', '2')->first();

            if($user->superAgent == null)
            {
                $percentage = $defaultpercent->value/100;
                $super_percent = $percentage;
               
            }else{

                $percentage = (($user->main_agent_share_raw/100) *  $defaultpercent->value) / 100;
                $sub_percent = $percentage;
                $super_percent = $defaultpercent->value/100 - $sub_percent;
              
            }
        }

    
        $country = auth()->user()->country;

        if ($country == "NG") {
            $price = $product->price * $quantity;
            $amount = $price - ($price * $percentage);

            if($sub_percent != 0)
            {
                $sub_share = ($price * $sub_percent);
            }

            if($super_percent != 0)
            {
                $super_share = ($price * $super_percent);
            }
            $total_price =  $price - ($sub_share + $super_share);

        } else {
            $price = $product->price_pounds * $quantity;
            $amount = $price - ($price * $percentage);
           
            if($sub_percent != 0)
            {
                $sub_share = ($price * $sub_percent);
            }

            if($super_percent != 0)
            {
                $super_share = ($price * $super_percent);
            }
            $total_price =  $price - ($sub_share + $super_share);
        }

  
      

        $transaction_ref = uniqid('voucher-') . rand(10000, 999999);

        $agent_id = auth()->user()->id;
        

        $data = $this->processPaystackVoucherData($amount, $transaction_ref, $country, $agent_id);

        $this->bookingService->getSubAccountsByRefCode(auth()->user()->referral_code);

            
           $vendorProduct = VendorProduct::where(['product_id' => $product_id, 'vendor_id' => $vendor_id])->first();
           $cost =  $vendorProduct->cost_price * $quantity;

            $save_data = [
                'agent'=> $agent_id,
                'transaction_ref' => $transaction_ref,
                'vendor_id' => $vendor_id,
                'product_id' => $product_id,
                'vendor_product_id' => $vendorProduct->id,
                'vendors_cost' => $cost,
                'o_price' => $price,
                'quantity' => $quantity,
                'charged_amount' => $total_price,
                'super_agent_share' => $sub_share,
                'sub_agent_share' => $super_share,
                'currency' => $country,
                'status' => 0
            ];

            // dd($save_data, $super_percent, $sub_percent, $super_share, $sub_share, $total_price);
    
            $voucherProduct = VoucherPayment::Create($save_data);
      
    
        $redirect_url = $this->processPaystack($data);

        return redirect()->to($redirect_url);
    }

    public function voucher_payment_confirmation(Request $request)
    {
        $request_data = $request->all();
        $txRef = $request->trxref;

        //run some curl commands to verify
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
        $data_response = json_decode($response);

        //check if succesful
        if (isset($data_response->data->status) && $data_response->data->status == "success") {

            $voucherpay = VoucherPayment::where('transaction_ref', $txRef)->first();

           
            if ($voucherpay->status != 1) {

                $count_check = VoucherCount::where(['agent' => $voucherpay->agent, 'product_id' => $voucherpay->product_id])->first();

                if($count_check == null)
                {
                      VoucherCount::create([
                         'agent' => $voucherpay->agent,
                         'product_id' => $voucherpay->product_id,
                         'quantity' => $voucherpay->quantity
                         
                     ]);
     
                }else{
     
                     $voucher_quantity = $count_check->quantity + $voucherpay->quantity;
     
                     $count_check->update([
                         'quantity' => $voucher_quantity
                     ]);
     
                }

                // update voucher payment status
                $voucherpay->update([
                    'status' => 1,
                ]);

            
                    try {
                        DB::beginTransaction();

                        $userService = new UserShare;
                        $user = User::where('id', $voucherpay->agent)->first();
                        $agent_share = $userService->myShare($user);
                        $share_data = $userService->calculateMainAgentShare($user->main_agent_share_raw, $agent_share);

                        $agent_percentage = $share_data["sub_agent_share"];

                        $cost_booking = $voucherpay->charged_amount;


                        if ($voucherpay->currency != null) {

                            //for international transaction in pounds
                            $product = VendorProduct::where('product_id', $voucherpay->product_id)->where('vendor_id',$voucherpay->vendor_id)->first();
                           
                            $user = User::where('id', auth()->user()->id)->first();
        
                            if ($user->percentage_split != null) {
                                $percentage = $user->percentage_split/100;
                            } else {
                                $defaultpercent = Setting::where('id', '2')->first();
                                $percentage = $defaultpercent->value/100;
                            }
                    
                            $country = auth()->user()->country;
                    
                            if ($country == "NG") {
                                $amount = $product->price * $voucherpay->quantity;
                                $amount = $amount * $percentage;
                    
                            } else {
                                $amount = $product->price_pounds * $voucherpay->quantity;
                                $amount = $amount * $percentage;
                            }

                            $agent_amount_credit = $amount;


                            VoucherDiscountProcess::processTransaction(
                                $user->id,
                                $voucherpay->id,
                                $agent_amount_credit,
                                $cost_booking,
                                $agent_percentage
                            );

                            if (!empty($superAgent = $user->superAgent)) {
                               //get the amount to credit super agent
                                $super_agent_amount_credit = ($agent_amount_credit * ( $user->main_agent_share_raw / 100));
                                
                                if($country == "NG"){
                                    //crediting the users wallet
                                    $total_amount = $user->pounds_wallet_balance +  $super_agent_amount_credit;
                                
                                    User::where('id', $user->superAgent->id)->update([
                                        'wallet_balance' => $total_amount,
                                       
                                    ]);

                                }else{
                                    //crediting the users wallet
                                    $total_amount = $user->wallet_balance +  $super_agent_amount_credit;
                                
                                    User::where('id', $user->superAgent->id)->update([
                                        'pounds_wallet_balance' => $total_amount,
                                    ]);

                                }
                            }
                        }

                      
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        dd($e);
                        logger("An error occured while saving discount");
                       
                    }
    
            }


            session()->flash('alert-success', "Transaction completed. Your account has been topped up");
            return redirect()->to('/view/vouchers');
        }


        session()->flash('alert-danger', "Sorry but this transaction wasnt successful");
        return redirect()->to('/view/vouchers');
    }

    public function view_vouchers()
    {
        if (auth()->user()->type == 1) {
            $vouchers = VoucherGenerate::orderBy('id', 'desc')->get();
        } else {
            $vouchers = VoucherGenerate::where('agent', auth()->user()->id)->orderBy('id', 'desc')->get();
        }
       $sub_agents = User::where('main_agent_id' , auth()->user()->id)->get();

        $products = Product::all();

        return view('admin.view_vouchers')->with(compact('vouchers', 'products', 'sub_agents'));
    }

    public function view_discounts()
    {
        if (auth()->user()->type == 1) {
            $vouchers = VoucherDiscount::orderBy('id', 'desc')->get();
        } else {
            $vouchers = VoucherDiscount::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }

        return view('admin.discount')->with(compact('vouchers'));
    }

    public function view_report_discount($type, $start, $end)
    {
        $currency = $type;
        if ($start != 1) {
            $start = Carbon::parse($start)->startOfDay();
            $end = Carbon::parse($end)->endOfDay();
   
            if($currency == "naira"){
                $discounts = VoucherPayment::where('status', 1)
                ->where('super_agent_share', '!=', '0')
                ->where('currency', 'NG')
                ->wherebetween('created_at', [$start, $end])->orderby('id', 'desc')->get();
            }else{
                $discounts = VoucherPayment::where('status', 1)
                ->where('super_agent_share', '!=', '0')
                ->where('currency', '!=', 'NG')
                ->wherebetween('created_at', [$start, $end])->orderby('id', 'desc')->get();
            }
           
        }else{

            if($currency =="naira"){
                 $discounts = VoucherPayment::where('status', 1)
                 ->where('super_agent_share', '!=', '0')
                 ->where('currency', 'NG')
                 ->orderby('id', 'desc')->get();
            }else{
                $discounts = VoucherPayment::where('status', 1)
                ->where('super_agent_share', '!=', '0')
                ->where('currency', '!=', 'NG')
                ->orderby('id', 'desc')->get();
            }
        
        }
       
        return view('admin.report_discount')->with(compact('discounts', 'currency'));
    }

    public function email_vouchers(request $request ,$id){
      
        
        if($request->test_kit0 != null){
            $test_kit = [];

            for($n = 0; $n < $request->quantity; $n++)
            {
                $test_kit[] = $request->{'test_kit'.$n};
               
            
            }
              // encode the testkit in json format
             $test_kit = json_encode($test_kit);

        }
       
        
      
     
        $voucherCount = VoucherCount::where(['product_id'=> $id, 'agent' => auth()->user()->id])->first();
    
        $email = $request->email;
        $quantity = $request->quantity;

        $voucher =  uniqid('voucher_') ."_". $voucherCount->id;
       
       
        try {
            DB::beginTransaction();
        if($request->test_kit0 != null){

            $v_generate = VoucherGenerate::create([
                'agent' => auth()->user()->id,
                'voucher_count_id' => $voucherCount->id,
                'email' => $email,
                'voucher' => $voucher,
                'quantity' => $quantity,
                'status' => 0,
                'test_kit'=> $test_kit
            ]);

        }else{

            $v_generate = VoucherGenerate::create([
                'agent' => auth()->user()->id,
                'voucher_count_id' => $voucherCount->id,
                'email' => $email,
                'voucher' => $voucher,
                'quantity' =>$quantity,
                'status' => 0  
            ]);
        }
        
            $new_v_quantity =  $voucherCount->quantity -  $quantity; 

            $voucherCount->update([
                'quantity' => $new_v_quantity
            ]);

            $message2 = "
            Hi,<br><br> You have been sent a voucher code.<br><br> Voucher code :-$voucher for ".optional(optional(optional($v_generate)->voucherCount)->product)->name." x  $v_generate->quantity.<br/><br/>
            Kindly click the button below to booking with this voucher.<br/><br/>
                        <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/") . "booking/voucher/" . $voucher . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                        Book with voucher
                       </a>
                <br/><br/>
                Thank you.
                <br/><br/>
                 Traveltestsltd Team
            ";

           
            Mail::to($email)->send(new BookingCreation($message2, "Voucher notification"));
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
        
            session()->flash('alert-danger', "Something went wrong");
            return back();
        }


        session()->flash('alert-success', "Successfully created a voucher and sent via email");
        return back();

    }

    public function voucher_transactions()
    {
        $paid_n = 0;
        $unpaid_n = 0;
        $paid_d = 0;
        $unpaid_d = 0;
        if(auth()->user()->type == 1){

            $vouchers = VoucherPayment::wherenotNull('transaction_ref')->orderby('id', 'desc')->get();
            $voucherboughts = VoucherPayment::whereNull('transaction_ref')->orderby('id', 'desc')->get();
            $products = Product::all();

            $voucherpaid = VoucherPayment::where('status', 1)->orderBy('id', 'desc')->get();
            $voucherunpaid = VoucherPayment::where('status', 0)->orderBy('id', 'desc')->get();

            $voucherpaid_n = VoucherPayment::where(['status'=> 1, 'currency' => 'NG'])->orderBy('id', 'desc')->get();
            $voucherpaid_d = VoucherPayment::where('status', 1)->where('currency', '!=', 'NG')->orderBy('id', 'desc')->get();
            $voucherunpaid_n = VoucherPayment::where(['status'=> 0, 'currency' => 'NG'])->orderBy('id', 'desc')->get();
            $voucherunpaid_d = VoucherPayment::where('status', 0)->where('currency','!=','NG')->orderBy('id', 'desc')->get();

            $voucher_all = VoucherPayment::all();

            foreach($voucherpaid_n as $vpay)
            {
              
                if($vpay->transaction_ref !=null)
                {
                    $paid_n = $paid_n + $vpay->charged_amount;
                }else{
                    $paid_n = $paid_n + ($vpay->charged_amount * $vpay->quantity );
                } 
            }

        
            
            foreach($voucherpaid_d as $vpay)
            {
              
                if($vpay->transaction_ref !=null)
                {
                    $paid_d = $paid_d + $vpay->charged_amount;
                }else{
                    $paid_d = $paid_d + ($vpay->charged_amount * $vpay->quantity );
                } 
            }

            foreach($voucherunpaid_n as $upay)
            {
                if($upay->transaction_ref !=null)
                {
                    $unpaid_n = $unpaid_n + $upay->charged_amount;
                }else{
                    $unpaid_n = $unpaid_n + ($upay->charged_amount * $upay->quantity );
                } 
            }
            foreach($voucherunpaid_d as $upay)
            {
                if($upay->transaction_ref !=null)
                {
                    $unpaid_d = $unpaid_d + $upay->charged_amount;
                }else{
                    $unpaid_d = $unpaid_d + ($upay->charged_amount * $upay->quantity );
                } 
            }
               
        }else{
            $vouchers = VoucherPayment::wherenotNull('transaction_ref')->where([
                'agent' => auth()->user()->id
                ])->orderby('id', 'desc')->get();

            $voucherboughts = VoucherPayment::whereNull('transaction_ref')->where([
                'agent' => auth()->user()->id
                ])->orderby('id', 'desc')->get();

            $products = Product::all();
    
            $voucherpaid = VoucherPayment::where([
                'status'=> 1,
                'agent' => auth()->user()->id
                ])->orderBy('id', 'desc')->get();

            $voucherunpaid = VoucherPayment::where([
                'status'=> 0,
                'agent' => auth()->user()->id
                ])->orderBy('id', 'desc')->get();

            $voucherpaid_n = VoucherPayment::where([
                 'status'=> 1,
                 'currency' => 'NG',
                 'agent' => auth()->user()->id
                 ])->orderBy('id', 'desc')->get();

                $voucherpaid_d = VoucherPayment::where([
                    'status'=> 1,
                    'agent' => auth()->user()->id
                    ])->where('currency', '!=', 'NG')->orderBy('id', 'desc')->get();

                $voucherunpaid_n = VoucherPayment::where([
                    'status'=> 0,
                    'currency' => 'NG',
                    'agent' => auth()->user()->id
                    ])->orderBy('id', 'desc')->get();

                $voucherunpaid_d = VoucherPayment::where([
                    'status'=> 0,
                    'agent' => auth()->user()->id
                    ])->where('currency','!=','NG')->orderBy('id', 'desc')->get();
    
                $voucher_all = VoucherPayment::where([
                    'agent' => auth()->user()->id
                    ])->get();

                foreach($voucherpaid_n as $vpay)
                {
                  
                    if($vpay->transaction_ref !=null)
                    {
                        $paid_n = $paid_n + $vpay->charged_amount;
                    }else{
                        $paid_n = $paid_n + ($vpay->charged_amount * $vpay->quantity );
                    } 
                }
                foreach($voucherpaid_d as $vpay)
                {
                  
                    if($vpay->transaction_ref !=null)
                    {
                        $paid_d = $paid_d + $vpay->charged_amount;
                    }else{
                        $paid_d = $paid_d + ($vpay->charged_amount * $vpay->quantity );
                    } 
                }
    
                foreach($voucherunpaid_n as $upay)
                {
                    if($vpay->transaction_ref !=null)
                    {
                        $unpaid_n = $unpaid_n + $upay->charged_amount;
                    }else{
                        $unpaid_n = $unpaid_n + ($upay->charged_amount * $upay->quantity );
                    } 
                }
                foreach($voucherunpaid_d as $upay)
                {
                    if($vpay->transaction_ref !=null)
                    {
                        $unpaid_d = $unpaid_d + $upay->charged_amount;
                    }else{
                        $unpaid_d = $unpaid_d + ($upay->charged_amount * $upay->quantity );
                    } 
                }
        
        }

        return view('admin.voucher_transactions')->with(compact('vouchers','voucherboughts', 'products', 'voucherpaid', 'voucherunpaid', 'voucher_all', 'unpaid_n', 'paid_n', 'unpaid_d', 'paid_d'));
    }

    public function voucher_assigned_subagent(Request $request)
    {
        if ($request->start) {

            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $vouchers = VoucherPayment::where('assignee', auth()->user()->id)->wherebetween('created_at', [$start, $end])->orderby('id', 'desc')->get();
       
        }else{
             $vouchers = VoucherPayment::where('assignee', auth()->user()->id)->orderby('id', 'desc')->get();
        }

        return view('admin.subagent_assigned_vouchers')->with(compact('vouchers'));
    }

    public function admin_assign_voucher(Request $request, $id)
    {
        
        //get data from vendor products table
        $v_rate = VendorProduct::where([
                    'product_id' => $request->product_id,
                    'vendor_id' => 3
        ])->first(); 

       
        //get the user collection
        $user = User::where('id', $id)->first();

        if ($user->percentage_split != null) {
            $percentage = $user->percentage_split/100;
        } else {
            $defaultpercent = Setting::where('id', '2')->first();
            $percentage = $defaultpercent->value/100;
        }

        //get the users country to get the currency and charge rate
        if($user->country == 'NG'){
            $currency = "NG";
            $charged = $v_rate->price - ($v_rate->price * $percentage);
            $o_price = $v_rate->price;
        }else{

            if($user->country == null)
            {
                session()->flash('alert-danger', "Sorry but this transaction couldnt be completed because the agent has completed his profile details");
                return back();
            }
            $currency = "USD";
            $o_price = $v_rate->price_pounds;
            $charged = $v_rate->price_pounds - ($v_rate->price_pounds * $percentage);
        }

       
        //create the voucher payment transaction for record keeping
        $voucherpay= VoucherPayment::Create([
            'agent' => $id,
            'vendor_id' => 3,
            'product_id' => $request->product_id,
            'vendor_product_id' => $v_rate->id,
            'o_price' => $o_price,
            'vendors_cost'=> $v_rate->cost_price,
            'charged_amount' => $charged,
            'quantity' => $request->number,
            'currency' => $currency,
            'status' => 0
        ]);

        if ($user->percentage_split != null) {
            $percentage = $user->percentage_split/100;
        } else {
            $defaultpercent = Setting::where('id', '2')->first();
            $percentage = $defaultpercent->value/100;
        }
      
       

        if ($user->country == "NG") {
            $amount = $v_rate->price * $request->number;
            $amount = ($amount * $percentage);

        } else {
            $amount = $v_rate->price_pounds * $request->number;
            $amount = ($amount * $percentage);
        }

        //check if this user already has wallet for this product
        $count_check = VoucherCount::where(['agent' => $id, 'product_id' => $request->product_id])->first();

        //if user has a wallet , update else create a wallet to store 
        if($count_check == null)
        {
              VoucherCount::create([
                 'agent' => $id,
                 'product_id' => $request->product_id,
                 'quantity' => $request->number
                 
             ]);

        }else{

             $voucher_quantity = $count_check->quantity + $request->number;

             $count_check->update([
                 'quantity' => $voucher_quantity
             ]);

        }

        try {
            DB::beginTransaction();

            $userService = new UserShare;
            $user = User::where('id', $voucherpay->agent)->first();
            $agent_share = $userService->myShare($user);
            $share_data = $userService->calculateMainAgentShare($user->main_agent_share_raw, $agent_share);

            $agent_percentage = $share_data["sub_agent_share"];

            $cost_booking = $voucherpay->charged_amount;


            if ($voucherpay->currency != null) {

                //for international transaction in pounds
               
                $agent_amount_credit = $amount;


                VoucherDiscountProcess::processTransaction(
                    $user->id,
                    $voucherpay->id,
                    $agent_amount_credit,
                    $cost_booking,
                    $agent_percentage
                );

                if (!empty($superAgent = $user->superAgent)) {
                    $super_agent_percentage = $share_data["main_agent_share_percent"];
                    $super_agent_amount_credit = $cost_booking + ($cost_booking * ($super_agent_percentage / 100));

                    VoucherDiscountProcess::processTransaction(
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
            DB::rollBack();
            logger("An error occured while saving discount", $e);
           
        }
        // dd($request->product_id,$request->number, $id, $v_rate, $currency, $charged, $voucherpay, $count_check);
        session()->flash('alert-success', "Transaction successful, $request->number voucher has been added to $user->first_name's account");
               
        return back();

    }

    public function agent_assign_voucher(Request $request, $id)
    {
       
        
        //get data from vendor products table
        $v_rate = VendorProduct::where([
                    'product_id' => $id,
                    'vendor_id' => 3
        ])->first(); 

       
        //get the user collection
        $user = User::where('id', $request->agent)->first();

        //get the users country to get the currency and charge rate
       
        if ($user->percentage_split != null) {
            $percentage = $user->percentage_split/100;
        } else {
            $defaultpercent = Setting::where('id', '2')->first();
            $percentage = $defaultpercent->value/100;
        }

        //get the users country to get the currency and charge rate
        if($user->country == 'NG'){
            $currency = "NG";
            $charged = $v_rate->price - ($v_rate->price * $percentage);
            $o_price = $v_rate->price;
        }else{

            if($user->country == null)
            {
                session()->flash('alert-danger', "Sorry but this transaction couldnt be completed because the agent has completed his profile details");
                return back();
            }
            $currency = "USD";
            $o_price = $v_rate->price_pounds;
            $charged = $v_rate->price_pounds - ($v_rate->price_pounds * $percentage);
        }

       
       try{
             DB::beginTransaction();
            //create the voucher payment transaction for record keeping
            $voucherpay= VoucherPayment::Create([
                'agent' => $request->agent,
                'assignee' => auth()->user()->id,
                'vendor_id' => 3,
                'product_id' => $id,
                'vendor_product_id' => $v_rate->id,
                'vendors_cost' => $v_rate->cost_price,
                'o_price' => $o_price,
                'charged_amount' => $charged,
                'quantity' => $request->quantity,
                'currency' => $currency,
                'status' => 1
            ]);

            //check if this user already has wallet for this product
            $count_check = VoucherCount::where(['agent' => $request->agent, 'product_id' => $id])->first();

            //if user has a wallet , update else create a wallet to store 
            if($count_check == null)
            {
                VoucherCount::create([
                    'agent' => $request->agent,
                    'product_id' => $id,
                    'quantity' => $request->quantity
                    
                ]);

            }else{

                $voucher_quantity = $count_check->quantity + $request->number;

                $count_check->update([
                    'quantity' => $voucher_quantity
                ]);

            }

            //deduct amount from super agent account
            $super_voucher = VoucherCount::where(['agent' => auth()->user()->id, 'product_id' => $id])->first();
            $super_agent_quantity = $super_voucher->quantity -  $request->quantity;

            VoucherCount::where(['agent' => auth()->user()->id, 'product_id' => $id])
            ->update([
                'quantity' => $super_agent_quantity
            ]);

            DB::commit();
            // dd($request->product_id,$request->number, $id, $v_rate, $currency, $charged, $voucherpay, $count_check);
            session()->flash('alert-success', "Transaction successful, $request->quantity vouchers has been added to $user->first_name's account");
                
           
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            session()->flash('alert-danger', "Something went wrong. Please reach out to Admin.");
                
        }

        return back();

    }

    public function mark_paid_voucher($id)
    {
        $voucherpay= VoucherPayment::where('id', $id)->update([
            'status' =>  1
        ]);

        session()->flash('alert-success', 'This transaction has been marked as paid');
        return back();
    }

    public function agent_process_price($product_id, $quantity)
    {
        $product = VendorProduct::findorfail($product_id);

            $amount = $product->price_pounds * $quantity;
            $price = "$ " . number_format($amount, 2);
        

        return response()->json([

            "item_total" => $price,

        ]);

    }

    function imitate_account($id)
    {
        auth()->loginUsingId($id);
        return redirect()->to('/dashboard');
    }

    function profile_view()
    {
        $id = Auth()->user()->id;
        $users = User::where('id', $id)->first();

        $country = Country::where('iso', $users->country)->first()->nicename;

        return view('admin.profile')->with(compact('users', 'country'));
    }

    function edit_profile_view()
    {
        $id = Auth()->user()->id;
        $users = User::where('id', $id)->first();
        $countries = Country::all();
        return view('admin.edit_profile')->with(compact('users', 'countries'));
    }

    function edit_profile(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'company' => 'required',
            'platform_name' => 'required',
            'director' => 'required',
            'file' => 'file|mimes:csv,txt,xlx,xls,pdf,docx|max:2048',
            'certified' => 'required',

        ]);

        $request_data = $request->all();

        $id = Auth()->user()->id;
        $user = User::where('id', $id)->first();

        // $request_data['password'] = Hash::make($request_data['password']);

        if ($request->file) {

            $certificate = time() . '.' . $request->file->extension();

            $request->file->move(public_path('img/certificate'), $certificate);

            $request_data['c_o_i'] = "/img/certificate/" . $certificate;

            $certificate_path = $user->c_o_i;

            if ($certificate_path != null) {

                unlink($_SERVER['DOCUMENT_ROOT'] . $certificate_path);
            }

        }

        $user->update($request_data);

        session()->flash('alert-success', "Successfully updated your profile");

        return back();
        // return view('admin.profile')->with(compact('users'));
    }

    public function view_individual_booking()
    {
        $bookings = Booking::whereNull('referral_code')->orderby('id', 'desc')->get();
        $users = User::count();
        $refs = User::wherenotNull('referal_code')->get();

        return view('admin.individual_booking')->with(compact('users', 'refs', 'bookings'));
    }

    public function view_agent_booking()
    {
        $bookings = Booking::wherenotNull('referral_code')->orderby('id', 'desc')->get();
        $users = User::count();
        // get agent with referral code
        $refs = User::wherenotNull('referal_code')->get();

        return view('admin.agent_booking')->with(compact('users', 'refs', 'bookings'));
    }

    public function view_transactions(Request $request)
    {
        $code = 0;
        if (auth()->user()->type == 2 && auth()->user()->id == 55) {
            
            if($request->code != null){
                if($request->code != 6780)
                {
                    session()->flash('alert-danger', "Please this is a wrong access code");
                    return back();
                }else{
                    $code = $request->code;
                }
            }
           
        }elseif (auth()->user()->type == 2 && auth()->user()->main_agent_id == 70) {
            
            if($request->code != null){
                if($request->code != 9009)
                {
                    session()->flash('alert-danger', "Please this is a wrong access code");
                    return back();
                }else{
                    $code = $request->code;
                }
            }
           
        }


        if (auth()->user()->type == 1) {

            //money from bookings
            $booking_trans = Transaction::orderBy('id', 'desc')->where([
                'type' => 1
            ])->get();

            //money from paid commision
            $paid_trans = Transaction::orderBy('id', 'desc')->where([
                'type' => 2
            ])->get();

            //money from Pound bookings
            $booking_trans_p = PoundTransaction::orderBy('id', 'desc')->where([
                'type' => 1
            ])->get();

            //money from pounds paid commision
            $paid_trans_p = PoundTransaction::orderBy('id', 'desc')->where([
                'type' => 2
            ])->get();

            $earned = Transaction::where([
                'type' => 2
            ])->sum('amount');

            $earnedPounds = PoundTransaction::where([
                'type' => 2
            ])->sum('amount');

            $gained = Transaction::where([
                'type' => 1
            ])->sum('amount');

            $gainedPounds = PoundTransaction::where([
                'type' => 1
            ])->sum('amount');

        } elseif (auth()->user()->type == 2) {

            $id = auth()->user()->id;

            $earned = Transaction::where([
                'user_id' => $id,
                'type' => 2
            ])->sum('amount');

            $earnedPounds = PoundTransaction::where([
                'user_id' => $id,
                'type' => 2
            ])->sum('amount');

            $gained = Transaction::where([
                'user_id' => $id,
                'type' => 1
            ])->sum('amount');

            $gainedPounds = PoundTransaction::where([
                'user_id' => $id,
                'type' => 1
            ])->sum('amount');


            //money from bookings
            $booking_trans = Transaction::orderBy('id', 'desc')->where([
                'user_id' => $id,
                'type' => 1
            ])->get();

            //money from paid commision
            $paid_trans = Transaction::orderBy('id', 'desc')->where([
                'user_id' => $id,
                'type' => 2
            ])->get();

            //money from pounds bookings
            $booking_trans_p = PoundTransaction::orderBy('id', 'desc')->where([
                'user_id' => $id,
                'type' => 1
            ])->get();

            //money from pounds paid commision
            $paid_trans_p = PoundTransaction::orderBy('id', 'desc')->where([
                'user_id' => $id,
                'type' => 2
            ])->get();

        }


        return view('admin.view_transactions')->with(compact('booking_trans', 'paid_trans', 'booking_trans_p', 'paid_trans_p', 'earned', 'earnedPounds','gained', 'gainedPounds', 'code'));
    }

    public function view_subagent_transactions(Request $request,$id)
    {
        if ($request->start) {
            
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $earned = Transaction::where([
                'user_id' => $id,
                'type' => 1
            ])->wherebetween('created_at', [$start, $end])->sum('amount');

            $earnedPounds = PoundTransaction::where([
                'user_id' => $id,
                'type' => 1
            ])->wherebetween('created_at', [$start, $end])->sum('amount');


            //money from bookings
            $booking_trans = Transaction::orderBy('id', 'desc')->where([
                'user_id' => $id,
                'type' => 1
            ])->wherebetween('created_at', [$start, $end])->get();

           
            //money from pounds bookings
            $booking_trans_p = PoundTransaction::orderBy('id', 'desc')->where([
                'user_id' => $id,
                'type' => 1
            ])->wherebetween('created_at', [$start, $end])->get();

            
        }else{  

                $earned = Transaction::where([
                    'user_id' => $id,
                    'type' => 1
                ])->sum('amount');

                $earnedPounds = PoundTransaction::where([
                    'user_id' => $id,
                    'type' => 1
                ])->sum('amount');


                //money from bookings
                $booking_trans = Transaction::orderBy('id', 'desc')->where([
                    'user_id' => $id,
                    'type' => 1
                ])->get();

               
                //money from pounds bookings
                $booking_trans_p = PoundTransaction::orderBy('id', 'desc')->where([
                    'user_id' => $id,
                    'type' => 1
                ])->get();

        
        }
        $user = User::where('id', $id)->first();

        if ($request->export) {
            
            $fileName = 'subagents_transaction_reports.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Commission', 'Booking Amount', 'Date');
            $columnEarning = array('Earned Naira', 'Earned Pounds');

            $callback = function () use ( $columns, $columnEarning, $booking_trans, $booking_trans_p, $earned, $earnedPounds) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                if($booking_trans->count() > 0){
                    foreach ($booking_trans as $trans) {

                        $row['Name'] = optional(optional($trans)->user)->first_name  . " " .optional(optional($trans)->user)->last_name;
                        $row['Commission'] = 'N'. number_format($trans->amount, 5) ;
                        $row['Booking Amount'] ='N'. number_format($trans->cost_config,5);
                        $row['Date'] = $trans->created_at;
                        


                        fputcsv($file, array($row['Name'], $row['Commission'], $row['Booking Amount'], $row['Date']));

                    }
                }
                fputcsv($file, array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '));

                
                if($booking_trans_p->count() > 0){
                    fputcsv($file, $column);
                    foreach ($booking_trans_p as $trans) {

                        $row['Name'] = optional(optional($trans)->user)->first_name  . " " .optional(optional($trans)->user)->last_name;
                        $row['Commission'] = '#'. number_format($trans->amount,5) ;
                        $row['Booking Amount'] ='#'. number_format($trans->cost_config,5);
                        $row['Date'] = $trans->created_at;
                        


                        fputcsv($file, array($row['Name'], $row['Commission'], $row['Booking Amount'], $row['Date']));

                    }
                }

                fputcsv($file, array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '));
                fputcsv($file, $columnEarning);
                $row['Naira'] = 'N' . number_format($earned, 5);
                $row['Pound'] = '# ' . number_format($earnedPounds, 5);

                fputcsv($file, array($row['Naira'], $row['Pound']));
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return view('admin.view_subagent_transactions')->with(compact('booking_trans', 'booking_trans_p', 'earned', 'earnedPounds', 'user'));
    }

    public function update_country(Request $request)
    {

        $id = auth()->user()->id;

        User::where('id', $id)->update(['country' => $request->country]);

        session()->flash('alert-success', "Successfully updated your country of residence");

        return back();
    }

    public function view_currency_report($currency, $startDate, $endDate)
    {


        if ($startDate != 1) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            //if a date range exist
            if ($currency == "naira") {
                $transact = Transaction::orderBy('id', 'desc')->where('type', '1')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "pounds") {
                $transact = PoundTransaction::orderBy('id', 'desc')->where('type', '1')->wherebetween('created_at', [$start, $end])->get();
            }
        } else {

            //if no date range exist
            if ($currency == "naira") {
                $transact = Transaction::orderBy('id', 'desc')->where('type', '1')->get();
            } elseif ($currency == "pounds") {
                $transact = PoundTransaction::orderBy('id', 'desc')->where('type', '1')->get();
            }
        }


        return view('admin.currency_report')->with(compact('transact', 'currency', 'startDate', 'endDate'));

    }

    public function view_profit_report($currency, $startDate, $endDate)
    {


        if ($startDate != 1) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            //if a date range exist
            if ($currency == "naira") {
                $transact = Transaction::orderBy('id', 'desc')->where('type', '1')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "dollars") {
                $transact = PoundTransaction::orderBy('id', 'desc')->where('type', '1')->wherebetween('created_at', [$start, $end])->get();
            }
        } else {

            //if no date range exist
            if ($currency == "naira") {
                $transact = Transaction::orderBy('id', 'desc')->where('type', '1')->get();
            } elseif ($currency == "dollars") {
                $transact = PoundTransaction::orderBy('id', 'desc')->where('type', '1')->get();
            }
        }


        return view('admin.profit_report')->with(compact('transact', 'currency', 'startDate', 'endDate'));

    }

    public function currency_export($currency, $startDate, $endDate)
    {

        if ($startDate != 1) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            //if a date range exist
            if ($currency == "naira") {
                $transact = BookingProduct::where('currency', 'NGN')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "pounds") {
                $transact = BookingProduct::where('currency', 'USD')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "cedis") {
                $transact = BookingProduct::where('currency', 'GHS')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "tzs") {
                $transact = BookingProduct::where('currency', 'TZS')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "kes") {
                $transact = BookingProduct::where('currency', 'KES')->wherebetween('created_at', [$start, $end])->get();
            } elseif ($currency == "zar") {
                $transact = BookingProduct::where('currency', 'ZAR')->wherebetween('created_at', [$start, $end])->get();
            }
        } else {

            //if no date range exist
            if ($currency == "naira") {
                $transact = BookingProduct::where('currency', 'NGN')->get();
            } elseif ($currency == "pounds") {
                $transact = BookingProduct::where('currency', 'USD')->get();
            } elseif ($currency == "cedis") {
                $transact = BookingProduct::where('currency', 'GHS')->get();
            } elseif ($currency == "tzs") {
                $transact = BookingProduct::where('currency', 'TZS')->get();
            } elseif ($currency == "kes") {
                $transact = BookingProduct::where('currency', 'KES')->get();
            } elseif ($currency == "zar") {
                $transact = BookingProduct::where('currency', 'ZAR')->get();
            }
        }

        $fileName = 'currency_tarnsactions.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Name', 'Product', 'Vendor', 'Amount', 'Date');


        $callback = function () use ($transact, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);


            foreach ($transact as $transact) {
                if ($transact->currency == 'NGN') {
                    $amount = 'N' . number_format($transact->charged_amount, 5);
                } elseif ($transact->currency == 'USD') {
                    $amount = '$' . number_format($transact->charged_amount, 5);
                } elseif ($transact->currency = 'GHS') {
                    $amount = 'GHS' . number_format($transact->charged_amount, 5);
                } elseif ($transact->currency = 'TZS') {
                    $amount = 'TZS' . number_format($transact->charged_amount, 5);
                } elseif ($transact->currency = 'KES') {
                    $amount = 'KES' . number_format($transact->charged_amount, 5);
                } elseif ($transact->currency = 'ZAR') {
                    $amount = 'ZAR' . number_format($transact->charged_amount, 5);
                }

                $row['Name'] = $transact->booking->first_name . " " . $transact->booking->last_name;
                $row['Product'] = $transact->product->name;
                $row['Vendor'] = $transact->vendor->name;
                $row['Amount'] = $amount;
                $row['Date'] = $transact->created_at;
                // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                // ."Account Name:". $user->account_name;


                fputcsv($file, array($row['Name'], $row['Product'], $row['Vendor'], $row['Amount'], $row['Date']));

            }

        };

        return response()->stream($callback, 200, $headers);

        return back();

    }

    public function admin_export()
    {
        $users = User::where('type', 1)->get();

        $fileName = 'admin_list.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Name', 'Phone', 'Email', 'User type', 'status');


        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);


            foreach ($users as $user) {
                if ($user->status == 1) {
                    $stat = "Active";

                } else {
                    $stat = "Not Active";
                }

                $row['Name'] = $user->first_name . " " . $user->last_name;
                $row['Phone'] = $user->phone;
                $row['Email'] = $user->email;
                $row['User type'] = 'Admin';
                $row['status'] = $stat;
                // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                // ."Account Name:". $user->account_name;


                fputcsv($file, array($row['Name'], $row['Phone'], $row['Email'], $row['User type'], $row['status']));

            }

        };

        return response()->stream($callback, 200, $headers);

        return back();
    }

    public function Agent_active_export()
    {
        $users = User::where(['type' => 2, 'status' => 1])->get();
        $setting = Setting::where('id', 2)->first();
        $fileName = 'active_agent_list.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Name', 'Phone', 'Email', 'Pending booking', 'Completed booking', 'User type', 'Status', 'Percentage', 'Referral Code');


        $callback = function () use ($users, $columns, $setting) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);


            foreach ($users as $user) {
                if ($user->percentage_split == null) {
                    $percent = $setting->value . '%';
                } else {
                    $percent = $user->percentage_split . '%';
                }

                $row['Name'] = $user->first_name . " " . $user->last_name;
                $row['Phone'] = $user->phone;
                $row['Email'] = $user->email;
                $row['Pending_booking'] = $user->pbookings->count();
                $row['Completed booking'] = $user->cbookings->count();
                $row['User type'] = 'Agent';
                $row['status'] = 'Active';
                $row['Percentage'] = $percent;
                $row['Referral Code'] = $user->referal_code;
                // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                // ."Account Name:". $user->account_name;


                fputcsv($file, array($row['Name'], $row['Phone'], $row['Email'], $row['Pending_booking'], $row['Completed booking'], $row['User type'], $row['status'], $row['Percentage'], $row['Referral Code']));

            }

        };

        return response()->stream($callback, 200, $headers);

        return back();
    }

    public function Agent_inactive_export()
    {
        $users = User::where(['type' => 2, 'status' => 1])->get();
        $setting = Setting::where('id', 2)->first();
        $fileName = 'Inactive_agents_list.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Name', 'Phone', 'Email', 'Pending booking', 'Completed booking', 'User type', 'Status', 'Percentage', 'Referral Code');


        $callback = function () use ($users, $columns, $setting) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);


            foreach ($users as $user) {
                if ($user->percentage_split == null) {
                    $percent = $setting->value . '%';
                } else {
                    $percent = $user->percentage_split . '%';
                }

                $row['Name'] = $user->first_name . " " . $user->last_name;
                $row['Phone'] = $user->phone;
                $row['Email'] = $user->email;
                $row['Pending_booking'] = $user->pbookings->count();
                $row['Completed booking'] = $user->cbookings->count();
                $row['User type'] = 'Agent';
                $row['status'] = 'Not Active';
                $row['Percentage'] = $percent;
                $row['Referral Code'] = $user->referal_code;
                // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                // ."Account Name:". $user->account_name;


                fputcsv($file, array($row['Name'], $row['Phone'], $row['Email'], $row['Pending_booking'], $row['Completed booking'], $row['User type'], $row['status'], $row['Percentage'], $row['Referral Code']));

            }

        };

        return response()->stream($callback, 200, $headers);

        return back();
    }

    public function details($id)
    {
            // if (auth()->user()->type != 1) {
            
            //     abort(404);
            // }
            
        $user = User::where('id', $id)->first();

        $builder = User::where("main_agent_id", $id)->orderby("created_at", "desc");
        $agents = $builder->paginate(20);

        $earned = Transaction::where([
            'user_id' => $user->id,
            'type' => 2
        ])->sum('amount');

        $earnedPounds = PoundTransaction::where([
            'user_id' => $user->id,
            'type' => 2
        ])->sum('amount');
// dd($user, $earned, $earnedPounds);

        return view('admin.details')->with(compact('user', 'agents', 'earnedPounds', 'earned'));
    }

    public function assign_subagent(Request $request, $id){

        
        
        if ($request->my_share > 99 || $request->my_share < 0) {
            session()->flash('alert-danger', "Super agent share cannot be greater than 99 % or less than 1%");
            return back()->withInput();
        }

        $check = User::where('main_agent_id', $request->agent)->first();

        if(!$check)
        {
            session()->flash('alert-danger', "This agent already has subagents, He/She cant be added under you as a subagent.");
            return back()->withInput();
        }
        
        User::where('id', $request->agent)->update([
            'main_agent_id'=> $id,
            'main_agent_share_raw' => $request->my_share
        ]);

        session()->flash('alert-success', "Successfully assigned a sub agent");
        return back();
    }

    public function view_guidelines($stepper)
    {

        return view('admin.guidelines')->with(compact('stepper'));
    }

}
