<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_warehouses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_new');
            $table->float('build_surface');
            $table->date('building_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_warehouses');
    }
}
