<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportedCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       
            Schema::create('supported_countries', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('country_id')->nullable();
//                $table->integer('vendor_id')->nullable();
                $table->longtext('arrival_vaccinated');
                $table->longtext('arrival_unvaccinated');
                $table->longtext('departure_vaccinated');
                $table->longtext('departure_unvaccinated');
                $table->longtext('faq');
                $table->timestamps();
                $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
//                $table->foreign('vendor_id')->references('id')->on('vendors')->nullOnDelete();
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
        Schema::dropIfExists('supported_countries');
    }
}
