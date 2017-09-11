<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('img_path')->nullable();
            $table->rememberToken();

            $table->string('first_surname', 30)->nullable();
            $table->string('last_surname', 30)->nullable();
            $table->char('gender', 1)->default('x');
            $table->char('mariage_status', 1)->default('x');
            $table->string('address', 80)->nullable();
            $table->char('kind', 1)->default('x');
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();

            $table->string('colonia', 30)->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('municipio', 30)->nullable();
            $table->string('estado', 30)->nullable();
            $table->string('pais', 30)->nullable();

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
