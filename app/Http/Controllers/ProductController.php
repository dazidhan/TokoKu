<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('stock', 'asc')->get();
        return view('pos.stock', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi simpel
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'min_stock' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->back(); // Kembali ke halaman stok
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back();
    }
}