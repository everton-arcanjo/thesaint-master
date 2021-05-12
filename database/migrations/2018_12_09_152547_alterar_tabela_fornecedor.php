<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarTabelaFornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fornecedor', function (Blueprint $table) {

            $table->string('for_nome_fantasia',150)->nullable()->after('for_razao_social');
            $table->string('for_celular',18)->nullable()->after('for_telefone');
            $table->string('for_contato',50)->nullable()->after('for_cnpj');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fornecedor', function (Blueprint $table) {
            $table->dropColumn(['for_nome_fantasia','for_celular','for_contato']);
        });
    }
}
