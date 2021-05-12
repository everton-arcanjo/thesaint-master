<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarColunaProdutoCaracteristica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produto_caracteristica', function (Blueprint $table) {
            $table->char('pca_cor',30)->after('pca_tecido');

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
            $table->dropColumn('pca_cor');

        });
    }
}
