<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('price', 45)->nullable();
            $table->integer('product_id')->nullable()->index('vendor_product_fk__idx');
            $table->integer('vendor_id')->nullable()->index('product_vendor_id_idx');
            $table->timestamps();
        });
        }catch (Exception $e){

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_products');
    }
}
