<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeFieldToTransactionsTable extends Migration
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
            $table->integer('stripe_session')->nullable()->default(1)->after('created_at');
            $table->integer('stripe_intent')->nullable()->default(1)->after('created_at');
        });

        Schema::table('booking_products', function (Blueprint $table) {
            //
            $table->integer('stripe_session')->nullable()->default(1)->after('created_at');
            $table->integer('stripe_intent')->nullable()->default(1)->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
            $table->dropColumn('type');
        });
    }
}
