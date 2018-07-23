@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .modal, .modal2, .modal-carousel-wrapper {
        background-color: none !important;
      }

    </style>

    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet"/>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>Agendamento de Partidas</h1>
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

  <div class="ticket-listing">
      <div class="container">
          <div class="row">
              <div class="col-md-12">

                  <div class="calendar"></div>

              </div>
          </div>
      </div>
  </div>

</div>

<div class="modal inmodal" id="cadastra-consulta-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">Consulta</h4>
                <small>Registre nova consulta</small>
            </div>

            <form id="formConsultaModal" method="POST" action="#">
            <div class="modal-body">

                  {{  csrf_field() }}
                  <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Notas do agendamento</label>
                            <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                <textarea class="form-control" rows="6" id="consulta-notas" name="notas"></textarea>
                            </div>
                        </div>
                    </div>

                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" id="btnConsulta" class="btn btn-primary">Marcar Consulta</button>
            </div>
            </form>
        </div>
    </div>
</div>


<input type="hidden" id="partidas-ajax" value="{{ route('partidas_ajax') }}">
<input type="hidden" id="now" value="{{ now()->format('c') }}">
@endsection

@section('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

  <script src="{{ asset('js/fullcalendar/moment.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.0/locale/pt-br.js"></script>

  <script>

  function popularModal(event) {
    $("#formConsultaModal").prop('action', '/professional/consults/' + event.id + '/update');
    $("#cadastra-consulta-modal").modal('show');
    $("#cadastra-consulta-modal").find('#title').val(event.title);
    $("#consulta-inicio").val(event.start.format('DD/MM/YYYY HH:mm'));
    $("#consulta-fim").val(event.end.format('DD/MM/YYYY HH:mm'));
    $("#consulta-notas").val(event.notas);
  }

  $('.calendar').fullCalendar({
    height: 380,
    contentHeight: 590,
    lang: 'pt-br',
    defaultView: 'month',
    eventLimit: true,
    eventLimitText: 'partidas',
    groupByResource: true,
    resources: [
      { id: '1', title: 'Quadra A' },
      { id: '2', title: 'Quadra B' },
      { id: '3', title: 'Quadra C' },
      { id: '4', title: 'Quadra C' },
      { id: '5', title: 'Quadra C' },
      { id: '6', title: 'Quadra C' },
    ],
    eventBorderColor: "#de1f1f",
    eventColor: "#AC1E23",
    minTime: '06:00:00',
    maxTime: '22:59:59',
    header:
    {
        left: 'prev,next,today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
    navLinks: true,
    selectable: false,
    selectHelper: true,
    select: function(start, end, jsEvent, view) {

        var view = $('.calendar').fullCalendar('getView');

        if(view.name == 'agendaDay' || view.name == 'agendaWeek') {

          limparModal();

          $("#cadastra-consulta-modal").modal('show');
          $("#consulta-inicio").val(start.format('DD/MM/YYYY HH:mm'));
          $("#consulta-fim").val(end.format('DD/MM/YYYY HH:mm'));

        }

    },
    eventClick: function(event, element, view) {
        popularModal(event);
    },
    editable: false,
    allDaySlot: false,
    dayClick: function(date, jsEvent, view) {

        jsEvent.preventDefault();

          setTimeout(function() {

            //limparModal();

            $("#formConsultaModal").prop('action', $("#consultas-store").val());

            if(view.name == 'month') {
              $('.calendar').fullCalendar('gotoDate', date);
              $('.calendar').fullCalendar('changeView','agendaDay');
            }

          }, 100);

      },
      eventSources: [

        // your event source
        {
          url: $("#partidas-ajax").val(),
          type: 'GET',
          error: function() {
            alert('there was an error while fetching events!');
          },
          complete: function() {



          }
        }

        // any other sources...

      ],
      color: 'black',     // an option!
      textColor: 'yellow', // an option!
      //When u drop an event in the calendar do the following:
      eventDrop: function (event, delta, revertFunc) {
        popularModal(event);
      },
      //When u resize an event in the calendar do the following:
      eventResize: function (event, delta, revertFunc) {
        popularModal(event);
      },
      eventRender: function(event, element) {
          $(element).tooltip({title: event.title});
      },
      ignoreTimezone: false,
      allDayText: 'Dia Inteiro',
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
      dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
      eventOverlap:false,
      views: {
        agenda: {
          titleFormat: 'dddd, DD MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: ''
        },
        day: {
          titleFormat: 'dddd, DD MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: ''
        },
        week: {
          titleFormat: 'MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: 'ddd D'
        },
        month: {
          titleFormat: 'MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: 'dddd'
        }
      },
      nowIndicator: true,
      now: $("#now").val(),
      slotLabelFormat: '',
      columnFormat: {
          month: 'ddd',
          week: 'ddd D',
          day: ''
      },
      axisFormat: 'HH:mm',
      timeFormat: {
          '': 'HH:mm',
          agenda: 'HH:mm'
      },
      buttonText: {
          prev: "<",
          next: ">",
          prevYear: "Ano anterior",
          nextYear: "Proximo ano",
          today: "Hoje",
          month: "Mês",
          week: "Semana",
          day: "Dia"
      }

  });

  </script>

@stop
