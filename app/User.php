<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'role','name', 'surname', 'num_empleado', 'nick', 'email', 'password', 'image', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Relación  One To Many for Center */
    public function partida() {
        return $this->hasMany('App\Partida');
    }

    /* Relación  One To Many for Center */
    public function beneficiario() {
        return $this->hasMany('App\Beneficiaro');
    }

    /* Relación  One To Many for Center */
    public function Reporte() {
        return $this->hasMany('App\Reporte');
    }
    
    
}
