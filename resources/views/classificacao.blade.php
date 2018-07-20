@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .team-box .player-name {
        padding: 35px 0 0 35px;
      }

    </style>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>Calendário Partidas</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>Calendário Partidas</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

    <!--Ticket Listing Page Start-->
    <div class="ticket-listing">
        <div class="container">
            <div class="row">
              <div class="col-md-3">
                  <div class="sidebar-search-widget">

                      <div class="side-title">
                          <h3>Pesquisa</h3>
                          <p>Informe a Categoria</p>
                      </div>
                      <form method="get" action="?">
                      <ul class="search-form">
                          <li>
                              <div class="input-group">
                                <select name="category">
                                    <option value="">Categoria</option>
                                    @foreach(\App\Models\Categoria::where('tipo', 'Simples')->orderBy('tipo')->get() as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-angle-down"></i> </div>
                          </li>

                          <li>
                              <div class="input-group">
                                <input class="form-control" name="jogador" type="text" placeholder="Jogador"/>
                                <i class="fa fa-angle-down"></i>
                              </div>
                          </li>

                          <li>
                              <input type="submit" class="submit" value="Pesquisar">
                          </li>
                      </ul>
                      <form>
                  </div>
              </div>
                <div class="col-md-9">

                  <div class="team-page">
                      <div class="row">
                        @foreach($ranking as $posicao)
                          <!--Team Box Start-->
                          <div class="col-md-4">
                              <div class="team-box">
                                  <div class="player-name">
                                      <p>{{ $posicao['categoria_nome'] }}
                                          <br>
                                          <strong class="name">{{ $posicao['primeiro_nome'] }}</strong>
                                          <br> {{ $posicao['pontos'] }} </p>
                                      <strong class="player-number">#{{ $posicao['posicao'] }}</strong> </div>
                                  <a href="{{route('jogador', ['slug'=> str_slug($posicao['nome']), 'id' => $posicao['id']])}}" class="readmore">+</a> </div>
                          </div>
                          <!--Team Box End-->
                        @endforeach
                      </div>
                      <div class="row">
                          <div class="techlinqs-pagination text-center">{{ $ranking->appends($_GET)->links() }}</div>
                      </div>
                  </div>

                </div>

            </div>
        </div>
    </div>
    <!--Ticket Listing Page End-->

</div>

@endsection
