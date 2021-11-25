<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewRequirementToBookingsTable extends Migration
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
            if(!Schema::hasColumn('bookings', 'ukht_id')){
                $table->text('ukht_id')->nullable()->after('dam_location');
                $table->text('certificate_no')->nullable()->after('dam_location');
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
            if(Schema::hasColumn('bookings', 'ukht_id')){
                $table->dropColumn('ukht_id');
                $table->dropColumn('certificate_no');
            }
        });
    }
}
