<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->enum('sex', ['1', '2'])->nullable();
            $table->dateTime('dob')->nullable();
            $table->integer('ethnicity')->nullable()->comment('0 = white
1 = Mixed/Muti Ethnic group
2 = Asain/Asian British
3 = Black
4 Others
');
            $table->string('nhs_number', 45)->nullable();
            $table->integer('vaccination_status')->nullable()->comment('1. Not
2. First Dose
3. Second Dose');
            $table->string('document_id', 200)->nullable();
            $table->string('address_1', 500)->nullable();
            $table->string('address_2', 500)->nullable();
            $table->string('home_town', 500)->nullable();
            $table->string('post_code', 45)->nullable();
            $table->integer('home_country_id')->nullable()->index('home_country_fk_idx');
            $table->string('isolation_address', 500)->nullable();
            $table->string('isolation_address2', 500)->nullable();
            $table->string('isolation_town', 500)->nullable();
            $table->string('isolation_postal_code', 45)->nullable();
            $table->integer('isolation_country_id')->nullable()->index('isolation_country_fk_idx');
            $table->dateTime('arrival_date')->nullable();
            $table->integer('country_travelling_from_id')->nullable()->index('traveling_country_fk_idx');
            $table->string('city_from', 500)->nullable();
            $table->dateTime('departure_date')->nullable();
            $table->dateTime('last_day_travel')->nullable();
            $table->integer('method_of_transportation')->nullable()->comment('1 = Airline
2. = Vessel
3 = Train
4 = Road Vehicle
5. = Others');
            $table->string('transport_no', 45)->nullable();
            $table->integer('country_code_id')->nullable()->index('country_code_fk_idx');
            $table->string('phone_no', 80)->nullable();
            $table->string('email', 1000)->nullable();
            $table->integer('consent')->nullable();
            $table->string('referral_code', 45)->nullable();
            $table->integer('user_id')->nullable()->index('user_id_fk_idx');
            $table->integer('mode_of_payment')->nullable()->comment('1 = Online
2 = Payment Code');
            $table->integer('vendor_id')->nullable()->index('vendors_if_k_idx');
            $table->string('booking_code', 45)->nullable();
            $table->string('transaction_ref', 500)->nullable();
            $table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('bookings');
    }
}
