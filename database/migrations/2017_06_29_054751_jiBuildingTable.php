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
        Schema::create('ji_buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('land_id')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->unsignedInteger('office_id')->nullable();
            $table->unsignedInteger('house_id')->nullable();

            $table->string('extraData');
            $table->timestamps();

            $table->foreign('land_id')->references('id')->on('ji_lands')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('ji_warehouses')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('ji_offices')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('ji_housings')->onDelete('cascade');
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
