<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Ringkasan (Real Database)
        $todayIncome = Transaction::whereDate('created_at', Carbon::today())->sum('total_price');
        $totalTransactions = Transaction::count();
        
        // --- LOGIC PERBAIKAN FORMAT ANGKA ---
        if ($todayIncome >= 1000000) {
            // Jika jutaan, format jadi 1.5jt
            $incomeDisplay = 'Rp ' . number_format($todayIncome / 1000000, 1) . 'jt';
        } else {
            // Jika ribuan/ratusan ribu, format biasa Rp 90.500
            $incomeDisplay = 'Rp ' . number_format($todayIncome, 0, ',', '.');
        }

        // 2. Data Statistik Cards
        $stats = [
            [
                'title' => 'Penjualan Hari Ini',
                'value' => $incomeDisplay, // <-- Pakai variabel yang sudah diformat benar
                'change' => 'Realtime',
                'type' => 'positive',
                'icon' => 'wallet',
                'bg' => 'bg-primary/10 text-primary'
            ],
            [
                'title' => 'Total Transaksi',
                'value' => $totalTransactions,
                'change' => '+'. Transaction::whereDate('created_at', Carbon::today())->count() .' hari ini',
                'type' => 'positive',
                'icon' => 'cart',
                'bg' => 'bg-info/10 text-info'
            ],
            [
                'title' => 'Produk Tersedia',
                'value' => Product::sum('stock'),
                'change' => Product::whereColumn('stock', '<=', 'min_stock')->count() . ' stok rendah',
                'type' => 'negative',
                'icon' => 'package',
                'bg' => 'bg-warning/10 text-warning'
            ],
            [
                'title' => 'Karyawan Aktif',
                'value' => Employee::where('status', 'active')->count(),
                'change' => Employee::where('status', 'cuti')->count() . ' sedang cuti',
                'type' => 'neutral',
                'icon' => 'users',
                'bg' => 'bg-success/10 text-success'
            ]
        ];

        // 3. Ambil 5 Transaksi Terakhir (Real)
        $recentTransactions = Transaction::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentTransactions'));
    }
}