<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestTypeToVendorProductsTable extends Migration
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
            if(!Schema::hasColumn('vendor_products', 'test_type_id')){
                $table->integer('test_type_id')->nullable()->after('vendor_id');    
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
            if(Schema::hasColumn('vendor_products', 'test_type_id')){
                $table->dropColumn('test_type_id');    
            }
        });
    }
}
