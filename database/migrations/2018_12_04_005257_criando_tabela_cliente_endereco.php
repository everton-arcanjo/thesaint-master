<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaClienteEndereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_endereco', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('cen_id');
            $table->string('cen_cep', 25);
            $table->string('cen_endereco',80);
            $table->integer('cen_numero');
            $table->string('cen_complemento',20)->nullable();
            $table->string('cen_bairro',30)->nullable();
            $table->string('cen_cidade',30)->nullable();
            $table->char('cen_estado',2)->nullable();
            $table->unsignedBigInteger('cen_cli_id');
            $table->foreign('cen_cli_id')->references('cli_id')->on('cliente');
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
        Schema::dropIfExists('cliente_endereco');
    }
}
