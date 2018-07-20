<div class="header-navbar">
    <nav>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li> <a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('calendario') }}">Calendário de jogos</a></li>
                <li><a href="{{ route('resultados') }}">Resultados de Jogos</a></li>
                <li><a href="{{ route('classificacao') }}">Classificação</a></li>
                
                <li><a href="{{ route('contato') }}">Contato</a></li>
            </ul>
        </div>
    </nav>
</div>
