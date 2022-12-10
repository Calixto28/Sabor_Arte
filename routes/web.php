<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\RegistrarseController;
use App\Http\Controllers\OpcionesMenuController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\MeserosController;
use App\Http\Controllers\CocinerosController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/registrarse', [RegistrarseController::class, 'index'])->name('registrarse.index');
Route::post('/registrarse', [RegistrarseController::class, 'registro'])->name('registrarse.registro');

Route::get('/ordenes', [OrdenesController::class, 'index'])->name('ordenes.index');
Route::get('/ordenes/detalle/{id}', [OrdenesController::class, 'detalle'])->name('ordenes.detalle');
Route::get('/ordenes/pagar/{id}', [OrdenesController::class, 'pagar'])->name('ordenes.pagar');

Route::get('/configuraciones', [ConfiguracionesController::class, 'index'])->name('configuraciones.index');
Route::get('/configuraciones/create', [ConfiguracionesController::class, 'create'])->name('configuraciones.create');
Route::post('/configuraciones/store', [ConfiguracionesController::class, 'store'])->name('configuraciones.store');
Route::get('/configuraciones/edit/{id}', [ConfiguracionesController::class, 'edit'])->name('configuraciones.edit');
Route::put('/configuraciones/update', [ConfiguracionesController::class, 'update'])->name('configuraciones.update');
Route::get('/configuraciones/baja/{id}', [ConfiguracionesController::class, 'baja'])->name('configuraciones.baja');
Route::get('/configuraciones/alta/{id}', [ConfiguracionesController::class, 'alta'])->name('configuraciones.alta');

Route::get('/opciones_menu', [OpcionesMenuController::class, 'index'])->name('opciones_menu.index');
Route::get('/opciones_menu/create', [OpcionesMenuController::class, 'create'])->name('opciones_menu.create');
Route::post('/opciones_menu/store', [OpcionesMenuController::class, 'store'])->name('opciones_menu.store');
Route::get('/opciones_menu/edit/{id}', [OpcionesMenuController::class, 'edit'])->name('opciones_menu.edit');
Route::put('/opciones_menu/update', [OpcionesMenuController::class, 'update'])->name('opciones_menu.update');
Route::get('/opciones_menu/baja/{id}', [OpcionesMenuController::class, 'baja'])->name('opciones_menu.baja');
Route::get('/opciones_menu/alta/{id}', [OpcionesMenuController::class, 'alta'])->name('opciones_menu.alta');

Route::get('/perfiles', [PerfilesController::class, 'index'])->name('perfiles.index');
Route::get('/perfiles/create', [PerfilesController::class, 'create'])->name('perfiles.create');
Route::post('/perfiles/store', [PerfilesController::class, 'store'])->name('perfiles.store');
Route::get('/perfiles/edit/{id}', [PerfilesController::class, 'edit'])->name('perfiles.edit');
Route::put('/perfiles/update', [PerfilesController::class, 'update'])->name('perfiles.update');
Route::get('/perfiles/baja/{id}', [PerfilesController::class, 'baja'])->name('perfiles.baja');
Route::get('/perfiles/alta/{id}', [PerfilesController::class, 'alta'])->name('perfiles.alta');

Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/update', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::get('/usuarios/baja/{id}', [UsuariosController::class, 'baja'])->name('usuarios.baja');
Route::get('/usuarios/alta/{id}', [UsuariosController::class, 'alta'])->name('usuarios.alta');
Route::get('/usuarios/desbloquear/{id}', [UsuariosController::class, 'desbloquear'])->name('usuarios.desbloquear');

Route::get('/permisos', [PermisosController::class, 'index'])->name('permisos.index');
Route::get('/permisos/asignacion/{id}', [PermisosController::class, 'asignacion'])->name('permisos.asignacion');
Route::put('/permisos/update', [PermisosController::class, 'update'])->name('permisos.update');

Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('/categorias/edit/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/update', [CategoriasController::class, 'update'])->name('categorias.update');
Route::get('/categorias/baja/{id}', [CategoriasController::class, 'baja'])->name('categorias.baja');
Route::get('/categorias/alta/{id}', [CategoriasController::class, 'alta'])->name('categorias.alta');

Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductosController::class, 'create'])->name('productos.create');
Route::post('/productos/store', [ProductosController::class, 'store'])->name('productos.store');
Route::get('/productos/edit/{id}', [ProductosController::class, 'edit'])->name('productos.edit');
Route::put('/productos/update', [ProductosController::class, 'update'])->name('productos.update');
Route::get('/productos/baja/{id}', [ProductosController::class, 'baja'])->name('productos.baja');
Route::get('/productos/alta/{id}', [ProductosController::class, 'alta'])->name('productos.alta');

Route::get('/cliente', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/cliente/menu/{id}', [ClientesController::class, 'menu'])->name('clientes.menu');
Route::post('/cliente/agregarProducto', [ClientesController::class, 'agregarProducto'])->name('clientes.agregarProducto');
Route::post('/cliente/generarOrden', [ClientesController::class, 'generarOrden'])->name('clientes.generarOrden');

Route::get('/mesero', [MeserosController::class, 'index'])->name('meseros.index');
Route::get('/mesero/orden', [MeserosController::class, 'orden'])->name('meseros.orden');
Route::post('/mesero/getDetailOrden', [MeserosController::class, 'getDetailOrden'])->name('meseros.getDetagetDetailOrdenilOrden');
Route::post('/mesero/productoEntregado', [MeserosController::class, 'productoEntregado'])->name('meseros.productoEntregado');
Route::post('/mesero/ordenServida', [MeserosController::class, 'ordenServida'])->name('meseros.ordenServida');

Route::get('/cocinero', [CocinerosController::class, 'index'])->name('cocineros.index');
Route::post('/cocinero/getDetailOrden', [CocinerosController::class, 'getDetailOrden'])->name('cocineros.getDetagetDetailOrdenilOrden');
Route::post('/cocinero/productoCocinado', [CocinerosController::class, 'productoCocinado'])->name('cocineros.productoCocinado');
Route::post('/cocinero/recetaProducto', [CocinerosController::class, 'recetaProducto'])->name('cocineros.recetaProducto');

Route::get('/', function () {
    return view('home');
});