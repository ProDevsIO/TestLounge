<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_discounts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->double('amount')->nullable();
            $table->integer('v_pay_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('cost_config')->nullable();
            $table->double('pecentage_config')->nullable();
            $table->string('currency', 3)->nullable();     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_discounts');
    }
}
