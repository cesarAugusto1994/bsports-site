<?php

namespace App\Models\Torneio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;
use App\Models\Partida;

class Resultado extends Model
{
    protected $table = 'partida_resultados';

    protected $dates = ['data'];

    public function jogador()
    {
        return $this->belongsTo(Jogador::class, 'jogador_id');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }
}
