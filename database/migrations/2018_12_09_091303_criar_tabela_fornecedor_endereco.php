<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaFornecedorEndereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor_endereco', function (Blueprint $table) {

            $table->engine="innoDB";

            $table->bigIncrements('fen_id');
            $table->string('fen_cep',10);
            $table->string('fen_endereco',80);
            $table->integer('fen_numero');
            $table->string('fen_complemento',20)->nullable();
            $table->string('fen_bairro',30)->nullable();
            $table->string('fen_cidade',30)->nullable();
            $table->char('fen_estado',2)->nullable();
            $table->unsignedBigInteger('fen_for_id');
            $table->foreign('fen_for_id')->references('for_id')->on('fornecedor');
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
        Schema::dropIfExists('fornecedor_endereco');
    }
}
