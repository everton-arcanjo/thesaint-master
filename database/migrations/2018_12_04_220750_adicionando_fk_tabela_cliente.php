<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionandoFkTabelaCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedido', function (Blueprint $table) {

           $table->unsignedBigInteger('ped_cli_id')->nullable()->after('ped_observacao');
           $table->foreign('ped_cli_id')->references('cli_id')->on('cliente');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropColumn('ped_cli_id');
            $table->dropForeign('ped_cli_id');
        });
    }
}
