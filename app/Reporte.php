<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = "reporte";
    
    protected $fillable = [
        'num_folio',
        'codigo',
        'fecha',
        'periodo',
        'clasi_financiera',
        'importe',
        'importe_letra',
        'concepto',
        'num_procedencia',
        'nom_procedencia',
        'cuenta_bancaria',
        'dependencia',
        'unidad',
        'proyecto',
        'beneficiario_id',
        'partida_id',
        'user_id'
    ];

    public function Reporte() {
        return $this->hasMany('App\Users');
    } 

    public function partida() {
        return $this->hasMany('App\Partida');
    } 

    public function usuario()
    {
        return $this->hasOne('App\Users');
    }

    public function usuario()
    {
        return $this->hasOne('App\Users');
    }

}
