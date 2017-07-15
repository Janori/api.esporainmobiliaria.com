<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiProspectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_prospects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('user_id');

            $table->string('extraData');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('ji_customers')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('ji_buildings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('ji_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_prospects');
    }
}
