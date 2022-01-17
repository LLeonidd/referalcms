<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteDefaultAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('sites', function(Blueprint $table){
        $table->boolean('default')->nullable()->default(NULL);
        $table->unique(['default']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('sites', function ($table) {
        $table->dropColumn('default');
      });
    }
}
