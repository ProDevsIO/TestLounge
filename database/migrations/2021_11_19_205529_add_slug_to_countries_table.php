<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('countries', 'slug_name')){
                $table->text('slug_name')->nullable()->after('iso');
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
        Schema::table('countries', function (Blueprint $table) {
            //
            if(Schema::hasColumn('countries', 'slug_name')){
                $table->dropColumn('slug_name');
            }
        });
    }
}
