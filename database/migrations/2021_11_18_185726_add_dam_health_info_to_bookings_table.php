<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDamHealthInfoToBookingsTable extends Migration
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
            if(!Schema::hasColumn('bookings', 'dam_location')){
                $table->string('dam_location',200)->nullable()->after('status');
                $table->longtext('dam_address')->nullable()->after('status');
                $table->string('dam_room')->nullable()->after('status');

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
            if(Schema::hasColumn('bookings', 'dam_location')){
                $table->dropcolumn('dam_location');
                $table->dropcolumn('dam_address');
                $table->dropcolumn('dam_room');
            }
        });
    }
}
