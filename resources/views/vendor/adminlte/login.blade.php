@extends('adminlte::master')
<head>
    <meta name="google-signin-client_id" content="547942327508-f90dgpiredb3mj5sosnsm89mq7c45f8u.apps.googleusercontent.com">
    <meta name="_token" content="{{ csrf_token() }}">
</head>

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop





@section('body_class', 'login-page')





@section('body')
    </div>
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'medicalconsultations')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body box">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
                <div id="myModal" class="modal2">
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <!-- casilla de recordar usuario. -->
                        &nbsp;
                        <!-- <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                            </label>
                        </div> -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-secondary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                    </div><br><br><br>
                    <!-- /.col -->
                    <div id="alertError"></div><!---->
                    <div class="box" align="center" style="border-style: none; box-shadow: none;"><br>
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
                                    data-scope="public_profile,email" onlogin="checkLoginState();"></div>
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
                                    <div class="g-signin2"  data-width="165" data-height="27" data-clientid="547942327508-f90dgpiredb3mj5sosnsm89mq7c45f8u.apps.googleusercontent.com"data-onsuccess="onSignInG"></div><br>
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
                                        api_key: 78maelkx5by0xp
                                        authorize: true
                                        onLoad: onLinkedInLoad
                                        scope: r_basicprofile r_emailaddress
                                        lang: es_ES
                                    </script>
                                    <div align="center"><script type="in/Login"></script></div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="overlay" id="cargar">
                            <div id="carga2"class="fa fa-refresh fa-spin"></div>
                        </div>
                     </div>
                </div>
            </form>
            <div class="" id="loginload">
                <div id="loginload2"class=""></div>
            </div>
        </div>
        <div class="auth-links">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="text-center" >
                        {{ trans('adminlte::adminlte.i_forgot_my_password') }}
                    </a>
                </div>
                <div class="col-xs-6">
                    @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}" class="text-center">
                        {{ trans('adminlte::adminlte.register_a_new_membership') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.login-box-body -->
        <div class="modal-content2">
                <div class="modal-header2">
                    <span class="close2">&times;</span>
                    <h3>Error: </h3>
                </div>
                <div class="modal-body2">
                    <h4>Los datos no corresponden con nuestra base de datos, asegúrese de estar registrado.</h4>
                </div>
        </div>
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
 