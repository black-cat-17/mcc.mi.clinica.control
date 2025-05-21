<?php

use App\Http\Controllers\AutorizadoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // -----------------------------------------------------------------------------
    // Rutas para el panel de paciente
    // -----------------------------------------------------------------------------

    Route::get('/paciente', function () {
        return view('mcc.paciente.home');
    })->middleware('can:isPaciente')->name('paciente.home');

    // DOCUMENTOS --------------------------------------------------------------------

    Route::get('/paciente/documentos', [DocumentoController::class, 'index'])
        ->name('paciente.documentos')
        ->middleware(['can:isPaciente']);

    // Nuevo
    Route::get('/paciente/documentos/nuevo', [DocumentoController::class, 'create'])
        ->name('paciente.documentos.nuevo')
        ->middleware(['can:isPaciente']);

    Route::post('/paciente/documentos', [DocumentoController::class, 'store'])
        ->name('paciente.documentos.store')
        ->middleware(['can:isPaciente']);

    // Editar
    Route::get('/paciente/documentos/{id}/editar', [DocumentoController::class, 'edit'])
        ->name('paciente.documentos.edit')
        ->middleware(['can:isPaciente']);

    // Actualizar
    Route::put('/paciente/documentos/{id}', [DocumentoController::class, 'update'])
        ->name('paciente.documentos.update')
        ->middleware(['can:isPaciente']);

    // Eliminar
    Route::delete('/paciente/documentos/{id}', [DocumentoController::class, 'destroy'])
        ->name('paciente.documentos.destroy')
        ->middleware(['can:isPaciente']);

    // ENLACES --------------------------------------------------------------------

    Route::get('/paciente/enlaces', [EnlaceController::class, 'index'])
        ->middleware('can:isPaciente')
        ->name('paciente.enlaces');

    // Nuevo
    Route::get('/paciente/enlaces/nuevo', [EnlaceController::class, 'create'])
        ->name('paciente.enlaces.nuevo')
        ->middleware(['can:isPaciente']);

    Route::post('/paciente/enlaces', [EnlaceController::class, 'store'])
        ->name('paciente.enlaces.store')
        ->middleware(['can:isPaciente']);

    // Editar
    Route::get('/paciente/enlaces/{id}/editar', [EnlaceController::class, 'edit'])
        ->name('paciente.enlaces.edit')
        ->middleware(['can:isPaciente']);

    // Actualizar
    Route::put('/paciente/enlaces/{id}', [EnlaceController::class, 'update'])
        ->name('paciente.enlaces.update')
        ->middleware(['can:isPaciente']);

    // Eliminar
    Route::delete('/paciente/enlaces/{id}', [EnlaceController::class, 'destroy'])
        ->name('paciente.enlaces.destroy')
        ->middleware(['can:isPaciente']);

    // AUTORIZADOS --------------------------------------------------------------------
    Route::get('/paciente/autorizados', [AutorizadoController::class, 'index'])
        ->middleware('can:isPaciente')
        ->name('paciente.autorizados');

    // Nuevo
    Route::get('/paciente/autorizados/nuevo', [AutorizadoController::class,  'create'])
        ->name('paciente.autorizados.nuevo')
        ->middleware(['can:isPaciente']);

    Route::post('/paciente/autorizados', [AutorizadoController::class, 'store'])
        ->name('paciente.autorizados.store')
        ->middleware(['can:isPaciente']);

    // Editar
    Route::get('/paciente/autorizados/{id}/editar', [AutorizadoController::class, 'edit'])
        ->name('paciente.autorizados.edit')
        ->middleware(['can:isPaciente']);

    // Actualizar
    Route::put('/paciente/autorizados/{id}', [AutorizadoController::class, 'update'])
        ->name('paciente.autorizados.update')
        ->middleware(['can:isPaciente']);

    // Eliminar
    Route::delete('/paciente/autorizados/{id}', [AutorizadoController::class, 'destroy'])
        ->name('paciente.autorizados.destroy')
        ->middleware(['can:isPaciente']);

    // Perfil --------------------------------------------------------------------

    Route::get('/paciente/perfil', [UserController::class, 'index'])
        ->middleware('can:isPaciente')
        ->name('paciente.perfil');

    // Editar
    Route::get('/paciente/perfil/{id}/editar', [UserController::class, 'edit'])
        ->name('paciente.perfil.edit')
        ->middleware(['can:isPaciente']);

    // Actualizar
    Route::put('/paciente/perfil/{id}', [UserController::class, 'update'])
        ->name('paciente.perfil.update')
        ->middleware(['can:isPaciente']);

});

require __DIR__.'/auth.php';
