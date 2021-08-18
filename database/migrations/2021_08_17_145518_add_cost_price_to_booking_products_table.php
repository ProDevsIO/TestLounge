<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostPriceToBookingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_products', function (Blueprint $table) {
            //
            $table->decimal('vendor_cost_price')->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_products', function (Blueprint $table) {
            //
            $table->dropColumn('vendor_cost_price');
        });
    }
}
