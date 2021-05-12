<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_produto_modelo', function (Blueprint $table) {

            $table->unsignedBigInteger('tpm_tpr_id')->after('tpm_modelo');
            $table->foreign('tpm_tpr_id')->references('tpr_id')->on('tipo_produto');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_produto_modelo', function (Blueprint $table) {
            $table->dropForeign('tpm_tpr_id');
            $table->dropColumn('tpm_tpr_id');
        });
    }
}
