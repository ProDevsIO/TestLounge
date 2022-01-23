<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('register_tests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('barcode', 50)->nullable();
            $table->dateTime('date_of_sampling')->nullable();
            $table->string('result_observed', 50)->nullable();
            $table->longtext('picture')->nullable();
            $table->string('type_of_test', 200)->nullable();
            $table->integer('greenCountryConsent')->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('flat_number', 200)->nullable();
            $table->string('postal_code', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('phone', 45)->nullable();
            $table->string('email', 1000)->nullable();
            $table->string('gender', 10)->nullable();
            $table->integer('ethnicity')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('passport_number', 100)->nullable();
            $table->integer('symptoms')->default(0)->nullable();
            $table->string('travel_type', 50)->nullable();
            $table->integer('flightNumber')->nullable();
            $table->dateTime('arrivalDate')->nullable();
            $table->string('countryVisited', 1000)->nullable();
            $table->integer('vaccination')->nullable();
            $table->integer('termsConsent')->nullable();
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
        Schema::dropIfExists('register_tests');
    }
}
