<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteracaoTabelaMenu extends Migration
{

    public function up()
    {
        Schema::table('menu', function (Blueprint $table) {

            $table->string('mnu_icone',30)->after('mnu_pai_id')->nullable();
            $table->smallInteger('mnu_ordem')->after('mnu_icone')->nullable();
        });
    }


    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn(['mnu_icone','mnu_ordem']);
        });
    }
}
