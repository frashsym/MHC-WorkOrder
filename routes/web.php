<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::middleware('auth.custom')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth.custom', 'verified'])->name('dashboard');

// API route to fetch dependent data based on department ID
Route::get('/api/dependent-data/{departmentId}', [OrderController::class, 'getDependentData']);

// Order routes
Route::prefix('order')->middleware(['auth.custom', 'verified'])->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('order.index'); // Menampilkan daftar order
    Route::post('/', [OrderController::class, 'store'])->name('order.store'); // Membuat order baru
    Route::get('/{order}', [OrderController::class, 'show'])->name('order.show'); // Menampilkan detail order
    Route::put('/{order}', [OrderController::class, 'update'])->name('order.update'); // Mengupdate order
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('order.destroy'); // Menghapus order
   });

require __DIR__.'/auth.php';
