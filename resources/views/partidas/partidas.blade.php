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
            <h3 class="box-title">Cargar MELP</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Descargar en diferentes documentos</h5>
                    <a href="{{ url('/partidas/downloadPartida/xlsx') }}"><button class="btn btn-dark">Descargar Excel xlsx</button></a>
                    {{-- <a href="{{ url('/partidas/downloadPartida/xls') }}"><button class="btn btn-success">Descargar Excel xls</button></a> --}}
                    <a href="{{ url('/partidas/downloadPlantilla/xls') }}"><button class="btn btn-warning">Descargar Plantilla</button></a>

                    <form  action="{{ url('/partidas/importData/') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <input type="file" name="import_file" />
                        <hr>
                        <button class="btn btn-primary">Importar Archivo</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

<!-- Table  -->
<div class="card">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header">
                <h2 class="box-title">Partidas</h2>
            </div>
            <!--Boton para abrir el modal -->
            <div class="col-xs-12">
                <button type="button" name="create_button" id="create_button" class="btn btn-success btn-sm">
                    <strong>Agregar partida</strong>
                </button> 
                {{-- <button type="button" name="trans_button" id="trans_button" class="btn btn-warning btn-sm">
                    <strong>Transferecia</strong>
                </button> --}}
                {{-- <button type="button" name="delete_button" id="delete_button" class="btn btn-danger btn-sm">
                    <strong>Vacias datos MELP</strong>
                </button> --}}
            </div>
            <!-- Tabla beneficiario-->
            <hr class="col-xs-12">
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-body table-responsive no-padding">
                                <table id="table_partidas" class="table table-hover" >
                                    <thead>
                                        <tr role="row" class="bg bg-gray">
                                            <th style="width: 5%">URG</th>
                                            <th style="width: 5%">Clave</th>
                                            <th style="width: 20%">Nombre de la partida</th>
                                            <th style="width: 5%">Enero</th>
                                            <th style="width: 5%">Febrero</th>
                                            <th style="width: 5%">Marzo</th>
                                            <th style="width: 5%">Abril</th>
                                            <th style="width: 5%">Mayo</th>
                                            <th style="width: 5%">Acomulado</th>
                                            <th style="width: 5%">Junio</th>
                                            <th style="width: 5%">Julio</th>
                                            <th style="width: 5%">Agosto</th>
                                            <th style="width: 5%">Septiembre</th>
                                            <th style="width: 5%">Obtubre</th>
                                            <th style="width: 5%">Noviembre</th>
                                            <th style="width: 5%">Diciembre</th>
                                            <th style="width: 5%">Total</th>
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
<!-- End Table -->

<!-- Formulario Modal -->
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar partida</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form"  enctype="multipart/form-data">
                    @csrf
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="urg">URG</label>
                                <input name="urg" id="urg" class="form-control typeahead" type="text" placeholder="URG"/>
                            </div>
                            <div class="col-xs-2">
                                <label for="">Clave</label>
                                <input name="cuenta" id="cuenta" class="form-control" type="text" placeholder="Cuenta"/>
                            </div>
                            <div class="col-xs-8">
                                <label for="">Nombre de la Partida</label>
                                <input name="nombre_de_cuenta" id="nombre_de_cuenta" class="form-control" type="text" placeholder="Nombre de la cuenta"/>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="">Enero</label>
                                <input name="enero" id="enero" class="form-control typeahead" type="text" placeholder="Enero"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Febrero</label>
                                <input name="febrero" id="febrero" class="form-control" type="text" placeholder="Febrero"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Marzo</label>
                                <input name="marzo" id="marzo" class="form-control" type="text" placeholder="Marzo"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Abril</label>
                                <input name="abril" id="abril" class="form-control" type="text" placeholder="Abril"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Mayo</label>
                                <input name="mayo" id="mayo" class="form-control" type="text" placeholder="Mayo"/>
                            </div>
                            {{-- <div class="col-xs-5">
                                <label for="">Acumulado</label>
                                <input name="acumulado" id="acumulado" class="form-control typeahead" type="text" placeholder="Acumuldo"/>
                            </div> --}}
                        
                            <div class="col-xs-3">
                                <label for="">Junio</label>
                                <input name="junio" id="junio" class="form-control typeahead" type="text" placeholder="Junio"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Julio</label>
                                <input name="julio" id="julio" class="form-control" type="text" placeholder="Julio"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Agosto</label>
                                <input name="agosto" id="agosto" class="form-control" type="text" placeholder="Agosto"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Septiembre</label>
                                <input name="septiembre" id="septiembre" class="form-control" type="text" placeholder="Septiembre"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Octubre</label>
                                <input name="octubre" id="octubre" class="form-control typeahead" type="text" placeholder="Octubre"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Noviembre</label>
                                <input name="noviembre" id="noviembre" class="form-control" type="text" placeholder="Noviembre"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="">Diciembre</label>
                                <input name="diciembre" id="diciembre" class="form-control" type="text" placeholder="Diciembre"/>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-6">
                                <label for="">Total</label>
                                <input name="total" id="total" class="form-control typeahead" type="text" placeholder="Total"/>
                            </div>
                        </div>
                    </div> --}}

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

