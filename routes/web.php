<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});


// mostrar formulario registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// procesar registro
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
});

Route::get('/mapa', function () {
    return view('mapa');
})->name('mapa');

Route::get('/vehiculos/mapa', [VehiculoController::class, 'mapa'])->name('vehiculos.mapa');

require __DIR__.'/auth.php';
