<div class="header-action-bar" style="background:white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

              <div class="header-navbar">

                  <nav>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    @foreach(\App\Models\MenuCategorias::all() as $item)
                        <li class="active"><a href="?category={{ $item->categoria->id }}">{{ $item->categoria->nome }}</a></li>
                    @endforeach

                  </ul>
                  </div>

                  </nav>

              </div>

            </div>

        </div>
    </div>
</div>
