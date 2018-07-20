<?php

namespace App\Models\Pessoa;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneio\Resultado;
use App\Models\{Categoria, Pessoa, Partida};

class Jogador extends Model
{
    protected $table = 'jogadores';

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'jogador_id');
    }

    public function partidas()
    {
        return $this->hasManyThrough(Resultado::class, Partida::class, 'jogador_id', 'partida_id', 'id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_simples_id');
    }
}
