<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriacaTabelaProdutofinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtofinal', function (Blueprint $table) {

            $table->bigIncrements('pfi_id');
            $table->string('pfi_tipo',50);
            $table->string('pfi_estampa',10);
            $table->string('pfi_molde',10);
            $table->string('pfi_tamanho',3)->nullable();
            $table->string('pfi_cor',30)->nullable();
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
        Schema::dropIfExists('produtofinal');
    }
}
