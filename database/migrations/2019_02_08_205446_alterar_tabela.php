<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima_compra', function (Blueprint $table) {

            $table->dropForeign('mtc_mpr_id');
            $table->dropColumn('mtc_mpr_id');


            $table->unsignedBigInteger('mtc_tec_id')->after('mtc_quantidade');
            $table->unsignedBigInteger('mtc_cor_id')->after('mtc_tec_id');

            $table->foreign('mtc_tec_id')->references('tec_id')->on('tecido');
            $table->foreign('mtc_cor_id')->references('cor_id')->on('cor');


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
            //
        });
    }
}
