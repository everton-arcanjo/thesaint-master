<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunaValor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedido_produto', function (Blueprint $table) {
            $table->double('ppr_valor_unitario',15,2)->after('ppr_qtd_gg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_produto', function (Blueprint $table) {
            $table->removeColumn('ppr_valor_unitario');
        });
    }
}
