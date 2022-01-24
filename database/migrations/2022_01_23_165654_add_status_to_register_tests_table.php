<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToRegisterTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register_tests', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('register_tests', 'status')){
                $table->integer('status')->nullable()->after('termsConsent');
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
        Schema::table('register_tests', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('register_tests', 'status')){
                $table->dropColumn('status');
           }
        });
    }
}
