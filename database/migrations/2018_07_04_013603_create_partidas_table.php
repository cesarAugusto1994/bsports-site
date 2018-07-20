<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('torneio_id');
            $table->unsignedInteger('quadra_id');

            $table->foreign('torneio_id')->references('id')->on('torneios');
            $table->foreign('quadra_id')->references('id')->on('quadras');

            $table->time('horario')->nullable();
            $table->date('data')->nullable();

            $table->enum('tipo_jogo', ['Simples', 'Duplas'])->default('Simples');
            $table->string('semana')->nullable();

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
        Schema::dropIfExists('partidas');
    }
}