<!-- Modal Change-->
<div id="chanceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg bg-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"> 
                 <span id="form_result"></span>
                <form method="post" id="chance_form"  enctype="multipart/form-data">
                    @csrf
                    <h4>Origen</h4>
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="partida">Clave</label>
                                <input name="partida" id="partida" class="form-control text-center" type="text" placeholder="Partida"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="urg">URG</label>
                                <input name="urge" id="urge" class="form-control" type="text" placeholder="URG"/>
                            </div>
                            <div class="col-xs-4">
                                <label for="mes">Mes</label>
                                <select name="mes" id="mes" class="js-example-placeholder-single js-states form-control"">
                                    <option>Mes</option>
                                    <option value="enero">Enero</option>
                                    <option value="febrero">Febrero</option>
                                    <option value="marzo">Marzo</option>
                                    <option value="abril">Abril</option>
                                    <option value="mayo">Mayo</option>
                                    <option value="junio">Junio</option>
                                    <option value="julio">Julio</option>
                                    <option value="agosto">Agosto</option>
                                    <option value="septiembre">Septiembre</option>
                                    <option value="octubre">Octubre</option>
                                    <option value="noviembre">Noviembre</option>
                                    <option value="diciembre">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label for="partida">Monto</label>
                                <input name="monto" id="monto" class="form-control" type="text" placeholder="Monto del mes"/>
                            </div>
                        </div>
                    </div>
                
                    <h4>Destino</h4>
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-12">
                                <label for="partida">Cuenta destino</label>
                                <select id="destino_id" name="destino_id" class="js-example-placeholder-single js-states form-control"">
                                    <option>Seleccione</option>
                                    @foreach ($partidas as $partida )
                                        <option value="{{ $partida->id }}">Clave: {{ $partida->urg }}, URG: {{ $partida->cuenta }}, {{ $partida->nombre_de_cuenta }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="col-xs-4">
                                <label for="mes">Mes</label>
                                <select class="js-example-placeholder-single js-states form-control"" name="mes2" id="mes2">
                                    <option>Mes</option>
                                    <option value="enero">Enero</option>
                                    <option value="febrero">Febrero</option>
                                    <option value="marzo">Marzo</option>
                                    <option value="abril">Abril</option>
                                    <option value="mayo">Mayo</option>
                                    <option value="junio">Junio</option>
                                    <option value="julio">Julio</option>
                                    <option value="agosto">Agosto</option>
                                    <option value="septiembre">Septiembre</option>
                                    <option value="octubre">Octubre</option>
                                    <option value="noviembre">Noviembre</option>
                                    <option value="diciembre">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <label for="partida">Monto</label>
                                <input name="monto2" id="monto2" class="form-control" type="text" placeholder="Monto"/>
                            </div>
                        </div>
                    </div>
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="hidden" name="action" id="action" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="hidden" id="id" name="id"/>
                                <input type="submit" name="actionbutton" id="actionbutton" class="btn btn-warning" value="" />
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- Fin modal Change -->

<!--
    TODO:Transferencia de mes a mes en el mismo periodo 
    Agregar bonton si el usuario decea ingresar la fecha de importacion de MELP
 -->

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
<!-- Fin modal -->

<!-- Modal Vaciar-->
 <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg bg-red">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmar</h4>
            </div>
            <div class="modal-body">
                <p class="lead">Se eliminaran unicamente las partidas que no esten en uso.</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_vaciar" id="ok_vaciar" class="btn btn-danger">Vaciar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div> 
<!-- Fin modal -->

<!-- TABLA PARTIDAS -->
<script type="text/javascript">

    $(document).ready(function() {

        $('#table_partidas').DataTable({
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
            "ajax": "{{ route('partidas.index') }}",
            "columns":[
                { "data": "urg" },
                { "data": "cuenta" },
                { "data": "nombre_de_cuenta" },
                { "data": "enero","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "febrero","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "marzo","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "abril","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "mayo","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "acumulado","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "junio","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "julio","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "agosto","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "septiembre","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "octubre","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "noviembre","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "diciembre","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "total","render": $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                { "data": "action" }
            ]
        });

        /* Boton Modal insert */
        $('#create_button').click(function(){
            $('#sample_form')[0].reset();
            $('.modal-title').text("Agregar Partida");
            $('#action_button').val("Agregar");
            $('#action').val("Agregar");
            $('#formModal').modal('show');
        });/* Fin Script */

        /* Boton Modal  Transferecnia  */ 
        $('#trans_button').click(function(){
            $('#chance_form')[0].reset();
            $('.modal-title').text("Transferecia");
            $('#actionbutton').val("Transferir");
            $('#action').val("Transferir");
            $('#chanceModal').modal('show');
        });/* Fin Script */

        /* Insertar datos */
        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action_button').val() == 'Agregar'){
                $.ajax({
                    url:"{{ route('partidas.store') }}",
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
                            html += '<h4><i class="icon fa fa-check"></i>Partida almacenado</h4></div>';
                            $('#sample_form')[0].reset();
                            $('#table_partidas').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action_button').val() == "Editar"){
                $.ajax({
                    url:"{{ route('partidas.update') }}",
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
                            $('#table_partidas').DataTable().ajax.reload();
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
                url:"/partidas/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#urg').val(html.data.urg);
                    $('#cuenta').val(html.data.cuenta);
                    $('#nombre_de_cuenta').val(html.data.nombre_de_cuenta);
                    $('#enero').val(html.data.enero);
                    $('#febrero').val(html.data.febrero);
                    $('#marzo').val(html.data.marzo);
                    $('#abril').val(html.data.abril);
                    $('#mayo').val(html.data.mayo);
                    $('#acumulado').val(html.data.acumulado);
                    $('#junio').val(html.data.junio);
                    $('#julio').val(html.data.julio);
                    $('#agosto').val(html.data.agosto);
                    $('#septiembre').val(html.data.septiembre);
                    $('#octubre').val(html.data.octubre);
                    $('#noviembre').val(html.data.noviembre);
                    $('#diciembre').val(html.data.diciembre);
                    $('#total').val(html.data.total);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Editar partida");
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
                url:"partidas/destroy/"+user_id,
                beforeSend:function(){
                    $('.modal-titlee').text("Eliminar partida");
                    $('#ok_button').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#table_partidas').DataTable().ajax.reload();
                    $('#ok_button').text('OK');
                    }, 2000);
                }
            })
        }); 

        /* Change */
         $(document).on('click', '.change', function(){

            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/partidas/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#id').val(html.data.id);
                    $('#partida').val(html.data.urg);
                    $('#urge').val(html.data.cuenta);                   
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Transferir a cuenta");
                    $('#actionbutton').val("Transferir");
                    $('#action').val("Transferir");
                    $('#chanceModal').modal('show');
                }
            })
        });/* Fin Script */

        /* Change datos */
        $('#chance_form').on('submit', function(event){
            event.preventDefault();

            if($('#actionbutton').val() == 'Transferir'){
                $.ajax({
                    url:"{{ route('transferencia.ready') }}",
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
                            html += '<h4><i class="icon fa fa-check"></i>Partida almacenado</h4></div>';
                            $('#sample_form')[0].reset();
                            $('#table_partidas').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            }

        });/* Fin Script */
        
        /* Eliminar todas las partidas */
        $('#delete_button').click(function(){
            user_idi = $(this).attr('id');
            $('.modal-title').text("Confirmar petición");
            $('#ok_vaciar').val("Vaciar");
            $('#deleteModal').modal('show');
        });/* Fin Script */

        
        $('#ok_vaciar').click(function(){
            if($('#ok_vaciar').val() == "Vaciar"){
                $.ajax({
                    url:"{{ route('partidas.empty') }}",
                    beforeSend:function(){
                        $('.modal-title').text("Vaciando datos MELP");
                        $('#ok_vaciar').text('Vaciando...');
                    },
                    success:function(data){
                        setTimeout(function(){
                            $('#deleteModal').modal('hide');
                            $('#table_partidas').DataTable().ajax.reload();
                            $('#ok_vaciar').text('Vaciar');
                        }, 1500);
                    }
                });
            }
        });

    });

     


    
</script>

@stop