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
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-black-light.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/css/select2.min.css"/>
    
  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script src="https://adminlte.io/themes/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.print.min.css" media="print">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/locale/es.js"></script>




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
        .navbar-custom-menu>.navbar-nav>li>.dropdown-menu {
            right: 0 !important; 
        }
        #mapAddressUser {
            height: 100%;
            width: 95%;
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
          .info-box.sm {
              min-height: 45px;
              font-size: 12px;
              margin-bottom: 3px;
               }
          .info-box {
              font-size: 13px;
              margin-bottom: 0;
               }
          .info-box-content {
               margin-left: 90px; 
               }    
          .info-box-content.sm {
               margin-left: 50px; 
               }    
              .info-box-icon.sm {
                  height: 45px;
                  width: 45px;
                  font-size: 23px;
                  line-height: 45px;        
              }
              .info-box-icon2-sm {
                  padding: 5px 10px;
                  height: 45px;
                  width: 45px;
                  font-size: 9px;
                  margin-top: 2px;
                  padding: 5px 10px;
                  text-align: center; 
                  font-size: 11px;
                  background: rgba(0,0,0,0);
                  display: block;
                  float: left;     
              }
.info-box-icon-2 {
    margin-top: 9px;
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 11px;
    background: rgba(0,0,0,0);
    line-height: 13px;
}
.lockscreen-item {
    margin: 0 0 13px auto !important;
}
      .modal.fade2 .modal-dialog{
    top: 300px;
    opacity: 0;
    -webkit-transition: all 0.7s;
    -moz-transition: all 0.7s;
    transition: all 0.7s;
    padding-right: 0 !important; 
      }
   .modal.fade2.in .modal-dialog {
    -webkit-transform: translate3d(0, -300px, 0);
    transform: translate3d(0, -300px, 0);
    opacity: 1;

    }
    </style>

    <style>
    /* The Modal (background) */
    .modal-danger2 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    /* Modal Content */
    .modal-content-danger2 {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 35%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }
    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
    }
    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }
    /* The Close Button */
    .close-danger2 {
        color: white;
        float: right;
        font-size: 26px;
        font-weight: bold;
    }
    .close-danger2:hover,
    .close2-danger:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .modal-header-danger2 {
        padding: 1px 10px;
        background-color: #e62e00;
        color: white;
    }
    .modal-body-danger2 {padding: 2px 16px;}
   table.dataTable.dtr-column>tbody>tr>td.control:before, table.dataTable.dtr-column>tbody>tr>th.control:before{
   background-color: #000000 !important;
   content: "\f06e" !important;
   font-family: "FontAwesome" !important;
   border: 0px  !important;
   height: 21px !important;
    width: 21px !important;
    line-height: 20px  !important;
   }
   table.dataTable.dtr-column>tbody>tr.parent td.control:before, table.dataTable.dtr-column>tbody>tr.parent th.control:before {
    content: "\f06e" !important;
    font-family: "FontAwesome" !important;
    background-color: #6E6E6E !important;
}
/*styles Wizard */
    .wizard .nav-tabs {
        position: relative;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }
    .wizard > div.wizard-inner {
        position: relative;
    }
.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}
.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
    margin: 15px auto !important;
}
span.round-tab {
    width: 30px;
    height: 30px;
    line-height: 26px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 16px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #151515;
    
}
.wizard li.active span.round-tab i{
    color: #151515;
}
span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}
.wizard .nav-tabs > li {
    width: 25%;
}
.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #151515;
    transition: 0.1s ease-in-out;
}
.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 35%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #151515;
}
.wizard .nav-tabs > li a {
    width: 30px;
    height: 30px;
    margin: 15px auto;
    border-radius: 100%;
    padding: 0;
}
    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }
.wizard .tab-pane {
    position: relative;
}
@media( max-width : 1300px ) {
    .wizard {
        height: auto !important;
    }
    span.round-tab {
        font-size: 15px;
        width: 30px;
        height: 30px;
        line-height: 30px;
    }
    .wizard .nav-tabs > li a {
        width: 30px;
        height: 30px;
        line-height: 30px;
    }
    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
        .select2-container--default .select2-selection--single {
        border-radius: 0px !important; 
        border-color: #d2d6de;
        }

        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #444 !important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0px !important;
        }

            .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {

                background-color: #333;
                border-color: #333;
            }
