@extends('layouts.layout')

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>{{ $pagina->titulo }}</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a href="{{ route('paginas') }}">Páginas</a> </li>
            <li> <a >{{$pagina->titulo}}</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a> </div>
</div>

<div class="page-wrapper">

    <!-- Blog Full Start -->
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <!--Blog Post Start-->
                    <div class="blog-post">
                        <h3><a>{{ $pagina->titulo }}</a></h3>
                        <div class="blog-content">
                            {!! $pagina->conteudo !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Blog Full End -->

</div>

@endsection
