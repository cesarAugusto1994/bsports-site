<?php

use Illuminate\Database\Seeder;

class PontuacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [

          [1,'Vitória',1000],
          [2,'Vitória sobre jogadores classificados de 01 à 05',9],
          [3,'Vitória sobre jogadores classificados de 06 à 10' ,7],
          [4,'Vitória sobre jogadores classificados de 11 à 15',5],
          [5,'Vitória sobre jogadores classificados de 16 à 20',3],
          [6,'Vitória sobre jogadores classificados em qualquer posição de categorias acima',11],
          [7,'Derrota por W.O.','-10']

        ];
    }
}
