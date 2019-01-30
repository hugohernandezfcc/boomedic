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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
    margin: 0 auto;
    bottom: 0px;

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
        .none {
          display: none;
        }
        .pointer{
         cursor:pointer;
        }
        .cutMess{
        width:60%;
        text-overflow:ellipsis;
        white-space:nowrap; 
        overflow:hidden; 
        }
      #mapaC{
        position: relative;
        height: 100%;
        width: 100%;
      } 
      #map{
        position: relative;
        width: 100%;
        z-index: 30;
      }
      #rango{ 
        position: absolute;
        width: 90%;
        bottom: 5%;
        right: 10%;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;
      }

      #rango03{
        font-size:25px;
      }

      .rango{ 
        position: absolute;
        width: 90%;
        bottom: 90%;
        right: 10%;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;
      }
      #rangothree{ 
        position: absolute !important;
        bottom: 4% !important;
        right: 2% !important;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 1000;
        text-align: center;
      }
      #rangotwo{ 
        position: absolute;
        top: 2%;
        right: 2%;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
      }  

      #searchDiv{
        position: absolute;
        width: 24%;
        top: 4.5%;
        right: 4%;
        padding-top: 0.5%;
        padding-bottom: 0.5%;
        padding-right: 0.1%;
        padding-left: 0.1%;
        background-color: rgba(255,255,255,0.6);
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;        
      }
      .rangeStyle{
        height: 1%;
        width: 100%;
        
      }
      .checkStyle{
        position: absolute;
        top: 4.5%;
        left: 1%;
        background-color: rgba(255,255,255,0.8);
        z-index: 100;
        font-size: 90%;
        line-height: 15%;
        padding-top: 0.5%;
        padding-bottom: 0.5%;
        padding-right: 0.5%;
        padding-left: 0.5%;
        border-radius: 1px;
      }

      .infoSpStyle{
        position: absolute;
        top: 19%;
        right: 1%;
        background-color: rgba(255,255,255,0.8);
        z-index: 100;
        font-size: 90%;
        padding-right: 0.5%;
        padding-left: 0.5%;
      }
      .launchSearchStyle{
        position: absolute;
        top: 7%;
        right: 1%;
        /*background-color: rgba(255,255,255,0.8);
        z-index: 100;
        font-size: 90%;
        padding-right: 0.5%;
        padding-left: 0.5%;*/
      }
      .textStyle01{
        color: #424242;
        text-shadow: 1px 1px 0.5px #424242;
      }
      .content{
        padding-left: 1px;
        padding-right: 1px;
        padding-top: 0px;
      }
      .content-header {
          position: relative;
          padding: 1px 1px 0 1px; 
      }
      /*** Range
      /*General format*/
      input[type='range'] {
        display: block;
        width: 100%;
        height: 100%;
        margin: 18px 0;
      }
      /*Removes the blue border*/
      input[type='range']:focus {
        outline: none;
      }
      input[type=range]:focus::-webkit-slider-runnable-track {
        outline: none;
      }
      /*Unstyled range input*/
      input[type='range'],
      input[type='range']::-webkit-slider-runnable-track,
      input[type='range']::-webkit-slider-thumb {
        -webkit-appearance: none;
      }
      /*Thumb Chrome*/
      input[type=range]::-webkit-slider-thumb {
        background-color: #000;
        width: 20px;
        height: 20px;
        border: 3px solid #000;
        border-radius: 50%;
        margin-top: -9px;
      }
      /*Thumb Mozilla*/
      input[type=range]::-moz-range-thumb {
        background-color: #000;
        width: 15px;
        height: 15px;
        border: 3px solid #000;
        border-radius: 50%;
      }
      /*Thumb Edge*/
      input[type=range]::-ms-thumb {
        background-color: #000;
        width: 20px;
        height: 20px;
        border: 3px solid #000;
        border-radius: 50%;
      }
      /*Track Chrome*/
      input[type=range]::-webkit-slider-runnable-track {
        background-color: #000;
        height: 3.5px;
      }
      /*Color barra Mozilla*/
      input[type=range]::-moz-range-track {
        background-color: #000;
        height: 3px;
      }
      /*Track Edge*/
      input[type=range]::-ms-track {
        width: 100%;
        height: 2.4px;
        background-color: #000;
        height: 3px;
      }
     /****/
     /* Modal */

      .btn-default {
          box-shadow: 1px 2px 5px #000000;   
      }
        .box {
             margin-bottom: 0;
        }
        .panel {
             margin-bottom: 0; 
        }
        .pac-container {
         z-index: 100000; 
       }
      .box.box-primary {
        border-top-color: #242627;
        }
    #infDr {
    bottom: 0;
    right: 0;
    position: fixed;
    z-index: 1050;
    width: 70%;
    margin: 0 0 0 0 !important;
    }
    @media( max-width : 700px ) {
       #infDr {
         width: 95%;
       }
    }
    .alert .close {
    color: white !important;
    opacity: .8 !important;
}
    #bodyDr{
       margin-left: 90px; 
    }
