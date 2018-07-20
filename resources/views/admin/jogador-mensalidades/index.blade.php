@extends('voyager::master')

@section('page_title', 'Jogadores')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Jogadores Mensalidades
    </h1>
    <a href="{{ route('voyager.mensalidades.create') }}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>Adicionar</span>
    </a>
@stop

@section('content')

<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">

                <div class="panel-body">

                  <form method="get" class="form-search">
                      <div id="search-input">

                          <div class="input-group col-md-12">
                              <input type="text" class="form-control" placeholder="Procurar" name="s" value="">
                              <span class="input-group-btn">
                                  <button class="btn btn-info btn-lg" type="submit">
                                      <i class="voyager-search"></i>
                                  </button>
                              </span>
                          </div>
                      </div>
                  </form>

                    <table id="dataTable" class="table table-striped database-tables">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Mes</th>
                                <th>Vencimento</th>
                                <th>Status</th>
                                <th>Referencia</th>
                                <th style="text-align:right" colspan="2">{{ __('voyager::database.table_actions') }}</th>
                            </tr>
                        </thead>

                        @foreach($mensalidades as $mensalidade)

                            @continue(in_array($mensalidade->name, config('voyager.database.tables.hidden', [])))
                            <tr>

                                <td>#{{ $mensalidade->id }}</td>

                                <td>
                                    <p class="name">
                                        <a href="{{ route('voyager.jogadores.show', $mensalidade->jogador->id) }}">
                                           {{ $mensalidade->jogador->pessoa->nome }}
                                        </a>
                                    </p>
                                </td>

                                <td>{{ $mensalidade->mes }}</td>
                                <td>{{ $mensalidade->vencimento->format('d/m/Y') }}</td>
                                <td>{{ $mensalidade->status->nome }}</td>
                                <td>{{ $mensalidade->referencia }}</td>

                                <td class="actions">
                                    <a class="btn btn-danger btn-sm pull-right delete_table @if($mensalidade->dataTypeId) remove-bread-warning @endif"
                                       data-table="{{ $mensalidade->name }}">
                                       <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                                    </a>
                                    <a href="{{ route('voyager.database.edit', $mensalidade->name) }}"
                                       class="btn btn-sm btn-primary pull-right" style="display:inline; margin-right:10px;">
                                       <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                                    </a>
                                    <a href="{{ route('voyager.database.show', $mensalidade->name) }}"
                                       data-name="{{ $mensalidade->name }}"
                                       class="btn btn-sm btn-warning pull-right desctable" style="display:inline; margin-right:10px;">
                                       <i class="voyager-eye"></i> {{ __('voyager::generic.view') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="text-center">{{ $mensalidades->links() }}</div>

                </div>

            </div>

        </div>
    </div>
</div>

@stop


@section('javascript')

    <script>

        var table = {
            name: '',
            rows: []
        };

        new Vue({
            el: '#table_info',
            data: {
                table: table,
            },
        });

        $(function () {

            // Setup Show Table Info
            //
            $('.database-tables').on('click', '.desctable', function (e) {
                e.preventDefault();
                href = $(this).attr('href');
                table.name = $(this).data('name');
                table.rows = [];
                $.get(href, function (data) {
                    $.each(data, function (key, val) {
                        table.rows.push({
                            Field: val.field,
                            Type: val.type,
                            Null: val.null,
                            Key: val.key,
                            Default: val.default,
                            Extra: val.extra
                        });
                        $('#table_info').modal('show');
                    });
                });
            });

            // Setup Delete Table
            //
            $('td.actions').on('click', '.delete_table', function (e) {
                table = $(this).data('table');
                if ($(this).hasClass('remove-bread-warning')) {
                    toastr.warning('{{ __('voyager::database.delete_bread_before_table') }}');
                } else {
                    $('#delete_table_name').text(table);

                    $('#delete_table_form')[0].action = '{{ route('voyager.database.destroy', ['database' => '__database']) }}'.replace('__database', table)
                    $('#delete_modal').modal('show');
                }
            });

            // Setup Delete BREAD
            //
            $('table .bread_actions').on('click', '.delete', function (e) {
                id = $(this).data('id');
                name = $(this).data('name');

                $('#delete_bread_name').text(name);
                $('#delete_bread_form')[0].action += '/' + id;
                $('#delete_bread_modal').modal('show');
            });
        });
    </script>

@stop
