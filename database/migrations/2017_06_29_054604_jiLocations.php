<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('latitude', 16, 13);
            $table->decimal('longitude', 16, 13);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_locations');
    }
}
