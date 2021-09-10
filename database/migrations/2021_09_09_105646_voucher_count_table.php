<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VoucherCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('voucher_counts', function (Blueprint $table) {
          
            $table->integer('id', true);
            $table->integer('agent')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->nullable()->default(0);
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->foreign('agent')->references('id')->on('users')->nullOnDelete();
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
        //
        Schema::dropIfExists('voucher_counts');
    }
}
