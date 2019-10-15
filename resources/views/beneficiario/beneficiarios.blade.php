@extends('adminlte::page')

@section('title', 'System SOP')

@section('content')


<div class="card">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header">
                <h2 class="box-title">Proveedores</h2>
            </div>
            <!--Boton para abrir el modal -->
            <div class="col-xs-2">
                <button type="button" name="create_button" id="create_button" class="btn btn-success btn-sm">
                    <strong>Agregar Proveedor</strong>
                </button>
            </div>
            <!-- Tabla beneficiario-->
            <hr class="col-xs-12">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-body table-responsive no-padding">
                                <table id="table_beneficiario" class="table table-hover" >
                                    <thead>
                                        <tr role="row" class="bg bg-gray">
                                            <th style="width: 5%">N° de Beneficiario</th>
                                            <th style="width: 25%">Beneficiario</th>
                                            <th style="width: 25%">Titular</th>
                                            <th style="width: 25%">Enlace</th>
                                            <th style="width: 25%">Telefono</th>
                                            <th style="width: 25%">Email</th>
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
                <h4 class="modal-title">Agregar Proveedor</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form"  enctype="multipart/form-data">
                    @csrf
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="num_beneficiario">N° de Proveedor</label>
                                <input name="num_beneficiario" id="num_beneficiario" class="form-control typeahead" type="text" placeholder="N°"/>
                            </div>
                            <div class="col-xs-9">
                                <label for="proveedor">Nombre del proveedor</label>
                                <input name="beneficiario" id="beneficiario" class="form-control" type="text" placeholder="Nombre del Proveedor"/>
                            </div>
                            <div class="col-xs-6">
                                <label for="titutlar">Titular</label>
                                <input name="titular" id="titular" class="form-control" type="text" placeholder="Titular"/>
                            </div>

                            <div class="col-xs-6">
                                <label for="enlace">Enlace</label>
                                <input name="enlace" id="enlace" class="form-control" type="text" placeholder="Enlace"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="rfc">RFC</label>
                                <input name="rfc" id="rfc" class="form-control" type="text" placeholder="RFC"/>
                            </div>
                            <div class="col-xs-5">
                                <label for="giro">Giro</label>
                                <div class="input-group">
                                    <input name="giro" id="giro" class="form-control" type="text" placeholder="Giro"/>
                                </div>
                            </div>

                            <div class="col-xs-3">
                                <label for="telefono">Telefono</label>
                                <input name="telefono" id="telefono" class="form-control" type="text" placeholder="Telefono"/>
                            </div>
                            <div class="col-xs-6">
                                <label for="email">Email</label>
                                <input name="email" id="email" class="form-control" type="email" placeholder="Email"/>
                            </div>

                            <div class="col-xs-6">
                                <label for="direccion">Dirección</label>
                                <input name="direccion" id="direccion" class="form-control" type="text" placeholder="Dirección"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="cp">CP</label>
                                <input name="cp" id="cp" class="form-control" type="text" placeholder="CP"/>
                            </div>

                            <div class="col-xs-4">
                                <label for="ciudad">Ciudad</label>
                                <input name="ciudad" id="ciudad" class="form-control" type="text" placeholder="Ciudad"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="pais">Pais</label>
                                <input name="pais" id="pais" class="form-control" type="text" value="México" placeholder="Pais" readonly/>
                            </div>
                            <div class="col-xs-4 ">
                                <label for="tipo">Tipo</label>
                                <input name="tipo" id="tipo" class="form-control" type="text" value="PROVEEDOR" readonly>
                            </div>
                            <div class="col-xs-8">
                                <label for="observaciones">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" class="form-control" rows="2" placeholder="Observaciones ..." ></textarea>
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

<!-- Script CRUD Ajax -->
<script type="text/javascript">
    $(document).ready(function() {

        /* Consulta Ajax Tabla beneficiario */
        $('#table_beneficiario').DataTable({
            "processing": true,
            "serverSide": true,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "ajax": "{{ route('beneficiario.index') }}",
            "columns":[
                { "data": "num_beneficiario" },
                { "data": "beneficiario" },
                { "data": "titular" },
                { "data": "enlace" },
                { "data": "telefono" },
                { "data": "email" },
                { "data": "action"}
            ]
        });/* Fin Script */

        /* Abrir ventana modal */
        $('#create_button').click(function(){
            $('#sample_form')[0].reset();
            $('.modal-title').text("Agregar provedor");
            $('#action_button').val("Agregar");
            $('#action').val("Agregar");
            $('#formModal').modal('show');
        });/* Fin Script */
        
        /* Insertar datos */
        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action').val() == 'Agregar'){
                $.ajax({
                    url:"{{route('beneficiario.store')}}",
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
                            html += '<h4><i class="icon fa fa-check"></i> Provedor almacenado</h4></div>';
                            $('#sample_form')[0].reset();
                            $('#table_beneficiario').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action').val() == "Editar"){
                $.ajax({
                    url:"{{ route('beneficiario.update') }}",
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
                            $('#table_beneficiario').DataTable().ajax.reload();
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
                url:"/beneficiario/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#num_beneficiario').val(html.data.num_beneficiario);
                    $('#beneficiario').val(html.data.beneficiario);
                    $('#titular').val(html.data.titular);
                    $('#enlace').val(html.data.enlace);
                    $('#rfc').val(html.data.rfc);
                    $('#giro').val(html.data.giro);
                    $('#telefono').val(html.data.telefono);
                    $('#email').val(html.data.email);
                    $('#direccion').val(html.data.direccion);
                    $('#cp').val(html.data.cp);
                    $('#ciudad').val(html.data.ciudad);
                    $('#pais').val(html.data.pais);
                    $('#observaciones').val(html.data.observaciones);
                    $('#tipo').val(html.data.tipo);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Editar provedor");
                    $('#action_button').val("Editar");
                    $('#action').val("Editar");
                    $('#formModal').modal('show');
                }
            })
        });/* Fin Script */

        var user_id;

        /* Eliminar */
        $(document).on('click', '.delete', function(){
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"beneficiario/destroy/"+user_id,
                beforeSend:function(){
                    $('.modal-titlee').text("Eliminar provedor");
                    $('#ok_button').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#table_beneficiario').DataTable().ajax.reload();
                    $('#ok_button').text('OK');
                    }, 2000);
                }
            })
        });

    });
</script>

@stop
