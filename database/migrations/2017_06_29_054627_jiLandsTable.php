<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('lands', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('for_sale');
            $table->unsignedInteger('location_id');
            $table->decimal('price', 12, 2);
            $table->float('surface');
            $table->decimal('predial_cost', 12,2);
            
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_lands');
    }
}
