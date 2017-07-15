<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('user_id');
            $table->boolean('active');

            $table->string('extraData');
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('ji_locations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('ji_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_branches');
    }
}
