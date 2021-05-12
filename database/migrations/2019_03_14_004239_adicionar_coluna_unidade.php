<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunaUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('molde', function (Blueprint $table) {

            $table->enum('mol_unidade',['MT','GR','KG'])->default('GR')->after('mol_consumo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('molde', function (Blueprint $table) {

            $table->dropColumn('mol_unidade');
        });
    }
}
