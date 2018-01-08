<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/skins/_all-skins.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.js"></script>
  

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.print.min.css" media="print">


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.js"></script>


    <style type="text/css">
        .btn-secondary { 
            color: #ffffff; 
            background-color: #000000; 
            border-color: #555; 
        }
        
        .btn-secondary:hover, 
        .btn-secondary.active, 
        .open .dropdown-toggle.btn-secondary
        { 
            color: #ffffff; 
            background-color: #333333; 
            border-color: #444; 
        }

        .btn-secondary:focus, 
        .btn-secondary:active, 
        .open .dropdown-toggle.btn-secondary
        { 
            color: #ffffff; 
            background-color: #696969; 
            border-color: #444; 
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #222d32;
        }

        .nav-tabs-custom>.nav-tabs>li {
            border-top: 3px solid rgb(210, 214, 222);
            margin-bottom: -2px;
            margin-right: 5px;
        }

        #mapAddressUser {
            height: 100%;
            width: 95%;
        }

        #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
        .btn-circle {
          width: 30px;
          height: 30px;
          text-align: center;
          padding: 6px 0;
          font-size: 12px;
          line-height: 1.428571429;
          border-radius: 15px;
        }
        .btn-circle.btn-lg {
          width: 50px;
          height: 50px;
          padding: 10px 16px;
          font-size: 18px;
          line-height: 1.33;
          border-radius: 25px;
        }
        .btn-circle.btn-xl {
          width: 70px;
          height: 70px;
          padding: 10px 16px;
          font-size: 24px;
          line-height: 1.33;
          border-radius: 35px;
        }


          .footer {
          position:fixed;
          bottom:0;
          width: 82%;
          }
          .info-box.sm {

              min-height: 45px;
             font-size: 12px;
              margin-bottom: 3px;
               }
              .info-box-icon.sm {
                  height: 45px;
                  width: 45px;
                  font-size: 20px;
                  line-height: 45px;        
              }
              .info-box-content.sm {
                  margin-left: 45px;
              }
         


    </style>


    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.css">
    @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASpjRM_KRr86IC02UvQKq9NtJL_9ZHbHg&libraries=geometry,places" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>


<script type="text/javascript">
    $(function () {
        //Datemask dd/mm/yyyy
        //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': "{{ trans('adminlte::adminlte.birthDate') }}" })
    
        //Date picker
        $('#datepicker').datepicker({
            format: "mm/dd/yyyy",
            language: "es",
            autoclose: true
        });


        $('#datepicker').datepicker().on('show', function(e) {
            $('div.datepicker').removeClass( "datepicker-dropdown" );
        });


        //$('#mobile').inputmask({"mask": "(999) 999-9999"});
        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
                e.preventDefault();
                return false;
            }
        });
        
        if (document.getElementById('paymentmethodtable')) {
            $('#paymentmethodtable').DataTable({
                language: {
                        'processing':     'Procesando...',
                        'lengthMenu':     'Mostrar _MENU_ registros',
                        'zeroRecords':    'No se encontraron resultados',
                        'emptyTable':     'Ningún dato disponible en esta tabla',
                        'info':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                        'infoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
                        'infoFiltered':   '(filtrado de un total de _MAX_ registros)',
                        'infoPostFix':    '',
                        'search':         'Buscar:',
                        'url':            '',
                        'infoThousandsi':  ',',
                        'loadingRecords': 'Cargando...',
                        'paginate': {
                            'first':    'Primero',
                            'last':     'Último',
                            'next':     'Siguiente',
                            'previous': 'Anterior'
                        },
                        "aria": {
                            'sortAscending':  ': Activar para ordenar la columna de manera ascendente',
                            'sortDescending': ': Activar para ordenar la columna de manera descendente'
                        }
                    },
                'lengthChange': false
            });
        }

        $('.select2').select2();
        if (document.getElementById('calendar')) {
             /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            $('#calendar').fullCalendar({
                  header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'month,agendaWeek,agendaDay'
                  },
                  buttonText: {
                    today: 'today',
                    month: 'month',
                    week : 'week',
                    day  : 'day'
                  },
                  defaultView: 'month',

                  //Random default events
                  events    : [
                    {
                      title          : 'All Day Event',
                      start          : new Date(y, m, 1),
                      backgroundColor: '#f56954', //red
                      borderColor    : '#f56954' //red
                    },
                    {
                      title          : 'Long Event',
                      start          : new Date(y, m, d - 5),
                      end            : new Date(y, m, d - 2),
                      backgroundColor: '#f39c12', //yellow
                      borderColor    : '#f39c12' //yellow
                    },
                    {
                      title          : 'Meeting',
                      start          : new Date(y, m, d, 10, 30),
                      allDay         : false,
                      backgroundColor: '#0073b7', //Blue
                      borderColor    : '#0073b7' //Blue
                    },
                    {
                      title          : 'Lunch',
                      start          : new Date(y, m, d, 12, 0),
                      end            : new Date(y, m, d, 14, 0),
                      allDay         : false,
                      backgroundColor: '#00c0ef', //Info (aqua)
                      borderColor    : '#00c0ef' //Info (aqua)
                    },
                    {
                      title          : 'Birthday Party',
                      start          : new Date(y, m, d + 1, 19, 0),
                      end            : new Date(y, m, d + 1, 22, 30),
                      allDay         : false,
                      backgroundColor: '#00a65a', //Success (green)
                      borderColor    : '#00a65a' //Success (green)
                    },
                    {
                      title          : 'Click for Google',
                      start          : new Date(y, m, 28),
                      end            : new Date(y, m, 29),
                      url            : 'http://google.com/',
                      backgroundColor: '#3c8dbc', //Primary (light-blue)
                      borderColor    : '#3c8dbc' //Primary (light-blue)
                    }
                  ],
                  editable  : false,
                  
                });
        }
        
    });



</script>

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <script src="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    

    <script src="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js"></script>
    


@endif

@yield('adminlte_js')

</body>
</html>



