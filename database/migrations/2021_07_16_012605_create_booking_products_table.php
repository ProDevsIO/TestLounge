<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('booking_products', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('booking_id')->nullable()->index('booking_product_fk_1_idx');
                $table->integer('product_id')->nullable()->index('product_booking_fk_1_idx');
                $table->integer('vendor_id')->nullable()->index('vendor_id_fk_p_idx');
                $table->integer('vendor_product_id')->nullable()->index('vendor_products_fkp_idx');
                $table->timestamps();
                $table->double('price')->nullable();
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
        Schema::dropIfExists('booking_products');
    }
}
