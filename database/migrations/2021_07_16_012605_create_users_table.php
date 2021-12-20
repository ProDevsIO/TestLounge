<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 500)->nullable();
            $table->string('last_name', 500)->nullable();
            $table->string('email', 500)->nullable();
            $table->string('password', 60)->nullable();
            $table->string('referal_code', 45)->nullable();
            $table->string('type', 60)->nullable()->default('0');
            $table->integer('verified')->nullable()->default(0);
            $table->double('wallet_balance')->nullable()->default(0);
            $table->double('referral_fee')->nullable();
            $table->integer('vendor_id')->nullable()->default(0);
            $table->double('percentage_split')->nullable();
            $table->string('account_no', 45)->nullable();
            $table->string('account_bank', 45)->nullable();
            $table->string('flutterwave_key', 45)->nullable();
            $table->string('flutterwave_id', 45)->nullable();
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
        Schema::dropIfExists('users');
    }
}
