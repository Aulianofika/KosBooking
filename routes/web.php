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
use App\Http\Controllers\UserKosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarGalleryController;

//homepage
Route::get('/', [UserKosController::class, 'index'])->name('homepage');
Route::get('/kos/{id}', [UserKosController::class, 'show'])->name('kos.detail');
Route::get('/kos', [UserKosController::class, 'index'])->name('kos.index');

//auth
// Form register
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
// Proses register
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//untuk admin
Route::middleware([RoleAdmin::class])->group(function () {  

Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('/admin/kos', KosController::class)->names([
        'index' => 'admin.kos.index',
        'create' => 'admin.kos.create',
        'store' => 'admin.kos.store',
        'edit' => 'admin.kos.edit',
        'update' => 'admin.kos.update',
        'destroy' => 'admin.kos.destroy'
    ]);

Route::middleware(['auth', RoleAdmin::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/gallery/{kos_id}', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery/{kos_id}', [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    
// Data Kamar
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/create', [KamarController::class, 'create'])->name('kamar.create');
    Route::post('/kamar', [KamarController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/{id}/edit', [KamarController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
});

Route::get('/admin/kamar/{kamar_id}/galeri', [KamarGalleryController::class, 'index'])->name('admin.kamar.galeri.index');
Route::post('/admin/kamar/{kamar_id}/galeri', [KamarGalleryController::class, 'store'])->name('admin.kamar.galeri.store');
Route::delete('/admin/kamar-galeri/{id}', [KamarGalleryController::class, 'destroy'])->name('admin.kamar.galeri.destroy');


});