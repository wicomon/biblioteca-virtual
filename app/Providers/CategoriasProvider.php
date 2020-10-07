<?php

namespace App\Providers;
use View;
use App\CategoriaLibro;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            
            $categorias = CategoriaLibro::all();
            $view->with('categorias', $categorias);
        });
    }
}
