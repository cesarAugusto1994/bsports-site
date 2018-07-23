<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Pessoa;
use App\Models\Pessoa\Jogador;
use TCG\Voyager\Facades\Voyager;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->role_id == 1){
            return Voyager::view('voyager::index');
        }

        $pessoa = Pessoa::where('email', $user->email)->get()->first();
        $jagador = [];

        if($pessoa) {
          $jagador = Jogador::where('pessoa_id', $pessoa->id)->get()->first();
        }

        return view('jogador.index')->with('jogador', $jagador);
    }

    public function perfil()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('jogador.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();
        dd($data);
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        //$user->avatar = $data['avatar'];
        if($data['password']) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        $pessoa = Pessoa::where('email', $data['name'])->get();

        if($pessoa->isNotEmpty()) {
          $pessoa->nome = $data['name'];
          $pessoa->email = $data['email'];
          $pessoa->save();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
