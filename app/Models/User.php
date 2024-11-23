<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//A�adimos la clase JWTSubject 
use Tymon\JWTAuth\Contracts\JWTSubject;

//A�adimos la implementaci�n de JWT en nuestro modelo
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const CREATED_AT = 'createdAt';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password','name','phone',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Request::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    /*
        A�adiremos estos dos m�todos
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}