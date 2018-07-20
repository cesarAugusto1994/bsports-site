<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class MenuCategorias extends Model
{
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function categoriaId()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
