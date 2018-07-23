<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pessoa, Partida, Semana, Categoria, Pagina};
use App\Models\Pessoa\{Jogador, Telefone};
use App\Models\Torneio\Resultado;
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};
use Illuminate\Support\Collection;
use App\{User, Role};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Pessoa::count() == 0) {
            $this->importJogadores();
        }

        if(Partida::count() == 0) {
            $this->importPartidas();
        }

        if(Resultado::count() == 0) {
            $this->importResultados();
        }

        if(Semana::count() == 0) {
            $this->importSemanas();
        }

        if(Pagina::count() == 0) {
            $this->importPaginas();
        }

        $id = 1;

        if($request->has('category')) {
            $id = $request->get('category');
        }

        $sql = "select
                jg.id,
                pe.nome,
                categoria_simples_id categoria,
                sum(pontos) - SUM(bonus) as pontos,
                '' link,
                '' url
                from partida_resultados res
                inner join jogadores jg ON(jg.id = res.jogador_id)
                inner join pessoas pe ON(pe.id = jg.pessoa_id)
                where jg.categoria_simples_id = ?
                group by jg.id, pe.nome, jg.categoria_simples_id
                order by pontos DESC
                limit 5";

        $resultado = \DB::select($sql, [$id]);

        $ranking = [];

        foreach ($resultado as $key => $item) {

          $nomeArray = explode(" ", $item->nome);

          $primeiroNome = $nomeArray[0] ?? "";
          $ultimoNome = $nomeArray[1] ?? "";

          $ranking[] = [
            "id" => $item->id,
            "primeiro_nome" => $primeiroNome,
            "ultimo_nome" => $ultimoNome,
            "categoria" => $item->categoria,
            "pontos" => $item->pontos,
            "link" => $item->link,
            "url" => $item->url
          ];
        }

        return view('home', compact('ranking'));
    }

    public function classificacao(Request $request)
    {
        $data = $request->request->all();

        $page = $request->page;

        $id = 1;

        $jogador = null;

        if($request->has('category') && !empty($request->get('category'))) {
            $id = $request->get('category');
        }

        if($request->has('jogador') && !empty($request->get('jogador'))) {
            $jogador = $request->get('jogador');
        }

        $sql = "select
                jg.id,
                pe.nome,
                categoria_simples_id categoria,
                ca.nome categoria_nome,
                sum(pontos) as pontos,
                '' link,
                '' url
                from partida_resultados res
                inner join jogadores jg ON(jg.id = res.jogador_id)
                inner join pessoas pe ON(pe.id = jg.pessoa_id)
                inner join categorias ca ON(ca.id = jg.categoria_simples_id)
                where jg.categoria_simples_id = ?
                ";

        if($jogador) {
          $sql .= " AND pe.nome like '%$jogador%' ";
        }

        $sql .= "group by jg.id, pe.nome, jg.categoria_simples_id
        order by pontos DESC";

        $resultado = \DB::select($sql, [$id]);

        $ranking = [];

        $items = new Collection();

        foreach ($resultado as $key => $item) {

          $nomeArray = explode(" ", $item->nome);

          $primeiroNome = $nomeArray[0] ?? "";
          $ultimoNome = $nomeArray[1] ?? "";

          $ranking[$key] = [
            "id" => $item->id,
            "nome" => $item->nome,
            "primeiro_nome" => $primeiroNome,
            "ultimo_nome" => $ultimoNome,
            "categoria" => $item->categoria,
            "categoria_nome" => $item->categoria_nome,
            "pontos" => $item->pontos,
            "posicao" => $key+1,
            "link" => $item->link,
            "url" => $item->url
          ];

          $items->push($ranking[$key]);

        }

        $perPage = 15;

        $ranking = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path'  => $request->url(),'query' => $request->query(),]);

        return view('classificacao', compact('ranking'));
    }

    public function contato()
    {
        return view('contato');
    }

    public function importJogadores()
    {
        $file = file_get_contents(storage_path('app/data/jogadors.json'));

        $registros = json_decode($file, true);

        //abort(404);

        #dd($registros);

        foreach ($registros as $key => $data) {

            //echo $key . '<br/>';

            if(empty($data['ds_email'])){
              $data['ds_email'] = 'mail@mail.com';
            }

            $pessoa = new Pessoa();
            $pessoa->id = $data['id'];
            $pessoa->nome = $data['nm_jogador'];
            $pessoa->nascimento = $data['dt_nascimento'];
            $pessoa->email = $data['ds_email'];
            $pessoa->save();

            $jogador = new Jogador();
            $jogador->id = $data['id'];
            $jogador->lateralidade = $data['ds_lateralidade'];
            $jogador->categoria_simples_id = $data['categoria_simples_id'];
            $jogador->categoria_duplas_id = $data['categoria_duplas_id'];
            $jogador->participa_duplas = $data['ic_participacao_duplas'] ?? false;
            $jogador->participa_simples = $data['ic_participacao_simples'] ?? false;
            $jogador->observacao = $data['ds_observacao'] ?? '';
            $jogador->pessoa_id = $pessoa->id;
            $jogador->save();

            $hasUser = \DB::table('users')->where([
              'email' => $data['ds_email'],
            ])->get();

            if($hasUser->isEmpty()) {

              $user = User::create([
                  'name' => $data['nm_jogador'],
                  'email' => $data['ds_email'],
                  'password' => bcrypt($data['ds_senha'] ?? 123),
              ]);

              \DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => 2
              ]);

            }

            $telefones = [];

            if(!empty($data['nr_telefone'])) {
               array_push($telefones, $data['nr_telefone']);
            }

            if(!empty($data['nr_telefone2'])) {
               array_push($telefones, $data['nr_telefone2']);
            }

            foreach ($telefones as $key => $item) {

              $item = intval($item);

              if(is_null($item) || empty($item)) {
                  continue;
              }

              $telefone = new Telefone();
              $telefone->pessoa_id = $pessoa->id;
              $telefone->numero = $item;
              $telefone->save();

            }

        }

    }

    public function importPartidas()
    {
        $file = file_get_contents(storage_path('app/data/partidas.json'));

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {

            $partida = new Partida();
            $partida->id = $data['id'];
            $partida->torneio_id = $data['torneio_id'];
            $partida->quadra_id = $data['campo_id'];
            $partida->horario = $data['hr_partida'];
            $partida->data = $data['dt_partida'];
            $partida->tipo_jogo = $data['ds_tipo_jogo'];
            $partida->semana = $data['ds_semana'];
            $partida->save();

        }
    }

    public function importResultados()
    {
        $file = file_get_contents(storage_path('app/data/resultados.json'));

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {

            $resultado = new Resultado();
            $resultado->id = $data['id'];
            $resultado->jogador_id = $data['jogador_id'];
            $resultado->partida_id = $data['partida_id'];
            $resultado->resultado_final = $data['nr_resultado_final'] ?? 0;
            $resultado->set1 = $data['nr_set1'] ?? 0;
            $resultado->set2 = $data['nr_set2'] ?? 0;
            $resultado->set3 = $data['nr_set3'] ?? 0;
            $resultado->tiebreak = $data['nr_tiebreak'] ?? 0;
            $resultado->vitoria_wo = $data['ic_vitoria_wo'] ?? 0;
            $resultado->desistencia = $data['ic_desistencia'] ?? 0;
            $resultado->pontos = $data['nr_pontos'] ?? 0;
            $resultado->bonus = $data['nr_bonus'] ?? 0;
            $resultado->computado = $data['ic_computado'] ?? 1;
            $resultado->save();

        }
    }

    public function importSemanas()
    {
        $file = file_get_contents(storage_path('app/data/semanas.json'));

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {

            $resultado = new Semana();
            $resultado->id = $data['id'];
            $resultado->jogador_id = $data['jogador_id'];
            $resultado->torneio_id = $data['torneio_id'];
            $resultado->semana = $data['ds_semana'] ?? 0;
            $resultado->pontos = $data['nr_pontos'] ?? 0;
            $resultado->bonus = $data['nr_bonus'] ?? 0;
            $resultado->save();

        }
    }

    public function importPaginas()
    {
        $file = file_get_contents(storage_path('app/data/paginas.json'));

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {
            $resultado = new Pagina();
            $resultado->id = $data['id'];
            $resultado->titulo = $data['ds_titulo'];
            $resultado->conteudo = $data['ds_pagina'];
            $resultado->save();
        }
    }
}