</style>


    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
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
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/GoogleLogin.js') }}"></script>
<script src="{{ asset('js/LinkedInLogin.js') }}"></script>
<script src="{{ asset('js/LinkedInRegister.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASpjRM_KRr86IC02UvQKq9NtJL_9ZHbHg&libraries=geometry,places" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>



<script type="text/javascript">




              //Ajax function call notify set timeout
            function notifications(){
              var doc = "@php echo session()->get('utype'); @endphp";
              if(doc == "doctor"){          
              $.ajax(
                                  {
                                    type: "GET",    
                                    url: "{{ url('HomeController/listpatients') }}", 
                                    success: function(result2){
                                  if(result2 == "listo"){
                                    console.log(result2);
                                       $('#stateCite').html('');
                                       $('#stateCite').append('<li><a href="javascript:void(0)">No hay citas en ningún estatus hoy...</a></li>');
                                  }else{    
                                  console.log(result2);
                                  $('#stateCite').html('');
                                   $('#futureCites').html('');
                                   $('#tool').html('');
                            for(var g =0; g < result2[0].length; g++){
                                   var gender = result2[0][g]['gender'];
                                       if(gender == 'female')
                                          gender = 'Femenino';
                                       if(gender == 'male')
                                          gender = 'Masculino';
                               var now = moment().format("MM/DD/YYYY HH:mm");
                                var com = moment(result2[0][g]['when']).format("MM/DD/YYYY HH:mm");
                               if(now < com){
                                  var tim ='en ' + moment.utc(moment(com).diff(moment(now))).format("HH:mm");
                                } else {
                                  console.log(now);
                                  console.log(com);
                                 var tim = 'hace ' + moment.utc(moment(now).diff(moment(com))).format("HH:mm");
                                }

                              $('#tool').append('<div class=modal fade" role="dialog" id="'+ result2[0][g]['id'] +'"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Modal x</h4></div><div class="modal-body"></div></div></div></div>');

                                  if(result2[0][g]['status'] == 'No completed'){  
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'"><i class="menu-icon fa fa-calendar-check-o bg-red"></i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p><p>'+ tim +'</p></div></a></li>');
                                  }
                                  if(result2[0][g]['status'] == 'Taked'){  
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'"><i class="menu-icon fa fa-calendar-check-o bg-green"></i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender+', edad: '+ result2[0][g]['age'] +'</p><p>'+ tim +'</p></div></a></li>');
                                  }
                                  if(result2[0][g]['status'] == 'Registered'){  
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'"><i class="menu-icon fa fa-calendar-check-o bg-gray"></i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p><p>'+ tim +'</p></div></a></li>');
                                  }
                                  }

                               for(var h =0; h < result2[1].length; h++){
                                 var gender = result2[1][h]['gender'];
                                       if(gender == 'female')
                                          gender = 'Femenino';
                                       if(gender == 'male')
                                          gender = 'Masculino';
                                $('#futureCites').append('<li><a data-toggle="modal" data-target="#'+ result2[1][h]['id'] +'"><i class="menu-icon fa fa-calendar-check-o bg-gray"></i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[1][h]['name'] +'</h4><p>'+ gender +', edad: '+ result2[1][h]['age'] +'</p><p>'+ result2[1][h]['when'] +'</p></div></a></li>');

                               }   
                                }
                             }
                       })
              }
              $.ajax(
              {
                type: "GET",    
                url: "{{ url('HomeController/notify') }}", 
                success: function(result){
                 var com = "@php echo session()->get('entered'); @endphp";
                    if(com != 1){
                      $('#notN').css("display", "block");  
                    }else{
                        $('#notN').css("display", "none"); 
                    }
                    $('#notify').html('');
                  for (var i =0; i < result.length; i++) {
                    if(i == 0){
                    $('#countNot').html('Tiene '+ result.length + ' notificación');
                     $('#notN').html('1');
                    }else{
                     $('#notN').html(result.length);
                    $('#countNot').html('Tiene '+ result.length + ' notificaciones');
                    }
                    var u = result[i]['url'];
                    var url = "{{ url('') }}";
                            $('#notify').append('<li><a href="'+ url +'/'+ u +'"><i class="fa fa-warning text-yellow"></i>'+ result[i]['description']+'</a></li>');
                        
                        }
                                }
              });
            $('#newMess').text();
             $.ajax(
                  {
                    type: "GET",    
                    url: "{{ url('HomeController/messages') }}", 
                    success: function(result){
                            console.log("me ejecuté");
                    if(result.length > 0){
                        $('#newMess').html('');
                      for (var o =0; o < result.length; o++) {
                                if(o == 0){
                                     $('#countMes').html('Tiene '+ result.length + ' mensaje no leido');
                                     $('#messN').html('1');
                                }else{
                                     $('#messN').html(result.length);
                                     $('#countMes').html('Tiene '+ result.length + ' mensajes no leidos');
                                }
                        var type = "@php echo session()->get('utype'); @endphp"
                        var mo = moment(result[o]['created_at']).fromNow();
                            if(type == "doctor"){
                                var url = "{{ url('') }}" + "/medicalconsultations";
                            }else{
                                var url = "{{ url('') }}" + "/clinicHistory/index"; 
                            } 

                          $('#newMess').append('<li><a href="'+ url +'"><div class="pull-left"><img src="'+ result[o]["profile_photo"] +'" class="img-circle" alt="User Image"></div><h4 style="text-align: left;">'+ result[o]["name"] +'<small><i class="fa fa-clock-o"></i> '+ mo +'</small></h4><p>'+ result[o]["namec"] +'</p></a></li>');
                            }
                          }
                            {
                             setTimeout(function(){ repeatNot(); },60000);
                            }
                      },
                        error: function (request, status, error) {
                            //window.location.href = "{{ url('') }}";
                        }
                  }); 
         }
        function repeatNot(){
            notifications();
        }
    $(function () {
            var par = "@php echo session()->get('parental'); @endphp";
      if(!par){
          $("body").removeClass("skin-black-light");
          $("body").addClass("skin-black");
          $("#uh").css("background-color", "#222");
          $("#uf").css("background-color", "#222");
          $("#au").removeAttr("style");
      }else{
        $("body").removeClass("skin-black");
        $("body").addClass("skin-black-light");
        $("#uh").css("background-color", "#31b7b0");
        $("#uf").css("background-color", "#31b7b0");
        $("#au").css("color", "white");
      }
                notifications();

        $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "yyyy/mm/dd"
    };

        $('#datepicker1').datepicker({
            autoclose: true,
            language: 'es'
                });
        $('#datepicker2').datepicker({
            autoclose: true,
            format: "yyyy/mm/dd",
            language: 'es',
            orientation: 'auto'
         });
        //Datemask dd/mm/yyyy
        //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': "{{ trans('adminlte::adminlte.birthDate') }}" })
         $.fn.datepicker.dates['es'] = {
            today: 'Hoy',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            format: "yyyy/mm/dd",
            titleFormat: "MM yyyy",
            weekStart: 0
          };


                    //Date picker
       /* $('#datepicker').datepicker({
            format: "mm/dd/yyyy",
            language: "es",
            autoclose: true
        });
        $('#datepicker').datepicker().on('show', function(e) {
            $('div.datepicker').removeClass( "datepicker-dropdown" );
        });*/
        //$('#mobile').inputmask({"mask": "(999) 999-9999"});
        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
                e.preventDefault();
                return false;
            }
        });
    /* Function notifications Page nav Bar */    
    $('#mess').on('click', function(e) {
            $('#messN').css("display", "none");
     });
    $('#not').on('click', function(e) {
                 $.ajax(
              {
                type: "GET",    
                url: "{{ url('HomeController/notify2') }}", 
                success: function(result){
                    if(result == true){
                      $('#notN').css("display", "none");  
                    }
                    }
              }); 
     });
   /* Function notifications */  
        
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
                'lengthChange': false,
        responsive: {
            details: {
                type: 'column',
                target: 0
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ]
            });
        }
        $('.select2').select2();
    
        
    });
</script>

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
       <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script src="https://adminlte.io/themes/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


    


@endif

@yield('adminlte_js')

</body>
</html>


