@extends('adminlte::page')

@section('title', 'System SOP')

@section('content')

<div class="card">
    <div class="col-xs-12 ">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Mi perfil</h3>
            </div>
            <div class="box-body ">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        
                        <img class="profile-user-img img-responsive img-circle" src="{{asset('img/foto.png')}}" id="avatarImage" >

                        <h3 class="profile-username text-center">{{ Auth::user()->nick }}</h3>

                        <ul class="list-group list-group-unbordered">

                            <li class="list-group-item">
                                <b>Nombre</b> <a class="pull-right">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Apellidos</b> <a class="pull-right">{{ Auth::user()->surname }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Numero de Empleado</b> <a class="pull-right">{{ Auth::user()->num_empleado }}</a>
                            </li>
                            <li class="list-group-item">
                                <form method="POST" action="#" enctype="multipart/form-data" aria-label="Configuración de mi cuenta" id="avatarForm" >
                                    @csrf
                                    <input type="file" id="avatarInput" name="photo">
                                    <hr>
                                    <input type="submit" value="Cambiar fotografia de perfil" class="btn btn-primary btn-block"> 
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {

        var $avatarImage, $avatarInput, $avatarForm;

        $avatarImage = $('#avatarImage');
        $avatarInput = $('#avatarInput');
        $avatarForm = $('#avatarForm');

        $avatarImage.on('click', function () {
            $avatarInput.click();
        });

        $avatarInput.on('change', function () {
            var formData = new FormData();
            formData.append('photo', $avatarInput[0].files[0]);

            $.ajax({
                url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
                method: $avatarForm.attr('method'),
                data: formData,
                processData: false,
                contentType: false
            }).done(function (data) {
                if (data.success)
                    $avatarImage.attr('src', data.path);
            }).fail(function () {
                alert('La imagen subida no tiene un formato correcto');
            });
        });
    });
</script>



@stop