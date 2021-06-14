<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarNovaFkTabelaProdutoPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedido_produto', function (Blueprint $table) {
            $table->unsignedBigInteger('ppr_pca_id')->after('ppr_ped_id');
            $table->foreign('ppr_pca_id')->references('pca_id')->on('produto_caracteristica');
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

            $table->dropForeign('ppr_pca_id');
            $table->dropColumn('ppr_pca_id');
        });
    }
}
