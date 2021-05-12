<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunaTecido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tecido', function (Blueprint $table) {

            $table->enum('tec_unidade',['MT','GR','KG'])->default('GR')->after('tec_tecido');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tecido', function (Blueprint $table) {

            $table->dropColumn('tec_unidade');

        });
    }
}
