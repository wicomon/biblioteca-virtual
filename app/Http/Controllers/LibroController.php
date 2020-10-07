<?php

namespace App\Http\Controllers;

use App\User;
use App\Libro;
use App\Categoria;
use App\CategoriaLibro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth',['except' => ['show','search']]);
    }

    public function index()
    {
        $usuario = auth()->user();

        $libros = Libro::where('user_id', $usuario->id)->paginate(3);

        return view('libros.index')->with('libros', $libros)->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = auth()->user();

        if ($usuario->rol != 'admin') {
            return redirect()->action('InicioController@index');
        }
        // $categorias = DB::table('categoria_libros')->get();

        $categorias = CategoriaLibro::all();
        return view('libros.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = auth()->user();

       //validacion
       $data= $request->validate([
        'titulo'=> 'required|min:6',
        'categoria'=>'required',
        'descripcion'=>'required',
        'imagen'=>'required|image',
        'enlace' => 'required|mimes:pdf',
        'categoria'=>'required'
        ]);
        if ($request->file('enlace')) 
        {
            $archivo = $request->file('enlace');
            $nombreArchivo = time() . "." . $request->file('enlace')->extension();
            $ubicacion = public_path('/storage/enlace');
            $archivo->move($ubicacion, $nombreArchivo);
        }

        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-libros', 'public');

        //Resize de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(400,300);
        $img->save();

        // auth()->user()->libros()->create([
        //     'titulo'=> $data['titulo'],
        //     'descripcion'=> $data['descripcion'],
        //     'imagen'=> $ruta_imagen,
        //     'enlace' => $nombreArchivo,
        //     'categoria_id'=> $data['categoria']
        // ]);

        $libro = new Libro();

        $libro->titulo = $data['titulo'];
        $libro->user_id = $usuario->id;
        $libro->descripcion = $data['descripcion'];
        $libro->imagen = $ruta_imagen;
        $libro->categoria_id = $data['categoria'];
        $libro->enlace = $nombreArchivo;

        $libro->save();

        return redirect()->action('LibroController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($libro->id) : false;

        //obtener la cantidad de likes
        $likes = $libro->likes->count();

        return view('libros.show', compact('libro', 'like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        //revisar el policy 
        $this->authorize('view', $libro);

        
        $categorias = CategoriaLibro::all(['nombre','id']);

        return view('libros.edit', compact('categorias','libro')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //revisar el policy
        $this->authorize('update', $libro);
        //validacion
        $data= $request->validate([
            'titulo'=> 'required|min:6',
            'categoria'=>'required',
            'descripcion'=>'required',
            'categoria'=>'required'
        ]);
        
        //asignar valores
        $libro->titulo = $data['titulo'];
        $libro->descripcion = $data['descripcion'];
        $libro->categoria_id = $data['categoria'];

        if (request('imagen')) {
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-libros', 'public');

            //Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(400,300);
            $img->save();

            //asignar al objeto
            $libro->imagen = $ruta_imagen;
        }

        if ($request->file('enlace')) 
        {
            $archivo = $request->file('enlace');
            $nombreArchivo = time() . "." . $request->file('enlace')->extension();
            $ubicacion = public_path('/storage/enlace');
            $archivo->move($ubicacion, $nombreArchivo);
            
            //Asignar al objeto
            $libro->enlace = $nombreArchivo;
        }

        $libro->save();

        return redirect()->action('LibroController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        //ejecutar el policy
        $this->authorize('delete',$libro);

        //eliminar la receta
        $libro->delete();

        return redirect()->action('LibroController@index');
    }

    public function search(Request $request)
    {
        $busqueda = $request['buscar'];
        $libros = Libro::where('titulo','like', '%'.$busqueda.'%' )->paginate(5);
        $libros->appends(['buscar' => $busqueda]);
        return view('busquedas.show', compact('libros' , 'busqueda'));
    }

}
