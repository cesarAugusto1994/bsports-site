<?php

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          'empresa-nome' => 'BSPORTS',
          'empresa-nome2' => 'B.Sports Tennis & Fitness ',
          'empresa-sobre' => '',
          'empresa-email' => 'bsports@bsports.com.br',
          'empresa-telefone' => '(11) 3871.9555',
          'empresa-endereco' => 'Rua Dona Ana Pimentel, 272 - Perdizes - São Paulo/SP',
          'empresa-horario-funcionamento' => 'Todos os dias',
          'empresa-facebook' => '',
          'empresa-twitter' => '',
          'empresa-google' => '',
          'empresa-vimeo' => '',
          'empresa-linkedin' => '',
          'empresa-youtube' => '',
          'empresa-banner-principal-texto' => 'Propaganda',
          'empresa-banner-principal-link' => '#',
          'empresa-banner-principal-imagem' => 'holder.js/275x500',
          'categorias-home' => true,
          'pagina-regulamento' => '/',
        ];

        foreach ($itens as $key => $item) {
            $config = new Config();
            $config->key = $key;
            $config->value = $item;
            $config->save();
        }
    }
}
