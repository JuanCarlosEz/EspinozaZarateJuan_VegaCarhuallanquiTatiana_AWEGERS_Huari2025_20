<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\VehiculoController;

// Controladores del Incremento 2
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\PlanificacionController;
use App\Http\Controllers\ZonaController;

Route::get('/', function () {
    return view('welcome');
});

// Mostrar formulario de registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Procesar registro
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Roles (solo para admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
});

// Mapa general
Route::get('/mapa', function () {
    return view('mapa');
})->name('mapa');

// Mapa de vehículos
Route::get('/vehiculos/mapa', [VehiculoController::class, 'mapa'])->name('vehiculos.mapa');


// 🔒 Agrupar rutas del sistema principal (solo usuarios autenticados)
Route::middleware(['auth'])->group(function () {

    // --- Incremento 2 ---
    // Reportes ciudadanos
    Route::resource('reportes', ReporteController::class);

    // Mantenimientos de vehículos
    Route::resource('mantenimientos', MantenimientoController::class);

    // Planificación de recolección
    Route::resource('planificaciones', PlanificacionController::class);

    // Gestión de zonas
    Route::resource('zonas', ZonaController::class);
});


Route::get('/rutas', function () {
        return view('rutas');
    })->name('rutas');


require __DIR__.'/auth.php';
