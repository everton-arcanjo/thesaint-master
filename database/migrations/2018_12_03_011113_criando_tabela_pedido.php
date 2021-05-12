<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('ped_id');
            $table->string('ped_numero_pedido',30);
            $table->date('ped_data_pedido');
            $table->date('ped_data_previsao');
            $table->enum('ped_forma_entrega',['LU','2L','3L'])->nullable();
            $table->enum('ped_forma_pagamento',['1','2','3','4','5', '6'])->nullable();
            $table->text('ped_observacao')->nullable();
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
        Schema::dropIfExists('pedido');
    }
}
