@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .team-box {
          background-color: #f4f4f4;
      }

    </style>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>{{ $jogador->pessoa->nome }}</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>{{ $jogador->pessoa->nome }}</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

  <div class="team-page">
      <div class="container">
          <div class="row">
              <div class="team-small-details">
                  <div class="col-md-5 col-sm-5"> <img src="holder.js/450x300" alt=""> </div>
                  <div class="col-md-7 col-sm-7">
                      <h2>{{ $jogador->pessoa->nome }}</h2>
                      <ul>
                          <li class="role">Categoria {{ $jogador->categoria->nome }}</li>
                          <li class="role">{{ $jogador->resultados->count() }} jogos</li>
                          <li class="role">{{ $jogador->resultados->sum('pontos') - $jogador->resultados->sum('bonus') }} pontos</li>
                          <li><strong>Lateralidade:</strong> {{ $jogador->lateralidade }}</li>
                          <li><strong>Nascimento:</strong> {{ $jogador->pessoa->nascimento ? $jogador->pessoa->nascimento->format('d/m/Y') : '' }} </li>
                          <!--
                          <li class="player-social"> <a href="#" class="fb-icon"><i class="fa fa-facebook"></i></a> <a href="#" class="tw-icon"><i class="fa fa-twitter"></i></a> <a href="#" class="lin-icon"><i class="fa fa-google-plus"></i></a> <a href="#" class="lin-icon"><i class="fa fa-vimeo"></i></a> <a href="#" class="lin-icon"><i class="fa fa-linkedin"></i></a> <a href="#" class="yt-icon"><i class="fa fa-youtube"></i></a> </li>
                          -->
                      </ul>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="small-txt">
                      <h2>Partidas</h2>

                      <div class="events-posts">
                        @foreach($jogador->resultados->sortByDesc('id') as $resultado)

                          <div class="event-post">
                              <div class="event-date">
                                  <h5><span>{{ $resultado->partida->data->format('M') }}</span> {{ $resultado->partida->data->format('d, Y') }}</h5>
                                  <strong>{{ $resultado->partida->horario }}</strong> </div>
                              <div class="event-content">
                                  <div class="event-txt-wrap">
                                      <div class="event-txt">
                                          <h4><a>{{ $resultado->partida->resultado->first()->jogador->pessoa->nome }} vs
                                            {{ $resultado->partida->resultado->last()->jogador->pessoa->nome }}</a></h4>
                                          <p class="loc"><i class="fa fa-map-marker"></i> {{ $resultado->partida->quadra->nome }}</p>
                                          <div class="event-box-footer">
                                            <div class="widget">
                                              <div class="social-counter">
                                                  <ul>
                                                      <li>
                                                          <a class="item twitter">
                                                            <span class="count">{{$resultado->partida->resultado->first()->set1}} x {{$resultado->partida->resultado->last()->set1}}</span>
                                                            <em>1º SET</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item ">
                                                            <span class="count">{{$resultado->partida->resultado->first()->set2}} x {{$resultado->partida->resultado->last()->set2}}</span>
                                                            <em>2º SET</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item twitter">
                                                            <span class="count">{{$resultado->partida->resultado->first()->set3}} x {{$resultado->partida->resultado->last()->set3}}</span>
                                                            <em>3º SET</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item ">
                                                            <span class="count">{{$resultado->partida->resultado->first()->resultado_final}} x {{$resultado->partida->resultado->last()->resultado_final}}</span>
                                                            <em>SETS</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item twitter">
                                                            <span class="count">{{$resultado->partida->resultado->first()->pontos}} x {{$resultado->partida->resultado->last()->pontos}}</span><em>Pontos</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item">
                                                            <span class="count">{{$resultado->partida->resultado->first()->bonus}} x {{$resultado->partida->resultado->last()->bonus}}</span><em>Bonus</em> </a>
                                                      </li>
                                                      <li></li>
                                                  </ul>
                                              </div>
                                          </div>

                                          </div>

                                      </div>
                                  </div>


                              </div>
                          </div>
                        @endforeach
                      </div>

                      <div class="techlinqs-pagination text-center">

                      </div>

                  </div>
              </div>
          </div>

      </div>
  </div>

</div>

@endsection
