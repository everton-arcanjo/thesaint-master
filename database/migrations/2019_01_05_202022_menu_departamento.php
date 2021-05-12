<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuDepartamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_departamento', function (Blueprint $table) {

            $table->engine="innoDB";

            $table->bigIncrements('mdp_id');
            $table->unsignedBigInteger('mdp_mnu_id');
            $table->unsignedBigInteger('mdp_dep_id');
            $table->foreign('mdp_mnu_id')->references('mnu_id')->on('menu');
            $table->foreign('mdp_dep_id')->references('dep_id')->on('departamento');
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
        Schema::dropIfExists('menu_departamento');
    }
}
