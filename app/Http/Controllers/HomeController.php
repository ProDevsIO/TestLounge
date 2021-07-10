<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function booking(){
        $countries = Country::all();
        return view('homepage.booking')->with(compact('countries'));
    }
}
