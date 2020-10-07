<div class="col-md-4 mt-4">
    <div class="card shadow">
       <img src="/storage/{{ $libro->imagen }}" alt="imagen libro" class="card-img-top">
       <div class="card-body">
           <h3 class="card-title">{{$libro->titulo}}</h3>
       
           <div class="meta-receta d-flex justify-content-between">
               @php
                   $fecha = $libro->created_at;
               @endphp
               <p class="text-danger fecha font-weight-bold">
                {{$libro->autor->name}}
               </p>
               <p>{{ count($libro->likes) }} les gustó</p>
           </div>
           <p>{{ Str::words( strip_tags($libro->descripcion), 15) }}</p>
           <a href="{{ route('libros.show', ['libro' => $libro->id ]) }}" 
               class="btn btn-warning d-block btn-receta">VER LIBRO
           </a>
       </div>
    </div>
</div>