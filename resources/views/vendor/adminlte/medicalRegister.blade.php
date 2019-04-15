@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')

  <script type="text/javascript">
                                $.ajax(
                                      {
                                        type: "GET",    
                                        url: "{{ url('/medicalRegister/society') }}", 
                                        success: function(result){
                                          console.log(result);

                                          var x = document.getElementById("medical_society");
                                          
                                          for (var i = 0; i < result.length; i++) {
                                            console.log(result[i].name);
                                            var option = document.createElement("option");
                                            option.text = result[i].name;
                                            option.value = result[i].name;
                                            x.add(option);

                                          }
                                        }
                                      }
                                    );



                                </script>

    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'medicalconsultations')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">

            <div class="alert alert-info alert-dismissible" >
                <i class="icon fa fa-info"></i> {{ trans('adminlte::adminlte.Message_to_doctor') }}
            </div>
            <!-- <p class="login-box-msg"></p> -->

            <!-- <form action="{{ url(config('adminlte.register_doctor_url', 'medicalRegister')) }}" method="post"> -->
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}


                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="{{ trans('adminlte::adminlte.full_name') }}" id="name">
                    <span class="fa  fa-user-md form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                    <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate') }}" placeholder="{{ trans('adminlte::adminlte.birthdate') }}" autocomplete="off">
                    <span class="fa fa-birthday-cake form-control-feedback"></span>
                    @if ($errors->has('birthdate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('birthdate') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('professional_license') ? 'has-error' : '' }}">
                    <input type="text" name="professional_license" class="form-control" value="{{ old('professional_license') }}" placeholder="{{ trans('adminlte::adminlte.professional_license') }}" id="professional_license">
                    <span class="fa  fa-keyboard-o form-control-feedback"></span>
                    @if ($errors->has('professional_license'))
                        <span class="help-block">
                            <strong>{{ $errors->first('professional_license') }}</strong>
                        </span>
                    @endif
                </div>

               <div class="form-group has-feedback {{ $errors->has('medical_society') ? 'has-error' : '' }}">
                   <select class="form-control select2" name="medical_society" id="medical_society" size="1">
                    <option default>--Ninguna--</option>
                    </select>
                </div> 
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>


                <button type="submit" class="btn btn-secondary btn-block btn-flat">
                    {{ trans('adminlte::adminlte.register_a_new_membership_doctor') }}
                </button><br/>
                <div class="row">
                <div class="col-sm-6" align="center">
                        <a href="{{ url(config('adminlte.login_url', 'login')) }}" class="btn btn-default btn-block btn-flat">
                             <i class="fa fa-arrow-left"></i>&nbsp;&nbsp;
                         {{ trans('adminlte::adminlte.i_already_have_a_membership') }}
                        </a> 
                </div>
                <div class="col-sm-6" align="center">
                    <a class="btn btn-default btn-block btn-flat" href="{{ url(config('adminlte.register__doctor_url', 'register')) }}" >
                        <i class="fa fa-user"></i>&nbsp;&nbsp;
                        {{ trans('adminlte::adminlte.i_am_a_patient') }}
                    </a> 
                </div>
            </div>
            </form>
           

            <div class="auth-links">
               
                <!-- <a href="{{ url(config('adminlte.login_url', 'login')) }}" class="text-center">{{ trans('adminlte::adminlte.i_am_a_doctor') }}</a> -->
            </div>
       
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
