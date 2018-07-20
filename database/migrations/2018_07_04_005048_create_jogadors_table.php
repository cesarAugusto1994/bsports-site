<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa_id')->unique();
            $table->string('lateralidade')->nullable();
            $table->boolean('ativo')->default(true);
            $table->integer('categoria_simples_id')->nullable();
            $table->integer('categoria_duplas_id')->nullable();
            $table->boolean('participa_simples')->default(true);
            $table->boolean('participa_duplas')->default(false);
            $table->text('observacao')->nullable();
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
        Schema::dropIfExists('jogadores');
    }
}
