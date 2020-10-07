<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'InicioController@index')->name('inicio.index');

Route::get('/libros', 'LibroController@index')->name('libros.index');
Route::get('/libros/create', 'LibroController@create')->name('libros.create');
Route::post('/libros', 'LibroController@store')->name('libros.store');
Route::get('/libros/{libro}', 'LibroController@show')->name('libros.show');
Route::get('/libros/{libro}/edit','LibroController@edit')->name('libros.edit');
Route::put('/libros/{libro}', 'LibroController@update')->name('libros.update');
Route::delete('/libros/{libro}', 'LibroController@destroy')->name('libros.destroy');

Route::get('/categoria/{categoriaLibro}', 'CategoriaController@show')->name('categorias.show');

//buscador de recetas
Route::get('/buscar', 'LibroController@search')->name('buscar.show');


Route::get('/perfiles', 'PerfilController@index')->name('perfiles.index');
Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');

// Almanacena los likes de los libros
Route::post('/libros/{libro}', 'LikesController@update')->name('likes.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('user-list-excel', 'PerfilController@exportExcel')->name('users.excel');
Route::post('import-list-excel', 'PerfilController@importExcel')->name('users.import.excel');

Route::get('/storage-link', function(){
    if (file_exists(public_path('storage'))) {
        return 'The public storage directory already exists';
    }

    app('files')->link(
        storage_path('app_public'), public_path('storage')
    );

    return 'the public starage directory has been linked';
});