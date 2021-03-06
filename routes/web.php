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



Route::get('/', [\App\Http\Controllers\HomeController::class,"home"]);
Route::get('/webhook/receiver', [\App\Http\Controllers\HomeController::class,"webhook_receiver"]);



Route::get('/password',[\App\Http\Controllers\HomeController::class,"testing"]);

Route::get('/login', [\App\Http\Controllers\HomeController::class,"login"]);
Route::get('/country_bank/{country}', [\App\Http\Controllers\HomeController::class,"country_bank"]);
Route::get('/account/name/{bank}/{no}', [\App\Http\Controllers\HomeController::class,"account_name"]);
Route::get('/country/query/{id}', [\App\Http\Controllers\HomeController::class,"country_query"]);

Route::get('/forgot/password', [\App\Http\Controllers\HomeController::class,"forgot_password"]);
Route::post('/reset_password', [\App\Http\Controllers\HomeController::class,"reset_password"]);
Route::get('/reset/password/{id}/{email}', [\App\Http\Controllers\HomeController::class,"c_password"]);
Route::post('/change/password', [\App\Http\Controllers\HomeController::class,"change_password"]);





Route::get('/register/agent', [\App\Http\Controllers\HomeController::class,"register_agent"]);
Route::get('/register/test', [\App\Http\Controllers\HomeController::class,"register_test"]);
Route::post('/submit/test', [\App\Http\Controllers\TestController::class,"submit_test"]);

Route::get('/next_steps', [\App\Http\Controllers\HomeController::class,"next_steps"])->name('next_steps');


Route::get('/payment/confirmation', [\App\Http\Controllers\HomeController::class,"payment_confirmation"]);
Route::any('/payment/{vas}/confirmation', [\App\Http\Controllers\HomeController::class,"payment_confirmation"]);
Route::get('/stripe/process/{id}/{type}', [\App\Http\Controllers\HomeController::class,"return_stripe_popup"]);
Route::get('/pick', [\App\Http\Controllers\HomeController::class,"pick"])->name('pick');
Route::get('/pricing', [\App\Http\Controllers\HomeController::class,"pricing"])->name('pricing');
Route::get('/about', [\App\Http\Controllers\HomeController::class,"about"])->name('about');
Route::get('/contact', [\App\Http\Controllers\HomeController::class,"contact"])->name('contact');
Route::get('/faq', [\App\Http\Controllers\HomeController::class,"faq"])->name('faq');
Route::get('/terms', [\App\Http\Controllers\HomeController::class, "terms"])->name('terms');
Route::get('/product/{type}', [\App\Http\Controllers\HomeController::class,"viewProducts"]);
Route::get('/product/country/{country}', [\App\Http\Controllers\HomeController::class,"viewCountryProducts"]);
Route::get('/walk-in', [\App\Http\Controllers\HomeController::class,"walkIn"]);
Route::get('/add/cart/{product_id}/{vendor_id}', [\App\Http\Controllers\HomeController::class,"addToCart"]);
Route::get('/view/cart', [\App\Http\Controllers\HomeController::class,"viewCart"]);
Route::get('/update/cart/{id}/{quantity}', [\App\Http\Controllers\HomeController::class,"updateCart"]);
Route::get('/delete/cart/{id}', [\App\Http\Controllers\HomeController::class,"deleteCart"]);
Route::get('/covid/testing', [\App\Http\Controllers\HomeController::class,"products"])->name('products_covid');
Route::get('/check/price/{vendor_id}', [\App\Http\Controllers\HomeController::class,"check_price"])->name('check_price');
Route::get('/view/country/{id}', [\App\Http\Controllers\HomeController::class,"view_uk"]);
Route::get('/travel/details/{id}/{action}', [\App\Http\Controllers\HomeController::class,"view_travel_details"]);

Route::get('/check/{nationality}/price', [\App\Http\Controllers\HomeController::class,"check_product_price"])->name('check_product_price');

Route::get('/product/descript/{product_id}', [\App\Http\Controllers\HomeController::class,"product_descript"]);
Route::get('/product/vendors/{product_id}/{nationality}',  [\App\Http\Controllers\HomeController::class,"product_to_vendors"]);

Route::post('/login', [\App\Http\Controllers\HomeController::class,"post_login"])->name('login');
Route::post('/register', [\App\Http\Controllers\HomeController::class,"register"]);

