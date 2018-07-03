@extends('adminlte::master')
<head>
    <meta name="google-signin-client_id" content="547942327508-f90dgpiredb3mj5sosnsm89mq7c45f8u.apps.googleusercontent.com">
    <meta name="_token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ asset('js/FacebookLogin.js') }}" async="true" defer="true"></script>
</head>

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop





@section('body_class', 'login-page')





@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'medicalconsultations')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body box">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
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
                <input type="hidden" name="uuid" id="uuid">
                        <button type="submit" class="btn btn-secondary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                  </form>
                    <!-- /.col -->
                    <div class="box" align="center" style="border-style: none; box-shadow: none;"><br>
                        <div class="box-group" id="accordion">
                        <div class="panel box box-primary">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="text-black" style="font-size: 14px;">
                          <div class="box-header with-border" align="left">
                                <i class="fa fa-fw fa-facebook-official" style="color: rgb(59, 89, 152);"></i><b>Facebook</b>
                          </div>
                          </a>
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
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="text-black" style="font-size: 14px;">
                          <div class="box-header with-border" align="left">
                                <i class="fa fa-fw fa-google" style="color: rgb(211, 72, 54);"></i><b>Google</b>
                          </div>
                          </a>
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
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="text-black" style=" font-size: 14px;">
                          <div class="box-header with-border" align="left">
                                <i class="fa fa-fw fa-linkedin"></i><b>LinkedIn</b>
                          </div>
                           </a>
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
                        <div class="overlay" id="cargarfacebook">
                            <div id="cargafacebook"class="fa fa-refresh fa-spin"></div>
                        </div>
                     </div>

            
            <div class="" id="loginload">
                <div id="loginload2"class=""></div>
            </div>
                        <div class="auth-links">
            <div class="row">
                <div class="col-sm-7" align="center">
                    <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="btn btn-default btn-block btn-flat">
                        {{ trans('adminlte::adminlte.i_forgot_my_password') }}
                    </a>
                </div>
                    @if (config('adminlte.register_url', 'register'))
                <div class="col-sm-5" align="center">
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}" class="btn btn-default btn-block btn-flat">
                        {{ trans('adminlte::adminlte.register_a_new_membership') }}
                    </a>
                </div>
                    @endif
                
            </div>
            </div>
        </div>

        </div>
        
        <!-- /.login-box-body -->
        <div id="myModal" class="modal-danger2">
            <div class="modal-content-danger2">
                <div class="modal-header-danger2">
                    <span class="close-danger2">&times;</span>
                    <h3>Error: </h3>
                </div>
                <div class="modal-body-danger2">
                    <h4>Los datos no corresponden con nuestra base de datos, asegúrese de estar registrado.</h4>
                </div>
            </div>
        </div>
    </div><!-- /.login-box -->
    <script type="text/javascript">
$(document).ready(function(){
     if("@php echo $agent->isMobile(); @endphp"){
            var link = location.href;
            var split = link.split('?');
          document.getElementById('uuid').value = split[1];
          "@php Session(['uuid' => '"+ split[1] + "']); @endphp" 
          alert("@php echo session()->get('uuid'); @endphp");
      }
  })
    </script>
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
 