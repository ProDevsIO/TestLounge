<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestKitToVoucherGenerate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voucher_generated', function (Blueprint $table) {
            //
          
                if(!Schema::hasColumn('voucher_generate', 'test_kit')){
                    $table->string('test_kit', 500)->nullabe()->after('status');
                   
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
        Schema::table('voucher_generated', function (Blueprint $table) {
            //
            $table->dropColumn('test_kit');
        });
    }
}
