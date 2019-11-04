@extends('adminlte::page')
@section('title', 'System SOP')
@section('content_header')

<div class="box-body">
@if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    <div class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
            <div class="col-sm-6 text-center">
                <div class="box-body table-responsive no-padding">
                    <form method="post" id="sample_form" action="{{ route('reportes.editar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="well well-sm">
                            <div class="row">
                                <table id="table_reportes" class="table table-hover text-center" >
                                    <thead>
                                        <tr role="row" class="bg bg-gray">
                                            <th style="width: 10%">Partida</th>
                                            <th style="width: 15%">Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($importes as $importe)
                                        <tr>
                                            <th style="width:100px;">
                                                <select name="partida_id[]" id="partida" class="form-control" >
                                                        <option value="{{$importe->partida_id}}">{{$importe->partida_id}}</option> 
                                                </select>
                                            </th>
                                            <th>
                                            <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control" name="importe[]" value="{{number_format($importe->importe)}}">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                            </th>
                                        </tr>
                                        <input type="hidden" name="num_folio" value="{{$importe->num_folio}}">
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Guardar" style="float:left">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

@stop