<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $fillable = [
        'departamento_id','descripcion'
    ];

    public function departamento()
    {
        return $this->hasOne('App\Departamentos','id','departamento_id');
    }
}
