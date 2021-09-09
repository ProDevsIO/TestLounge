<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VoucherGeneratedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('voucher_generated', function (Blueprint $table) {
          
            $table->integer('id', true);
            $table->string('email', 500)->nullable();
            $table->integer('voucher_count_id')->nullable();
            $table->integer('agent')->nullable();
            $table->string('voucher', 50)->nullable();
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('voucher_generated');
    }
}
