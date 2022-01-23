<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TestService;

class TestController extends Controller
{
    //
    public $TestService;
   

    public function __construct()
    {
        $this->TestService = new TestService;
       
    }

    public function submit_test(Request $request){
        try{
            $this->validate($request, [
                "barcode" => 'required',
                "barcode_confirm" => 'required',
                "date_of_sampling" => 'required',
                "result_observed" => 'required',
                "type_of_test" => 'required',
                "first_name" => 'required',
                "last_name" => 'required',
                "address" => 'required',
                "flat_number" => 'required',
                "postal_code" => 'required',
                "city" => "required",
                "phone" => "required",
                "email" => "required",
                "confirm_email" => "required",
                "gender" => "required",
                "ethnicity" => "required",
                "dob" => "required",
                "passport_number" => "required",
                "symptoms" => "required",
                "travel_type" => "required",
                "flightNumber" => "required",
                "arrivalDate" => "required",
                "countryVisited" => "required",
                "vaccination" => "required",
                "termsConsent" => "required",
                "picture" => "file|mimes:jpeg,png,jpg|max:2048",
            ]);

            $this->TestService->register($request->all());

            $user = $request->all();

            return view('homepage.test_success')->with(compact('user'));

        } catch (\Exception $e) {
            session()->flash('alert-success', "Error".$e->getMessage());
            return back();
        }
    }
    
}