Route::get('/green', [\App\Http\Controllers\HomeController::class, "view_green"]);
Route::get('/amber', [\App\Http\Controllers\HomeController::class, "view_amber"]);
Route::get('/red', [\App\Http\Controllers\HomeController::class, "view_red"]);


Route::post('/post/booking', [\App\Http\Controllers\HomeController::class,"post_booking"]);
Route::get('/post/booking', [\App\Http\Controllers\HomeController::class,"booking"]);
Route::get('/booking2', [\App\Http\Controllers\HomeController::class,"booking2"]);
Route::get('/booking/success', [\App\Http\Controllers\HomeController::class,"booking_success"])->name('booking_success');
Route::get('/booking/code/failed', [\App\Http\Controllers\HomeController::class,"code_failed"])->name('code_failed');
Route::get('/booking/stripe/success', [\App\Http\Controllers\HomeController::class,"success_stripe"])->name('success_stripe');
Route::get('/booking/stripe/failed', [\App\Http\Controllers\HomeController::class,"success_failed"])->name('failed_stripe');
Route::get('/booking/voucher/{code}/{walk?}', [\App\Http\Controllers\HomeController::class,"voucher_booking"])->name('voucher_booking');
Route::get('/voucher/voucherOption/{code}', [\App\Http\Controllers\HomeController::class,"voucher_option"])->name('voucher_option');

Route::get('/testEmail', [\App\Http\Controllers\HomeController::class,"testEmail"])->name('testEmail');
Route::get('/make/payment/{booking}', [\App\Http\Controllers\HomeController::class,"make_payment"])->name('make_payment');
Route::post('/make/payment/{booking}', [\App\Http\Controllers\HomeController::class,"p_make_payment"]);
Route::get('/booking/failed', [\App\Http\Controllers\HomeController::class,"booking_failed"])->name('booking_failed');
Route::get('/sub/continue/registration/{referral_code}/{id}', [\App\Http\Controllers\HomeController::class,"sub_verify_account"])->name('verify_account');
Route::get('/super/continue/registration/{referral_code}/{id}', [\App\Http\Controllers\HomeController::class,"super_verify_account"]);
Route::post('/complete/register', [\App\Http\Controllers\HomeController::class,"complete_registration"])->name('complete_registration');

