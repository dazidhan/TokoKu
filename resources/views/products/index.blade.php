@extends('layouts.app')

@section('title', 'Menu Kasir')

@section('content')
    <div class="mb-6">
        <div class="relative">
            <input type="text" placeholder="Cari barang..." class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm transition-all">
            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        
        @forelse($products as $product)
            <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow active:scale-95 duration-150 cursor-pointer group relative overflow-hidden">
                <div class="aspect-square bg-slate-100 rounded-xl mb-3 overflow-hidden relative">
                    <img src="{{ $product->image_url ?? 'https://placehold.co/400' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-semibold text-slate-800 text-sm truncate leading-tight">{{ $product->name }}</h3>
                <div class="flex justify-between items-end mt-2">
                    <p class="text-indigo-600 font-bold text-sm">Rp {{ number_format($product->price) }}</p>
                    <button class="bg-indigo-50 text-indigo-600 p-1.5 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-10 text-slate-400">
                <p>Belum ada produk.</p>
            </div>
        @endforelse
    </div>
@endsection