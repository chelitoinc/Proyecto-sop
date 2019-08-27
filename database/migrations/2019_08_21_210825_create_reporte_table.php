<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('num_folio');
            $table->string('codigo');
            $table->date('fecha');
            $table->string('periodo');
            $table->string('clasi_financiera');
            $table->decimal('importe',10, 2);
            $table->string('importe_letra');
            $table->string('concepto');
            $table->integer('num_procedencia');
            $table->string('nom_procedencia');
            $table->string('cuenta_bancaria');
            $table->string('dependencia');
            $table->string('unidad');
            $table->string('proyecto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte');
    }
}
