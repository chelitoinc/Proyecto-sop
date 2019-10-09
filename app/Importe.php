<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importe extends Model
{
    protected $table = "importes";
    
    protected $fillable = [
        'importe',
        'importe_letra',
        'num_folio',
        'partida_id'
    ];
}
