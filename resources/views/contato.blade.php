@extends('layouts.layout')

@section('content')

<div class="inner-banner">
    <h1>Contato</h1>
    <p>Entre em contato conosco</p>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Home</a> </li>
            <li> <a>Contato</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar à Home <i class="fa fa-caret-right"></i></a> </div>
</div>

<div class="page-wrapper">

    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <h2 class="section-title"> Informações para contato</h2>
                        <address>
                            <ul>
                              @if(App\Helpers\Helper::getConfig('empresa-endereco'))
                                <li>
                                  <div class="add-icon"> <i class="fa fa-map-marker"></i> </div>
                                  <strong>Endereço</strong>
                                  <p>{{ App\Helpers\Helper::getConfig('empresa-endereco') }}</p>
                                </li>
                              @endif
                              @if(App\Helpers\Helper::getConfig('empresa-telefone'))
                                <li>
                                  <div class="add-icon"> <i class="fa fa-phone"></i> </div>
                                  <strong>Telefones</strong>
                                  <p> {{ App\Helpers\Helper::getConfig('empresa-telefone') }}<br />
                                    {{ App\Helpers\Helper::getConfig('empresa-horario-funcionamento') }}
                                  </p>
                                </li>
                              @endif
                              @if(App\Helpers\Helper::getConfig('empresa-email'))
                                <li>
                                  <div class="add-icon"> <i class="fa fa-envelope"></i> </div>
                                  <strong>Email</strong>
                                  <a href="mailto:{{ App\Helpers\Helper::getConfig('empresa-email') }}">{{ App\Helpers\Helper::getConfig('empresa-email') }}</a>
                                </li>
                              @endif

                              @if(App\Helpers\Helper::getConfig('empresa-facebook') ||
                                App\Helpers\Helper::getConfig('empresa-twitter') ||
                                App\Helpers\Helper::getConfig('empresa-google') ||
                                App\Helpers\Helper::getConfig('empresa-vimeo') ||
                                App\Helpers\Helper::getConfig('empresa-linkedin') ||
                                App\Helpers\Helper::getConfig('empresa-youtube'))
                                <li class="player-social">
                                  <div class="add-icon"> <i class="fa fa-share-alt"></i> </div>
                                  <strong>Siga-nos</strong>
                                  @if(App\Helpers\Helper::getConfig('empresa-facebook'))
                                      <a href="{{ App\Helpers\Helper::getConfig('empresa-facebook') }}" class="fb-icon"><i class="fa fa-facebook"></i></a>
                                  @endif
                                  @if(App\Helpers\Helper::getConfig('empresa-twitter'))
                                      <a href="{{ App\Helpers\Helper::getConfig('empresa-twitter') }}" class="tw-icon"><i class="fa fa-twitter"></i></a>
                                  @endif
                                  @if(App\Helpers\Helper::getConfig('empresa-google'))
                                      <a href="{{ App\Helpers\Helper::getConfig('empresa-google') }}" class="lin-icon"><i class="fa fa-google-plus"></i></a>
                                  @endif
                                  @if(App\Helpers\Helper::getConfig('empresa-vimeo'))
                                      <a href="{{ App\Helpers\Helper::getConfig('empresa-vimeo') }}" class="lin-icon"><i class="fa fa-vimeo"></i></a>
                                  @endif
                                  @if(App\Helpers\Helper::getConfig('empresa-linkedin'))
                                      <a href="{{ App\Helpers\Helper::getConfig('empresa-linkedin') }}" class="lin-icon"><i class="fa fa-linkedin"></i></a>
                                  @endif
                                  @if(App\Helpers\Helper::getConfig('empresa-youtube'))
                                      <a href="{{ App\Helpers\Helper::getConfig('empresa-youtube') }}" class="yt-icon"><i class="fa fa-youtube"></i></a>
                                  @endif
                                </li>
                              @endif
                            </ul>
                        </address>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <h2 class="section-title"> Entre em Contato </h2>
                        <form />
                            <ul>
                                <li>
                                    <input type="text" class="form-control" placeholder="Nome Completo" required="" />
                                </li>
                                <li>
                                    <input type="text" class="form-control" placeholder="Telefone" />
                                </li>
                                <li>
                                    <input type="text" class="form-control" placeholder="Email" required="" />
                                </li>
                                <li>
                                    <input type="text" class="form-control" placeholder="Assunto" />
                                </li>
                                <li>
                                    <textarea class="form-control" placeholder="Mensagem"></textarea>
                                </li>
                                <li>
                                    <input class="submit" value="Enviar" type="submit" />
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="google-map">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
@stop
