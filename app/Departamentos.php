<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $fillable = [
        'pais_id','descripcion'
    ];

    public function pais()
    {
        return $this->hasOne('App\Paises','id','pais_id');
    }
}
