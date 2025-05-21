<?php

use App\Http\Controllers\AutorizadoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\FacultativoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // -----------------------------------------------------------------------------
    // Rutas para el panel de paciente
    // -----------------------------------------------------------------------------

    Route::get('/facultativo', function () {
        return view('mcc.facultativo.home');
    })->middleware(['can:isFacultativo'])->name('facultativo.home');

    // DOCUMENTOS --------------------------------------------------------------------

    Route::get('/facultativo/documentos', [DocumentoController::class, 'index'])
        ->name('facultativo.documentos')
        ->middleware(['can:isFacultativo']);

    // Nuevo
    Route::get('/facultativo/documentos/nuevo', [DocumentoController::class, 'create'])
        ->name('facultativo.documentos.nuevo')
        ->middleware(['can:isFacultativo']);

    Route::post('/facultativo/documentos', [DocumentoController::class, 'store'])
        ->name('facultativo.documentos.store')
        ->middleware(['can:isFacultativo']);

    // Editar
    Route::get('/facultativo/documentos/{id}/editar', [DocumentoController::class, 'edit'])
        ->name('facultativo.documentos.edit')
        ->middleware(['can:isFacultativo']);

    // Actualizar
    Route::put('/facultativo/documentos/{id}', [DocumentoController::class, 'update'])
        ->name('facultativo.documentos.update')
        ->middleware(['can:isFacultativo']);

    // Eliminar
    Route::delete('/facultativo/documentos/{id}', [DocumentoController::class, 'destroy'])
        ->name('facultativo.documentos.destroy')
        ->middleware(['can:isFacultativo']);

    // ENLACES --------------------------------------------------------------------

    Route::get('/facultativo/enlaces', [EnlaceController::class, 'index'])
        ->middleware('can:isFacultativo')
        ->name('facultativo.enlaces');

    // Nuevo
    Route::get('/facultativo/enlaces/nuevo', [EnlaceController::class, 'create'])
        ->name('facultativo.enlaces.nuevo')
        ->middleware(['can:isFacultativo']);

    Route::post('/facultativo/enlaces', [EnlaceController::class, 'store'])
        ->name('facultativo.enlaces.store')
        ->middleware(['can:isFacultativo']);

    // Editar
    Route::get('/facultativo/enlaces/{id}/editar', [EnlaceController::class, 'edit'])
        ->name('facultativo.enlaces.edit')
        ->middleware(['can:isFacultativo']);

    // Actualizar
    Route::put('/facultativo/enlaces/{id}', [EnlaceController::class, 'update'])
        ->name('facultativo.enlaces.update')
        ->middleware(['can:isFacultativo']);

    // Eliminar
    Route::delete('/facultativo/enlaces/{id}', [EnlaceController::class, 'destroy'])
        ->name('facultativo.enlaces.destroy')
        ->middleware(['can:isFacultativo']);

    // AUTORIZADOS --------------------------------------------------------------------
    Route::get('/facultativo/autorizados', [AutorizadoController::class, 'index'])
        ->middleware('can:isFacultativo')
        ->name('facultativo.autorizados');

    // Nuevo
    Route::get('/facultativo/autorizados/nuevo', [AutorizadoController::class,  'create'])
        ->name('facultativo.autorizados.nuevo')
        ->middleware(['can:isFacultativo']);

    Route::post('/facultativo/autorizados', [AutorizadoController::class, 'store'])
        ->name('facultativo.autorizados.store')
        ->middleware(['can:isFacultativo']);

    // Editar
    Route::get('/facultativo/autorizados/{id}/editar', [AutorizadoController::class, 'edit'])
        ->name('facultativo.autorizados.edit')
        ->middleware(['can:isFacultativo']);

    // Actualizar
    Route::put('/adfacultativomin/autorizados/{id}', [AutorizadoController::class, 'update'])
        ->name('facultativo.autorizados.update')
        ->middleware(['can:isFacultativo']);

    // Eliminar
    Route::delete('/facultativo/autorizados/{id}', [AutorizadoController::class, 'destroy'])
        ->name('facultativo.autorizados.destroy')
        ->middleware(['can:isFacultativo']);

    // ESPECIALIDADES --------------------------------------------------------------------

    Route::get('/facultativo/especialidades', [EspecialidadController::class, 'index'])
        ->middleware('can:isFacultativo')
        ->name('facultativo.especialidades');

    // Nuevo
    Route::get('/facultativo/especialidades/nuevo', [EspecialidadController::class,  'create'])
        ->name('facultativo.especialidades.nuevo')
        ->middleware(['can:isFacultativo']);

    Route::post('/facultativo/especialidades', [EspecialidadController::class, 'store'])
        ->name('facultativo.especialidades.store')
        ->middleware(['can:isFacultativo']);

    // Editar
    Route::get('/facultativo/especialidades/{id}/editar', [EspecialidadController::class, 'edit'])
        ->name('facultativo.especialidades.edit')
        ->middleware(['can:isFacultativo']);

    // Actualizar
    Route::put('/facultativo/especialidades/{id}', [EspecialidadController::class, 'update'])
        ->name('facultativo.especialidades.update')
        ->middleware(['can:isFacultativo']);

    // Eliminar
    Route::delete('/facultativo/especialidades/{id}', [EspecialidadController::class, 'destroy'])
        ->name('facultativo.especialidades.destroy')
        ->middleware(['can:isFacultativo']);

    // Perfil --------------------------------------------------------------------

    Route::get('/facultativo/perfil', [UserController::class, 'index'])
        ->middleware('can:isFacultativo')
        ->name('facultativo.perfil');

    // Editar
    Route::get('/facultativo/perfil/{id}/editar', [UserController::class, 'edit'])
        ->name('facultativo.perfil.edit')
        ->middleware(['can:isFacultativo']);

    // Actualizar
    Route::put('/facultativo/perfil/{id}', [UserController::class, 'update'])
        ->name('facultativo.perfil.update')
        ->middleware(['can:isFacultativo']);

    // Facultativo --------------------------------------------------------------------

    Route::get('/facultativo/facultativos', [FacultativoController::class, 'index'])
        ->middleware('can:isFacultativo')
        ->name('facultativo.facultativos');

    // Nuevo
    Route::get('/facultativo/facultativos/nuevo', [FacultativoController::class,  'create'])
        ->name('facultativo.facultativos.nuevo')
        ->middleware(['can:isFacultativo']);

    Route::post('/facultativo/facultativos', [FacultativoController::class, 'store'])
        ->name('facultativo.facultativos.store')
        ->middleware(['can:isFacultativo']);

    // Editar
    Route::get('/facultativo/facultativos/{id}/editar', [FacultativoController::class, 'edit'])
        ->name('facultativo.facultativos.edit')
        ->middleware(['can:isFacultativo']);

    // Actualizar
    Route::put('/facultativo/facultativos/{id}', [FacultativoController::class, 'update'])
        ->name('facultativo.facultativos.update')
        ->middleware(['can:isFacultativo']);

    // Eliminar
    Route::delete('/facultativo/facultativos/{id}', [FacultativoController::class, 'destroy'])
        ->name('facultativo.facultativos.destroy')
        ->middleware(['can:isFacultativo']);

});

require __DIR__.'/auth.php';
