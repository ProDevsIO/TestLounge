<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
        Schema::create('vendors', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 500)->nullable();
            $table->string('email', 500)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
