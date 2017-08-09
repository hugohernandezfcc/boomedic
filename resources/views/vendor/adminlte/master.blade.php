<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    
    <!-- Adding React JS by CDN-->
    <script crossorigin src="https://unpkg.com/react@15/dist/react.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@15/dist/react-dom.js"></script>


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

<script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>


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


        $('#mobile').inputmask({"mask": "(999) 999-9999"});
    });


</script>

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <script src="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.date.extensions.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.extensions.js"></script>

@endif

@yield('adminlte_js')

</body>
</html>
