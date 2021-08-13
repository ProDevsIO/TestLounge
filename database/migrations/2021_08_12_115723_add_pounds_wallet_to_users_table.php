<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoundsWalletToUsersTable extends Migration
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
            $table->decimal('total_credit_pounds')->nullable()->after('total_credit');
            $table->decimal('pounds_wallet_balance')->nullable()->after('wallet_balance');
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
            $table->dropColumn('total_credit_pounds');
            $table->dropColumn('pounds_wallet_balance');
        });
    }
}
