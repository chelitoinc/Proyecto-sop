@extends('adminlte::page')
@section('title', 'System SOP')
@section('content')

<div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @elseif(Session::has('error'))
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('error') }}</p>
    </div>
    @endif
</div>

<div class="col-md-12">
    <div class="box box-default box-solid collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Cargar Responsables</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
            
        </div>
        
        <div class="box-body" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Descargar en diferentes documentos</h5>
                    <a href="{{ url('/clasificados/downloadResponsables/xlsx') }}"><button class="btn btn-dark">Descargar Excel xlsx</button></a>
                    <a href="{{ url('/clasificados/downdoaldPlantilla/xlsx') }}"><button class="btn btn-warning">Descargar Prantilla</button></a>

                    <form  action="{{ url('clasificados/importData') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <input type="file" name="import_file" />
                        <hr>
                        <button class="btn btn-primary">Importar Archivo</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header">
                <h2 class="box-title">Responsables</h2>
            </div>
            <!--Boton para abrir el modal -->
            <div class="col-xs-2">
                <button type="button" name="create_button" id="create_button" class="btn btn-success btn-sm">
                    <strong>Agregar Responsable</strong>
                </button>
            </div>
            <!-- Tabla Clasificado-->
            <hr class="col-xs-12">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-body table-responsive no-padding">
                                <table id="table_responsables" class="text-center table table-hover" >
                                    <thead>
                                        <tr role="row" class="text-center bg bg-gray">
                                            <th style="width: 25%"># Dependencia</th>
                                            <th style="width: 15%">Dependencia</th>
                                            <th style="width: 25%"># Unidad</th>
                                            <th style="width: 20%">Unidad Administrativa</th>
                                            <th style="width: 15%">Numero de Proyecto</th>
                                            <th style="width: 35%">Nombre de Proyecto</th>
                                            <th style="width: 10px">Acción</th> 
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
                <h4 class="modal-title">Agregar Responsable</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form"  enctype="multipart/form-data">
                    @csrf
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-12">
                                <p>Num de Dependencia</p>
                                <input name="num_dependencia" id="num_dependencia" class="form-control" type="text"/>
                            </div>
                            <div class="col-xs-12">
                                <p>Dependencia</p>
                                <input name="dependencia" id="dependencia" class="form-control" type="text" value="Secretaría de Obras Públicas"/>
                            </div>
                            <div class="col-xs-12">
                                <p>Num de Unidad</p>
                                <input name="num_unidad" id="num_unidad" class="form-control" type="text"  />
                            </div>
                            <div class="col-xs-12">
                                <p>Unidad</p>
                                <input name="unidad" id="unidad" class="form-control" type="text" placeholder="Unidad"/>
                            </div>
                            <div class="col-xs-12">
                                <p>Numero de Proyecto</p>
                                <input name="num_proyecto" id="num_proyecto" class="form-control" placeholder="Numero de proyecto" >
                            </div>
                            <div class="col-xs-12">
                                <p>Nombre</p>
                                <input name="nombre" id="nombre" class="form-control" placeholder="Nombre" >
                            </div>
                            <div class="col-xs-6">
                                <br>
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

<script type="text/javascript">
    $(document).ready(function() {

        /* Table Responsables */
        $('#table_responsables').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('responsables.index') }}",
            "columns":[
                { "data": "num_dependencia" },
                { "data": "dependencia" },
                { "data": "num_unidad" },
                { "data": "unidad" },
                { "data": "num_proyecto" },
                { "data": "nombre"},
                { "data": "action" }
            ]
        });/* Fin script */

        /* Abrir ventana modal */
        $('#create_button').click(function(){
            $('#sample_form')[0].reset();
            $('.modal-title').text("Agregar Responsable");
            $('#action_button').val("Agregar");
            $('#action').val("Agregar");
            $('#formModal').modal('show');
        });/* Fin Script */

        /* Insertar datos */
        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action').val() == 'Agregar'){
                $.ajax({
                    url:"{{route('responsables.store')}}",
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
                            html += '<h4><i class="icon fa fa-check"></i> Responsable almacenado</h4></div>';
                            $('#sample_form')[0].reset();
                            $('#table_responsables').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action_button').val() == "Editar"){
                $.ajax({
                    url:"{{ route('responsables.update') }}",
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
                            $('#table_responsables').DataTable().ajax.reload();
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
                url:"/responsables/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#num_dependencia').val(html.data.num_dependencia);
                    $('#dependencia').val(html.data.dependencia);
                    $('#num_unidad').val(html.data.num_unidad);
                    $('#unidad').val(html.data.unidad);
                    $('#num_proyecto').val(html.data.num_proyecto);
                    $('#nombre').val(html.data.nombre);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Editar Responsable");
                    $('#action_button').val("Editar");
                    $('#action').val("Editar");
                    $('#formModal').modal('show');
                }
            })
        });/* Fin Script */

        var crasificado_id;

        $(document).on('click', '.delete', function(){
            crasificado_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"responsables/destroy/"+crasificado_id,
                beforeSend:function(){
                    $('.modal-titlee').text("Eliminar Responsable");
                    $('#ok_button').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#table_responsables').DataTable().ajax.reload();
                    $('#ok_button').text('OK');
                    }, 2000);
                }
            })
        }); /* End script */

    });
</script>

@stop