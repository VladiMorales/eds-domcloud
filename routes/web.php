<?php

use App\Http\Controllers\AgenciaController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\CorridasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RealizarVentaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\ViajesController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//Rutas generales para un administrador y vendedor
Route::middleware('auth')->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    /* Rutas para el proceso de venta */
    Route::get('/buscar-corrida', [RealizarVentaController::class, 'index'])->name('buscar.corridas');
    Route::post('/buscar-corrida', [RealizarVentaController::class, 'store']);
    /* Route::get('/seleccionar-corrida', [RealizarVentaController::class, 'seleccionar'])->name('seleccionar.corrida'); */
    Route::get('/pasajeros/{id}/{numBoletos}', [RealizarVentaController::class, 'pasajeros'])->name('pasajeros.nombres');
    Route::post('/realizar-venta', [RealizarVentaController::class, 'venta'])->name('realizar.venta');
    Route::get('/boletos', [RealizarVentaController::class, 'boletos'])->name('boletos');

    

    /* Rutas para la venta de viajes */
    Route::get('/viajes', [ViajesController::class, 'index'])->name('viajes');
    Route::post('/viajes', [ViajesController::class, 'store']);

    /* Cerrar sesión */
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
});

//Rutas para un administrador
Route::middleware('can:isAdmin')->group(function () {
    /* Rutas para Crear, editar y eliminar usuarios */
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.delete');
    Route::patch('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

    /* Rutas para Crear, editar y eliminar corridas */
    Route::get('/corridas', [CorridasController::class, 'index'])->name('corridas');
    Route::post('/corridas', [CorridasController::class, 'store']);
    Route::post('/corridas-filtradas', [CorridasController::class, 'filtrar'])->name('corridas.filtrar');
    Route::get('/corridas-pasajeros/{id}', [CorridasController::class, 'boletos'])->name('corridas.pasajeros');
    Route::delete('/corridas/{id}', [CorridasController::class, 'destroy'])->name('corridas.delete');
    Route::patch('/corridas/{id}', [CorridasController::class, 'update'])->name('corridas.update');

    /* Rutas reportes */
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');
    Route::post('/reportes', [ReportesController::class, 'filtrar']);

    Route::get('/reportes/excel', [ReportesController::class, 'descargarExcel'])->name('reportes.excel');
    Route::get('/reportes/pdf', [ReportesController::class, 'descargarPdf'])->name('reportes.pdf');

    /* Rutas para agencia */
    Route::get('/agencias', [AgenciaController::class, 'index'])->name('agencias');
    Route::post('/agencias', [AgenciaController::class, 'store']);    
    Route::delete('/agencias/{id}', [AgenciaController::class, 'destroy'])->name('agencias.delete');
    Route::patch('/agencias/{id}', [AgenciaController::class, 'update'])->name('agencias.update');

    /* Cambios y cancelaciones de boletos */
    Route::get('/gestion-boletos', [BoletoController::class, 'index'])->name('boletos.gestion');
    Route::post('/gestion-boletos', [BoletoController::class, 'encontrarVenta']);
    Route::delete('/cancelar-venta/{idV}/{idC}', [BoletoController::class, 'cancelarVenta'])->name('cancelar.venta');

    Route::get('/vendedores', [VendedorController::class, 'index'])->name('vendedores');
    Route::post('/vendedores', [VendedorController::class, 'store']);
    Route::delete('/vendedores/{id}', [VendedorController::class, 'destroy'])->name('vendedores.delete');
    Route::patch('/vendedores/{id}', [VendedorController::class, 'update'])->name('vendedores.edit');
});

