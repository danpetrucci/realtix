<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'ciudad', 'telefono','inmobiliarias_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];
    
    
    public function inmobiliaria()
    {
        return $this->hasOne('App\Inmobiliarias','id','inmobiliarias_id');
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("telefono", "LIKE", "%$keyword%")
                    ->orWhere("ciudad", "LIKE", "%$keyword%")
                    ->orWhere("role", "LIKE", "%$keyword%")
                    ->orWhere("inmobiliarias_id", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
    
}
