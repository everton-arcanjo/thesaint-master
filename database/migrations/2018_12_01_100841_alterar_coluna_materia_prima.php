<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarColunaMateriaPrima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima', function (Blueprint $table) {
            $table->double('mpr_qtd_minima_estoque', 15, 5)->nullable()->after('mpr_material');
            $table->unsignedBigInteger('mpr_cor_id')->nullable()->after('mpr_qtd_minima_estoque');
            $table->foreign('mpr_cor_id')->references('cor_id')->on('cor');
            $table->dropColumn('mpr_cor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materia_prima', function (Blueprint $table) {
            $table->string('mpr_cor',25);
            $table->dropForeign('mpr_cor_id');
            $table->dropColumn(['mpr_cor_id','mpr_qtd_minima_estoque']);
        });
    }
}
