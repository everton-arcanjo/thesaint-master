<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarReferenteAprovacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedido', function (Blueprint $table) {

            $table->enum('ped_status_aprovacao',['AG','AP','RE'])->default('AG')->after('ped_observacao');
            $table->longText('ped_motivo_rejeitado')->nullable()->after('ped_status_aprovacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido', function (Blueprint $table) {
            $table->dropColumn('ped_status_aprovacao');
            $table->dropColumn('ped_motivo_rejeitado');
        });
    }
}
