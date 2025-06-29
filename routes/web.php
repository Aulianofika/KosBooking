<?php

use App\Models\AuliaKos;
use App\Models\AuliaKamar;
use App\Models\AuliaGallery;
use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware([RoleAdmin::class])->group(function () {
    
    //untuk admin
Route::middleware([RoleAdmin::class])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'));
}); 

//untuk tambah
Route::get('/admin/dashboard', function () {
    $totalKos = AuliaKos::count();
    $totalKamar = AuliaKamar::count();
    $totalGambar = AuliaGallery::count();
    return view('admin.dashboard', compact('totalKos', 'totalKamar', 'totalGambar'));
})->name('admin.dashboard');

Route::resource('/admin/kos', KosController::class)->names([
        'index' => 'admin.kos.index',
        'create' => 'admin.kos.create',
        'store' => 'admin.kos.store',
        'edit' => 'admin.kos.edit',
        'update' => 'admin.kos.update',
        'destroy' => 'admin.kos.destroy'
    ]);

Route::middleware(['auth', RoleAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/gallery/{kos_id}', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery/{kos_id}', [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    });


});