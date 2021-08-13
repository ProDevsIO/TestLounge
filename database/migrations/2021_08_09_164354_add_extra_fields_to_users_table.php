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
            if(!Schema::hasColumn('users', 'director') && !Schema::hasColumn('users', 'c_o_i') && !Schema::hasColumn('users', 'certified') && !Schema::hasColumn('users', 'certified_no') && !Schema::hasColumn('users', 'platform_name')){
                $table->string('director', 500)->nullable()->after('agent_show_name');
                $table->string('c_o_i', 500)->nullable()->after('agent_show_name');
                $table->string('certified', 500)->nullable()->after('agent_show_name');
                $table->string('certified_no', 500)->nullable()->after('agent_show_name');
                $table->string('platform_name', 500)->nullable()->after('agent_show_name');
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
            if(Schema::hasColumn('users', 'director') && Schema::hasColumn('users', 'c_o_i') && Schema::hasColumn('users', 'certified') && Schema::hasColumn('users', 'certified_no') && Schema::hasColumn('users', 'platform_name')){
                $table->dropColum('director');
                $table->dropColum('c_o_i');
                $table->dropColum('certified');
                $table->dropColum('certified_no');
                $table->dropColum('platform_name');
            }
        });
    }
}
