<?php

use App\Http\Controllers\ProdutoController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('produto', 'App\Http\Controllers\ProdutoController');
Route::post('produto/{produto}', 'App\Http\Controllers\ProdutoController@show')->name('produto.show');

Route::prefix('/entrada')->group(function(){
    Route::get('listar', 'App\Http\Controllers\EntradaController@index')->name('entrada.listar');
    Route::get('cadastrar/{produto}', 'App\Http\Controllers\EntradaController@create')->name('entrada.cadastrar');
    Route::post('cadastrar', 'App\Http\Controllers\EntradaController@store')->name('entrada.cadastrar.post');
});
