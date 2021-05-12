<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaClienteContato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_contato', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('cco_id');
            $table->string('cco_nome_contato',50);
            $table->string('cco_telefone_comercial',19);
            $table->string('cco_celular',19);
            $table->string('cco_email',50);
            $table->unsignedBigInteger('cco_cli_id');
            $table->foreign('cco_cli_id')->references('cli_id')->on('cliente');
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
        Schema::dropIfExists('cliente_contato');
    }
}
