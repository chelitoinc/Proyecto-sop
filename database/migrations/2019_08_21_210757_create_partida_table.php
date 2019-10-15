<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidaTable extends Migration
{

    public function up()
    {
        Schema::create('partida', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('codigo_p');
            $table->string('nombre_p');
            $table->longText('descripcion_p');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partida');
    }
}
