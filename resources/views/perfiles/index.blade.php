@extends('layouts.app')

@section('content')

{{-- {{$perfil->usuario->recetas}} --}}
@section('botones')
    <div class="py-4 mt-1 col-12">
        <a class="btn btn-outline-danger mr-2 text-uppercase font-weight-bold" href="{{route('libros.index')}}" novalidate>
            <svg class="icono" viewBox="0 0 20 20" fill="currentColor" class="arrow-circle-left w-6 h-6"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
            Volver
        </a>
    </div>
@endsection

<div class="container">
    <div class="container">
        <h3>Exportar Usuarios</h3>
        <p>
            Click <a href="{{route('users.excel')}}">Aqui </a>
            para descargar en Excel los usuarios
        </p>
    </div>
    <div class="container bordered mt-5">
        <form action="{{route('users.import.excel')}}" method="POST" enctype="multipart/form-data">
        
            <h3>Importar Usuarios</h3>
            @csrf
            @if(Session::has('message'))
                <p>{{Session::get('message')}}</p>
            @endif

            <input type="file" name="file"><br><br>
            <input type="submit" class="btn btn-primary" value="Importar excel">
        
        </form>
    </div>
</div>

@endsection