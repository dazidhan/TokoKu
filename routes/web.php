<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController; // <--- TAMBAHKAN INI

// --- AUTH ROUTES (Breeze) ---
require __DIR__.'/auth.php';

// --- MAIN ROUTES (Protected) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kasir
    Route::get('/kasir', [PosController::class, 'index'])->name('kasir');
    Route::post('/kasir/checkout', [PosController::class, 'store'])->name('kasir.store');

    // Stok
    Route::get('/stok', [ProductController::class, 'index'])->name('stok');
    Route::post('/stok', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/stok/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Karyawan
    Route::get('/karyawan', [EmployeeController::class, 'index'])->name('karyawan');
    Route::post('/karyawan', [EmployeeController::class, 'store'])->name('employees.store');
    Route::delete('/karyawan/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // --- TAMBAHKAN BAGIAN INI (PROFILE ROUTES) ---
    // Ini yang dicari oleh Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Offline Page
Route::get('/offline', [PosController::class, 'offline']);

Route::view('/offline', 'offline')->name('offline');