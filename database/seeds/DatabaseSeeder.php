<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriasTableSeeder::class);
        $this->call(QuadrasTableSeeder::class);
        $this->call(TorneiosTableSeeder::class);
        $this->call(PontuacoesTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
    }
}
