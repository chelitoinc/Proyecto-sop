@extends('adminlte::page')
@section('title', 'System SOP')
@section('content_header')

{{-- Datatable Tramite --}}
<div class="card">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header">
                <h2 class="box-title">Altas de Reportes</h2>
            </div>
            <!--Boton para abrir el modal -->
            <div class="col-xs-2">
                <button type="button" name="create_button" id="create_button" class="btn btn-success btn-sm">
                    <strong>Nuevo Reporte</strong>
                </button>
            </div>
            <!-- Tabla Usuarios-->
            <hr class="col-xs-12">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="box-body table-responsive no-padding">
                                <table id="table_reportes" class="table table-hover text-center" >
                                    <thead>
                                        <tr role="row" class="bg bg-gray">
                                            <th style="width: 13%">Número de Folio</th>
                                            <th style="width: 25%">Nombre del Proveedor</th>
                                            <th style="width: 10%">Importe</th>
                                            <th style="width: 15%">Proyecto</th>
                                            <th style="width: 15%">Fecha</th>
                                            <th style="width: 10%">Acción</th> 
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
{{-- Datatable Saldos --}}
<div class="col-xs-6">
    <div class="box box-default box-solid collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Saldos Acumulados</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="col-sm-12">
                            <table id="table_saldos" class="table table-bordered table-hover dataTable" >
                                <thead>
                                    <tr role="row">
                                        <th>ID</th>
                                        <th>Numero de Folio</th>
                                        <th>Codigo</th>
                                        <th>Monto</th> 
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right">Total </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario Modal -->
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Reporte</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form"  enctype="multipart/form-data">
                    @csrf
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-4">
                                <label for="num_folio" class="text-muted">N° Folio</label>
                                <input name="num_folio" id="num_folio" class="form-control typeahead" type="text" placeholder="Numero de folio"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="codigo" class="text-muted">Codigo</label>
                                <input name="codigo" id="codigo" class="form-control" type="text" placeholder="Codigo"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="fecha" class="text-muted">Fecha</label>
                                <input name="fecha" id="fecha" class="form-control" type="date"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="periodo" class="text-muted">Periodo</label>
                                <input name="periodo" id="periodo" class="form-control" type="text" placeholder="Perido">
                            </div>
                            <div class="col-xs-4">
                                <label for="clasi_financiera" class="text-muted">Clasificación Financiera</label>
                                <input name="clasi_financiera" id="clasi_financiera" class="form-control" type="text" placeholder="Clasificación Financiera">
                            </div>
                            <div class="col-xs-4">
                                <label for="importe" class="text-muted">Monto</label>
                                <input name="importe" id="importe" class="form-control" type="text" placeholder="Monto">
                            </div>
                            <div class="col-xs-12">
                                <label for="concepto" class="text-muted">Concepto de Pago</label>
                                <textarea name="concepto" id="concepto" class="form-control" rows="2" placeholder="Observaciones ..." ></textarea>
                            </div>
                            <div class="col-xs-4">
                                <label for="num_procedencia" class="text-muted">N° Procedencia</label>
                                <input name="num_procedencia" id="num_procedencia" class="form-control" type="text" placeholder="N° Procedencia">
                            </div>
                            <div class="col-xs-4">
                                <label for="nom_procedencia" class="text-muted">Nombre Procedencia</label>
                                <input name="nom_procedencia" id="nom_procedencia" class="form-control" type="text" placeholder="Nombre Procedencia">
                            </div>
                            <div class="col-xs-4">
                                <label for="cuenta_bancaria" class="text-muted">Cuenta Bancaria</label>
                                <input name="cuenta_bancaria" id="cuenta_bancaria" class="form-control" type="text" placeholder="Cuenta Bancaria">
                            </div>
                            <div class="col-xs-4">
                                <label for="responsable_id" class="text-muted">Proyecto</label>
                                <select name="responsable_id" id="responsable_id" class="form-control">
                                    <option>Selecciona</option>
                                    @foreach ($responsables as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->num_proyecto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label for="beneficiario_id" class="text-muted">Beneficiario</label>
                                <select name="beneficiario_id" id="beneficiario_id" class="form-control">
                                    <option>Selecciona</option>
                                    @foreach ($beneficiarios as $beneficiario)
                                        <option value="{{ $beneficiario->id }}">{{ $beneficiario->beneficiario }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label for="partida" class="text-muted">Partida</label>
                                <select name="partida_id" id="partida_id" class="form-control">
                                    <option>Selecciona</option>
                                    @foreach ($crasificados as $crasificado)
                                        <option value="{{ $crasificado->id }}">{{ $crasificado->codigo_p }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-12">
                                <div class="clearfix"><hr></div>
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
        /* Consulta Ajax Tabla Reportes */
        $('#table_reportes').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('reportes.index') }}",
            "columns":[
                { "data": "num_folio" }, /* Numero de folio */
                { "data": "beneficiario" }, /* Nombre beneficiario */
                { "data": "importe", "render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) }, /* Importe */
                { "data": "num_proyecto"}, /* Proyecto */
                { "data": "fecha" }, /* Fecha */
                { "data": "action"}
            ]
        });/* Fin Script */
        /* Consulta Ajax Tabla Reportes */
        $('#table_saldos').DataTable({
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                // Total over all pages
                total = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( api.column( 3 ).footer() ).html(
                    '$'+ total 
                );
            },
            "processing": true,
            "searching": true,
            "serverSide": true,
            "ajax": "{{ route('reportes.index') }}",
            "columns":[
                { "data": "id" },
                { "data": "num_folio" },
                { "data": "codigo" },
                { "data": "importe","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "fecha"},
            ]
        });/* Fin Script */

        /* Abrir ventana modal */
        $('#create_button').click(function(){
            $('#sample_form')[0].reset();
            $('.modal-title').text("Nuevo Reporte");
            $('#action_button').val("Agregar");
            $('#action').val("Agregar");
            $('#formModal').modal('show');
        });/* Fin Script */

        /* Insertar datos */
        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action_button').val() == 'Agregar'){
                $.ajax({
                    url:"{{route('reportes.store')}}",
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
                            html += '<h4><i class="icon fa fa-check"></i> Reporte Creado</h4></div>';
                            $('#sample_form')[0].reset();
                            $('#table_reportes').DataTable().ajax.reload();
                            $('#table_saldos').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action').val() == "Editar"){
                $.ajax({
                    url:"{{ route('reportes.update') }}",
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
                            $('#table_reportes').DataTable().ajax.reload();
                            $('#table_saldos').DataTable().ajax.reload();
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
                url:"reportes/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#num_folio').val(html.data.num_folio);
                    $('#codigo').val(html.data.codigo);
                    $('#fecha').val(html.data.fecha);
                    $('#periodo').val(html.data.periodo);
                    $('#clasi_financiera').val(html.data.clasi_financiera);
                    $('#importe').val(html.data.importe);
                    $('#concepto').val(html.data.concepto);
                    $('#num_procedencia').val(html.data.num_procedencia);
                    $('#nom_procedencia').val(html.data.nom_procedencia);
                    $('#cuenta_bancaria').val(html.data.cuenta_bancaria);
                    $('#responsable_id').val(html.data.responsable_id);
                    $('#beneficiario_id').val(html.data.beneficiario_id);
                    $('#partida_id').val(html.data.partida_id);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Editar Reporte");
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
                url:"reportes/destroy/"+user_id,
                beforeSend:function(){
                    $('.modal-titlee').text("Eliminar Reporte");
                    $('#ok_button').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#table_reportes').DataTable().ajax.reload();
                    $('#table_saldos').DataTable().ajax.reload();
                    $('#ok_button').text('OK');
                    }, 1500);
                }
            })
        });

        


        


    });

</script>

@stop

