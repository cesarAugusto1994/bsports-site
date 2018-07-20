<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partida_resultados', function (Blueprint $table) {

          $table->increments('id');

          $table->unsignedInteger('jogador_id');
          $table->unsignedInteger('partida_id');
          $table->foreign('jogador_id')->references('id')->on('jogadores');
          $table->foreign('partida_id')->references('id')->on('partidas');

          $table->smallInteger('resultado_final')->default(0);

          $table->smallInteger('set1')->default(0);
          $table->smallInteger('set2')->default(0);
          $table->smallInteger('set3')->default(0);

          $table->boolean('tiebreak')->default(false);
          $table->boolean('vitoria_wo')->default(false);
          $table->boolean('desistencia')->default(false);

          $table->integer('pontos')->default(0);
          $table->integer('bonus')->default(0);

          $table->boolean('computado')->default(true);

          $table->boolean('ativo')->default(true);

          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados');
    }
}
