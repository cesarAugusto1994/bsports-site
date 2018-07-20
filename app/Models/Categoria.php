<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;

class Categoria extends Model
{
    public function jogadores()
    {
        return $this->hasMany(Jogador::class, 'categoria_simples_id');
    }
}
