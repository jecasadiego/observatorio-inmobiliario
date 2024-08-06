<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\UsuarioAprobado;
use App\Http\Controllers\NotificationController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/ver_inmueble/{id}', [InmuebleController::class, 'ver_inmueble'])->name('inmuebles.ver_inmueble');
Route::post('/buscar_inmuebles', [InmuebleController::class, 'buscar'])->name('inmuebles.buscar');
Route::post('/recuperar_contrasena', [InmuebleController::class, 'RecuperarContrasena'])->name('recuperar_contrasena');
route::get('/correo_prueba', [InmuebleController::class, 'enviar_correo_prueba'])->name('correo_prueba');
Route::get('/update-dias-restantes', [InmuebleController::class, 'updateDiasRestantes']);
Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', UsuarioAprobado::class])->group(function () {
        Route::get('/crear_inmueble', [InmuebleController::class, 'index'])->name('inmuebles.crear');
        Route::get('/listar_inmuebles/{tipo_oferta}/{active}', [InmuebleController::class, 'show'])->name('inmuebles.show');
        Route::get('/listar_vencidos', [InmuebleController::class, 'vencidos'])->name('inmuebles.vencidos');
        Route::get('/editar_inmueble/{id}', [InmuebleController::class, 'edit'])->name('inmuebles.edit');
        Route::post('/actualizar_inmueble/{id}', [InmuebleController::class, 'update'])->name('inmuebles.actualizar');
        Route::post('/guardar_inmueble', [InmuebleController::class, 'store'])->name('inmuebles.guardar');
        Route::post('/desactivar_inmueble/{id}', [InmuebleController::class, 'delete'])->name('inmuebles.desactivar');
        Route::post('/reactivar_inmueble/{id}', [InmuebleController::class, 'reactivar'])->name('inmuebles.reactivar');

        Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', SuperAdmin::class])->group(function () {
            Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
            Route::get('/superadmin/entidad', [SuperAdminController::class, 'entidad'])->name('superadmin.entidad');
            Route::post('/superadmin/entidad/update', [SuperAdminController::class, 'entidad_update'])->name('superadmin.entidad.update');
            Route::get('/superadmin/formatos_email', [SuperAdminController::class, 'formatos_email'])->name('superadmin.formatos_email');
            Route::get('/superadmin/formatos_email/create', [SuperAdminController::class, 'formatos_email_create'])->name('superadmin.formatos_email_create');
            Route::post('/superadmin/formatos_email', [SuperAdminController::class, 'formatos_email_store'])->name('superadmin.formatos_email_store');
            Route::get('/superadmin/formatos_email/{formato}/edit', [SuperAdminController::class, 'formatos_email_edit'])->name('superadmin.formatos_email_edit');
            Route::put('/superadmin/formatos_email/{formato}', [SuperAdminController::class, 'formatos_email_update'])->name('superadmin.formatos_email_update');
            Route::delete('/superadmin/formatos_email/{formato}', [SuperAdminController::class, 'formatos_email_destroy'])->name('superadmin.formatos_email_destroy');
            Route::get('/superadmin/usuarios', [SuperAdminController::class, 'usuarios'])->name('superadmin.usuarios');
            Route::get('/superadmin/usuarios/create', [SuperAdminController::class, 'usuarios_create'])->name('superadmin.usuarios_create');
            Route::post('/superadmin/usuarios/store', [SuperAdminController::class, 'usuarios_store'])->name('superadmin.usuarios_store');
            Route::get('superadmin/usuarios/{id}/edit', [SuperAdminController::class, 'usuarios_edit'])->name('superadmin.usuarios_edit');
            Route::put('superadmin/usuarios/{id}', [SuperAdminController::class, 'usuarios_update'])->name('superadmin.usuarios_update');
            Route::get('/superadmin/usuarios/pendientes', [SuperAdminController::class, 'usuarios_pendientes'])->name('superadmin.usuarios_pendientes');
            Route::post('/superadmin/usuarios/pendientes/aprobar/{user}', [SuperAdminController::class, 'AprobarUsuario'])->name('superadmin.aprobar_usuarios');
            Route::get('/superadmin/inmuebles/ver', [SuperAdminController::class, 'inmuebles_show'])->name('superadmin.inmuebles_show');
            Route::post('/superadmin/inmuebles/enviar-observacion/{inmueble}', [SuperAdminController::class, 'EnviarObservacion'])->name('superadmin.enviar_observacion');
            Route::post('/superadmin/inmuebles/editar-observacion/{inmueble}', [SuperAdminController::class, 'EditarObservacion'])->name('superadmin.editar_observacion');
            Route::post('/superadmin/inmuebles/eliminar-observacion/{inmueble}', [SuperAdminController::class, 'DeleteObservacion'])->name('superadmin.eliminar_observacion');
            Route::get('/superadmin/inmuebles/pendientes', [SuperAdminController::class, 'inmuebles_pendientes_show'])->name('superadmin.inmuebles_pendientes');
            Route::post('/superadmin/inmuebles/{inmueble}/aprobar', [SuperAdminController::class, 'AprobarInmueble'])->name('superadmin.aprobar_inmueble');
            Route::post('/superadmin/inmuebles/{inmueble}/rechazar', [SuperAdminController::class, 'RechazarInmueble'])->name('superadmin.rechazar_inmueble');
            Route::get('/superadmin/exportar-csv', [SuperAdminController::class, 'exportarCSVConEstructura'])->name('superadmin.exportar_csv');




        });
    });
});
