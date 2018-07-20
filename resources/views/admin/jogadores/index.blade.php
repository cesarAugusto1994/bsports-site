@extends('voyager::master')

@section('page_title', 'Jogadores')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-people"></i> Jogadores
    </h1>
    <a href="{{ url('jogadores') }}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>Adicionar</span>
    </a>
@stop

@section('content')

<div class="page-content container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped database-tables">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th style="text-align:right" colspan="2">{{ __('voyager::database.table_actions') }}</th>
                    </tr>
                </thead>

            @foreach($jogadores as $jogador)

                @continue(in_array($jogador->name, config('voyager.database.tables.hidden', [])))
                <tr>
                    <td>
                        <p class="name">
                            <a href="{{ route('voyager.jogadores.show', $jogador->id) }}"
                               data-name="{{ $jogador->pessoa->nome }}" class="desctable">
                               {{ $jogador->pessoa->nome }}
                            </a>
                        </p>
                    </td>

                    <td>
                        <p class="name">

                               {{ $jogador->pessoa->email }}

                        </p>
                    </td>

                    <td>
                        <div class="bread_actions">
                        @if($jogador->dataTypeId)
                            <a href="{{ route('voyager.' . $jogador->slug . '.index') }}"
                               class="btn-sm btn-warning browse_bread">
                                <i class="voyager-plus"></i> {{ __('voyager::database.browse_bread') }}
                            </a>
                            <a href="{{ route('voyager.bread.edit', $jogador->name) }}"
                               class="btn-sm btn-default edit">
                               {{ __('voyager::bread.edit_bread') }}
                            </a>
                            <a data-id="{{ $jogador->dataTypeId }}" data-name="{{ $jogador->name }}"
                                 class="btn-sm btn-danger delete">
                                 {{ __('voyager::bread.delete_bread') }}
                            </a>
                        @else
                            <a href="{{ route('voyager.bread.create', ['name' => $jogador->name]) }}"
                               class="btn-sm btn-default">
                                <i class="voyager-plus"></i> {{ __('voyager::bread.add_bread') }}
                            </a>
                        @endif
                        </div>
                    </td>

                    <td class="actions">
                        <a class="btn btn-danger btn-sm pull-right delete_table @if($jogador->dataTypeId) remove-bread-warning @endif"
                           data-table="{{ $jogador->name }}">
                           <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                        </a>
                        <a href="{{ route('voyager.database.edit', $jogador->name) }}"
                           class="btn btn-sm btn-primary pull-right" style="display:inline; margin-right:10px;">
                           <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                        </a>
                        <a href="{{ route('voyager.database.show', $jogador->name) }}"
                           data-name="{{ $jogador->name }}"
                           class="btn btn-sm btn-warning pull-right desctable" style="display:inline; margin-right:10px;">
                           <i class="voyager-eye"></i> {{ __('voyager::generic.view') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </table>
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
