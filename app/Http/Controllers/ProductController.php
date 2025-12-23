<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Tambahkan ini untuk validasi unik saat update

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('stock', 'asc')->get();
        
        // PASTIKAN NAMA VIEW SESUAI LOKASI FILE
        // Jika file ada di resources/views/stock.blade.php, pakai 'stock'
        // Jika file ada di resources/views/pos/stock.blade.php, pakai 'pos.stock'
        return view('stok', compact('products')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'min_stock' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        // Gunakan findOrFail agar error 404 jika ID tidak ada (lebih aman)
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            // Validasi SKU unik, TAPI abaikan (ignore) untuk produk ini sendiri
            'sku' => ['required', Rule::unique('products')->ignore($id)],
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
        ]);

        // 2. Cari Produk
        $product = Product::findOrFail($id);
        
        // 3. Update Data (Termasuk SKU)
        $product->update([
            'name' => $request->name,
            'sku' => $request->sku, // <-- Jangan lupa update SKU juga
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }
}