@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">
            <b>System</b>SOP
            </a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Registrar a un nuevo miembro</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="Nombre">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('surname') ? 'has-error' : '' }}">
                    <input type="text" name="surname" class="form-control" value="{{ old('surname') }}"
                           placeholder="Apellidos">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('surname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('nick') ? 'has-error' : '' }}">
                    <input type="text" name="nick" class="form-control" value="{{ old('nick') }}"
                           placeholder="Usuario">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('nick'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nick') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('num_empleado') ? 'has-error' : '' }}">
                    <input type="text" name="num_empleado" class="form-control" value="{{ old('num_empleado') }}"
                           placeholder="Numero de empleado">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('num_empleado'))
                        <span class="help-block">
                            <strong>{{ $errors->first('num_empleado') }}</strong>
                        </span>
                    @endif
                </div>
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
                           placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="Confirmar contraseña">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
