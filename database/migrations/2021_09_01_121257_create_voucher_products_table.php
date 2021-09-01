<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('voucher_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('vendor_product_id')->nullable();
            $table->decimal('charged_amount')->nullable();
            $table->integer('quantity')->nullable()->default(0);
            $table->string('currency', 10)->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->nullOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->foreign('voucher_id')->references('id')->on('vouchers')->nullOnDelete();
            $table->foreign('vendor_product_id')->references('id')->on('vendor_products')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_products');
    }
}
