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
    // Rutas para el panel de admin
    // -----------------------------------------------------------------------------

    Route::get('/admin', function () {
        return view('mcc.admin.home');
    })->middleware('can:isAdmin')->name('admin.home');

    // USUARIOS --------------------------------------------------------------------

    Route::get('/admin/usuarios', [UserController::class, 'index'])
        ->middleware('can:isAdmin')
        ->name('admin.usuarios');

    // Nuevo
    Route::get('/admin/usuarios/nuevo', [UserController::class, 'create'])
        ->name('admin.usuarios.nuevo')
        ->middleware(['can:isAdmin']);

    Route::post('/admin/usuarios', [UserController::class, 'store'])
        ->name('admin.usuarios.store')
        ->middleware(['can:isAdmin']);

    // Editar
    Route::get('/admin/usuarios/{id}/editar', [UserController::class, 'edit'])
        ->name('admin.usuarios.edit')
        ->middleware(['can:isAdmin']);

    // Actualizar
    Route::put('/admin/usuarios/{id}', [UserController::class, 'update'])
        ->name('admin.usuarios.update')
        ->middleware(['can:isAdmin']);

    // Eliminar
    Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])
        ->name('admin.usuarios.destroy')
        ->middleware(['can:isAdmin']);

    // ESPECIALIDADES --------------------------------------------------------------------

    Route::get('/admin/especialidades', [EspecialidadController::class, 'index'])
        ->middleware('can:isAdmin')
        ->name('admin.especialidades');

    // Nuevo
    Route::get('/admin/especialidades/nuevo', [EspecialidadController::class,  'create'])
        ->name('admin.especialidades.nuevo')
        ->middleware(['can:isAdmin']);

    Route::post('/admin/especialidades', [EspecialidadController::class, 'store'])
        ->name('admin.especialidades.store')
        ->middleware(['can:isAdmin']);

    // Editar
    Route::get('/admin/especialidades/{id}/editar', [EspecialidadController::class, 'edit'])
        ->name('admin.especialidades.edit')
        ->middleware(['can:isAdmin']);

    // Actualizar
    Route::put('/admin/especialidades/{id}', [EspecialidadController::class, 'update'])
        ->name('admin.especialidades.update')
        ->middleware(['can:isAdmin']);

    // Eliminar
    Route::delete('/admin/especialidades/{id}', [EspecialidadController::class, 'destroy'])
        ->name('admin.especialidades.destroy')
        ->middleware(['can:isAdmin']);

    // AUTORIZADOS --------------------------------------------------------------------
    Route::get('/admin/autorizados', [AutorizadoController::class, 'index'])
        ->middleware('can:isAdmin')
        ->name('admin.autorizados');

    // Nuevo
    Route::get('/admin/autorizados/nuevo', [AutorizadoController::class,  'create'])
        ->name('admin.autorizados.nuevo')
        ->middleware(['can:isAdmin']);

    Route::post('/admin/autorizados', [AutorizadoController::class, 'store'])
        ->name('admin.autorizados.store')
        ->middleware(['can:isAdmin']);

    // Editar
    Route::get('/admin/autorizados/{id}/editar', [AutorizadoController::class, 'edit'])
        ->name('admin.autorizados.edit')
        ->middleware(['can:isAdmin']);

    // Actualizar
    Route::put('/admin/autorizados/{id}', [AutorizadoController::class, 'update'])
        ->name('admin.autorizados.update')
        ->middleware(['can:isAdmin']);

    // Eliminar
    Route::delete('/admin/autorizados/{id}', [AutorizadoController::class, 'destroy'])
        ->name('admin.autorizados.destroy')
        ->middleware(['can:isAdmin']);

    // Facultativo --------------------------------------------------------------------
    Route::get('/admin/facultativos', [FacultativoController::class, 'index'])
        ->middleware('can:isAdmin')
        ->name('admin.facultativos');

    // Nuevo
    Route::get('/admin/facultativos/nuevo', [FacultativoController::class,  'create'])
        ->name('admin.facultativos.nuevo')
        ->middleware(['can:isAdmin']);

    Route::post('/admin/facultativos', [FacultativoController::class, 'store'])
        ->name('admin.facultativos.store')
        ->middleware(['can:isAdmin']);

    // Editar
    Route::get('/admin/facultativos/{id}/editar', [FacultativoController::class, 'edit'])
        ->name('admin.facultativos.edit')
        ->middleware(['can:isAdmin']);

    // Actualizar
    Route::put('/admin/facultativos/{id}', [FacultativoController::class, 'update'])
        ->name('admin.facultativos.update')
        ->middleware(['can:isAdmin']);

    // Eliminar
    Route::delete('/admin/facultativos/{id}', [FacultativoController::class, 'destroy'])
        ->name('admin.facultativos.destroy')
        ->middleware(['can:isAdmin']);

    // DOCUMENTOS --------------------------------------------------------------------

    Route::get('/admin/documentos', [DocumentoController::class, 'index'])
        ->name('admin.documentos')
        ->middleware(['can:isAdmin']);

    // Nuevo
    Route::get('/admin/documentos/nuevo', [DocumentoController::class, 'create'])
        ->name('admin.documentos.nuevo')
        ->middleware(['can:isAdmin']);

    Route::post('/admin/documentos', [DocumentoController::class, 'store'])
        ->name('admin.documentos.store')
        ->middleware(['can:isAdmin']);

    // Editar
    Route::get('/admin/documentos/{id}/editar', [DocumentoController::class, 'edit'])
        ->name('admin.documentos.edit')
        ->middleware(['can:isAdmin']);

    // Actualizar
    Route::put('/admin/documentos/{id}', [DocumentoController::class, 'update'])
        ->name('admin.documentos.update')
        ->middleware(['can:isAdmin']);

    // Eliminar
    Route::delete('/admin/documentos/{id}', [DocumentoController::class, 'destroy'])
        ->name('admin.documentos.destroy')
        ->middleware(['can:isAdmin']);

    // ENLACES --------------------------------------------------------------------

    Route::get('/admin/enlaces', [EnlaceController::class, 'index'])
        ->middleware('can:isAdmin')
        ->name('admin.enlaces');

    // Nuevo
    Route::get('/admin/enlaces/nuevo', [EnlaceController::class, 'create'])
        ->name('admin.enlaces.nuevo')
        ->middleware(['can:isAdmin']);

    Route::post('/admin/enlaces', [EnlaceController::class, 'store'])
        ->name('admin.enlaces.store')
        ->middleware(['can:isAdmin']);

    // Editar
    Route::get('/admin/enlaces/{id}/editar', [EnlaceController::class, 'edit'])
        ->name('admin.enlaces.edit')
        ->middleware(['can:isAdmin']);

    // Actualizar
    Route::put('/admin/enlaces/{id}', [EnlaceController::class, 'update'])
        ->name('admin.enlaces.update')
        ->middleware(['can:isAdmin']);

    // Eliminar
    Route::delete('/admin/enlaces/{id}', [EnlaceController::class, 'destroy'])
        ->name('admin.enlaces.destroy')
        ->middleware(['can:isAdmin']);
});

require __DIR__.'/auth.php';
