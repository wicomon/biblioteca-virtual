@extends('layouts.app')

@section('content')

{{--<h1>{{$receta}}</h1>--}}

<article class="contenido-receta bg-white p-5 shadow">
    <h1 class="text-center">{{$libro->titulo}}</h1>

    <div class="imagen-receta">
        <img src="/storage/{{$libro->imagen}}" class="w-100">
    </div>

    <div class="receta-meta mt-3">
        <p>
            <span class="font-weight-bold text-danger"> Área : </span>
            <a class="text-dark" href="
            {{ route('categorias.show', ['categoriaLibro' => $libro->categoria->id]) }}
            ">
                {{$libro->categoria->nombre}}
            </a>
        </p>
        <p>
            <span class="font-weight-bold text-danger"> Publicación : </span>
            {{--TO DO : mostrar el usuario--}}
            
            <a class="text-dark" href="
            {{ route('perfiles.show', ['perfil' => $libro->autor->id]) }}
            ">
                {{$libro->autor->name}}
            </a>
        </p>
        
        
    </div>

    <div class="preparacion">
        <h2 class="my-3 text-danger">Descripción: </h2>
        {!!$libro->descripcion!!}
    </div>
    
        <a href="/storage/enlace/{{ $libro->enlace }}" 
            class="btn btn-outline-danger mr-2 text-uppercase font-weight-bold mt-3"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Ver Libro
        </a>

    <div class="justify-content-center row text-center">
        <like-button libro-id="{{$libro->id}}" 
            like="{{$like}}" likes="{{$likes}}"
            ></like-button>
    </div>
    

</article>

@endsection