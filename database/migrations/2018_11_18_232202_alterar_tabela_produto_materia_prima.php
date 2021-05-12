<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarTabelaProdutoMateriaPrima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtofinal_materiaprima', function (Blueprint $table) {
            $table->char('pmp_unidade',2)->after('pmp_peso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtofinal_materiaprima', function (Blueprint $table) {
            $table->dropColumn('pmp_unidade');
        });
    }
}
