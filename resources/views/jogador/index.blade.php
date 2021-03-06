@extends('voyager::master')

@section('css')


    <link href="{{ asset('css/custom-new.css') }}" rel="stylesheet" />

    <style>
        .user-email {
            font-size: .85rem;
            margin-bottom: 1.5em;
        }

        html body {
            background: none;
        }

        .event-txt-wrap {
          box-shadow:none;
        }
    </style>



@stop

@section('content')
<div style="background-size:cover; background-image: url({{ Voyager::image( Voyager::setting('admin.bg_image'), config('voyager.assets_path') . '/images/bg.jpg') }}); background-position: center center;position:absolute; top:0; left:0; width:100%; height:300px;"></div>
<div style="height:160px; display:block; width:100%"></div>
<div style="position:relative; z-index:9; text-align:center;" class="row">
    <img src="@if( !filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)){{ Voyager::image( Auth::user()->avatar ) }}@else{{ Auth::user()->avatar }}@endif"
         class="avatar"
         style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
         alt="{{ Auth::user()->name }} avatar">
    <h4>{{ ucwords(Auth::user()->name) }}</h4>
    <div class="user-email text-muted">{{ ucwords(Auth::user()->email) }}</div>
    <a href="{{ route('perfil.edit', Auth::user()->id) }}" class="btn btn-primary">Editar</a>
</div>

<div style="height:60px; display:block; width:100%"></div>

<div class="row">
    <div class="col-md-7">
        <div class="about-video">

          <div class="small-txt text-center">
              <h2>Partidas</h2>
              <br/>
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
    <div class="col-md-5">
      <div class="team-small-details">
          <div class="col-md-12 col-sm-12">
              <h2>Informações Técnicas</h2>
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

</div>

@stop
