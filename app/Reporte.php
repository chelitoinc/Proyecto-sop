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
        'concepto',
        'importe_total',
        'nom_procedencia',
        'cuenta_bancaria',
        'beneficiario_id',
        'responsable_id',
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

    

}
