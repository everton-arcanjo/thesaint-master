<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunaQtdEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_prima', function (Blueprint $table) {
            $table->double('mpr_qtd_estoque', 15, 5)->nullable()->after('mpr_qtd_minima_estoque');
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
            $table->dropColumn('mpr_qtd_estoque');
        });
    }
}
