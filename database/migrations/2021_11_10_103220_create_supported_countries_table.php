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
                $table->longtext('image')->nullable();
                $table->longtext('arrival_vaccinated')->nullable();
                $table->longtext('arrival_unvaccinated')->nullable();
                $table->longtext('departure_vaccinated')->nullable();
                $table->longtext('departure_unvaccinated')->nullable();
                $table->longtext('faq')->nullable();
                $table->timestamps();
                $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
                // $table->foreign('vendor_id')->references('id')->on('vendors')->nullOnDelete();
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
