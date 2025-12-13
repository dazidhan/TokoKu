<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', function () {
    return response()->json([
        'status' => 'success',
        'data' => Product::all()
    ], 200);
});