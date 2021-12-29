<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
          $table->id();
          $table->string('referer_host')->nullable();
          $table->string('user_agent')->nullable();
          $table->string('datetime_end')->comment('The time the user ended the session')->nullable();

          $table->unsignedBigInteger('user_id')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

          $table->unsignedBigInteger('site_id')->nullable();
          $table->foreign('site_id')->references('id')->on('sites')->nullOnDelete();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
