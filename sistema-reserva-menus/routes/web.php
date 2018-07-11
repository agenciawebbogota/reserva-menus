<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('Dashboard');
Route::get('/menus', 'MenuController@index');
Route::post('/menus/crear', 'MenuController@create')->middleware('auth');
// ->middleware('auth');
Route::PUT('/menus/actualizar', 'MenuController@update')->middleware('auth');
Route::PUT('/menus/actualizar/estado', 'MenuController@updateEstado')->middleware('auth');
Route::get('/descarga/menus', 'MenuController@pdf')->middleware('auth');
// Implementar el guardado de los pedidos
// Route::post('pedido/crear', 'PedidoController@crearPedido');


// Route::DELETE('/menus/eliminar/{id}', 'MenuController@delete')->middleware('auth');

