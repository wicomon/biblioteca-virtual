<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        //asignar perfil una vez que s ehaya creado un usuario nuevo
        static::created(function($user){
            $user->perfil()->create();
        });
    }
    

    // Relacion de uno a mucho (1:n) de usuarios a recetas
    public function libros()
    {
        return $this->hasMany(Libro::class);
    }

    public function perfil()
    {
        return $this->hasOne(perfil::class);
    }

    public function meGusta()
    {
        return $this->belongsToMany(Libro::class, 'likes_libro');
    }


}
