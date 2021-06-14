<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuarioTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('usu_id');
            $table->string('usu_nome',50);
            $table->string('usu_cpf',15)->nullable();
            $table->string('usu_matricula',50)->nullable();
            $table->string('usu_telefone',25)->nullable();
            $table->string('usu_celular',25)->nullable();
            $table->string('usu_email',255)->nullable();
            $table->string('usu_login',25);
            $table->string('usu_senha',25);
            $table->date('usu_data_nascimento')->nullable();
            $table->unsignedBigInteger('cli_dep_id');
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
        Schema::dropIfExists('usuario');
    }
}
