<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasUrgTable extends Migration
{

    public function up()
    {
        Schema::create('partidas_urg', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('urg');
            $table->integer('cuenta');
            $table->string('nombre_de_cuenta');
            $table->decimal('enero', 10, 2);
            $table->decimal('febrero', 10, 2);
            $table->decimal('marzo', 10, 2);
            $table->decimal('abril', 10, 2);
            $table->decimal('mayo', 10, 2);
            $table->decimal('acumulado', 10, 2);
            $table->decimal('junio', 10, 2);
            $table->decimal('julio', 10, 2);
            $table->decimal('agosto', 10, 2);
            $table->decimal('septiembre', 10, 2);
            $table->decimal('octubre', 10, 2);
            $table->decimal('noviembre', 10, 2);
            $table->decimal('diciembre', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partidas_urg');
    }
}
