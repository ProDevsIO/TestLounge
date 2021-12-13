<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupportedTestidToSupportedCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supported_countries', function (Blueprint $table) {
            if(!Schema::hasColumn('supported_countries', 'supported_test_id')){
                $table->integer('supported_test_id')->nullable()->after('faq');    
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
        Schema::table('supported_countries', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('supported_countries', 'supported_test_id')){
              $table->dropColumn('supported_test_id');
            }
        });
    }
}
