<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semanas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('jogador_id');
            $table->unsignedInteger('torneio_id');
            $table->foreign('jogador_id')->references('id')->on('jogadores');
            $table->foreign('torneio_id')->references('id')->on('torneios');

            $table->integer('semana')->nullable();

            $table->float('pontos')->default(0);
            $table->float('bonus')->default(0);

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
        Schema::dropIfExists('semanas');
    }
}
