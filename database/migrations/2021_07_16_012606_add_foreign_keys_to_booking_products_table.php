<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBookingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
        Schema::table('booking_products', function (Blueprint $table) {
            $table->foreign('booking_id', 'booking_product_fk_1')->references('id')->on('bookings')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('product_id', 'product_booking_fk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('vendor_id', 'vendor_id_fk_p')->references('id')->on('vendors')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('vendor_product_id', 'vendor_products_fkp')->references('id')->on('vendor_products')->onUpdate('CASCADE')->onDelete('NO ACTION');
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
        Schema::table('booking_products', function (Blueprint $table) {
            $table->dropForeign('booking_product_fk_1');
            $table->dropForeign('product_booking_fk_1');
            $table->dropForeign('vendor_id_fk_p');
            $table->dropForeign('vendor_products_fkp');
        });
    }
}
