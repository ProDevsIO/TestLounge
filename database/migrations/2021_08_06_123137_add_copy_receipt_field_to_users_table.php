<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCopyReceiptFieldToUsersTable extends Migration
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
            if(!Schema::hasColumn('users', 'copy_receipt'))
            { 
                $table->integer('copy_receipt')->nullable()->default(0)->after('flutterwave_id');
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
            if(Schema::hasColumn('users', 'copy_receipt'))
            { 
                $table->dropColum('copy_receipt');
            }
        });
    }
}
