@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection

@section('botones')
    <div class="py-3 mt-1 col-12">
        <a class="btn btn-outline-danger mr-2 text-uppercase font-weight-bold" href="{{route('libros.index')}}" novalidate>
            <svg class="icono" viewBox="0 0 20 20" fill="currentColor" class="arrow-circle-left w-6 h-6"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
            Volver
        </a>
    </div>
@endsection

@section('content')
{{-- {{$perfil}} --}}
<h1 class="text-center">Editar mi Perfil</h1>

<div class="row justify-content-center mt-5">
    <div class="col-md-10 bg-white p-3">
        <form action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control 
                    @error('nombre') is-invalid @enderror" id="nombre" 
                    placeholder="Your Name"
                    value="{{$perfil->usuario->name}}"
                >
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="biografia">Biografía</label>
                <input type="hidden" id="biografia" name="biografia" value="{{$perfil->biografia}}">
                <trix-editor class="trix-content @error('biografia') is-invalid @enderror" input="biografia"></trix-editor>
                @error('biografia')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="imagen">Tu imagen</label><br>
                <input type="file" class="form-controll @error('imagen') is-invalid @enderror" 
                id="imagen" name="imagen">
                
                @if($perfil->imagen)
                    <div class="mt-4">
                        <p>Imagen Actual</p>
                        <img src="/storage/{{$perfil->imagen}}" style="width: 300px">
                    </div>
                    
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                @endif
                
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-danger" value="Actualizar Perfil">
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