<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Perfil;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    
    public function index()
    {
        $usuario = auth()->user();

        if ($usuario->rol != 'admin') {
            return redirect()->action('InicioController@index');
        }

        return view('perfiles.index');
    }

    public function show(Perfil $perfil)
    {
        $usuario = auth()->user();

        if ($usuario->rol != 'admin') {
            return redirect()->action('InicioController@index');
        }
        
        //Obtener las recetas con paginacion
        $libros = Libro::where('user_id', $perfil->user_id)->paginate(6);

        
        return view('perfiles.show', compact('perfil','libros'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $usuario = auth()->user();

        if ($usuario->rol != 'admin') {
            return redirect()->action('InicioController@index');
        }
        
        //ejecutar el policy
        $this->authorize('view', $perfil);
        
        
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Policy
        $this->authorize('update', $perfil);

        //validar 
        $data=request()->validate([
            'nombre' => 'required',
            'biografia' => 'required'
        ]);
        
        //Si el usuario sube una imagen
        if($request['imagen']){
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            //asignar al objeto
            $array_imagen = ['imagen' => $ruta_imagen];

        }

        //Asignar nombre y URL
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();
        
        //Eliminar url y name de $data
        unset($data['nombre']);

        //Asignar Biografia e imagen
        auth()->user()->perfil()->update(array_merge($data, $array_imagen ?? []));//array merge para unir 2 arreglos

        //redireccionar
        return redirect()->action('LibroController@index');
    }

    public function exportExcel()
    {
        $usuario = auth()->user();

        if ($usuario->rol != 'admin') {
            return redirect()->action('InicioController@index');
        }

        return Excel::download(new UsersExport, 'user-list.xlsx');
    }

    public function importExcel(Request $request)
    {
        $usuario = auth()->user();

        if ($usuario->rol != 'admin') {
            return redirect()->action('InicioController@index');
        }
        
        $file = $request->file('file');

        Excel::import(new UsersImport, $file);

        return back()->with('message', 'Importación de usuarios completada');
    }


}
