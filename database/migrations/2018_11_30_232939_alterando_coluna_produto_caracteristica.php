<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterandoColunaProdutoCaracteristica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produto_caracteristica', function (Blueprint $table) {

            //$table->dropColumn(['pca_molde','pca_familia','pca_tecido','pca_cor']);
            $table->unsignedBigInteger('pca_mol_id')->after('pca_codigo');
            $table->unsignedBigInteger('pca_tec_id')->after('pca_mol_id');
            $table->unsignedBigInteger('pca_cor_id')->after('pca_tec_id');
            $table->foreign('pca_mol_id')->references('mol_id')->on('molde');
            $table->foreign('pca_tec_id')->references('tec_id')->on('tecido');
            $table->foreign('pca_cor_id')->references('cor_id')->on('cor');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produto_caracteristica', function (Blueprint $table) {
            $table->string('pca_molde',10);
            $table->string('pca_familia',15)->nullable();
            $table->string('pca_tecido',15);
            $table->char('pca_cor',30)->after('pca_tecido');
        });
    }
}
