<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaPrimaComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_prima_compra', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('mtc_id');
            $table->date('mtc_data');
            $table->unsignedBigInteger('mtc_for_id')->nullable();
            $table->smallInteger('prazo');
            $table->date('mtc_data_previsao');
            $table->unsignedBigInteger('mtc_mpr_id');
            $table->foreign('mtc_mpr_id')->references('mpr_id')->on('materia_prima');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_prima_compras');
    }
}
