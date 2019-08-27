<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crasificado extends Model
{
    protected $table = "partida";

    protected $fillable = [
        'codigo_p',
        'nombre_p',             
        'descripcion_p',
        'user_id'
    ];

    public function usuario()
    {
        return $this->hasOne('App\Users');
    }

}
