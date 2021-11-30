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
        dd('yes');
    }
}
