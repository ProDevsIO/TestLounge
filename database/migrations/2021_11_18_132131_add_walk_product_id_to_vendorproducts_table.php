<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWalkProductIdToVendorproductsTable extends Migration
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
            if(!Schema::hasColumn('vendor_products', 'walk_product_id')){
                $table->integer('walk_product_id')->nullable()->after('product_id');
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
            if(Schema::hasColumn('vendor_products', 'walk_product_id')){
                $table->dropcolumn('walk_product_id');
            }
        });
    }
}
