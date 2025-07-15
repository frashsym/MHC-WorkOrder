<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::middleware(['auth'],)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/api/dependent-data/{departmentId}', [OrderController::class, 'getDependentData']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// API route to fetch dependent data based on department ID
// Order routes
Route::prefix('order')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('order.index'); // Menampilkan daftar order
    Route::post('/', [OrderController::class, 'store'])->name('order.store'); // Membuat order baru
    Route::get('/{order}', [OrderController::class, 'show'])->name('order.show'); // Menampilkan detail order
    // Hanya super admin & admin yang bisa mengupdate atau menghapus order
    Route::middleware(['auth', 'verified', 'role.access:super admin,admin'])->group(function () {
        Route::put('/{order}', [OrderController::class, 'update'])->name('order.update'); // Mengupdate order
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('order.destroy'); // Menghapus order
    });
});

// Master Data - hanya super admin & admin
Route::middleware(['auth', 'verified', 'role.access:super admin,admin'])->group(function () {

    // Department
    Route::prefix('department')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
        Route::post('/', [DepartmentController::class, 'store'])->name('department.store');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('department.update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
    });

    // Category
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('category.show');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Item
    Route::prefix('item')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('item.index');
        Route::post('/', [ItemController::class, 'store'])->name('item.store');
        Route::put('/{item}', [ItemController::class, 'update'])->name('item.update');
        Route::delete('/{item}', [ItemController::class, 'destroy'])->name('item.destroy');
    });

    // Priority
    Route::prefix('priority')->group(function () {
        Route::get('/', [PriorityController::class, 'index'])->name('priority.index');
        Route::post('/', [PriorityController::class, 'store'])->name('priority.store');
        Route::put('/{id}', [PriorityController::class, 'update'])->name('priority.update');
        Route::delete('/{id}', [PriorityController::class, 'destroy'])->name('priority.destroy');
    });

    // Progress
    Route::prefix('progress')->group(function () {
        Route::get('/', [ProgressController::class, 'index'])->name('progress.index');
        Route::post('/', [ProgressController::class, 'store'])->name('progress.store');
        Route::put('/{id}', [ProgressController::class, 'update'])->name('progress.update');
        Route::delete('/{id}', [ProgressController::class, 'destroy'])->name('progress.destroy');
    });
});

// Pengguna & Akses - hanya super admin
Route::middleware(['auth', 'verified', 'role.access:super admin'])->group(function () {

    // Role
    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    // User
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});

require __DIR__ . '/auth.php';
