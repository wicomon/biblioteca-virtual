@extends('layouts.app')

@section('styles')
{{-- owl carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias">
        <form action="{{ route('buscar.show') }}" class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-mrd-4 texto-buscar">
                    <p class="display-4">
                    Encuentra un libro en especifico

                    <input type="search" name="buscar" class="form-control" placeholder="Buscar Libro...">
                    </p>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')

    <div class="container nuevas-recetas mt-3">
        <h2 class="titulo-categoria text-uppercase mb-4"> Ultimas Publicaciones</h2>
        <div class="owl-carousel owl-theme">            
            @foreach($nuevas as $nueva)
                    <div class="card">
                        <img src="/storage/{{ $nueva->imagen }}" alt="imagen libro" class="card-img-top">

                        <div class="card-body">
                            <h3>{{ Str::title($nueva->titulo) }}</h3>
                            <div class="meta-receta d-flex justify-content-between">
                            <p class="text-danger fecha font-weight-bold">
                                {{$nueva->autor->name}}
                               </p>
                               <p>{{ count($nueva->likes) }} les gustó</p>
                            </div>
                            <p>{{ Str::words( strip_tags($nueva->descripcion), 15) }}</p>
                            
                        <a href="{{ route('libros.show', ['libro' => $nueva->id]) }}" 
                            class="btn btn-danger d-block font-weight-bold text-uppercase">
                            Ver Libro
                        </a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
    
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> Libros más Votados</h2>
        <div class="row">
            @foreach($votadas as $libro)
                @include('ui.libro')   
            @endforeach
        </div>
    </div>

    @foreach($libros as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-',' ',$key) }}</h2>
            <div class="row">
                @foreach($grupo as $libros)
                    @foreach($libros as $libro)
                        @include('ui.libro')   
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach


    
@endsection


@section('scripts')
{{-- owl carrusel --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" defer></script>
@endsection