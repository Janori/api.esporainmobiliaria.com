<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeFieldToBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->enum('type', [
                'Casas',
                'Departamentos',
                'Oficinas',
                'Terrenos',
                'Edificios',
                'Parques industriales',
                'Plantas industriales',
                'Hoteles',
                'Ranchos',
                'Haciendas y quintas/Granjas',
                'Predio rustico'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
