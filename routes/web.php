<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage.home');
});

Route::get('/webhook/receiver', [\App\Http\Controllers\HomeController::class,"webhook_receiver"]);



Route::get('/password', function () {
    return \Illuminate\Support\Facades\Hash::make('password');
});

Route::get('/login', [\App\Http\Controllers\HomeController::class,"login"]);
Route::get('/register/agent', [\App\Http\Controllers\HomeController::class,"register_agent"]);

Route::get('/payment/confirmation', [\App\Http\Controllers\HomeController::class,"payment_confirmation"]);
Route::get('/pick', [\App\Http\Controllers\HomeController::class,"pick"])->name('pick');
Route::get('/about', [\App\Http\Controllers\HomeController::class,"about"])->name('about');
Route::get('/covid/testing', [\App\Http\Controllers\HomeController::class,"products"])->name('products_covid');
Route::get('/check/price/{vendor_id}/{product_id}', [\App\Http\Controllers\HomeController::class,"check_price"])->name('check_price');

Route::post('/login', [\App\Http\Controllers\HomeController::class,"post_login"])->name('login');

Route::post('/register', [\App\Http\Controllers\HomeController::class,"register"]);



Route::post('/post/booking', [\App\Http\Controllers\HomeController::class,"post_booking"]);
Route::get('/booking/success', [\App\Http\Controllers\HomeController::class,"booking_success"])->name('booking_success');
Route::get('/testEmail', [\App\Http\Controllers\HomeController::class,"testEmail"])->name('testEmail');
Route::get('/make/payment/{booking}', [\App\Http\Controllers\HomeController::class,"make_payment"])->name('make_payment');
Route::get('/booking/failed', [\App\Http\Controllers\HomeController::class,"booking_failed"])->name('booking_failed');
Route::get('/continue/registration/{referral_code}/{id}', [\App\Http\Controllers\HomeController::class,"verify_account"])->name('verify_account');



Route::get('/booking',[\App\Http\Controllers\HomeController::class,"booking"])->name('booking');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,"dashboard"]);
    Route::get('/pending/booking', [\App\Http\Controllers\DashboardController::class,"pending_booking"]);
    Route::get('/complete/booking', [\App\Http\Controllers\DashboardController::class,"complete_booking"]);
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,"dashboard"]);
    Route::get('/view/booking/{id}', [\App\Http\Controllers\DashboardController::class,"view_booking"]);
    Route::get('/vendors', [\App\Http\Controllers\DashboardController::class,"vendors"]);
    Route::get('/users', [\App\Http\Controllers\DashboardController::class,"users"]);
    Route::get('/products', [\App\Http\Controllers\DashboardController::class,"products"]);
    Route::post('/edit/product', [\App\Http\Controllers\DashboardController::class,"edit_product"]);
    Route::post('/add/product', [\App\Http\Controllers\DashboardController::class,"add_product"]);
    Route::get('/delete/product/{id}', [\App\Http\Controllers\DashboardController::class,"delete_product"]);
    Route::get('/product/vendor/{id}/{price}', [\App\Http\Controllers\DashboardController::class,"product_vendor"]);


    Route::post('/add/vendor', [\App\Http\Controllers\DashboardController::class,"add_vendor"]);
    Route::get('/admin/make/{id}', [\App\Http\Controllers\DashboardController::class,"admin_make"]);
    Route::get('/agent/make/{id}', [\App\Http\Controllers\DashboardController::class,"agent_make"]);
    Route::get('/settings', [\App\Http\Controllers\DashboardController::class,"settings"]);
    Route::get('/user/bank', [\App\Http\Controllers\DashboardController::class,"user_bank"]);


    Route::post('/add/bank', [\App\Http\Controllers\DashboardController::class,"add_bank"]);
    Route::post('/settings', [\App\Http\Controllers\DashboardController::class,"p_settings"]);



    Route::get('/logout', [\App\Http\Controllers\DashboardController::class,"logout"]);

});
