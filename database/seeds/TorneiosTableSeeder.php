<?php

use Illuminate\Database\Seeder;
use App\Models\Torneio;

class TorneiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          [1,'Torneio 1',10,0],
          [2,'Ranking 1° semestre 2015',15,0],
          [3,'Ranking  2º Semestre 2015',12,0],
          [4,'Ranking 1º Semestre 2016',12,0],
          [6,'Ranking  2º Semestre 2016',12,0],
          [7,'Ranking 1º Semestre 2017',12,0],
          [9,'Ranking  2º semestre 2017',12,0],
          [10,'Ranking 1º Semestre 2018',12,0],
          [11,'Ranking 2º Semestre 2018',12,1]
        ];

        foreach ($itens as $key => $item) {
            $torneio = new Torneio();
            $torneio->id = $item[0];
            $torneio->nome = $item[1];
            $torneio->partidas = $item[2];
            $torneio->ativo = $item[3];
            $torneio->save();
        }
    }
}