.customMarker {
    position:absolute;
    cursor:pointer;
    background:#424242;
    width:50px;
    height:50px;
    /* -width/2 */
    margin-left:-25px;
    /* -height + arrow */
    margin-top:-55px;
    border-radius:50%;
    padding:0px;
}
.customMarker:after {
    content:"";
    position: absolute;
    bottom: -5px;
    left: 20px;
    border-width: 5px 5px 0;
    border-style: solid;
    border-color: #424242 transparent;
    display: block;
    width: 0;
}
.customMarker img {
    width:45px;
    height:45px;
    margin:3px;
    border-radius:50%;
    pointer-events: auto;
}
    .modal-content-2 {
        position: relative;
        background-color: transparent;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        color: white;
        padding-top: 50%;
    }
    .liright { 
    color: #999 !important;
    float: right !important;
    padding: 3px !important;
    font-size: 10px !important;
    }
    .nav-stacked>li.active>a {
      border-left-color: #080808 !important;
    }
    .cut{
      width:60%;
      text-overflow:ellipsis;
      white-space:nowrap; 
      overflow:hidden; 
      text-align: right;
    }
    .direct-chat-contacts {
          height: 28px !important;
          background: transparent !important; 
          top: 90% !important; 
          z-index: 900;
    }


/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 25px;
  height: 15px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #777;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 10px;
  width: 10px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

 input:checked + .slider {
  background-color: #333;
}

 input:focus + .slider {
  box-shadow: 0 0 1px #333;
}

 input:checked + .slider:before {
  -webkit-transform: translateX(10px);
  -ms-transform: translateX(10px);
  transform: translateX(10px);
}

/* Rounded sliders */
 .slider.round {
  border-radius: 13px;
}

