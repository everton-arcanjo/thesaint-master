<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaPedidoProdudo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produto', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('ppr_id');
            $table->smallInteger('ppr_qtd_pp');
            $table->smallInteger('ppr_qtd_p');
            $table->smallInteger('ppr_qtd_m');
            $table->smallInteger('ppr_qtd_g');
            $table->smallInteger('ppr_qtd_gg');
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
        Schema::dropIfExists('pedido_produto');
    }
}
