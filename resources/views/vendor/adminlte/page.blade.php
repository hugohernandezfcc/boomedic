@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' fixed sidebar-mini sidebar-mini-expand-feature' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))


@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'medicalconsultations')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'medicalconsultations')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  @if($photo == '')
                                        <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" class="user-image" alt="User Image">
                                    @else
                                        <img src="{{ $photo }}" class="user-image" alt="User Image">            
                                    @endif 
                                  <span class="hidden-xs">{{ $name }}</span>
                                </a>
                                <ul class="dropdown-menu bg-darken-4">
                                  <!-- User image -->
                                  <li class="user-header" style="background-color: #222;">
                                    @if($photo == '')
                                        <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" class="img-circle" alt="User Image">
                                    @else
                                        <img src="{{ $photo }}" class="img-circle" alt="User Image">            
                                    @endif 

                                    <p>
                                        {{ $name }}
                                      <small>Miembro desde
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '01') Ene. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '02') Feb. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '03') Mar. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '04') Abr. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '05') May. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '06') Jun. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '07') Jul. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '08') Ago. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '09') Sep. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '10') Oct. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '11') Nov. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '12') Dic. @endif
                                        {{ \Carbon\Carbon::parse($date)->format('Y') }}

                                      </small>
                                    </p>
                                  </li>
                                  <!-- Menu Footer-->
                                  <li class="user-footer" style="background-color: #222;">
                                    <div class="pull-center">
                                 @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-block btn-flat" style="background:white; color:black;">
                                    <i class="fa fa-sign-out"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                 class="btn btn-default btn-block btn-flat" style="background:white; color: black;">
                                    <i class="fa fa-sign-out"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                                    </div>
                                  </li>
                                </ul>
                              </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
    @if(!$mode)
    &nbsp;
    @elseif($mode == 'labor')

    <footer class="main-footer">
  
            @if($labor-&gt;isEmpty())
                         <span class="text-black">No hay ningún consultorio asociado a su cuenta.</span>
            @else

                <div class="box-group" id="accordion">
                <div class="panel box box-default" style="border-top-color: gray;">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="a text-black collapsed" style="font-size: 12px;">
                 <div class="box-header with-border"> 
                       <div align="left"><i class="fa fa-chevron-down text-muted"></i> <b>Consultorios agregados recientemente</b></div>
                     </div> 
                    </a>
                  <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    @foreach($labor-&gt;sortByDesc('created_at') as $labor) 
                    
                                @if($loop-&gt;iteration &lt; 3)
                                <div class="form-group">
                                    <div class="col-sm-8" style="padding-right: 0; padding-left: 0;">
                                      <div class="info-box sm bg-gray">
                                        <a href="{{ url('workboardDr/index') }}/{{$labor-&gt;id}}"><span class="info-box-icon sm bg-black"><i class="fa fa-calendar"></i></span></a>
                                        <div class="info-box-content sm">
                                          <b> {{ $labor-&gt;workplace}}</b>
                                         <span class="text-black">{{ $labor-&gt;country }}, {{ $labor-&gt;state }}, {{ $labor-&gt;colony }}, {{ $labor-&gt;delegation }}, {{ $labor-&gt;street }} {{ $labor-&gt;streetNumber }}. CP: {{ $labor-&gt;postalcode }}</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-4" style="padding-right: 0; padding-left: 0;">

                                    <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $labor-&gt;latitude }},{{ $labor-&gt;longitude }}&amp;markers=color:black%7Clabel:%7C{{ $labor-&gt;latitude }},{{ $labor-&gt;longitude }}&amp;zoom=15&amp;size=350x45&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%; height:45px;">    
                                    </div>
                                        
                               @endif   
                               @if($loop-&gt;iteration &gt; 2)
                               <div class="col-sm-12" style="text-align: right;" align="right">
                                <a href="{{ url('doctor/laborInformationView') }}/{{ $userId }}" class="text-muted">
                               Ver todos... <i class="fa fa-arrow-right"></i>
                               </a>
                               </div>
                               </div>
                               @break
                               @endif           
                    @endforeach
                </div>   
            </div>
                    </div>
                  </div>
        @endif
    </footer>
    @endif

@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
