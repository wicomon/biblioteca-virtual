<?php

namespace App\Http\Controllers;

use App\Libro;
use App\CategoriaLibro;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // $nuevas = Receta::orderBy('created_at','DESC')->get(); AL SER tan comun esto laravel tiene su metodo :v
        $nuevas = Libro::latest()->take(5)->get(); // take y limit son lo mismo

        //obtener las categorias
        $categorias = CategoriaLibro::all();

        //Agrupar las recetas por categoria
        $libros = [];

        foreach ($categorias as $categoria) {
            $libros[ Str::slug($categoria->nombre)] [] = Libro::where('categoria_id', $categoria->id)->take(3)->get();
        }

        //return $libros;
        
        //mostrar libros por cantidad de votos
        $votadas = Libro::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();

        return view('inicio.index', compact('nuevas', 'libros','votadas'));
    }
}
