@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')
<h2 class="text-center mb-5"> Administra tus publicaciones </h2>


<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-danger text-light">
            <tr>
                <th scope="col"> Titulo </th>
                <th scope="col"> Categoría </th>
                <th scope="col"> Acciones </th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $receta)
            <tr>
                <td>{{$receta->titulo}}</td>
                <td>{{$receta->categoria->nombre}}</td>
                <td>
                    <eliminar-libro receta-id={{$receta->id}}></eliminar-libro>
                    
                    <a href="{{route('libros.edit', ['libro' => $receta->id])}}" class="btn btn-dark d-block mr-1 mb-2">Editar</a>
                    <a href="{{route('libros.show', ['libro' => $receta->id])}}" class="btn btn-success d-block mr-1">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 mt-4 justify-content-center d-flex">
        {{$libros->links()}}
    </div>

    {{-- <h2 class="text-center my-5"> Recetas que te gustan</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        @if(count( $usuario->meGusta )>0)
            <ul class="list-group">
                @foreach($usuario->meGusta as $receta)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{$receta->titulo}}</p>
                        <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{route('recetas.show', ['receta' => $receta->id])}}">VER</a>
                    </li>                    
                @endforeach
            </ul>
        @else
            <p class="text-center">Aún no tienes recetas guardadas <small>Dale me gusta a las recetas para verlas aqui.</small></p>
            
        @endif
    </div> --}}

</div>


@endsection