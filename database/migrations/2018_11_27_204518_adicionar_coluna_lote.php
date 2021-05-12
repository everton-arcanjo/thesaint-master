<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunaLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima_compra', function (Blueprint $table) {
            $table->string('mtc_lote',50)->after('mtc_id');
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
            $table->dropColumn('mtc_lote');
        });
    }
}
