<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController; // Baru
use App\Http\Controllers\EmployeeController; // Baru

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Kasir
Route::get('/kasir', [PosController::class, 'index'])->name('kasir');
Route::post('/kasir/checkout', [PosController::class, 'store'])->name('kasir.store');

// Stok (Product) - Menggunakan ProductController untuk logic lengkapnya
Route::get('/stok', [ProductController::class, 'index'])->name('stok');
Route::post('/stok', [ProductController::class, 'store'])->name('products.store'); // Simpan
Route::delete('/stok/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Hapus

// Karyawan - Menggunakan EmployeeController
Route::get('/karyawan', [EmployeeController::class, 'index'])->name('karyawan');
Route::post('/karyawan', [EmployeeController::class, 'store'])->name('employees.store'); // Simpan
Route::delete('/karyawan/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Hapus

// Offline
Route::get('/offline', [PosController::class, 'offline']);
