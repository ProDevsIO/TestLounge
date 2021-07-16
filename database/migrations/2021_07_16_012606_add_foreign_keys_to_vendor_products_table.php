<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVendorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            $table->foreign('vendor_id', 'product_vendor_id')->references('id')->on('vendors')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('product_id', 'vendor_product_fk_')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('NO ACTION');
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
            $table->dropForeign('product_vendor_id');
            $table->dropForeign('vendor_product_fk_');
        });
    }
}
