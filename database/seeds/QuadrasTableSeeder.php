<?php

use Illuminate\Database\Seeder;
use App\Models\Quadras;

class QuadrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          [1,	'Quadra 1 - BSports'],
          [2,	'Quadra 2 - BSports'],
          [3,	'Quadra 3 - BSports'],
          [4,	'Quadra 4 - Monte Carlos'],
          [5,	'Quadra 5 - Monte Carlos'],
          [6,	'Quadra 6 - Monte Carlos'],
          [7,	'Beach Tennis - Monte Carlos']
        ];

        foreach ($itens as $key => $item) {
            $quadra = new Quadras();
            $quadra->nome = $item[1];
            $quadra->save();
        }


    }
}
