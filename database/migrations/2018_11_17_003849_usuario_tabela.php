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
            $table->string('cli_nome',50);
            $table->string('cli_cpf',15);
            $table->string('cli_matricula',50)->nullable();
            $table->string('cli_telefone',25);
            $table->string('cli_email',255)->nullable();
            $table->string('cli_login',25);
            $table->string('cli_senha',25);
            $table->date('cli_data_nascimento')->nullable();
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
