<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname', 30);
            $table->string('sname', 30)->nullable();
            $table->string('flname', 30);
            $table->string('slname', 30)->nullable();
            $table->char('gender', 1)->default('x');
            $table->char('mstatus', 1)->default('x');
            $table->string('address', 80)->nullable();
            $table->char('kind', 1)->default('x');
            $table->string('email', 80)->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_customers');
    }
}
