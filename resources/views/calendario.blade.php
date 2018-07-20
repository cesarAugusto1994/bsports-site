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
                <div class="col-md-9">
                  @if($partidas->isNotEmpty())
                    <div class="tickets-sort"> <a href="#" class="pull-left"><i class="fa fa-map-marker"></i><span> Todas as Partidas </span> <i class="fa fa-angle-right"></i></a>
                      <a href="#" class="pull-right"><i class="fa fa-calendar"></i><span>Calendario</span><i class="fa fa-angle-right"></i></a> </div>

                        <div class="tickets-list">

                          <ul>
                            @foreach($partidas as $partida)

                              @if($partida->resultado->isEmpty())
                                @continue;
                              @endif

                              <li>
                                  <div class="tickets-date"> <span>{{ $partida->data->format('D') }}</span> <strong>{{ $partida->data->format('M d') }}</strong> <span>{{ $partida->horario }}</span> </div>
                                  <div class="tickets-detail text-center">
                                    <div class="logo-team1"> <img src="holder.js/64x64" alt=""> </div>
                                      <div class="team-vs">
                                          <h4>{{ $partida->resultado->first()->jogador->pessoa->nome }}<i>vs</i>{{ $partida->resultado->last()->jogador->pessoa->nome }}</h4>
                                          <p>{{ $partida->quadra->nome }}</p>
                                      </div>
                                    <div class="logo-team1"> <img src="holder.js/64x64" alt=""> </div>
                                  </div>
                              </li>

                            @endforeach
                          </ul>


                    </div>

                    <div class="text-center">{{ $partidas->links() }}</div>

                    @else

                    <div class="alert alert-info">Nenhuma consulta foi agendada até o momento. </div>

                    @endif
                </div>
                <div class="col-md-3">
                    <div class="sidebar-search-widget">

                        <div class="side-title">
                            <h3>Pesquisar Partidas</h3>
                            <p>Pesquise uma partida</p>
                        </div>
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
                                <input type="submit" class="submit" value="Pesquisar">
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Ticket Listing Page End-->

</div>

@endsection
