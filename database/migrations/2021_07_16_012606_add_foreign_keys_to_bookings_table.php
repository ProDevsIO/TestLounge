<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('country_code_id', 'country_code_fk__')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('country_travelling_from_id', 'country_from_fk_')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('home_country_id', 'home_country_fk_')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('isolation_country_id', 'isolation_country_fk_')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('user_id', 'user_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign('vendor_id', 'vendors_if_k')->references('id')->on('vendors')->onUpdate('CASCADE')->onDelete('NO ACTION');
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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('country_code_fk__');
            $table->dropForeign('country_from_fk_');
            $table->dropForeign('home_country_fk_');
            $table->dropForeign('isolation_country_fk_');
            $table->dropForeign('user_id_fk');
            $table->dropForeign('vendors_if_k');
        });
    }
}
