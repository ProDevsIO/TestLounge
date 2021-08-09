<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('director', 500)->nullable()->after('agent_show_name');
            $table->string('c_o_i', 500)->nullable()->after('agent_show_name');
            $table->string('certified', 500)->nullable()->after('agent_show_name');
            $table->string('certified_no', 500)->nullable()->after('agent_show_name');
            $table->string('platform_name', 500)->nullable()->after('agent_show_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
