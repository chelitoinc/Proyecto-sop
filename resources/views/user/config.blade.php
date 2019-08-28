@extends('adminlte::page')

@section('title', 'System SOP')

@section('content')

<div class="card">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Mi perfil</h3>
            </div>
            <div class="box-body">

                <div class="container col-xs-4">
                    <img src="{{asset('img/foto.png')}}" alt="foto de perfil" class="img-thumbnail" width="270"> 
                    <form action="#" enctype="multipart/form-data" aria-label="Configuración de mi cuenta" >
                        @csrf
                       {{--  <div class="form-group">
                            <label for="surname">Apellidos</label>
                            <input type="file" class="form-control" id="foto" >
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>--}}
                    </form>
                </div>
                <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data" aria-label="Configuración de mi cuenta" class="col-xs-4">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ Auth::user()->name }}" readonly="readonly">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellidos</label>
                        <input type="text" class="form-control" id="surname" placeholder="Apellidos" value="{{ Auth::user()->surname }}" readonly="readonly">
                        @if ($errors->has('surname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nick">Usuario</label>
                        <input type="text" class="form-control" id="nick" placeholder="Usuario" value="{{ Auth::user()->nick }}" readonly="readonly">
                        @if ($errors->has('nick'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nick') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="num_empleado">N° de Empleado</label>
                        <input type="text" class="form-control" id="num_empleado" placeholder="Usuario" value="{{ Auth::user()->num_empleado }}" readonly="readonly">
                        @if ($errors->has('num_empleado'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('num_empleado') }}</strong>
                        </span>
                        @endif
                    </div>
                </form>
            </div> <!-- fin contenido-->
        </div>
    </div>
</div>

@stop