.slider.round:before {
  border-radius: 50%;
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=geometry,places" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
  <p id="power"></p>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>-->
<script type="text/javascript">

          //Function for minutes appointments set interval dinamic
            function minutes(){
            var x = document.getElementsByClassName("minutes");
              for (var i = 0; i < x.length; i++) {
                 if(x[i].innerHTML > 1){
                    var tot =parseInt(x[i].innerHTML) - 1;
                    x[i].innerHTML = tot;
                 }
              }
            }

            //Ajax function call aware no complete
            function sendAware(id){
                            $.ajax({
                                    type: "GET",    
                                    url: "{{ url('HomeController/listpatients2') }}/"+ id, 
                                    success: function(result){
                                        $('.modal').modal('toggle');
                                        panelDr();

                      }
                    });
            }

            function agend(){
              window.location.href = "{{ url('drAppointments/redirecting/index') }}";
            }
            function panelDr(){
                var doc = "@php echo session()->get('utype'); @endphp";
              if(doc == "doctor"){          
              $.ajax({
                                    type: "GET",    
                                    url: "{{ url('HomeController/listpatients') }}", 
                                    success: function(result2){
                                  if(result2 == "listo"){
                                    console.log(result2);
                                       $('#stateCite').html('');
                                       $('#stateCite2').show();
                                       $('#drAlert').removeClass('animated');
                                       $('#drAlert').addClass('label-default');
                                       $('#futureCites').html('');
                                       $('#futureCites2').show();
                                       $('#futureCites').removeClass('timeline');
                                  }else{    
                                  console.log(result2);
                                  $('#futureCites').addClass('timeline');
                                  $('#stateCite').html('');
                                  $('#futureCites').html('<li class="time-label none" id="yesterday"><span class="bg-gray">Mañana</span></li><li class="time-label none" id="moreYesterday"><span class="bg-gray">Pasado mañana</span></li><li class="time-label none" id="more"><span class="bg-gray">El resto de la semana</span></li><li><i class="fa fa-clock-o bg-gray" onclick="agend();"></i></li>');
                                   $('#tool').html('');

                      ///Function for cites of day         
                     var now = moment().format("MM/DD/YYYY HH:mm");
                      
                   if(result2[0] != null && result2[0].length > 0){
                     $('#numberAppo').html(result2[0].length);
                     $('#stateCite2').hide();
                     $('#drAlert').addClass('label-warning');
                     $('#drAlert').addClass('animated');
                     var array = new Array();
                      for(var g =0; g < result2[0].length; g++){
                                      var gender = result2[0][g]['gender'];
                                      if(result2[0][g]['profile_photo'] == null){
                                        if(gender == 'female'){
                                           var  photo = "{{ asset('profile-female.png') }}";
                                           gender = 'Femenino';
                                         }
                                        if(gender == 'male'){
                                           var  photo = "{{ asset('profile-42914_640.png') }}";
                                           gender = 'Masculino';
                                         }
                                        if(gender == 'other'){
                                           var  photo = "{{ asset('profile-other.png') }}";
                                           gender = 'Otro';
                                         } 
                                      }else
                                      var photo = result2[0][g]['profile_photo'];
                                           

                                var com = moment(result2[0][g]['when']).format("MM/DD/YYYY HH:mm");
                               if(now < com){
                                  var past = 0;
                                  var tim = moment.utc(moment(com).diff(moment(now))).format("HH:mm");
                                  var timp = tim.split(":");
                                  array.push(timp[1]);
                                } else {
                                  var past = 1;
                                 var tim = moment.utc(moment(now).diff(moment(com))).format("HH:mm");
                                }


                         if(result2[0][g]['status'] == 'No completed'){  
                                    $('#stateCite').append('<li><a class="pointer"><i class="menu-icon fa fa-calendar-times-o bg-red"></i><button type="button" class="close" data-dismiss="li" data-toggle="modal" data-target="#cancel'+ result2[0][g]['id'] +'" onclick=" $(this).parent().parent().fadeOut(1000);">×</button><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p></div></a></li>');

                                                                   $('#tool').append('<div class="modal fade" role="dialog" id="cancel'+ result2[0][g]['id'] +'" data-backdrop="static" data-keyboard="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Detalle de cita cancelada</h4></div><div class="modal-body"><div align="center"><img src="'+ photo +'" class="img-circle" alt="User Image" style="height: 80px;"><br>xxxxxxxxxxxxxxxxxxxxxxx<br><button class="btn btn-secondary btn-flat" onclick="sendAware('+ result2[0][g]['id'] +')">Enterado</button></div></div></div></div></div>');
                                  }
                       else{      

                              $('#tool').append('<div class="modal fade" role="dialog" id="'+ result2[0][g]['id'] +'"><div class="modal-dialog modal-sm modal-content"><div class="modal-header"><button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Información general de la cita</h4></div><div class="modal-body"><ul class="nav nav-stacked" id="normal"><div align="center"><img src="'+ photo +'" id="userp" class="img-circle" alt="User Image" style="height: 100px;"></div><br><li><a ><label class="text-muted">Nombre: </label> '+ result2[0][g]['name'] +'</a></li><li><a><label class="text-muted">Edad: </label> '+ result2[0][g]['age'] +'</a></li><li><a><label class="text-muted">Fecha: </label> '+ result2[0][g]['when'] +'</a></li><li id="buttondetail"><form action="{{ url("doctor/viewPatient/") }}/'+ result2[0][g]['did'] +'" method="get" id="form_profile">{{ csrf_field() }}<button type="submit" class="btn btn-secondary btn-block btn-flat">Detalle de paciente</button></form></li></ul><br></div></div></div>');    

                         if(result2[0][g]['status'] == 'Taked'){  
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'" class="pointer"><i class="menu-icon fa fa-calendar-check-o bg-green"></i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender+', edad: '+ result2[0][g]['age'] +'</p><p></div></a></li>');
                                  }
                         if(result2[0][g]['status'] == 'Registered'){  

                                    var res = tim.split(":");
                                      if(res[0] == '00'){
                                        var ico = res[1];
                                        var ico2 = 'min';
                                        var min = 1;
                                      }else{
                                       var ico = '1'; 
                                       var ico2 = 'H';
                                       var min = 0;
                                      }
                                if(past == 1){
                                   if(min == 1){
                                  $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'" class="pointer"><i class="menu-icon bg-yellow" style="font-size: 11px;">-<span class="minutes">'+ ico +'</span>'+ ico2 +'</i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p></div></a></li>');
                                }else{
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'" class="pointer"><i class="menu-icon bg-yellow" style="font-size: 11px;">-' + ico + ico2 +'</i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p></div></a></li>');
                                }

                                    }else{
                                      if(min == 1){
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'" class="pointer"><i class="menu-icon bg-green" style="font-size: 11px;"><span class="minutes">'+ ico +'</span>'+ ico2 +'</i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p></div></a></li>');
                                      }else{
                                    $('#stateCite').append('<li><a data-toggle="modal" data-target="#'+ result2[0][g]['id'] +'" class="pointer"><i class="menu-icon bg-green" style="font-size: 11px;">+' + ico + ico2 +'</i><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[0][g]['name'] +'</h4><p>'+ gender +', edad: '+ result2[0][g]['age'] +'</p></div></a></li>');

                                      }
                                    }
                                  }
                                }
                                }
                              }else{
                               $('#numberAppo').html('0'); 
                                $('#stateCite2').show();
                                $('#drAlert').removeClass('animated');
                                $('#drAlert').addClass('label-default');
                              }

                      //Function for future cites 
                      if(result2[1] != null && result2[1].length > 0){
                        $('#futureCites2').hide();
                        $('#futureCites').addClass('timeline');
                        var yesterday = moment().add(1, 'day').format("MM/DD/YYYY");
                        var more = moment().add(2, 'day').format("MM/DD/YYYY");      
                       for(var h =0; h < result2[1].length; h++){

                                      var gender = result2[0][h]['gender'];
                                      if(result2[0][h]['profile_photo'] == null){
                                        if(gender == 'female'){
                                           var  photo = "{{ asset('profile-female.png') }}";
                                           gender = 'Femenino';
                                         }
                                        if(gender == 'male'){
                                           var  photo = "{{ asset('profile-42914_640.png') }}";
                                           gender = 'Masculino';
                                         }
                                        if(gender == 'other'){
                                           var  photo = "{{ asset('profile-other.png') }}";
                                           gender = 'Otro';
                                         } 
                                      }else
                                      var photo = result2[0][h]['profile_photo'];

                                     var when = moment(result2[1][h]['when']).format("MM/DD/YYYY");
                            if(yesterday == when){
                              $('#yesterday').removeClass('none');
                              $('#yesterday').after('<li><a class="pointer"><img src="'+ photo +'" class="menu-icon"><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[1][h]['name'] +'</h4><p>'+ gender +', edad: '+ result2[1][h]['age'] +'</p></div></a></li>');

                            }
                            if(more == when){
                              $('#moreYesterday').removeClass('none');
                              $('#moreYesterday').after('<li><a class="pointer"><img src="'+ photo +'" class="menu-icon"><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[1][h]['name'] +'</h4><p>'+ gender +', edad: '+ result2[1][h]['age'] +'</p></div></a></li>');
                            }    
                            if(when > more){
                              $('#more').removeClass('none');
                              $('#more').after('<li><a class="pointer"><img src="'+ photo +'" class="menu-icon"><div class="menu-info"><h4 class="control-sidebar-subheading">'+ result2[1][h]['name'] +'</h4><p>'+ gender +', edad: '+ result2[1][h]['age'] +'</p></div></a></li>');
                            }         

                                   }  
                                 }else{
                                  $('#futureCites').removeClass('timeline');
                                  $('#futureCites').html('');
                                  $('#futureCites2').show();
                                 }  
                               }
                               if($('.minutes').length > 0){
                                  setInterval(minutes, 60000);
                               }
                               var totalTime = parseInt(array[0]) * 60000;
                               if(totalTime > 0)
                               {setTimeout(function(){ timePanel(totalTime); }, totalTime); console.log('setTimeout: ' + totalTime);}
                                else
                               {setTimeout(function(){ timePanel(totalTime); }, 3600000); console.log('setTimeout: 1h');}

                              } 
                       });
              }
            }
    
              //Ajax function call notify set timeout
            function notifications(){
            
              $.ajax(
              {
                type: "GET",    
                url: "{{ url('HomeController/notify') }}", 
                success: function(result){
                 var com = "{{ session()->get('entered') }}";
                    if(com != 1){
                      $('#notN').css("display", "block");  
                    }else{
                        $('#notN').css("display", "none"); 
                    }
                    $('#notify').html('');
                      if(result[1].length > 0){  

                          var length = result[0].length + 1;
                          $('#notify').append('<li><a data-toggle="modal" data-target="#medications"><i class="fa fa-warning text-yellow"></i>Tienes un tratamiento por iniciar</a></li>');

                      }else 
                          var length = result[0].length;   


                  for (var i =0; i < length; i++) {
                    if(length == 1){
                    $('#countNot').html('Tiene '+ length + ' notificación');
                     $('#notN').html('1');
                    }else{
                     $('#notN').html(length);
                    $('#countNot').html('Tiene '+ length + ' notificaciones');
                    }
                    var u = result[0][i]['url'];
                    var url = "{{ url('') }}";
                            $('#notify').append('<li><a href="'+ url +'/'+ u +'"><i class="fa fa-warning text-yellow"></i>'+ result[0][i]['description']+'</a></li>');
                        
                        }
                                }
              });
            $('#newMess').text();
             $.ajax(
                  {
                    type: "GET",    
                    url: "{{ url('HomeController/messages') }}", 
                    success: function(result){
                            console.log(result);
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

                          $('#newMess').append('<li><a href="'+ url +'"><div class="pull-left"><img src="'+ result[o]["profile_photo"] +'" class="img-circle"></div><h4 style="text-align: left; font-size: 9px;">'+ result[o]["name"] +'<small><i class="fa fa-clock-o"></i> '+ mo +'</small></h4><p>'+ result[o]["title"] +'</p></a></li>');
                            }
                          }else{
                               $('#countMes').html('');
                               $('#newMess').html('<li><div class="col-sm-6" align="center"><img src="{{ asset(config("adminlte.empty-message")) }}" height="60" width="60"></div><div class="col-sm-6 text-muted" align="center"><h5>No tienes mensajes nuevos</h5><br></div></li>');
                          }
                            
                             setTimeout(function(){ repeatNot(); },120000);
                            
                      },
                        error: function (request, status, error) {
                            //window.location.href = "{{ url('') }}";
                        }
                  }); 
         }
        function repeatNot(){
            notifications();
        }
        function timePanel(time){
          console.log('ya paso el tiempo '+ time);
            panelDr();
        }

    $(function () {
       /* var socket =  io.connect('http://localhost:6379');
        socket.on('testone:App\\Events\\Event', function(data){
                //you append that data to DOM, so user can see it
                //$('#power').text(data.username)
                console.log('socket');
            });*/

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
                panelDr();

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
@if(!empty(session()->get('medication')))
      @include('modals.medicationsNotConfirm', ['medication' => session()->get('medication') ])
@endif

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


