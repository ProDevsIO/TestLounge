<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingProduct;
use App\Models\PaymentCode;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

        if (auth()->user()->type == 1) {
            $bookings = Booking::orderby('id', 'desc')->get();
            $pending_booking = Booking::where('status', 0)->count();
            $complete_booking = Booking::where('status', 1)->count();
            $users = User::count();
            $payment_codes = PaymentCode::count();
        } elseif (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = Booking::whereIn('id', $bookings_vendors)->orderby('id', 'desc')->get();
            $pending_booking = Booking::whereIn('id', $bookings_vendors)->where('status', 0)->count();
            $complete_booking = Booking::whereIn('id', $bookings_vendors)->where('status', 1)->count();
            $users = 0;
            $payment_codes = 0;

        } else {
            $bookings = Booking::where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc')->get();
            $pending_booking = Booking::where('status', 0)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->count();
            $complete_booking = Booking::where('status', 1)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->count();
            $users = 0;
            $payment_codes = 0;
        }

        return view('admin.dashboard')->with(compact('bookings', 'pending_booking', 'users', 'payment_codes', 'complete_booking'));
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
        return view('admin.pending_booking')->with(compact('bookings', 'products', 'vendors', 'users'));
    }

    public function complete_booking(Request $request)
    {
        if (auth()->user()->type == "1") {
            $bookings = Booking::where('status', 1)->orderby('id', 'desc');
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

        return view('admin.complete_booking')->with(compact('bookings', 'products', 'vendors', 'users'));
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

    public function users()
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }
        $users = User::orderby('created_at', 'desc')->get();
        $setting = Setting::where('id', 2)->first();

        return view('admin.users')->with(compact('users', 'setting'));
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

    public function product_vendor($id, $price)
    {
        VendorProduct::where('id', $id)->update([
            'price_pounds' => $price
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
            'account_no'
        ]);

        $banks = json_decode($request->bank_array);
        $banks_ = [];
        foreach ($banks as $bank){
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
        //return the colors to view
        return view('admin.colors')->with(compact('colors'));
    }

    public function edit_color(Request $request, $id)
    {

        $colors = Color::where([
            'name' => $request->name
        ])->get();

        if (count($colors) > 0) {
            session()->flash("alert-danger", "Color already exist");
            return back();
        } else {
            Color::where('id', $id)->update([
                'name' => $request->name
            ]);
            session()->flash("alert-success", "Color has been updated ");
            return back();
        }


    }

    public function add_color(Request $request)
    {
        Color::create([
            'name' => $request->name
        ]);
        session()->flash("alert-success", "New color added");
        return back();
    }


    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->to('/');
    }

    public function change_referral_code(Request $request ,$id){
        $this->validate($request,[
           'referal_code' => "required"
        ]);

        $user = User::where('referal_code',$request->referal_code)->where('id','!=',$id)->first();

        if($user){
            session()->flash("alert-info","Name already exist. Kindly use another name");
            return back();
        }

        User::where('id',$id)->update([
             'referal_code' => $request->referal_code
        ]);

        session()->flash('alert-success',"Referral code changed successfully");
        return back();
    }
}
