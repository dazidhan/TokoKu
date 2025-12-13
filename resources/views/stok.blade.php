@extends('layouts.app')
@section('title', 'Manajemen Stok')

@section('content')
<div class="px-5 mt-4 mb-4">
    <input type="text" placeholder="Cari nama atau SKU..." class="w-full bg-dark-800 border border-dark-700 text-white rounded-xl py-3 px-4 focus:outline-none focus:border-primary-500">
</div>

@php $lowStockCount = \App\Models\Product::whereColumn('stock', '<=', 'min_stock')->count(); @endphp
@if($lowStockCount > 0)
<div class="px-5 mb-4">
    <div class="bg-yellow-900/30 border border-yellow-700/50 p-4 rounded-xl flex items-start gap-3">
        <div class="bg-yellow-600/20 p-2 rounded-lg text-yellow-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h4 class="text-yellow-500 font-bold text-sm">Stok Rendah!</h4>
            <p class="text-slate-400 text-xs">{{ $lowStockCount }} produk perlu di-restock segera.</p>
        </div>
    </div>
</div>
@endif

<div class="px-5 pb-20 space-y-3">
    @foreach(\App\Models\Product::orderBy('stock', 'asc')->get() as $item)
    <div class="bg-dark-800 p-4 rounded-xl border border-dark-700 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-dark-700 flex items-center justify-center text-primary-500">
                📦
            </div>
            <div>
                <h4 class="font-bold text-white text-sm">{{ $item->name }}</h4>
                <p class="text-xs text-slate-500">SKU: {{ $item->sku }} • {{ $item->category }}</p>
                <p class="text-xs font-medium text-primary-500 mt-1">Rp {{ number_format($item->price) }}</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-lg font-bold {{ $item->stock <= $item->min_stock ? 'text-red-500' : 'text-white' }}">
                {{ $item->stock }}
            </span>
            <p class="text-[10px] text-slate-500">Min: {{ $item->min_stock }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection