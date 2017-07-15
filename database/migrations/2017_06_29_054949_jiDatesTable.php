<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prospect_id');
            $table->dateTime('date_date');
            $table->unsignedInteger('user_id');

            $table->string('extraData');
            $table->timestamps();

            $table->foreign('prospect_id')->references('id')->on('ji_prospects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('ji_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_dates');
    }
}
