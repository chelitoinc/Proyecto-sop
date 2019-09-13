@extends('adminlte::page')
@section('title', 'System SOP')
@section('content')

<div class="card">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header">
                <h2 class="box-title">Usuarios</h2>
            </div>
            <!--Boton para abrir el modal -->
            <div class="col-xs-2">
                <button type="button" name="create_button" id="create_button" class="btn btn-success btn-sm">
                    <strong>Agregar Usuario</strong>
                </button>
            </div>
            <!-- Tabla Usuarios-->
            <hr class="col-xs-12">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-body table-responsive no-padding">
                                <table id="table_usuario" class="table table-hover" >
                                    <thead>
                                        <tr role="row" class="bg bg-gray">
                                            {{-- <th style="width: 25%">Foto</th> --}}
                                            <th style="width: 20%">N° de empleado</th>
                                            <th style="width: 40%">Nombres</th>
                                            <th style="width: 40%">Apellidos</th>
                                            <th style="width: 50%">Email</th>
                                            <th style="width: 20%">Rol</th>
                                            <th style="width: 40px">Acción</th> 
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!---Fin tabla -->
        </div>
    </div>
</div>

<!-- Formulario Modal -->
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar usuario</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form"  enctype="multipart/form-data">
                    @csrf
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-5">
                                <p>Nombre</p>
                                <input name="name" id="name" class="form-control" type="text" placeholder="Nombres"/>
                            </div>
                            <div class="col-xs-7">
                                <p>Apellidos</p>
                                <input name="surname" id="surname" class="form-control" type="text" placeholder="Apellidos"/>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-3">
                                <p>N° de empleado</p>
                                <input name="num_empleado" id="num_empleado" class="form-control" type="text" placeholder="N° Emplead@"/>
                            </div>
                            <div class="col-xs-4">
                                <p>Nombre de usuario</p>
                                <input name="nick" id="nick" class="form-control" type="text" placeholder="Usuario"/>
                            </div>
                            <div class="col-xs-5">
                                <div class="input-group">
                                    <p>Email</p>
                                    <input name="email" id="email" class="form-control" type="email" placeholder="Email"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-4">
                                <p>Tipo de usuario</p>
                                <select name="role" id="role" class="form-control select2 ">
                                    <option value="user" active >Usuario</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <p>Contraseña por defecto: "obp-2019"</p>
                                <input name="password" id="password" class="form-control" type="password" value="obp-2019" placeholder="obp-2019"/>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="hidden" name="action" id="action" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Agregar" />
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Seguridad-->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg bg-red">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-titlee">Confirmar</h4>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Estas seguro de eliminarlo?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Fin -->

<!-- TABLA USUARIOS -->
<script type="text/javascript">
    $(document).ready(function() {

        /* Consulta AJAX tabla Users */
        $('#table_usuario').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('user.index') }}",
            "columns":[
                { "data": "num_empleado" },
                { "data": "name" },
                { "data": "surname" },
                { "data": "email" },
                { "data": "role" },
                { "data": "action" }
            ]
        });
        /* Fin script */

        /* Abrir ventana modal */
        $('#create_button').click(function(){
            $('#sample_form')[0].reset();
            $('.modal-title').text("Agregar usuario");
            $('#action_button').val("Agregar");
            $('#action').val("Agregar");
            $('#formModal').modal('show');
        });/* Fin Script */

        /* Insertar datos */
        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action').val() == 'Agregar'){
                $.ajax({
                    url:"{{route('user.store')}}",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success:function(data){
                        var hmlt= '';
                        if(data.errors){
                            html = '<div class="alert alert-danger alert-dismissible">';
                            html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                            html += '<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
                            for(var count = 0; count < data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success){
                            html = '<div class="alert alert-success alert-dismissible">' + data.success;
                            html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                            html += '<h4><i class="icon fa fa-check"></i> Usuario almacenado</h4></div>';
                            $('#sample_form')[0].reset();
                            $('#table_usuario').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action').val() == "Editar"){
                $.ajax({
                    url:"{{ route('user.updateAdmin') }}",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++){
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success){
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#table_usuario').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            }
        });/* Fin Script */

        /* Edit  */
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/user/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#name').val(html.data.name);
                    $('#surname').val(html.data.surname);
                    $('#num_empleado').val(html.data.num_empleado);
                    $('#nick').val(html.data.nick);
                    $('#email').val(html.data.email);
                    $('#role').val(html.data.role);
                    $('#password').val(html.data.password);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Editar usuario");
                    $('#action_button').val("Editar");
                    $('#action').val("Editar");
                    $('#formModal').modal('show');
                }
            })
        });/* Fin Script */

        /* Eliminar */
        var user_id;

        $(document).on('click', '.delete', function(){
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"user/destroy/"+user_id,
                beforeSend:function(){
                    $('.modal-titlee').text("Eliminar Usuario");
                    $('#ok_button').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#table_usuario').DataTable().ajax.reload();
                    $('#ok_button').text('OK');
                    }, 2000);
                }
            })
        }); /* End script */

    });
</script>

@stop