<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = "responsable";

    protected $fillable = [

        'dependencia',
        'unidad',
        'num_proyecto',
        'nombre',
    ];

   /*  public function Reporte() {
        return $this->hasMany('App\Responsable');
    } */

}
