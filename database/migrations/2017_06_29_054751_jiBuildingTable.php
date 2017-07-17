<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiBuildingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('land_id')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->unsignedInteger('office_id')->nullable();
            $table->unsignedInteger('house_id')->nullable();

            $table->string('extra_data');
            $table->timestamps();

            $table->foreign('land_id')->references('id')->on('lands')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('housings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_buildings');
    }
}
