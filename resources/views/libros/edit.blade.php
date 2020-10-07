@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
<div class="py-4 mt-5 col-12">
    <a class="btn btn-outline-danger mr-2 text-uppercase font-weight-bold" href="{{route('libros.index')}}" novalidate>
        <svg class="icono" viewBox="0 0 20 20" fill="currentColor" class="arrow-circle-left w-6 h-6"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
        Volver
    </a>
</div>
@endsection

@section('content')
<h2 class="text-center mb-5"> Crear nueva Receta </h2>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form method="POST" action="{{route('libros.update', ['libro' => $libro->id])}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="form-group">
                <label for="titulo">Titulo Receta</label>
                <input type="text" name="titulo" class="form-control 
                @error('titulo') is-invalid @enderror" id="titulo" 
                placeholder="Titulo de la Receta"
                value="{{$libro->titulo}}">
                @error('titulo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="categoria">Categorias</label>
                <select name="categoria" class="form-control @error('categoria') is-invalid @enderror" id="categoria">
                    <option value="">-- Seleccione --</option>
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}" {{ $libro->categoria_id == $categoria->id ? 'selected' : '' }}>{{$categoria->nombre}}</option>
                    @endforeach
                </select>
                @error('categoria')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="descripcion">Descripción: </label>
                <input type="hidden" id="descripcion" name="descripcion" value="{{$libro->descripcion}}">
                <trix-editor class="trix-content @error('descripcion') is-invalid @enderror" input="descripcion"></trix-editor>
                @error('descripcion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="enlace">Subir tu Libro (PDF)</label><br>
                <input type="file" class="form-controll @error('enlace') is-invalid @enderror" 
                    id="enlace" 
                    name="enlace"
                    accept="application/pdf"
                >
                
                @error('enlace')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="imagen">Selecciona tu imagen</label><br>
                <input type="file" class="form-controll @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                
                <div class="mt-4">
                    <p>Imagen Actual</p>
                    <img src="/storage/{{$libro->imagen}}" style="width: 300px">
                </div>
                
                
                @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Modificar Publicación">
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" 
integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" 
crossorigin="anonymous" defer></script>
@endsection