<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [

          ['Masculino A',	'3',	'Simples',	1],
          ['Masculino B',	'4',	'Duplas',	1],
          ['Masculino C',	'5',	'Simples',	0],
          ['Feminino A',	3,	'Simples',	1],
          ['Feminino B',	4,	'Simples',	1],
          ['Feminino C',	5,	'Simples',	0],
          ['Master',	2,	'Simples',	1],
          ['Special',	1,	'Simples',	1],
          ['Masculino A',	2,	'Duplas',	0],
          ['Masculino B',	4,	'Simples',	0],
          ['Masculino C',	4,	'Duplas',	0],
          ['Special',	1,	'Duplas',	0],
          ['Teens',	6,	'Simples',	1]

        ];

        foreach ($itens as $key => $item) {
            $categoria = new Categoria();
            $categoria->nome = $item[0];
            $categoria->numero = $item[1];
            $categoria->tipo = $item[2];
            $categoria->ativo = $item[3];
            $categoria->save();
        }

    }
}
