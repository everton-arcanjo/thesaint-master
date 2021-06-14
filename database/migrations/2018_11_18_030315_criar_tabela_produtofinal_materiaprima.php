<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProdutofinalMateriaprima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtofinal_materiaprima', function (Blueprint $table) {

            $table->bigIncrements('pmp_id');
            $table->unsignedBigInteger('pmp_pfi_id');
            $table->unsignedBigInteger('pmp_mpr_id');
            $table->unsignedMediumInteger('pmp_peso');
            $table->foreign('pmp_pfi_id')->references('pfi_id')->on('produtofinal');
            $table->foreign('pmp_mpr_id')->references('mpr_id')->on('materia_prima');
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
        Schema::dropIfExists('produtofinal_materiaprima');
    }
}
