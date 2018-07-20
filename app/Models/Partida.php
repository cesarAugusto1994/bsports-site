<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;
use App\Models\Torneio\Resultado;
use App\Models\Quadras;

class Partida extends Model
{
    protected $dates = ['data'];

    public function jogadores()
    {
        return $this->hasMany(Jogador::class, 'partida_id');
    }

    public function resultado()
    {
        return $this->hasMany(Resultado::class, 'partida_id');
    }

    public function quadra()
    {
        return $this->belongsTo(Quadras::class, 'quadra_id');
    }
}
