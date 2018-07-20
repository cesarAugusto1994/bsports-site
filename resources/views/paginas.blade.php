@extends('layouts.layout')

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>Páginas</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>Páginas</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

    <div class="blog-list">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                      @foreach($paginas as $pagina)
                        <div class="blog-post">
                            <div class="col-md-7 col-sm-7">
                                <div class="blog-content">
                                    <h3><a href="{{ route('pagina', ['slug' => str_slug($pagina->titulo), 'id' => $pagina->id]) }}">{{ $pagina->titulo }}</a></h3>

                                    <p>{{ substr(strip_tags($pagina->conteudo), 0, 30) }}</p>
                                    <a class="detail-btn" href="{{ route('pagina', ['slug' => str_slug($pagina->titulo), 'id' => $pagina->id]) }}">Acessar</a> </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="techlinqs-pagination text-center">
                        {{ $paginas->links() }}
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- Blog Full End -->

@endsection

@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
@stop
