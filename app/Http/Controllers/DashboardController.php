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
        }else {
            $bookings = Booking::where('status', 0)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc');

        }

        if (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = $bookings->whereIn('id', $bookings_vendors);
        }

        if (auth()->user()->type == 1) {
            if ($request->vendor_id) {
                $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
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

        }else {
            $bookings = Booking::where('status', 1)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc');
        }

        if (auth()->user()->vendor_id != 0) {
            $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
            $bookings = $bookings->whereIn('id', $bookings_vendors);
        }

        if (auth()->user()->type == 1) {
            if ($request->vendor_id) {
                $bookings_vendors = BookingProduct::where('vendor_id', auth()->user()->vendor_id)->pluck('booking_id')->toArray();
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
        return view('admin.complete_booking')->with(compact('bookings', 'products', 'vendors', 'users'));
    }

    public function view_booking($id)
    {
        if (auth()->user()->type != 1){
            if(!auth()->user()->vendor_id) {
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
        return view('admin.view_booking')->with(compact('booking'));
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

    public function users()
    {
        if (auth()->user()->type == 0) {
            abort(403);
        }
        $users = User::get();

        return view('admin.users')->with(compact('users'));
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
            'percentage' => 'required'
        ]);

        Setting::where('id', "1")->update([
            'value' => $request->amount
        ]);

        Setting::where('id', "1")->update([
            'value' => $request->percentage
        ]);
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
            'price' => $price
        ]);

        return "success";
    }

    public function user_bank()
    {
        $banks = $this->bank();

        usort($banks, function ($a, $b) {
            return $b->name < $a->name;
        });

        return view('admin.user_bank')->with(compact('banks'));
    }

    function bank()
    {
        $ch = curl_init();
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . env('RAVE_SECRET_KEY', "FLWSECK_TEST-516babb36b12f7f60ae0a118dcc9482a-X");
        curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/banks/NG");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $server_output = json_decode($server_output);

        return $server_output->data;
    }

    public function add_bank(Request $request)
    {
        $this->validate($request, [
            'account_bank',
            'account_no'
        ]);
        $data_save = [
            'account_bank' => $request->account_bank,
            'account_no' => $request->account_no,
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
            "split_value" => (auth()->user()->percentage_split) ? (100 - auth()->user()->percentage_split)/100 : (100 - $settings->value)/100
        ];

        if (!auth()->user()->flutterwave_key) {
            $data = $this->addFlutterwave($flutterwave_data);

            if(!$data->data){
                session()->flash("alert-danger", $data->message);
                return back();

            }

            $data_save['flutterwave_key'] = $data->data->subaccount_id;
        }

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

    public function editFlutterwave()
    {

    }

    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->to('/');
    }
}
