<?php

use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware([RoleAdmin::class])->group(function () {
    // Route::get('/admin', function () {
    //     return view('admin.layouts');
    // });

    // Route::resource('/admin/kos', KosController::class);
//     Route::middleware([RoleAdmin::class])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.dashboard', [
//             'totalKos' => 5,
//             'totalKamar' => 10,
//             'totalGambar' => 30
//         ]);
//     });
// });
Route::middleware([RoleAdmin::class])->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'));
});
});