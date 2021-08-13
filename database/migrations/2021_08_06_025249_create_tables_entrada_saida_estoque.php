<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesEntradaSaidaEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('estoque', function(Blueprint $table){
            $table->id();
            $table->integer('quantidade');
            $table->unsignedBigInteger('produto_id')->unique();
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->unsignedBigInteger('estoque_id');
            $table->timestamps();

            $table->foreign('estoque_id')->references('id')->on('estoque');
        });
        
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->unsignedBigInteger('estoque_id');
            $table->timestamps();

            $table->foreign('estoque_id')->references('id')->on('estoque');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saidas', function(Blueprint $table){
            $table->dropForeign('saidas_estoque_id_foreign');
        });
        Schema::dropIfExists('saidas');
        
        Schema::table('entradas', function(Blueprint $table){
            $table->dropForeign('entradas_estoque_id_foreign');
        });
        Schema::dropIfExists('entradas');

        Schema::table('estoque', function(Blueprint $table){
            $table->dropForeign('estoque_produto_id_foreign');
        });
        Schema::dropIfExists('estoque');
    }
}
