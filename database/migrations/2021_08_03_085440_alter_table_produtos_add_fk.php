<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProdutosAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->unsignedBigInteger('capsula_id')->nullable();
            $table->unsignedBigInteger('peso_id')->nullable();
            $table->unsignedBigInteger('quantidade_id')->nullable();

            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('capsula_id')->references('id')->on('capsulas');
            $table->foreign('peso_id')->references('id')->on('pesos');
            $table->foreign('quantidade_id')->references('id')->on('quantidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign('produtos_tipo_id_foreign');
            $table->dropForeign('produtos_capsula_id_foreign');
            $table->dropForeign('produtos_peso_id_foreign');
            $table->dropForeign('produtos_quantidade_id_foreign');

            $table->dropColumn('tipo_id');
            $table->dropColumn('capsula_id');
            $table->dropColumn('peso_id');
            $table->dropColumn('quantidade_id');
        });
    }
}
