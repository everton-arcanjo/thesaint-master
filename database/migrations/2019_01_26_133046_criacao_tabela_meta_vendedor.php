<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriacaoTabelaMetaVendedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_vendedor', function (Blueprint $table) {
            $table->unsignedBigInteger('mve_id');
            $table->date('mve_data_inicio');
            $table->date('mve_data_fim');
            $table->double('mve_valor_meta', 12, 2);
            $table->unsignedBigInteger('mve_usu_id');
            $table->foreign('mve_usu_id')->references('usu_id')->on('usuario');
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
        Schema::dropIfExists('meta_vendedor');
    }
}
