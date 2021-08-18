<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainAgentColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users', 'main_agent_id')){
                $table->unsignedBigInteger('main_agent_id')->nullable();
            }
            if(!Schema::hasColumn('users', 'main_agent_share_raw')){
                $table->float('main_agent_share_raw')->nullable();
            }
            if(!Schema::hasColumn('users', 'main_agent_share_percent')){
                $table->float('main_agent_share_percent')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
