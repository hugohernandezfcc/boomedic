@extends('adminlte::master')
<head>
    <meta name="google-signin-client_id" content="627103508601-mstgbse0thdiv2qcn2dop6pn0u28gc31.apps.googleusercontent.com">
    <meta name="_token" content="{{ csrf_token() }}">
</head>

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'medicalconsultations')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}


                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="{{ trans('adminlte::adminlte.full_name') }}" id="name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}" id="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                    <input type="text" name="birthdate" class="form-control" value="{{ old('birthdate') }}" placeholder="{{ trans('adminlte::adminlte.birthdate') }}" id="datepicker">
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    @if ($errors->has('birthdate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('birthdate') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}" id="passw">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('adminlte::adminlte.retype_password') }}" id="passwc">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>


                <button type="submit" class="btn btn-secondary btn-block btn-flat">
                    {{ trans('adminlte::adminlte.register_a_new_membership') }}
                </button>

                <div class="box"  align="center" id="socialnet" style="border:none; box-shadow: none;"><br>
                    <div class="box-group" id="accordion">
                        <div class="panel box box-primary">
                          <div class="box-header with-border" align="left">
                            <h4 class="box-title">
                                <i class="fa fa-fw fa-facebook-official" style="color: rgb(59, 89, 152);"></i>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Facebook
                                </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse">
                            <div class="box-body">
                                <div class="row" align="center">
                                    <div class="fb-login-button" id="botonfacebook_tocustom" data-size="medium" data-button-type="login_with" 
                                    data-scope="public_profile,email" onlogin="fbRegister();"></div>
                                </div><br>
                            </div>
                          </div>
                        </div>
                        <div class="panel box box-danger">
                          <div class="box-header with-border" align="left">
                            <h4 class="box-title">
                                <i class="fa fa-fw fa-google" style="color: rgb(211, 72, 54);"></i>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >
                                Google
                              </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                                <div class="row" align="center">
                                    <div class="g-signin2"  data-width="165" data-height="27" data-clientid="627103508601-mstgbse0thdiv2qcn2dop6pn0u28gc31.apps.googleusercontent.com  "data-onsuccess="onRegisterG"></div><br>
                            <!--<div class="g-plusone" id="myButton" data-onload="renderG"></div>-->
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="panel box box-success">
                          <div class="box-header with-border" align="left">
                            <h4 class="box-title">
                                <i class="fa fa-fw fa-linkedin"></i>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                LinkedIn
                              </a>
                            </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse">
                            <div class="box-body">
                                <div class="row">
                                    <script type="text/javascript" src="//platform.linkedin.com/in.js" async defer>
                                        api_key: 78ezayhtq8yi4u
                                        authorize: true
                                        onLoad: onLinkedInLoad2
                                        scope: r_basicprofile r_emailaddress
                                        lang: es_ES
                                    </script>
                                    <div align="center"><script type="in/Login"></script></div>
                                </div>
                            </div>
                          </div>
                        </div>
                </div>

            </form>
            <br/> 
            <div class="row">
                <div class="col-sm-6" align="center">
                    <a class="btn btn-default btn-block btn-flat" href="{{ url(config('adminlte.login_url', 'login')) }}" >
                        <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;
                        {{ trans('adminlte::adminlte.i_already_have_a_membership') }}
                    </a> 
                </div>
                <div class="col-sm-6" align="center">
                    <a class="btn btn-default btn-block btn-flat" href="{{ url(config('adminlte.register__doctor_url', 'medicalRegister')) }}" >
                        <i class="fa fa-user-md"></i>&nbsp;&nbsp;
                        {{ trans('adminlte::adminlte.i_am_a_doctor') }}
                    </a> 
                </div>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
