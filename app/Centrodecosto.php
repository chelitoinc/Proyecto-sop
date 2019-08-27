<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centrodecosto extends Model
{
    //
    protected $table = 'centro_de_costos';

    // Relación One To Many for Like
    public function partida()
    {
        return $this->hasMany('App\Partida');
    }

    // Relación Many To One for User
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
