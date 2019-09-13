<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = "responsable";

    protected $fillable = [
        'num_dependencia',
        'dependencia',
        'num_unidad',
        'unidad',
        'num_proyecto',
        'nombre'
    ];

   /*  public function Reporte() {
        return $this->hasMany('App\Responsable');
    } */

}
