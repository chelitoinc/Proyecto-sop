<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionesTable extends Migration
{

    public function up()
    {

        /* RELACIONES ENTRE BENEFICIARIO Y USUARIOS */
        Schema::table('beneficiario', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
        
            $table->foreign('user_id')->references('id')->on('users');
        });
        /* RELACIONES ENTRE PARTIDAS Y USUARIOS */
        Schema::table('partida', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
        
            $table->foreign('user_id')->references('id')->on('users');
        });
        /* RELACIONES ENTRE PARTIDAS_URG Y USUARIOS */
        Schema::table('partidas_urg', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
        
            $table->foreign('user_id')->references('id')->on('users');
        });
        /* RELACIONES ENTRE REPORTE Y USUARIOS */
        Schema::table('reporte', function (Blueprint $table) {
            $table->unsignedBigInteger('beneficiario_id');
            $table->unsignedBigInteger('partida_id');
            $table->unsignedBigInteger('user_id');
        
            $table->foreign('beneficiario_id')->references('id')->on('beneficiario');
            $table->foreign('partida_id')->references('id')->on('partida');
            $table->foreign('user_id')->references('id')->on('users');
        });

        /* INSERT A TRABLA USERS */
        DB::table('users')->insert([
            [
                'role' => 'user', 
                'name' => 'Angel', 
                'surname' => 'Paredes Torres', 
                'num_empleado' => '15090105', 
                'nick' => 'angel95', 
                'email' => 'angelparedestorres.apt@gmail.com', 
                'password' => '$2y$10$yDXi/kwlDMLIM0ntcrrAY.Zq1ZCwBP1/T6.cMgWVlJeG/I6Aicb4G', 
                'image' => 'default.png'
            ],
        ]);
        /* INSERT A TRABLA BENEFICIARIO */
        DB::table('beneficiario')->insert([
            [
                'user_id'           => '1',
                'num_beneficiario'  => '1', 
                'beneficiario'      => 'Marisol Nava', 
                'titular'           => 'Mi titular', 
                'enlace'            => 'Mi enlace', 
                'rfc'               => 'PATA9510933JHBSD', 
                'giro'              => 'Mi giro', 
                'telefono'          => '7312171652', 
                'email'             => 'beneficiario@beneficiario.com', 
                'direccion'         => 'SN', 
                'cp'                => '62000', 
                'ciudad'            => 'Cuernavaca', 
                'pais'              => 'Mexico', 
                'observaciones'     => 'No', 
                'tipo'              => 'Provedor'           
            ],
        ]);

        /* INSERT A TRABLA PARTIDA */
        DB::table('partida')->insert([
            [
                'codigo_p'       => '1110',
                'nombre_p'       => 'DIETAS', 
                'descripcion_p'  => 'Asignaciones para remuneraciones a los Diputados, Senadores, Asambleístas, Regidores y Síndicos.',
                'user_id'        => '1'
            ],
        ]);

        /* INSERT A TRABLA PARTIDAS_URG */
        DB::table('partidas_urg')->insert([
            [
                'user_id'           => '1',
                'urg'               => '611', 
                'cuenta'           => '1131', 
                'nombre_de_cuenta' => 'SUELDOS BASE AL PERSONAL PERMANENTE', 
                'enero'             => '8539.82', 
                'febrero'           => '8539.82', 
                'marzo'             => '8539.82', 
                'abril'             => '121716.52', 
                'mayo'              => '1629.28', 
                'acumulado'         => '148963.16', 
                'junio'             => '1629.28', 
                'julio'             => '1629.28', 
                'agosto'            => '1629.28', 
                'septiembre'        => '1629.28', 
                'octubre'           => '1629.28', 
                'noviembre'         => '1629.28', 
                'diciembre'         => '1629.28', 
                'total'             => '160368.12'
            ],
        ]);
        /* INSERT A TRABLA REPORTE */
        DB::table('reporte')->insert([
            [
                'num_folio'         => '000737', 
                'codigo'            => '065LR737', 
                'fecha'             => '2019-08-16 11:38:56', 
                'periodo'           => 'JUNIO DEL 2019', 
                'clasi_financiera'  => 'PROVEEDOR',
                'importe'           => '11913.20', 
                'importe_letra'     => 'ONCE MIL NUEVECIENTOS TRECE PESOS',
                'concepto'          => 'PAGO A PROVEEDOR FACTURA 2100', 
                'num_procedencia'   => '10', 
                'nom_procedencia'   => 'Pagadora Ramo', 
                'cuenta_bancaria'   => '70136245230 - Pagadora Ramo', 
                'dependencia'       => 'Secretaria de Obras Publicas', 
                'unidad'            => 'Oficina de Secretaria de Obras Publicas',
                'proyecto'          => '060001',  
                'beneficiario_id'   => '1',
                'user_id'           => '1',
                'partida_id'        => '1'
            ],
        ]);  


        
    }

    public function down()
    {
        Schema::dropIfExists('relaciones');
    }
}
