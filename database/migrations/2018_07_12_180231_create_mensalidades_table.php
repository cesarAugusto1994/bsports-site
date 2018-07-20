<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_mensalidade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('label')->unique();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::create('mensalidades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jogador_id');
            $table->foreign('jogador_id')->references('id')->on('jogadores');
            $table->string('referencia')->unique();
            $table->string('mes');
            $table->float('valor');
            $table->date('vencimento');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status_mensalidade');
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
        Schema::dropIfExists('mensalidades');
        Schema::dropIfExists('status_mensalidade');
    }
}
