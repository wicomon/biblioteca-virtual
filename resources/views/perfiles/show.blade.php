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
    <div class="row">
        <div class="col-md-5">
            @if($perfil->imagen)
            <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="imagen chef">
            @endif
        </div>
        <div class="col-md-7 mt-5 mt-md-0">
            <h2 class="text-center mb-2 text-danger">{{$perfil->usuario->name}}</h2>
            <div class="biografia">
                {!! $perfil->biografia !!}
            </div>
        </div>
    </div>
</div>

<h2 class="text-center my-5">Libros Subidos por : {{$perfil->usuario->name}}</h2>
<div class="container">
<div class="row mx-auto bg-white p-4">
    @if(count($libros)>0)
        @foreach($libros as $libro)
            <div class="col-md-4 mb-1">
                <div class="card">
                    <img src="/storage/{{$libro->imagen}}" class="card-img-top" alt="imagen libro">
                    <div class="card-body">
                        <h4>{{$libro->titulo}}</h4>
                        <a href="{{route('libros.show', ['libro' => $libro->id])}}" class="btn btn-danger d-block mt-4 text-uppercase font-weight-bold">Ver receta</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <p class="text-center w-100">No hay recetas aún...</p>
    @endif
</div>
</div>
<div class="d-flex justify-content-center">
    {{$libros->links()}}
</div>
@endsection