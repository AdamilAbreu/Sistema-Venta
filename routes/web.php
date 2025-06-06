<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('categorias', CategoriasController::class);
Route::get('/usuarios/inicio',[UsuariosController::class, 'Inicio'])-> name('usuarios.inicio');
Route::resource('/articulos', ArticulosController::class);
Route::get('/articulos', function () {
    if (session('role') === 'admin') {
        return app()->call('App\Http\Controllers\ArticulosController@index');
    } else {
        return app()->call('App\Http\Controllers\ArticulosController@obtenerArticulo');
    }
})->name('articulos.index');
Route::post('/carrito/agregar', [ArticulosController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::get('/carrito', [ArticulosController::class, 'verCarrito'])->name('carrito.ver');
Route::post('/carrito/vaciar', [ArticulosController::class, 'vaciarCarrito'])->name('carrito.vaciar');
Route::resource('/cliente', ClienteController::class)->names([
    'index' => 'VistaUsuario.indexUsuario',
]);
Route::put('cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::get('/cliente', [ClienteController::class, 'index'])->name('VistaUsuario.indexUsuario');
Route::resource('/ventas', VentasController::class);
Route::resource('usuarios', UsuariosController::class);
Route::get('/login', [UsuariosController::class, 'index']); // Mostrar formulario de login
Route::post('/usuarios/login', [UsuariosController::class, 'login']); // Procesar login
Route::post('/usuarios/registrar', [UsuariosController::class, 'registrar'])->name('usuarios.registrar'); // Procesar login
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::resource('pedidos', PedidoController::class);   
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::post('/logout', function () {
    Auth::logout();  
    session()->flush();
    //Redirigir a la pagina de login al cerrar la sesion
    return redirect('usuarios');
})->name('logout');
Route::get('/obtenerVentas', [PedidoController::class, 'obtenerVentas'])->name('obtenerVentas');




