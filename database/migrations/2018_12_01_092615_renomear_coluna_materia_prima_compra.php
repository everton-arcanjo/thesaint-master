<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenomearColunaMateriaPrimaCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima_compra', function (Blueprint $table) {
            $table->renameColumn('mtc_lote', 'mtc_numero_pedido');
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
            $table->renameColumn('mtc_numero_pedido', 'mtc_lote');
        });
    }
}
