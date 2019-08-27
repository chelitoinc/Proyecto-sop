<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiarioTable extends Migration
{

    public function up()
    {
        Schema::create('beneficiario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('num_beneficiario');
            $table->string('beneficiario');
            $table->string('titular');
            $table->string('enlace');
            $table->string('rfc');
            $table->string('giro');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('direccion');
            $table->integer('cp');
            $table->string('ciudad');
            $table->string('pais');
            $table->string('observaciones');
            $table->string('tipo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beneficiario');
    }
}
