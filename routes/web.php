<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('order')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('order.index'); // Menampilkan daftar order
    // Route::get('/create', [OrderController::class, 'create'])->name('order.create'); // Menampilkan halaman tambah order
    // Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('order.edit'); // Menampilkan halaman edit order
    // Route::get('/{id}/delete', [OrderController::class, 'confirm'])->name('order.confirm'); // Menampilkan halaman delete order
    // Route::post('/', [OrderController::class, 'store'])->name('order.store'); // Membuat order baru
    // Route::put('/{id}', [OrderController::class, 'update'])->name('order.update'); // Mengedit order
    // Route::delete('/{id}', [OrderController::class, 'delete'])->name('order.delete'); // Menghapus order
});

require __DIR__.'/auth.php';
