<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiVisitorController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(function () {
    // Protected API routes
});

route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth
route::post('/register', RegisterController::class);
route::post('/login', LoginController::class);
route::post('/logout', LogoutController::class)->middleware('auth:sanctum');

    // Statistik pengunjung harian
    Route::get('/daily', [ApiVisitorController::class, 'getDailyStats']);

Route::middleware(['auth:sanctum'])->prefix('api-visitors')->group(function () {
    // Mengambil semua data pengunjung
    Route::get('/', [ApiVisitorController::class, 'index']);

    // Menyimpan pengunjung baru
    Route::post('/', [ApiVisitorController::class, 'store']);

    // Mengambil pengunjung berdasarkan ID (edit form jika diperlukan)
    Route::get('/{id}', [ApiVisitorController::class, 'edit']);

    // Mengupdate data pengunjung
    Route::put('/{id}', [ApiVisitorController::class, 'update']);

    // Menghapus pengunjung
    Route::delete('/{id}', [ApiVisitorController::class, 'destroy']);

    // Pencarian pengunjung (filter data)
    Route::get('/search', [ApiVisitorController::class, 'indexView']);



    // Statistik pengunjung umum
    Route::get('/statistik', [ApiVisitorController::class, 'visitorStat']);
});
