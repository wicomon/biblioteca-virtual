<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //campos que se agregaran
    protected $fillable = [
        'titulo', 'descripcion', 'imagen','enlace','categoria_id'
    ];

    public function autor(){
        return $this->belongsTo(User::class,'user_id');
    }

    //Obtener la categoria de la receta via llave foranea FK
    public function categoria(){
        return $this->belongsTo(CategoriaLibro::class);
    }

    //LIkes que recibio una receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_libro');
    }

}
