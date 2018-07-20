@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

    </style>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>Resultado Partidas</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>Resultado Partidas</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

    <div class="blog-list">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="events-posts">
                      @foreach($resultados as $resultado)

                        @if($resultado->resultado->isEmpty())
                          @continue;
                        @endif

                        <div class="event-post">
                            <div class="event-date">
                                <h5><span>{{ $resultado->data->format('M') }}</span> {{ $resultado->data->format('d, Y') }}</h5>
                                <strong>{{ $resultado->horario }}</strong> </div>
                            <div class="event-content">
                                <div class="event-txt-wrap">
                                    <div class="event-txt">
                                        <h4><a>{{ $resultado->resultado->first()->jogador->pessoa->nome }} vs {{ $resultado->resultado->last()->jogador->pessoa->nome }}</a></h4>
                                        <p class="loc"><i class="fa fa-map-marker"></i> {{ $resultado->quadra->nome }}</p>
                                        <div class="event-box-footer">

                                          <div class="widget">
                                            <div class="social-counter">
                                                <ul>
                                                    <li>
                                                        <a class="item twitter">
                                                          <span class="count">{{$resultado->resultado->first()->set1}} x {{$resultado->resultado->last()->set1}}</span>
                                                          <em>1º SET</em> </a>
                                                    </li>
                                                    <li>
                                                        <a class="item ">
                                                          <span class="count">{{$resultado->resultado->first()->set2}} x {{$resultado->resultado->last()->set2}}</span>
                                                          <em>2º SET</em> </a>
                                                    </li>
                                                    <li>
                                                        <a class="item twitter">
                                                          <span class="count">{{$resultado->resultado->first()->set3}} x {{$resultado->resultado->last()->set3}}</span>
                                                          <em>3º SET</em> </a>
                                                    </li>
                                                    <li>
                                                        <a class="item ">
                                                          <span class="count">{{$resultado->resultado->first()->resultado_final}} x {{$resultado->resultado->last()->resultado_final}}</span>
                                                          <em>SETS</em> </a>
                                                    </li>
                                                    <li>
                                                        <a class="item twitter">
                                                          <span class="count">{{$resultado->resultado->first()->pontos}} x {{$resultado->resultado->last()->pontos}}</span><em>Pontos</em> </a>
                                                    </li>
                                                    <li>
                                                        <a class="item">
                                                          <span class="count">{{$resultado->resultado->first()->bonus}} x {{$resultado->resultado->last()->bonus}}</span><em>Bonus</em> </a>
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
                        {{ $resultados->links() }}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="sidebar-search-widget">
                        <div class="side-title">
                            <h3>Pesquisar</h3>
                        </div>
                        <ul class="search-form">
                            <li>
                                <div class="input-group">
                                    <select>
                                        <option value="">Categoria</option>
                                        @foreach(\App\Models\Categoria::orderBy('tipo')->get() as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }} / {{ $categoria->tipo }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </li>

                            <li>
                                <div class="input-group">
                                  <input class="form-control" type="text" placeholder="Jogador"/>
                                  <i class="fa fa-angle-down"></i>
                                </div>
                            </li>

                            <li>
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Data"/>
                                    <i class="fa fa-angle-down"></i> </div>
                            </li>

                            <li>
                                <input type="submit" class="submit" value="Search">
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
@stop
