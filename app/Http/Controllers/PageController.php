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
use App\Models\Pages;
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

class PageController extends Controller
{
    //

    public function view_created_pages()
    {
        $countries = Country::all();
        $products = Product::all();
        $pages = Pages::all();  

       return view('admin.pages')->with(compact('countries', 'products','pages'));
    }

    public function add_page(Request $request)
    {
        $this->validate($request, [
            'title' => "required",
            'content' => "required",
            'type' => "required"
        ]);

        DB::beginTransaction();
        try{

            $request_data = $request->all();

            unset($request_data['_token']);

            if($request->type == "Modal")
            {
                $request_data['type'] = 1;
            }else{
                $request_data['type'] = 2;
            }

            $page = Pages::create($request_data);  

            DB::commit();
            session()->flash('alert-success', 'Page created successfully.');
            return back();

        } catch(\Exception $e){

             DB::rollback();
             session()->flash('alert-danger', 'Something went wrong.');
             return back()->withInput();
        }
    }

    public function edit_page(Request $request, $id)
    {
        $this->validate($request, [
            'title' => "required",
            'econtent'.$id => "required",
            'type' => "required"
        ]);
     

        DB::beginTransaction();

        try{

            $request_data = $request->all();

            unset($request_data['_token']);
            unset($request_data['econtent'.$id]);
            $request_data['content'] = $request['econtent'.$id];

            if($request->type == "Modal")
            {
                $request_data['type'] = 1;
            }else{
                $request_data['type'] = 2;
            }
            
            $page = Pages::where('id', $id)->update($request_data);  

            DB::commit();
            session()->flash('alert-success', 'Page updated successfully.');
            return back();

        } catch(\Exception $e){

             DB::rollback();
             dd($e);
             session()->flash('alert-danger', 'Something went wrong.');
             return back()->withInput();
        }

    }

    
}
