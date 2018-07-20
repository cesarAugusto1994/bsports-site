<?php

namespace App\Models\Jogador;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa\Jogador;
use App\Models\Mensalidade\Status;
use App\Models\Pessoa;

class Mensalidade extends Model
{
    protected $dates = ['vencimento'];

    public function jogador()
    {
        return $this->belongsTo(Jogador::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
