<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorsCostToVoucherPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voucher_payments', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('voucher_payments', 'vendors_cost')){
                $table->decimal('vendors_cost')->default(0)->after('vendor_product_id');
           }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher_payments', function (Blueprint $table) {
            //
            $table->dropColumn('vendors_cost');
        });
    }
}
