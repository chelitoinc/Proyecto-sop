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
            <div class="col-xs-4">
                <button type="button" name="create_button" id="create_button" class="btn btn-success btn-sm">
                    <strong>Nuevo Reporte</strong>
                </button> 
            </div>
            
            <div class="col-xs-3" id="seccionRecargar">
                <p>Descargar reporte</p> 
                <form method="post" id="form_pdf" action="{{ route('reportes.pdf') }}"   enctype="multipart/form-data" >
                    @csrf
                    <select name="folio" id="id_folio" class="js-data-example-ajax">
                        <option></option>
                        @foreach ($folios as $reporte)
                            <option value="{{ $reporte->id }}" required>{{ $reporte->num_folio }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="num_folio" hidden>
                    <div class="clearfix">.</div>
                    <input type="submit" name="button-pdf" id="button-pdf" value="Descargar" class="btn btn-primary" >
                </form> 
            </div>

            <script type="text/javascript">
                $(document).ready(function(){
                    setInterval(
                            function(){
                                $('#seccionRecargar').load();
                            },1000
                        );
                });
            </script>

            <!-- Tabla Reportes-->
            <hr class="col-xs-12">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="box-body table-responsive no-padding">
                                <table id="table_reportes" class="table table-hover text-center" >
                                    <thead>
                                        <tr role="row" class="bg bg-gray">
                                            <th style="width: 10%">Número de Folio</th>
                                            <th style="width: 15%">Nombre del Proveedor</th>
                                            <th style="width: 5%">Importe</th>
                                            <th style="width: 5%">Proyecto</th>
                                            <th style="width: 5%">Fecha</th>
                                            <th style="width: 5%">Acción</th> 
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
                            <div class="col-xs-6">
                                <label for="periodo" class="text-muted">Periodo</label>
                                <input name="periodo" id="periodo" class="form-control" type="text" placeholder="Perido">
                            </div>
                            <div class="col-xs-6">
                                <label for="nom_procedencia" class="text-muted">Nombre Procedencia</label>
                                <input name="nom_procedencia" id="nom_procedencia" class="form-control" type="text" placeholder="Nombre Procedencia">
                            </div>
                            <div class="col-xs-7">
                                <label for="cuenta_bancaria" class="text-muted">Cuenta Bancaria</label>
                                <input name="cuenta_bancaria" id="cuenta_bancaria" class="form-control" type="text" placeholder="Cuenta Bancaria">
                            </div>
                            <div class="col-xs-5">
                                <label for="beneficiario_id" class="text-muted">Beneficiario</label>
                                <select name="beneficiario_id" id="beneficiario_id" class="form-control">
                                    <option>Selecciona</option>
                                    @foreach ($beneficiarios as $beneficiario)
                                        <option value="{{ $beneficiario->id }}">{{ $beneficiario->beneficiario }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label for="responsable_id" class="text-muted">Proyecto</label>
                                <select name="responsable_id" id="responsable_id" class="form-control">
                                    <option>Selecciona</option>
                                    @foreach ($responsables as $responsable)
                                    <option value="{{ $responsable->id }}">{{ $responsable->num_proyecto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-9">
                                <label for="concepto" class="text-muted">Concepto de Pago</label>
                                <textarea name="concepto" id="concepto" class="form-control" rows="2" placeholder="Observaciones ..." ></textarea>
                            </div>
                            <div class="col-xs-12">
                                <table id="tabla" class="table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr class="bg bg-gray">
                                            <th>Partida</th>
                                            <th>Importe</th>
                                            <th><input type="button" id="add" value="Añadir fila" class="btn btn-primary"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width:100px;">
                                                <select name="partida_id[]" id="partida_id" class="form-control" required>
                                                    <option></option>
                                                    @foreach ($crasificados as $crasificado)
                                                    <option value="{{ $crasificado->id }}" >{{ $crasificado->codigo_p }}</option>
                                                    @endforeach
                                                </select>
                                            </td> 
                                            <td><input type='text' name='importe[]' required class="form-control"></td> 
                                            <td><input type='button' class='del' value='Eliminar Fila' class='btn btn-danger'></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                            
                            <div class="col-xs-12">
                                <br>
                                <input type="hidden" name="action" id="action" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Guardar" />
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

{{-- Modal Descargar pdf --}}
<div id="pdfModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg bg-blue">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Descargar Reporte</h4>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Descargar este reporte?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button_pdf" id="ok_button_pdf" class="btn btn-danger">Descargar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
{{-- Modal Final --}}

<script type="text/javascript">

    /* Add column with */
    $(document).ready(function(){
		/**
		 * Funcion para añadir una nueva fila en la tabla
		 */
		$("#add").click(function(){
			var nuevaFila="<tr> \
				<td><select name='partida_id[]' id='partida_id' required class='form-control'><option>Selecciona ...</option>@foreach ($crasificados as $crasificado)<option value='{{ $crasificado->id }}''>{{ $crasificado->codigo_p }}</option>@endforeach</select></td> \
				<td><input type='text' name='importe[]' required class='form-control'></td> \
				<td><input type='button' class='del' value='Eliminar Fila' class='btn btn-danger'></td> \
			</tr>";
			$("#tabla tbody").append(nuevaFila);
		});
 
		// evento para eliminar la fila
		$("#tabla").on("click", ".del", function(){
			$(this).parents("tr").remove();
		});
	});
    /* Fin */
    
    /* Llenar select descargas */
    $('#id_folio').select2({
        "processing": true,
        "serverSide": true,
        placeholder: "Selecciona numero de folio",
        width: "210"
    });
    $('#partida_id').select2({
        "processing": true,
        "serverSide": true,
        placeholder: "Selecciona ...",
        width: "150"
    });
    /* Fin */

    /* Formato a numeros */
    var formatNumber = {
        separador: ".", // separador para los miles
        sepDecimal: ',', // separador para los decimales
        formatear:function (num){
            num +='';
            var splitStr = num.split('.');
            var splitLeft = splitStr[0];
            var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
            var regx = /(\d+)(\d{3})/;
            while (regx.test(splitLeft)) {
                splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
            }
            return this.simbol + splitLeft +splitRight;
        },
        new:function(num, simbol){
            this.simbol = simbol ||'';
            return this.formatear(num);
        }
    }
    /* Fin */
    
    $(document).ready(function() {
        /* Consulta Ajax Tabla Reportes */
        $('#table_reportes').DataTable({
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
            "ajax": "{{ route('reportes.index') }}",
            "columns":[
                { "data": "num_folio" }, /* Numero de folio */
                { "data": "beneficiario" }, /* Nombre beneficiario */
                { "data": "importe_total", "render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) }, /* Importe */
                { "data": "num_proyecto"}, /* Proyecto */
                { "data": "fecha" }, /* Fecha */
                { "data": "action"}
            ]
        });/* Fin Script */
        /* Consulta Ajax Tabla Reportes */

        /* CREAR OTRA TABLA FOLIO DONDE CAPTURAR */

        $('#table_saldos').DataTable({
            
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(',', '.', 2, '$')*1 :
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
                    .column( 3, { page: 'current',} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( api.column( 3 ).footer() ).html(
                    '$'+ formatNumber.new(total) 
                );
            },
            "processing": true,
            "paging":   false,
            "ordering": false,
            "searching": false,
            "info":     false,
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
            "ajax": "{{ route('reportes.index') }}",
            "columns":[
                { "data": "id" },
                { "data": "num_folio" },
                { "data": "codigo" },
                { "data": "codigo","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "fecha"},
            ]
        });/* Fin Script */

        /* Abrir ventana modal */
        $('#create_button').click(function(){
            $('#sample_form')[0].reset();
            $('.modal-title').text("Nuevo Reporte");
            $('#action_button').val("Guardar");
            $('#action').val("Guardar");
            $('#formModal').modal('show');
        });/* Fin Script */

        /* Insertar datos */
        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action_button').val() == 'Guardar'){
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
                });
                $( "#seccionRecargar" ).load();
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
                    $('#concepto').val(html.data.concepto);
                    $('#nom_procedencia').val(html.data.nom_procedencia);
                    $('#cuenta_bancaria').val(html.data.cuenta_bancaria);
                    $('#responsable_id').val(html.data.responsable_id);
                    $('#beneficiario_id').val(html.data.beneficiario_id);
                    
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

