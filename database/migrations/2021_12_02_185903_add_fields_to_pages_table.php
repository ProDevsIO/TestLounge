<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('pages', 'title')){
                $table->string('title', 300)->nullable();
                $table->longtext('content')->nullable();
                $table->integer('type')->nullable();
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
        Schema::table('pages', function (Blueprint $table) {
            //
            if(Schema::hasColumn('pages', 'title')){
                $table->dropColumn('title', 300);
                $table->dropColumn('content');
                $table->dropColumn('type');
            }
        });
    }
}
