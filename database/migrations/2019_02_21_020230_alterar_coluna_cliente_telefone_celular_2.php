<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarColunaClienteTelefoneCelular2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cliente_contato', function (Blueprint $table) {
            $table->string('cco_celular',18)->nullable()->after('cco_telefone_comercial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente_contato', function (Blueprint $table) {
            //
        });
    }
}
