<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Libro $libro)
    {
        //DB::insert('insert into likes_receta (libro_id) values ('.$libro->id.')');

       // Almacena los likes de un usuario a una receta
       return auth()->user()->meGusta()->toggle($libro);
    }

    public function destroy(Libro $libro)
    {

    }
}
