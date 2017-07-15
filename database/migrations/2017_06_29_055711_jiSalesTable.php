<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('sale_date');
            $table->decimal('amount', 12, 2);
            $table->unsignedInteger('customer_id');

            $table->string('extraData');
            $table->timestamps();

            $table->foreign('building_id')->references('id')->on('ji_buildings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('ji_users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('ji_customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_sales');
    }
}