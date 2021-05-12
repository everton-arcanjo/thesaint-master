<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('cli_id');
            $table->string('cli_cnpj',14);
            $table->string('cli_razao_social',50);
            $table->string('cli_nome_fantasia',50)->nullable();
            $table->string('cli_inscricao_estadual',15)->nullable();
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
        Schema::dropIfExists('cliente');
    }
}
