<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa\Jogador;

class JogadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogadores = Jogador::take(30)->get();

        return view('admin.jogadores.index', compact('jogadores'));
    }

    public function show($slug, $id)
    {
        $jogador = Jogador::findOrFail($id);

        //$resultados = $jogador->partidas->first();

        #dd($jogador->resultados);

        #dd($resultados);

        return view('jogador', compact('jogador'));
    }

    public function toAjax(Request $request)
    {
        $data = $request->request->all();

        $search = $data['search'];

        $user = \Auth::user();

        $jogadores = \App\Models\Pessoa::where('nome', 'like', "%$search%")->get();

        return $jogadores->toJson();
    }


}
