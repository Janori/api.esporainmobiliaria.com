<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JiDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ji_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filePath', 1024);
            $table->unsignedInteger('customer_id');
            $table->string('kind', 100);
            $table->string('name', 255);

            $table->string('extraData');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('ji_customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ji_documents');
    }
}
