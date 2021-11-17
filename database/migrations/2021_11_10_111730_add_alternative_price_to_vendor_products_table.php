<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlternativePriceToVendorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('vendor_products', 'alternative_price')){
                $table->text('alternative_price')->nullable()->after('price_stripe');
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
        Schema::table('vendor_products', function (Blueprint $table) {
            //
            if(Schema::hasColumn('vendor_products', 'alternative_price')){
                $table->dropColumn('alternative_price');
            }
        });
    }
}
