<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\SessionLoginController;

// route::get('/', function(){
//     return view('mylogin');
// });



route::get('/', [SessionLoginController::class, 'form'])->name('login');
route::post('/login-proses', [SessionLoginController::class, 'login_proses'])->name('login-proses');

route::get('/log-out', [SessionLoginController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->prefix('visitors')->group(function () {
    
    Route::get('/chart', [VisitorController::class, 'getDailyStats']);
    Route::get('/', [VisitorController::class, 'index']); // Mengambil semua data pengunjung
    Route::post('/visitors/store', [VisitorController::class, 'store'])->name('visitors.store'); // Menambah pengunjung baru
    Route::get('/visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
    Route::get('/visitors/edit/{id}', [VisitorController::class, 'edit'])->name('visitors.edit');
    Route::put('/visitors/update/{id}', [VisitorController::class, 'update'])->name('visitors.update'); // Mengupdate pengunjung
    Route::delete('{id}', [VisitorController::class, 'destroy'])->name('visitors.destroy'); // Menghapus pengunjung
    Route::get('/visitors/search', [VisitorController::class, 'search'])->name('visitors.search');
    Route::get('/visitors', [VisitorController::class, 'indexView'])->name('visitors.index');
    Route::get('/visitors/statistik', [VisitorController::class, 'visitorStat'])->name('visitors.statistik');
});