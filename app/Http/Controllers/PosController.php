<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    // Halaman Kasir (POS)
    // public function index()
    // {
    //     $products = Product::all();
    //     return view('pos.index', compact('products'));
    // }

    // // Halaman Manajemen Stok
    // public function stock()
    // {
    //     $products = Product::orderBy('stock', 'asc')->get();
    //     return view('pos.stock', compact('products'));
    // }

    // // Halaman Offline
    // public function offline()
    // {
    //     return view('vendor.offline');
    // }

    // Method baru untuk Index agar tetap jalan
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get(); // Hanya tampilkan yang ada stok
        return view('pos.index', compact('products'));
    }

    public function offline()
    {
        return view('vendor.offline');
    }

    // --- LOGIC BARU: PROSES TRANSAKSI ---
    public function store(Request $request)
    {
        // Validasi input dari Javascript (JSON)
        $request->validate([
            'customer_name' => 'required|string',
            'cart' => 'required|array', // Array belanjaan
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.qty' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction(); // Mulai Transaksi Database (agar aman)

            // 1. Buat Header Transaksi
            $totalPrice = 0;
            $totalItems = 0;
            
            // Hitung total dulu dari server side (biar aman tidak dimanipulasi client)
            foreach ($request->cart as $item) {
                $product = Product::find($item['id']);
                $totalPrice += $product->price * $item['qty'];
                $totalItems += $item['qty'];
            }

            $trx = Transaction::create([
                'invoice_code' => 'TRX-' . date('YmdHis') . '-' . rand(100, 999),
                'customer_name' => $request->customer_name,
                'total_price' => $totalPrice,
                'total_items' => $totalItems,
                'status' => 'completed'
            ]);

            // 2. Simpan Detail Item & Kurangi Stok
            foreach ($request->cart as $item) {
                $product = Product::lockForUpdate()->find($item['id']); // Lock agar tidak rebutan stok

                // Cek stok cukup gak?
                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok {$product->name} tidak cukup!");
                }

                // Kurangi stok
                $product->decrement('stock', $item['qty']);

                // Simpan ke transaction_items
                TransactionItem::create([
                    'transaction_id' => $trx->id,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $product->price,
                ]);
            }

            DB::commit(); // Simpan permanen

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi Berhasil!',
                'invoice' => $trx->invoice_code
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}