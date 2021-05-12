<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarNovosCampos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima_compra', function (Blueprint $table) {
            $table->enum('mtc_movimento',['E','S'])->default('E')->after('mtc_data');
            $table->double('mtc_quantidade',8,2)->after('mtc_data_previsao');
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
            $table->dropColumn(['mtc_movimento','mtc_movimento']);
        });
    }
}
