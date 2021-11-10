<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsentVaccineToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('bookings', 'vaccinated')){
                $table->text('vaccinated')->nullable()->after('vaccination_type');
                $table->text('proof_vaccine')->nullable()->after('vaccination_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
            $table->dropColumn('vaccinated');
            $table->dropColumn('proof_vaccine');
        });
    }
}
