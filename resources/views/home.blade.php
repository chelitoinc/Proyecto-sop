@extends('adminlte::page')
@section('title', 'System SOP')
@section('content_header')
<h3 class="box-title">Panel pricipal</h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reportes</span>
                <span class="info-box-number">{{ App\Reporte::all()->count() }}</span>
            </div>
        </div>
    </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Proveedores</span>
                <span class="info-box-number">{{ App\Beneficiario::all()->count() }}</span>
            </div>
        </div>
  </div>

  <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-list-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">MELP</span>
                <span class="info-box-number">{{ App\Partida::all()->count() }}</span>
            </div>
        </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Responsables</span>
                <span class="info-box-number">{{ App\Responsable::all()->count() }}</span>
            </div>
        </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Clasificados</span>
                <span class="info-box-number">{{ App\Crasificado::all()->count() }}</span>
            </div>
        </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Usuarios</span>
                <span class="info-box-number">{{Auth::user()->count() }}</span>
            </div>
        </div>
  </div>

  <div class="col-xs-12">

  </div>

@stop