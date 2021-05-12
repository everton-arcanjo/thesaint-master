<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaMolde extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('molde', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('mol_id');
            $table->string('mol_codigo',30)->nullable();
            $table->string('mol_molde',30);
            $table->double('mol_consumo', 15, 5);
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
        Schema::dropIfExists('molde');
    }
}
