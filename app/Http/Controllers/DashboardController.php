<?php

namespace App\Http\Controllers;

use App\Helpers\BarcodeHelper;
use App\Mail\BookingCreation;
use App\Mail\VendorReceipt;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
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


        } elseif (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = Booking::whereIn('id', $bookings_vendors)->orderby('id', 'desc')->get();
            $pending_booking = Booking::whereIn('id', $bookings_vendors)->where('status', 0)->count();
            $complete_booking = Booking::whereIn('id', $bookings_vendors)->where('status', 1)->count();
            $users = 0;
            $payment_codes = 0;
            $refs = [];

        } else {
            $earned =  Transaction::where([
                'user_id'=> auth()->user()->id,
                'type' => 2
            ])->sum('amount');

            $earnedPounds =  PoundTransaction::where([
                'user_id'=> auth()->user()->id,
                'type' => 2
            ])->sum('amount');

            $bookings = Booking::where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc')->get();
            $pending_booking = Booking::where('status', 0)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->count();
            $complete_booking = Booking::where('status', 1)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->count();
            $users = 0;
            $payment_codes = 0;
            $refs = [];
        }
        $countries = Country::all();
        return view('admin.dashboard')->with(compact('bookings', 'pending_booking', 'users', 'payment_codes', 'complete_booking', 'refs', 'countries', 'earned', 'earnedPounds'));
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

            $columns = array('Name', 'Email', 'PhoneNo', 'Sex', 'DOB', 'Ethnicity', 'Vaccination Status', 'Products', 'Home Address', "Isolation Address", "Document Id", "Arrival Date", "Country From", "Departure Date", "Mode of Transportation", "Flight Number");

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

                    if ($booking->vaccination_status == "1") {
                        $row['Vaccination Status'] = "Has not been vaccinated";
                    } elseif ($booking->vaccination_status == "2") {
                        $row['Vaccination Status'] = "Has received the first dose, but not the second";
                    } elseif ($booking->vaccination_status == "3") {
                        $row['Vaccination Status'] = "Has received both first and second dose";
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
                                        Home PostCode: {$booking->post_code}\n
                                        Home Country: {$booking->homeCountry->name}\n";

                    $row['Isolation Address'] = "Address1: {$booking->isolation_address }\n
                                        Address2: {$booking->isolation_addres2}\n
                                        Home City: {$booking->isolation_town}\n
                                        Home PostCode: {$booking->isolation_postal_code }\n
                                        Home Country: {$booking->country->name}\n";

                    $row['Document Id'] = $booking->document_id;

                    $row['Arrival Date'] = $booking->arrival_date;

                    $row['Country From'] = $booking->travelingFrom->name;
                    $row['Departure Date'] = $booking->departure_date;
                    if ($booking->method_of_transportation == "1") {
                        $row['Mode of Transportation'] = "Airplane";
                    } elseif ($booking->method_of_transportation == "2") {
                        $row['Mode of Transportation'] = "Vessel";
                    } elseif ($booking->method_of_transportation == "3") {
                        $row['Mode of Transportation'] = "Train";
                    } elseif ($booking->method_of_transportation == "4") {
                        $row['Mode of Transportation'] = "Road Vehicle";
                    } elseif ($booking->method_of_transportation == "5") {
                        $row['Mode of Transportation'] = "Other";
                    }
                    $row['Flight Number'] = $booking->transport_no;

                    fputcsv($file, array($row['Name'], $row['Email'], $row['PhoneNo'], $row['Sex'], $row['DOB'], $row['Ethnicity'], $row['Vaccination Status'], $row['Products'], $row['Home Address'], $row['Isolation Address'], $row['Document Id'], $row['Arrival Date'], $row['Country From'], $row['Departure Date'], $row['Mode of Transportation'], $row['Flight Number']));
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
        if (auth()->user()->type == 1) {
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

            $columns = array('Name', 'Email', 'PhoneNo', 'Sex', 'DOB', 'Ethnicity', 'Vaccination Status', 'Products', 'Home Address', "Isolation Address", "Document Id", "Arrival Date", "Country From", "Departure Date", "Mode of Transportation", "Flight Number");

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

                    if ($booking->vaccination_status == "1") {
                        $row['Vaccination Status'] = "Has not been vaccinated";
                    } elseif ($booking->vaccination_status == "2") {
                        $row['Vaccination Status'] = "Has received the first dose, but not the second";
                    } elseif ($booking->vaccination_status == "3") {
                        $row['Vaccination Status'] = "Has received both first and second dose";
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
                                        Home PostCode: {$booking->post_code}\n
                                        Home Country: {$booking->homeCountry->name}\n";

                    $row['Isolation Address'] = "Address1: {$booking->isolation_address }\n
                                        Address2: {$booking->isolation_addres2}\n
                                        Home City: {$booking->isolation_town}\n
                                        Home PostCode: {$booking->isolation_postal_code }\n
                                        Home Country: {$booking->country->name}\n";

                    $row['Document Id'] = $booking->document_id;

                    $row['Arrival Date'] = $booking->arrival_date;

                    $row['Country From'] = $booking->travelingFrom->name;
                    $row['Departure Date'] = $booking->departure_date;
                    if ($booking->method_of_transportation == "1") {
                        $row['Mode of Transportation'] = "Airplane";
                    } elseif ($booking->method_of_transportation == "2") {
                        $row['Mode of Transportation'] = "Vessel";
                    } elseif ($booking->method_of_transportation == "3") {
                        $row['Mode of Transportation'] = "Train";
                    } elseif ($booking->method_of_transportation == "4") {
                        $row['Mode of Transportation'] = "Road Vehicle";
                    } elseif ($booking->method_of_transportation == "5") {
                        $row['Mode of Transportation'] = "Other";
                    }
                    $row['Flight Number'] = $booking->transport_no;

                    fputcsv($file, array($row['Name'], $row['Email'], $row['PhoneNo'], $row['Sex'], $row['DOB'], $row['Ethnicity'], $row['Vaccination Status'], $row['Products'], $row['Home Address'], $row['Isolation Address'], $row['Document Id'], $row['Arrival Date'], $row['Country From'], $row['Departure Date'], $row['Mode of Transportation'], $row['Flight Number']));
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

    public function vendors()
    {
        $vendors = Vendor::all();
        return view('admin.vendors')->with(compact('vendors'));
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
        User::where('id', $users_id)->delete();

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
        $setting = Setting::where('id', 2)->first();

        return view('admin.users')->with(compact('users', 'setting'));
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
        VendorProduct::where('id', $id)->update([
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


        if(Hash::check( $request->password, auth()->user()->password) == false)
        {
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
            'country' => "NG",
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
        $country_id_exclude = CountryColor::pluck('country_id')->toArray();;
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

        $code = str_replace(" ","_",$request->referal_code);
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
            if ($user->percentage_split != null) {
                $pecentage = $user->percentage_split;
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

            $total_ngn = BookingProduct::where('currency', 'NGN')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_gbp = BookingProduct::where('currency', 'GBP')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_ghs = BookingProduct::where('currency', 'GHS')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_tzs = BookingProduct::where('currency', 'TZS')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_kes = BookingProduct::where('currency', 'KES')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
            $total_zar = BookingProduct::where('currency', 'ZAR')->wherebetween('created_at', [$start, $end])->sum('charged_amount');
        } else {
            $start = 1;
            $end = 1;
            $total_ngn = BookingProduct::where('currency', 'NGN')->sum('charged_amount');
            $total_gbp = BookingProduct::where('currency', 'GBP')->sum('charged_amount');
            $total_ghs = BookingProduct::where('currency', 'GHS')->sum('charged_amount');
            $total_tzs = BookingProduct::where('currency', 'TZS')->sum('charged_amount');
            $total_kes = BookingProduct::where('currency', 'KES')->sum('charged_amount');
            $total_zar = BookingProduct::where('currency', 'ZAR')->sum('charged_amount');
        }

        $due_amount = User::sum("wallet_balance");

        $users = User::where('type', '!=', '1')->whereNotNull('wallet_balance')->orderby('wallet_balance', 'desc')->get();
// dd('₦'. number_format($total_ngn));
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
            $columnMoney = array('Total Revenue(Naira)', 'Total Revenue(Pound)', 'Total Revenue(cedis)', 'Total Revenue(TZS)', 'Total Revenue(KES)', 'Total Revenue(ZAR)' , 'Amount due(Referrals');

            $callback = function () use ($users, $columns, $columnMoney, $total_ngn, $total_gbp, $total_ghs, $total_tzs, $total_kes, $total_zar, $due_amount) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($users as $user) {

                    $row['Name'] = $user->first_name . " " . $user->last_name;
                    $row['Referral Code'] =  $user->referal_code.", ".$user->email.", ".$user->phone;
                    $row['Total C.booking'] = $user->cbookings->count() ;
                    $row['Wallet Balance'] = "N". number_format($user->wallet_balance,2);
                    $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                    ."Account Name:". $user->account_name;


                    fputcsv($file, array($row['Name'],  $row['Referral Code'] ,$row['Total C.booking'] , $row['Wallet Balance'] , $row['Account Details']));

                }
                fputcsv($file, array(' ',' ',' ',' ',' ',' ',' ',' '));

                fputcsv($file, $columnMoney);
                  $row['Naira'] = 'N'. number_format($total_ngn);
                  $row['Pound'] = '# '. number_format($total_gbp);
                  $row['cedis']= 'GH'. number_format($total_ghs);
                  $row['tzs'] = 'TZS '. number_format($total_tzs);
                  $row['kes'] = 'KES '. number_format($total_kes);
                  $row['zar'] = 'ZAR '. number_format($total_zar);
                  $row['due'] = 'N '. number_format($due_amount);


                fputcsv($file, array($row['Naira'],  $row['Pound'], $row['cedis'], $row['tzs'], $row['kes'], $row['zar'], $row['due']));
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }



        return view('admin.report')->with(compact('total_ngn', 'total_gbp', 'total_ghs', 'total_kes', 'due_amount', 'total_zar', 'total_tzs', 'users', 'start', 'end'));

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
                if($type == 1){
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
                }elseif($type == 2){

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
                        UKTravelsTeam
                    ";
                    Mail::to('kelvin@prodevs.io')->send(new BookingCreation($message2, "Payment Notification"));


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

        if($copied == 0){

             User::where('id', $id)->update(['copy_receipt' => 1]);

             session()->flash('alert-success', "Successfully activated this agent to be copied on emailing of receipt for bookings.");

             return back();

        }elseif($copied == 1){

            User::where('id', $id)->update(['copy_receipt' => 0]);

            session()->flash('alert-success', "Successfully deactivated this agent to be copied on emailing of receipt for bookings.");

            return back();

        }else{

            session()->flash('alert-danger', "Something went wrong is processing this request");

            return back();
        }

    }

    function imitate_account($id){
        auth()->loginUsingId($id);
        return redirect()->to('/dashboard');
    }

    function profile_view()
    {
        $id = Auth()->user()->id;
        $users = User::where('id', $id)->first();

        return view('admin.profile')->with(compact('users'));
    }

    function edit_profile_view()
    {
        $id = Auth()->user()->id;
        $users = User::where('id', $id)->first();

        return view('admin.edit_profile')->with(compact('users'));
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
        
        if($request->file)
        {

            $certificate =  time().'.'.$request->file->extension();

            $request->file->move(public_path('img/certificate'), $certificate);

            $request_data['c_o_i'] = "/img/certificate/". $certificate;

            $certificate_path = $user->c_o_i;

            if($certificate_path != null)
            {

               unlink($_SERVER['DOCUMENT_ROOT'].$certificate_path);
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

        return view('admin.individual_booking')->with(compact('users','refs','bookings'));
    }

    public function view_agent_booking()
    {
        $bookings = Booking::wherenotNull('referral_code')->orderby('id', 'desc')->get();
        $users = User::count();
        // get agent with referral code
        $refs = User::wherenotNull('referal_code')->get();

        return view('admin.agent_booking')->with(compact('users','refs','bookings'));
    }

    public function view_transactions()
    {
       

        if (auth()->user()->type == 1) {

            //money from bookings
            $booking_trans = Transaction::where([
                'type' => 1
            ])->get();

            //money from paid commision
            $paid_trans = Transaction::where([
                'type' => 2
            ])->get();

               //money from Pound bookings
            $booking_trans_p = PoundTransaction::where([
            'type' => 1
            ])->get();

            //money from pounds paid commision
             $paid_trans_p = PoundTransaction::where([
                'type' => 2
            ])->get();

            $earned =  Transaction::where([
                'type' => 2
            ])->sum('amount');

            $earnedPounds = PoundTransaction::where([
                'type' => 2
            ])->sum('amount');

        }elseif(auth()->user()->type == 2){

            $id = auth()->user()->id;

            $earned =  Transaction::where([
                'user_id'=> $id,
                'type' => 2
            ])->sum('amount');

            $earnedPounds =  PoundTransaction::where([
                'user_id'=> $id,
                'type' => 2
            ])->sum('amount');

            //money from bookings
            $booking_trans = Transaction::where([
                'user_id'=> $id,
                'type' => 1
            ])->get();

            //money from paid commision
            $paid_trans = Transaction::where([
                'user_id'=> $id,
                'type' => 2
            ])->get();

            //money from pounds bookings
            $booking_trans_p = PoundTransaction::where([
                'user_id'=> $id,
                'type' => 1
            ])->get();

            //money from pounds paid commision
            $paid_trans_p = PoundTransaction::where([
                'user_id'=> $id,
                'type' => 2
            ])->get();

        }

       
        return view('admin.view_transactions')->with(compact('booking_trans', 'paid_trans', 'booking_trans_p', 'paid_trans_p', 'earned', 'earnedPounds'));
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
        
     
        if($startDate != 1){
            $start = Carbon::parse($startDate)->startOfDay();
             $end = Carbon::parse($endDate)->endOfDay();
            //if a date range exist
            if($currency == "naira"){
                $transact = BookingProduct::where('currency', 'NGN')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "pounds"){
                $transact = BookingProduct::where('currency', 'GBP')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "cedis"){
                $transact = BookingProduct::where('currency', 'GHS')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "tzs"){
                $transact = BookingProduct::where('currency', 'TZS')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "kes"){
                $transact = BookingProduct::where('currency', 'KES')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "zar"){
                $transact = BookingProduct::where('currency', 'ZAR')->wherebetween('created_at', [$start, $end])->get();
            }
        }else{
         
            //if no date range exist
            if($currency == "naira"){
                $transact = BookingProduct::where('currency', 'NGN')->get();
            }elseif($currency == "pounds"){
                $transact = BookingProduct::where('currency', 'GBP')->get();
            }elseif($currency == "cedis"){
                $transact = BookingProduct::where('currency', 'GHS')->get();
            }elseif($currency == "tzs"){
                $transact = BookingProduct::where('currency', 'TZS')->get();
            }elseif($currency == "kes"){
                $transact = BookingProduct::where('currency', 'KES')->get();
            }elseif($currency == "zar"){
                $transact = BookingProduct::where('currency', 'ZAR')->get();
            }
        }
       

        return view('admin.currency_report')->with(compact('transact','currency', 'startDate', 'endDate'));

    }
   
    public function currency_export($currency, $startDate, $endDate)
    {

        if($startDate != 1){
            $start = Carbon::parse($startDate)->startOfDay();
             $end = Carbon::parse($endDate)->endOfDay();
            //if a date range exist
            if($currency == "naira"){
                $transact = BookingProduct::where('currency', 'NGN')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "pounds"){
                $transact = BookingProduct::where('currency', 'GBP')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "cedis"){
                $transact = BookingProduct::where('currency', 'GHS')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "tzs"){
                $transact = BookingProduct::where('currency', 'TZS')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "kes"){
                $transact = BookingProduct::where('currency', 'KES')->wherebetween('created_at', [$start, $end])->get();
            }elseif($currency == "zar"){
                $transact = BookingProduct::where('currency', 'ZAR')->wherebetween('created_at', [$start, $end])->get();
            }
        }else{
         
            //if no date range exist
            if($currency == "naira"){
                $transact = BookingProduct::where('currency', 'NGN')->get();
            }elseif($currency == "pounds"){
                $transact = BookingProduct::where('currency', 'GBP')->get();
            }elseif($currency == "cedis"){
                $transact = BookingProduct::where('currency', 'GHS')->get();
            }elseif($currency == "tzs"){
                $transact = BookingProduct::where('currency', 'TZS')->get();
            }elseif($currency == "kes"){
                $transact = BookingProduct::where('currency', 'KES')->get();
            }elseif($currency == "zar"){
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
                if($transact->currency == 'NGN'){
                    $amount = 'N' . number_format($transact->charged_amount,2);
                }elseif($transact->currency == 'GBP'){
                    $amount ='£'. number_format($transact->charged_amount,2);
                }elseif($transact->currency = 'GHS'){
                    $amount ='GHS' .number_format($transact->charged_amount,2);
                }elseif($transact->currency = 'TZS'){
                    $amount ='TZS' .number_format($transact->charged_amount,2);
                }elseif($transact->currency = 'KES'){
                    $amount ='KES'. number_format($transact->charged_amount,2);
                }elseif($transact->currency = 'ZAR'){
                    $amount ='ZAR'. number_format($transact->charged_amount,2);
                }

                $row['Name'] = $transact->booking->first_name . " " . $transact->booking->last_name;
                $row['Product'] =  $transact->product->name;
                $row['Vendor'] = $transact->vendor->name;
                $row['Amount'] = $amount;
                $row['Date'] = $transact->created_at ;
                // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                // ."Account Name:". $user->account_name;


                fputcsv($file, array($row['Name'],  $row['Product'] ,$row['Vendor'] , $row['Amount'] , $row['Date']));

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
                    if($user->status == 1){
                        $stat = "Active";
                        
                    }else{
                        $stat = "Not Active";
                    }

                    $row['Name'] = $user->first_name . " " . $user->last_name;
                    $row['Phone'] =  $user->phone;
                    $row['Email'] = $user->email ;
                    $row['User type'] = 'Admin';
                    $row['status'] = $stat ;
                    // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                    // ."Account Name:". $user->account_name;


                    fputcsv($file, array($row['Name'],  $row['Phone'] ,$row['Email'] , $row['User type'] , $row['status']));

                }
               
            };

            return response()->stream($callback, 200, $headers);

            return back();
    }

    public function Agent_active_export()
    {
        $users = User::where(['type'=> 2, 'status' => 1])->get();
        $setting = Setting::where('id', 2)->first();
            $fileName = 'active_agent_list.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Phone', 'Email', 'Pending booking','Completed booking','User type', 'Status', 'Percentage', 'Referral Code');


            $callback = function () use ($users, $columns, $setting) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($users as $user) {
                    if($user->percentage_split == null)
                    {
                        $percent = $setting->value.'%';
                    }else
                    {
                      $percent = $user->percentage_split .'%';
                    }

                    $row['Name'] = $user->first_name . " " . $user->last_name;
                    $row['Phone'] =  $user->phone;
                    $row['Email'] = $user->email ;
                    $row['Pending_booking'] =  $user->pbookings->count() ;
                    $row['Completed booking'] =  $user->cbookings->count();
                    $row['User type'] = 'Agent';
                    $row['status'] = 'Active';
                    $row['Percentage'] = $percent ;
                    $row[ 'Referral Code'] = $user->referal_code ;
                    // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                    // ."Account Name:". $user->account_name;


                    fputcsv($file, array($row['Name'],  $row['Phone'] ,$row['Email'] , $row['Pending_booking'] , $row['Completed booking'], $row['User type'] , $row['status'],  $row['Percentage'],  $row[ 'Referral Code']));

                }
               
            };

            return response()->stream($callback, 200, $headers);

            return back();
    }

    public function Agent_inactive_export()
    {
        $users = User::where(['type'=> 2, 'status' => 1])->get();
        $setting = Setting::where('id', 2)->first();
            $fileName = 'Inactive_agents_list.csv';

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Name', 'Phone', 'Email', 'Pending booking','Completed booking','User type', 'Status', 'Percentage', 'Referral Code');


            $callback = function () use ($users, $columns, $setting) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);


                foreach ($users as $user) {
                    if($user->percentage_split == null)
                    {
                        $percent = $setting->value.'%';
                    }else
                    {
                      $percent = $user->percentage_split .'%';
                    }

                    $row['Name'] = $user->first_name . " " . $user->last_name;
                    $row['Phone'] =  $user->phone;
                    $row['Email'] = $user->email ;
                    $row['Pending_booking'] =  $user->pbookings->count() ;
                    $row['Completed booking'] =  $user->cbookings->count();
                    $row['User type'] = 'Agent';
                    $row['status'] = 'Not Active';
                    $row['Percentage'] = $percent ;
                    $row[ 'Referral Code'] = $user->referal_code ;
                    // $row['Account Details'] =  "Country:" .$user->country. ", " ."Bank:" .$user->bank . "Account No:". $user->account_no .", "
                    // ."Account Name:". $user->account_name;


                    fputcsv($file, array($row['Name'],  $row['Phone'] ,$row['Email'] , $row['Pending_booking'] , $row['Completed booking'], $row['User type'] , $row['status'],  $row['Percentage'],  $row[ 'Referral Code']));

                }
               
            };

            return response()->stream($callback, 200, $headers);

            return back();
    }
}
