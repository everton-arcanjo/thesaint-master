<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelaEstoqueProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_produto', function (Blueprint $table) {

            $table->engine="innoDB";
            $table->bigIncrements('epr_id');
            $table->unsignedInteger('epr_qtd_minima_pp')->default(0);
            $table->unsignedInteger('epr_qtd_maxima_pp')->default(0);
            $table->unsignedInteger('epr_qtd_estoque_pp')->default(0);
            $table->unsignedInteger('epr_qtd_minima_p')->default(0);
            $table->unsignedInteger('epr_qtd_maxima_p')->default(0);
            $table->unsignedInteger('epr_qtd_estoque_p')->default(0);
            $table->unsignedInteger('epr_qtd_minima_m')->default(0);
            $table->unsignedInteger('epr_qtd_maxima_m')->default(0);
            $table->unsignedInteger('epr_qtd_estoque_m')->default(0);
            $table->unsignedInteger('epr_qtd_minima_g')->default(0);
            $table->unsignedInteger('epr_qtd_maxima_g')->default(0);
            $table->unsignedInteger('epr_qtd_estoque_g')->default(0);
            $table->unsignedInteger('epr_qtd_minima_gg')->default(0);
            $table->unsignedInteger('epr_qtd_maxima_gg')->default(0);
            $table->unsignedInteger('epr_qtd_estoque_gg')->default(0);
            $table->unsignedBigInteger('epr_pca_id');
            $table->foreign('epr_pca_id')->references('pca_id')->on('produto_caracteristica');
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
        Schema::dropIfExists('estoque_produto');
    }
}
