<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunarNovas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima', function (Blueprint $table) {

            $table->unsignedBigInteger('mpr_tec_id')->after('mpr_qtd_minima_estoque');
            $table->foreign('mpr_tec_id')->references('tec_id')->on('tecido');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materia_prima', function (Blueprint $table) {

        });
    }
}
