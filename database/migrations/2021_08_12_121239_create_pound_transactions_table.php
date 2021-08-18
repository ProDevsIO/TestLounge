<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoundTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pound_transactions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->double('amount')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('type')->nullable();
            $table->double('cost_config')->nullable();
            $table->double('pecentage_config')->nullable();     
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
        Schema::dropIfExists('pound_transactions');
    }
}
