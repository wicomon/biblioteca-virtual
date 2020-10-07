@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Resultado de la Búsqueda : {{ $busqueda }}
        </h2>

        <div class="row">
            @foreach($libros as $libro)
                @include('ui.libro')                
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{$libros->links()}}
        </div>
    </div>

@endsection