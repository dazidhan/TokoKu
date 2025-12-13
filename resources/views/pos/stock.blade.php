@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-lg px-4 py-4 min-h-screen relative">
    
    <div class="animate-fade-in mb-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-foreground">Manajemen Stok</h1>
            <p class="text-sm text-muted-foreground">
                <span id="total-count">{{ count($products) }}</span> produk
            </p>
        </div>
        <button onclick="toggleModal('addProductModal')" class="h-10 w-10 inline-flex items-center justify-center rounded-xl bg-primary text-primary-foreground shadow-card hover:bg-primary/90 transition-colors active:scale-95">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        </button>
    </div>

    <div class="animate-slide-up relative mb-4">
        <input type="text" id="search-stock" placeholder="Cari..." class="flex h-12 w-full rounded-xl border-2 border-input bg-card px-4 py-3 pl-4 text-base font-medium focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-foreground">
    </div>

    <div id="stock-list" class="space-y-3 pb-20">
        @foreach($products as $product)
        @php $isLow = $product->stock <= $product->min_stock; @endphp
        <div class="stock-item animate-slide-up flex items-center gap-4 rounded-2xl border border-border bg-card p-4 shadow-card hover:shadow-card-hover group relative">
            
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Hapus produk {{ $product->name }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-muted-foreground hover:text-destructive transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $isLow ? 'bg-destructive/10 text-destructive' : 'bg-accent text-accent-foreground' }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            
            <div class="flex-1 min-w-0 pr-6">
                <p class="truncate text-sm font-semibold text-foreground">{{ $product->name }}</p>
                <p class="text-xs text-muted-foreground">SKU: {{ $product->sku }} • {{ $product->category }}</p>
                <p class="text-xs font-medium text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
            
            <div class="text-right">
                <p class="text-lg font-bold {{ $isLow ? 'text-destructive' : 'text-foreground' }}">{{ $product->stock }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div id="addProductModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('addProductModal')"></div>
        
        <div class="absolute bottom-0 left-0 right-0 bg-card rounded-t-3xl p-6 animate-slide-in-bottom max-w-lg mx-auto border-t border-border shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-foreground">Tambah Produk Baru</h2>
                <button onclick="toggleModal('addProductModal')" class="p-2 bg-secondary rounded-full text-secondary-foreground">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-muted-foreground">SKU (Kode)</label>
                        <input type="text" name="sku" required placeholder="PRD00X" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-muted-foreground">Kategori</label>
                        <select name="category" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Dapur">Dapur</option>
                            <option value="Kebersihan">Kebersihan</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-medium text-muted-foreground">Nama Produk</label>
                    <input type="text" name="name" required placeholder="Contoh: Indomie Goreng" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-medium text-muted-foreground">Harga Jual (Rp)</label>
                    <input type="number" name="price" required placeholder="0" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-muted-foreground">Stok Awal</label>
                        <input type="number" name="stock" required placeholder="0" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-muted-foreground">Min. Stok (Alert)</label>
                        <input type="number" name="min_stock" required value="10" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-primary-foreground font-bold py-3 rounded-xl shadow-lg active:scale-95 transition-transform mt-2">
                    Simpan Produk
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection