@extends('voyager::master')

@section('page_title', 'Jogadores')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Jogadores Mensalidades
    </h1>
    <a href="{{ route('voyager.mensalidades.index') }}" class="btn btn-warning btn-add-new">
        <i class="voyager-list"></i> <span>Voltar à lista</span>
    </a>
@stop

@section('content')

<div class="page-content container-fluid">
    @include('voyager::alerts')

    <form class="form-edit-add" role="form"
          action="{{ route('voyager.mensalidades.store') }}"
          method="POST" autocomplete="off">
        <!-- PUT Method if we are editing -->
        @if(isset($dataTypeContent->id))
            {{ method_field("PUT") }}
        @endif
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-bordered">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name">{{ __('voyager::generic.name') }}</label>
                             <select class="form-control select2 select-jogador" id="select-jogador" data-url="{{ route('jogadores_ajax') }}" name="jogador_id" required>

                                 <option value=""></option>

                             </select>
                        </div>

                        <div class="form-group">
                            <label for="email">Mês Referência</label>
                            <input type="text" class="form-control datetime" id="mes" name="mes" placeholder="Meses" required>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel panel-bordered panel-warning">
                    <div class="panel-body">
                        <div class="form-group">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary pull-right save">
            {{ __('voyager::generic.save') }}
        </button>
    </form>

</div>

<div class="input-append date" id="datepicker1"
data-date="Aug-2015"
data-date-format="mm-yyyy"
data-dates-disabled="Set-2018,Out-2018" style="display:inline-block; font-weight:bold;">

@stop



@section('javascript')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>

      $(document).ready(function() {


        var datesToDisable = $('#datepicker1').data("datesDisabled").split(',');

        console.log(datesToDisable);

        $('.datetime').datepicker({
            format: "mm/yyyy",
            startView: "months",
            minViewMode: "months",
            clearBtn: true,
            language: "pt-BR",
            multidate: true,
            multidateSeparator: ", ",
            todayHighlight: true
        }).on("show", function(event) {

            var year = $("th.datepicker-switch").eq(1).text();  // there are 3 matches

            $(".month").each(function(index, element) {

              var el = $(element);

              var hideMonth = $.grep( datesToDisable, function( n, i ) {
                                return n.substr(4, 4) == year && n.substr(0, 3) == el.text();
                              });

              /*
              if (hideMonth.length)
                el.addClass('disabled').css({
                  'color': 'red'
                });
                */

              /* To hide those months completely...
              if (hideMonth.length)
                el.hide();
              */
           });

        });

        $(".select-jogador").select2({
          ajax: {
            type: 'GET',
            url: $('#select-jogador').data('url'),
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                search: params.term
              };
            },
            processResults: function (data, params) {

              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.nome,
                          email: item.email,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
          },
          escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
          templateResult: formatRepo,
          placeholder: 'Selecione um jogador',
          minimumInputLength: 1
        });

        function formatRepo (repo) {

          //console.log(repo);

          if (repo.loading) {
            return repo.text;
          }

          var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
              "<div class='select2-result-repository__title'>" + repo.text + "</div>";

          if (repo.description) {
            markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
          }

          markup += "<div class='select2-result-repository__statistics'>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> Email: " + repo.email + " </div>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> Código: #" + repo.id + " </div>" +
          "</div>" +
          "</div></div>";

          return markup;
        }

        function formatRepoSelection (repo) {
          return repo.full_name || repo.text;
        }

      });



    </script>

@stop
