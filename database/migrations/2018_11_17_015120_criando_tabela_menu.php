<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriandoTabelaMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {

            $table->engine = "innoDB";

            $table->bigIncrements('mnu_id');
            $table->string('mnu_nome',50);
            $table->string('mnu_link',50);
            $table->unsignedBigInteger('mnu_dep_id');
            $table->foreign('mnu_dep_id')->references('dep_id')->on('departamento');
            $table->unsignedBigInteger('mnu_pai_id')->nullable();
            $table->foreign('mnu_pai_id')->references('mnu_id')->on('menu');
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
        Schema::dropIfExists('menu');
    }
}
