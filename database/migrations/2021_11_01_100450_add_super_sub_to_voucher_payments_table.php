<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuperSubToVoucherPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voucher_payments', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('voucher_payments', 'super_agent_share')){
                $table->integer('super_agent_share')->nullable()->default(null)->after('charged_amount');
                $table->integer('sub_agent_share')->nullable()->default(null)->after('charged_amount');
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
        Schema::table('voucher_payments', function (Blueprint $table) {
            //
            $table->dropColumn('super_agent_share');
            $table->dropColumn('sub_agent_share');
        });
    }
}
