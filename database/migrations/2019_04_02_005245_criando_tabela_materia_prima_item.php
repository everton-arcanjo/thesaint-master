<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaMateriaPrimaItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_prima_item', function (Blueprint $table) {

            $table->engine="innoDB";

            $table->bigIncrements('mpi_id');
            $table->unsignedBigInteger('mpi_mtc_id');
            $table->unsignedBigInteger('mpi_tec_id');
            $table->unsignedBigInteger('mpi_cor_id');
            $table->unsignedBigInteger('mpi_for_id');
            $table->smallInteger('mpi_prazo');
            $table->date('mpi_data_previsao');
            $table->double('mtc_quantidade',8,2);

            $table->foreign('mpi_mtc_id')->references('mtc_id')->on('materia_prima_compra');
            $table->foreign('mpi_tec_id')->references('tec_id')->on('tecido');
            $table->foreign('mpi_cor_id')->references('cor_id')->on('cor');
            $table->foreign('mpi_for_id')->references('for_id')->on('fornecedor');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_prima_item');
    }
}
