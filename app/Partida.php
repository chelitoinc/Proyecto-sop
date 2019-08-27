<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{

    protected $table = 'partidas_urg';

    protected $fillable = [
        'urg', 
        'cuenta', 
        'nombre_de_cuenta', 
        'enero', 
        'febrero', 
        'marzo',
        'abril', 
        'mayo', 
        'acumulado', 
        'junio', 
        'julio', 
        'agosto', 
        'septiembre',
        'octubre', 
        'noviembre', 
        'diciembre', 
        'total',
        'created_at',
        'user_id'
    ];
    
     public function centrodecosto() {
        return $this->hasMany('App\Users');
    } 

    public function usuario()
    {
        return $this->hasOne('App\Users');
    }

}
