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
    Route::post('/', [OrderController::class, 'store'])->name('order.store'); // Membuat order baru
   });

require __DIR__.'/auth.php';
