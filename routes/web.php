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



Route::get('/password',[\App\Http\Controllers\HomeController::class,"testing"]);

Route::get('/login', [\App\Http\Controllers\HomeController::class,"login"]);
Route::get('/country_bank/{country}', [\App\Http\Controllers\HomeController::class,"country_bank"]);
Route::get('/account/name/{bank}/{no}', [\App\Http\Controllers\HomeController::class,"account_name"]);

Route::get('/forgot/password', [\App\Http\Controllers\HomeController::class,"forgot_password"]);
Route::post('/reset_password', [\App\Http\Controllers\HomeController::class,"reset_password"]);
Route::get('/reset/password/{id}/{email}', [\App\Http\Controllers\HomeController::class,"c_password"]);
Route::post('/change/password', [\App\Http\Controllers\HomeController::class,"change_password"]);





Route::get('/register/agent', [\App\Http\Controllers\HomeController::class,"register_agent"]);
Route::get('/next_steps', [\App\Http\Controllers\HomeController::class,"next_steps"])->name('next_steps');


Route::get('/payment/confirmation', [\App\Http\Controllers\HomeController::class,"payment_confirmation"]);
Route::get('/pick', [\App\Http\Controllers\HomeController::class,"pick"])->name('pick');
Route::get('/pricing', [\App\Http\Controllers\HomeController::class,"pricing"])->name('pricing');
Route::get('/about', [\App\Http\Controllers\HomeController::class,"about"])->name('about');
Route::get('/covid/testing', [\App\Http\Controllers\HomeController::class,"products"])->name('products_covid');
Route::get('/check/price/{vendor_id}', [\App\Http\Controllers\HomeController::class,"check_price"])->name('check_price');

Route::get('/check/{nationality}/price', [\App\Http\Controllers\HomeController::class,"check_product_price"])->name('check_product_price');

Route::get('/product/descript/{product_id}', [\App\Http\Controllers\HomeController::class,"product_descript"]);
Route::get('/product/vendors/{product_id}/{nationality}',  [\App\Http\Controllers\HomeController::class,"product_to_vendors"]);

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
    Route::get('/booking/delete/{id}', [\App\Http\Controllers\DashboardController::class,"delete_booking"]);
    Route::get('/vendors', [\App\Http\Controllers\DashboardController::class,"vendors"]);
    Route::get('/users', [\App\Http\Controllers\DashboardController::class,"users"]);
    Route::get('/users/delete/{id}', [\App\Http\Controllers\DashboardController::class,"delete_user"]);
    Route::get('/products', [\App\Http\Controllers\DashboardController::class,"products"]);
    Route::post('/edit/product', [\App\Http\Controllers\DashboardController::class,"edit_product"]);
    Route::post('/add/product', [\App\Http\Controllers\DashboardController::class,"add_product"]);
    Route::get('/delete/product/{id}', [\App\Http\Controllers\DashboardController::class,"delete_product"]);
    Route::get('/product/vendor/{id}/{price}/{pricestripe}', [\App\Http\Controllers\DashboardController::class,"product_vendor"]);

    Route::get('/agent/activate/{id}', [\App\Http\Controllers\HomeController::class,"agent_activate"]);
    Route::get('/agent/deactivate/{id}', [\App\Http\Controllers\HomeController::class,"agent_deactivate"]);
    Route::get('/agent/percent/{id}', [\App\Http\Controllers\HomeController::class, "agent_percent"]);
    Route::get('/agent/percent/{id}', [\App\Http\Controllers\HomeController::class, "agent_percent"]);
    Route::post('/update/percent/{id}', [\App\Http\Controllers\HomeController::class, "UpdatePercent"]);

    Route::post('/add/vendor', [\App\Http\Controllers\DashboardController::class,"add_vendor"]);
    Route::get('/admin/make/{id}', [\App\Http\Controllers\DashboardController::class,"admin_make"]);
    Route::get('/send/booking/{id}', [\App\Http\Controllers\DashboardController::class,"send_booking"]);

    Route::get('/agent/make/{id}', [\App\Http\Controllers\DashboardController::class,"agent_make"]);
    Route::get('/settings', [\App\Http\Controllers\DashboardController::class,"settings"]);
    Route::get('/user/bank', [\App\Http\Controllers\DashboardController::class,"user_bank"]);


    Route::post('/add/bank', [\App\Http\Controllers\DashboardController::class,"add_bank"]);
    Route::post('/change/referral_code/{id}', [\App\Http\Controllers\DashboardController::class,"change_referral_code"]);

    Route::post('/settings', [\App\Http\Controllers\DashboardController::class,"p_settings"]);

    Route::get('/colors', [\App\Http\Controllers\DashboardController::class,"color"]);
    Route::post('/add/colors', [\App\Http\Controllers\DashboardController::class, "add_color"]);
    Route::post('/edit/colors/{id}', [\App\Http\Controllers\DashboardController::class, "edit_color"]);
    Route::get('/delete/color/{id}', [\App\Http\Controllers\DashboardController::class, "delete_color"]);


    Route::get('/logout', [\App\Http\Controllers\DashboardController::class,"logout"]);

});
