<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmobiliarias extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'nit', 'pais_inmo','departamento_inmo','ciudad_inmo', 'direccion', 'telefono'
    ];

    protected $dates = ['deleted_at'];

     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("nombre", "LIKE","%$keyword%")
                    ->orWhere("nit", "LIKE", "%$keyword%")
                    ->orWhere("pais_inmo", "LIKE", "%$keyword%")
                    ->orWhere("departamento_inmo", "LIKE", "%$keyword%")
                    ->orWhere("ciudad_inmo", "LIKE", "%$keyword%")
                    ->orWhere("direccion", "LIKE", "%$keyword%")
                    ->orWhere("telefono", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

}
