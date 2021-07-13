<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PaymentCode;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vendor;
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
        } else {
            $bookings = Booking::where('status', 0)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc');

        }

        if ($request->start) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $bookings = $bookings->wherebetween('created_at', [$start, $end]);
        }

        $bookings = $bookings->get();

        return view('admin.pending_booking')->with(compact('bookings'));
    }

    public function complete_booking(Request $request)
    {
        if (auth()->user()->type == "1") {
            $bookings = Booking::where('status', 1)->orderby('id', 'desc');
        } else {
            $bookings = Booking::where('status', 1)->where('referral_code', auth()->user()->referal_code)->where('user_id', auth()->user()->id)->orderby('id', 'desc');

        }
        if (auth()->user()->type == 1) {
            if ($request->vendor_id) {
                $bookings = $bookings->where('vendor_id', $request->vendor_id);
            }

            if ($request->user_id) {

                $bookings = $bookings->where('user_id', $request->user_id);
            }
        }


        if ($request->start) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $bookings = $bookings->wherebetween('created_at', [$start, $end]);
        }


        $bookings = $bookings->get();

        $vendors = Vendor::all();
        $users = User::where('type',"!=",'1')->get();
        return view('admin.complete_booking')->with(compact('bookings', 'vendors','users'));
    }

    public function view_booking($id)
    {
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

    public function admin_make($id){
        if (auth()->user()->type == 0) {
            abort(403);
        }

        User::where('id',$id)->update([
            'type' => 1
        ]);

        session()->flash('alert-success',"User has been switched to an admin");
        return back();

    }

    public function agent_make($id){
        if (auth()->user()->type == 0) {
            abort(403);
        }

        User::where('id',$id)->update([
            'type' => 0
        ]);

        session()->flash('alert-success',"User has been switched to an Agent");
        return back();

    }

    public function settings(){
        $percentage = Setting::where('id',2)->first();
        $amount = Setting::where('id',1)->first();

        return view('admin.settings')->with(compact('amount','percentage'));

    }

    public function p_settings(Request $request){
        $this->validate($request, [
            'amount' => 'required',
            'percentage' => 'required'
        ]);

        Setting::where('id',"1")->update([
            'value' => $request->amount
        ]);

        Setting::where('id',"1")->update([
            'value' => $request->percentage
        ]);
        session()->flash('alert-success',"Settings has been updated successfully");

        return back();
    }

    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->to('/');
    }
}
