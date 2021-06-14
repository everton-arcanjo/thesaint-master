<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaProdutoCaracteristica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_caracteristica', function (Blueprint $table) {
            $table->bigIncrements('pca_id');
            $table->string('pca_codigo',45);
            $table->string('pca_molde',45);
            $table->string('pca_familia',45)->nullable();
            $table->string('pca_tecido',45);
            $table->double('pca_valor', 15, 2);
            $table->unsignedBigInteger('pca_pro_id');
            $table->foreign('pca_pro_id')->references('pro_id')->on('produto');
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
        Schema::dropIfExists('produto_caracteristica');
    }
}
