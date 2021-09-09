<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToBookingProductsTable extends Migration
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
            if(!Schema::hasColumn('booking_products', 'quantity')){
                $table->Integer('quantity')->default(1)->after('charged_amount');
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
        Schema::table('booking_products', function (Blueprint $table) {
            //
            $table->dropColumn('quantity');
        });
    }
}