Route::post('/pay', [\App\Http\Controllers\PaymentController::class, 'redirectToGateway']);
Route::get('/payment/callback', [\App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);

Route::get('/booking',[\App\Http\Controllers\HomeController::class,"booking"])->name('booking');

Route::get('/view/product/{slug}', [\App\Http\Controllers\HomeController::class, "view_single_product"]);

Route::get('/check/time/damlocation/{location}/{room}/{product}', [\App\Http\Controllers\HomeController::class, "getdamtimeslot"]);

Route::get('/get/damlocation/{product}', [\App\Http\Controllers\HomeController::class, "getdamlocate"]);

Route::get('/testing' ,[\App\Http\Controllers\HomeController::class, "test"]);

Route::get('/slugging' ,[\App\Http\Controllers\HomeController::class, "slugify"]);



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,"dashboard"]);
    Route::get('/pending/booking', [\App\Http\Controllers\DashboardController::class,"pending_booking"]);
    Route::get('/complete/booking', [\App\Http\Controllers\DashboardController::class,"complete_booking"]);
    Route::get('/view/individual/booking', [\App\Http\Controllers\DashboardController::class,"view_individual_booking"]);
    Route::get('/view/agent/booking', [\App\Http\Controllers\DashboardController::class,"view_agent_booking"]);
    Route::get('/view/agent/details/{id}', [\App\Http\Controllers\DashboardController::class,"details"]);
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,"dashboard"]);
    Route::get('/view/booking/{id}', [\App\Http\Controllers\DashboardController::class,"view_booking"]);
    Route::get('/view/bookings/{id}', [\App\Http\Controllers\DashboardController::class,"view_bookings"]);
    Route::get('/booking/delete/{id}', [\App\Http\Controllers\DashboardController::class,"delete_booking"]);
    Route::get('/booking/generate/code/{id}', [\App\Http\Controllers\DashboardController::class,"generate_booking_code"]);
    Route::get('/vendors', [\App\Http\Controllers\DashboardController::class,"vendors"]);
    Route::post('/edit/email', [\App\Http\Controllers\DashboardController::class,"edit_email"]);
    Route::post('/make/pay', [\App\Http\Controllers\DashboardController::class,"make_pay"]);
    Route::get('/resend/receipt/{id}', [\App\Http\Controllers\DashboardController::class,"resend_receipt"]);
    Route::get('/finance/report', [\App\Http\Controllers\DashboardController::class,"financial_report"]);
    Route::get('/view/subagent/report', [\App\Http\Controllers\DashboardController::class,"subagent_report"]);
    Route::get('currency/detail/report/{currency}/{startDate}/{endDate}', [\App\Http\Controllers\DashboardController::class,"view_currency_report"]);
    Route::get('profit/report/{currency}/{startDate}/{endDate}', [\App\Http\Controllers\DashboardController::class,"view_profit_report"]);
    Route::get('profit/voucher/{currency}/{startDate}/{endDate}', [\App\Http\Controllers\DashboardController::class,"view_profit_voucher"]);
    Route::get('view/report/discount/{type}/{startDate}/{endDate}', [\App\Http\Controllers\DashboardController::class,"view_report_discount"]);
    Route::get('/imitate/account/{id}', [\App\Http\Controllers\DashboardController::class,"imitate_account"]);
    Route::get('/view/transactions', [\App\Http\Controllers\DashboardController::class,"view_transactions"]);
    Route::post('/view/transactions', [\App\Http\Controllers\DashboardController::class,"view_transactions"]);
    Route::get('/view/sub-agent/transaction/{id}', [\App\Http\Controllers\DashboardController::class,"view_subagent_transactions"]);
    Route::post('/update/country', [\App\Http\Controllers\DashboardController::class,"update_country"]);
    Route::post('/add/test_kit', [\App\Http\Controllers\DashboardController::class,"add_test_kit"]);



    Route::get('/users', [\App\Http\Controllers\DashboardController::class,"users"]);
    Route::get('/admins', [\App\Http\Controllers\DashboardController::class,"admins"]);
    Route::get('/users/delete/{id}', [\App\Http\Controllers\DashboardController::class,"delete_user"]);
    Route::get('/products', [\App\Http\Controllers\DashboardController::class,"products"]);
    Route::post('/edit/product', [\App\Http\Controllers\DashboardController::class,"edit_product"]);
    Route::post('/add/product', [\App\Http\Controllers\DashboardController::class,"add_product"]);
    Route::get('/delete/product/{id}', [\App\Http\Controllers\DashboardController::class,"delete_product"]);
    Route::get('/product/vendor/{id}/{price}/{pricestripe}/{costPrice}/{altprice}/{walkid?}', [\App\Http\Controllers\DashboardController::class,"product_vendor"]);

    Route::get('/agent/activate/{id}', [\App\Http\Controllers\HomeController::class,"agent_activate"]);
    Route::get('/agent/deactivate/{id}', [\App\Http\Controllers\HomeController::class,"agent_deactivate"]);
    Route::get('/agent/percent/{id}', [\App\Http\Controllers\HomeController::class, "agent_percent"]);
    Route::resource('sub-agents', \App\Http\Controllers\SubAgentController::class);
    Route::post('/update/percent/{id}', [\App\Http\Controllers\HomeController::class, "UpdatePercent"]);
    Route::get('/agent/copy/{id}', [\App\Http\Controllers\DashboardController::class, "agent_copy_receipt"]);
    Route::get('/barcode/process/{id}/{stat}', [\App\Http\Controllers\DashboardController::class, "barcode_status"]);
    Route::get('/profile', [\App\Http\Controllers\DashboardController::class, "profile_view"]);
    Route::get('/edit/profile/view', [\App\Http\Controllers\DashboardController::class, "edit_profile_view"]);
    Route::post('/edit/profile', [\App\Http\Controllers\DashboardController::class, "edit_profile"]);
    Route::get('/agent/view/products', [\App\Http\Controllers\DashboardController::class,"agent_view_product"]);
    Route::get('/post/agent/buy/{product_id}/{vendor_id}/{quantity}', [\App\Http\Controllers\DashboardController::class,"post_agent_buy"]);
    Route::get('/process/price/{product_id}/{quantity}', [\App\Http\Controllers\DashboardController::class,"agent_process_price"]);
    Route::any('/voucher/payment/confirmation', [\App\Http\Controllers\DashboardController::class,"voucher_payment_confirmation"]);
    Route::get('/view/vouchers', [\App\Http\Controllers\DashboardController::class, "view_vouchers"]);
    Route::get('/view/discounts', [\App\Http\Controllers\DashboardController::class, "view_discounts"]);
    Route::get('/view/vouchers/transaction', [\App\Http\Controllers\DashboardController::class, "voucher_transactions"]);
    Route::get('/subagent/assigned/vouchers', [\App\Http\Controllers\DashboardController::class, "voucher_assigned_subagent"]);
    Route::post('/voucher/email/{id}', [\App\Http\Controllers\DashboardController::class, "email_vouchers"]);

    Route::post('/add/vendor', [\App\Http\Controllers\DashboardController::class,"add_vendor"]);
    Route::get('/admin/make/{id}', [\App\Http\Controllers\DashboardController::class,"admin_make"]);
    Route::get('/send/booking/{id}', [\App\Http\Controllers\DashboardController::class,"send_booking"]);

    Route::get('/agent/deactivate/name/{id}', [\App\Http\Controllers\DashboardController::class,"agent_deactivate_name"]);
    Route::get('/agent/activate/name/{id}', [\App\Http\Controllers\DashboardController::class,"agent_activate_name"]);
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
    Route::post('/add/referer/{code}', [\App\Http\Controllers\DashboardController::class, "add_referer"]);
    Route::post('/assign/sub-agent/{id}', [\App\Http\Controllers\DashboardController::class, "assign_subagent"]);
    Route::post('/assign/voucher/{id}', [\App\Http\Controllers\DashboardController::class, "admin_assign_voucher"]);
    Route::post('/agent/assign/voucher/{id}', [\App\Http\Controllers\DashboardController::class, "agent_assign_voucher"]);
    Route::get('/mark/voucher/{id}', [\App\Http\Controllers\DashboardController::class, "mark_paid_voucher"]);

    Route::get('/admin/list/export', [\App\Http\Controllers\DashboardController::class,"admin_export"]);
    Route::get('/active/agent/export', [\App\Http\Controllers\DashboardController::class,"Agent_active_export"]);
    Route::get('/inactive/agent/export', [\App\Http\Controllers\DashboardController::class,"Agent_inactive_export"]);
    Route::get('currency/export/{currency}/{startDate}/{endDate}', [\App\Http\Controllers\DashboardController::class,"currency_export"]);

    Route::get('/view/guidelines/{num}', [\App\Http\Controllers\DashboardController::class,"view_guidelines"]);
    Route::get('/supported/countries', [\App\Http\Controllers\DashboardController::class,"view_supported_countries"]);
    Route::get('/add/supported/countries', [\App\Http\Controllers\DashboardController::class,"view_add_supported_countries"]);
    Route::get('/vendor/supported/{id}', [\App\Http\Controllers\DashboardController::class,"view_supported_vendor"]);
    Route::get('/edit/configuration/{id}', [\App\Http\Controllers\DashboardController::class,"view_edit_configuration"]);
    Route::post('/page/configure/data', [\App\Http\Controllers\DashboardController::class, "page_configuration"]);
    Route::post('/edit/configure/data', [\App\Http\Controllers\DashboardController::class, "edit_page_configuration"]);
    Route::get('/view/configure/products/{id}', [\App\Http\Controllers\DashboardController::class,"view_configure_products"]);

    Route::get('/pages', [\App\Http\Controllers\PageController::class,"view_created_pages"]);
    Route::post('/page/save', [\App\Http\Controllers\PageController::class,"add_page"]);
    Route::post('/page/edit/{id}', [\App\Http\Controllers\PageController::class,"edit_page"]);

    Route::post('/update/damlocation/{id}', [\App\Http\Controllers\DashboardController::class,"updateDamBookingLocation"]);

    Route::get('/logout', [\App\Http\Controllers\DashboardController::class,"logout"]);

    Route::get('/validate/test', [\App\Http\Controllers\TestController::class,"view_test_list"]);

    Route::get('/test/status/{id}/{status}', [\App\Http\Controllers\TestController::class,"set_test_status"]);
});
