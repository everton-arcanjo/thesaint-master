<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoProdutoModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_produto_modelo', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('tpm_id');
            $table->string('tpm_codigo',30)->nullable();
            $table->string('tpm_modelo',30);
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
        Schema::dropIfExists('tipo_produto_modelos');
    }
}
