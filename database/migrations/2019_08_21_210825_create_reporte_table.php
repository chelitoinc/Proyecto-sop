<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteTable extends Migration
{

    public function up()
    {

        Schema::create('reporte', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('num_folio');
            $table->string('codigo');
            $table->date('fecha');
            $table->string('periodo');
            $table->string('concepto');
            $table->decimal('importe_total',12,2); // Se agrego esta linea
            $table->string('nom_procedencia');
            $table->string('cuenta_bancaria');
            $table->timestamps();
        });

        Schema::create( 'importes', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->decimal('importe',10, 2);
            $table->string('importe_letra');
            $table->integer('num_folio');
            $table->timestamps();
        }); 

        Schema::create('responsable', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('num_dependencia');
            $table->string('dependencia');
            $table->integer('num_unidad');
            $table->string('unidad');
            $table->string('num_proyecto');
            $table->string('nombre');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('reporte');
    }
}


