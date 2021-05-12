<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionandoColunaFkPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedido_produto', function (Blueprint $table) {

            $table->unsignedBigInteger('ppr_ped_id')->after('ppr_mol_id');
            $table->foreign('ppr_ped_id')->references('ped_id')->on('pedido');

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
            $table->dropForeign('ppr_ped_id');
            $table->dropColumn('ppr_ped_id');
        });
    }
}
