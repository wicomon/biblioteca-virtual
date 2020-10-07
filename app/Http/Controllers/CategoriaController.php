<?php

namespace App\Http\Controllers;

use App\Libro;
use App\CategoriaLibro;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show(CategoriaLibro $categoriaLibro)
    {
        $libros = Libro::where('categoria_id', $categoriaLibro->id)->paginate(3);

        return view('categorias.show', compact('libros' , 'categoriaLibro'));
    }
}
