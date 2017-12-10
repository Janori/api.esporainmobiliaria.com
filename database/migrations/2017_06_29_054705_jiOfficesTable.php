<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('offices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->float('baths');
            $table->integer('parkings');
            $table->integer('yards');
            $table->char('kind', 1)->default('x');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('offices');
    }
}
