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
                $table->integer('vendor_id')->nullable();
                $table->text('on_arrival');
                $table->text('departure');
                $table->text('faq');
                $table->timestamps();
                $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
                $table->foreign('vendor_id')->references('id')->on('vendors')->nullOnDelete();
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
