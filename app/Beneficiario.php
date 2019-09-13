<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    //
    protected $table= 'beneficiario';

    protected $fillable = [
        'num_beneficiario', 
        'beneficiario', 
        'titular', 
        'enlace', 
        'rfc', 
        'giro', 
        'telefono', 
        'email', 
        'direccion', 
        'cp', 
        'ciudad', 
        'pais', 
        'observaciones',
        'tipo', 
        'user_id'
    ];

    public function usuario()
    {
        return $this->hasOne('App\Users');
    }

}
