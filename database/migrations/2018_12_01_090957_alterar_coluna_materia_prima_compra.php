<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarColunaMateriaPrimaCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima_compra', function (Blueprint $table) {
            $table->dropColumn('mtc_movimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materia_prima_compra', function (Blueprint $table) {
            $table->enum('mtc_movimento',['E','S'])->default('E')->after('mtc_data');
        });
    }
}
