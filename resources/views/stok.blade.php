@extends('layouts.app')
@section('title', 'Manajemen Stok')

@section('content')
<div class="px-5 mt-4 mb-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white">Stok Barang</h2>
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg hover:brightness-110 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah
        </button>
    </div>
    
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama atau SKU..." class="w-full bg-secondary border border-border text-white rounded-xl py-3 px-4 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
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

<div class="px-5 pb-20 space-y-3" id="productList">
    @foreach(\App\Models\Product::orderBy('stock', 'asc')->get() as $item)
    
    <div onclick="openEditModal({{ $item }})" class="group cursor-pointer bg-card p-4 rounded-xl border border-border flex justify-between items-center hover:border-primary transition-colors">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-secondary flex items-center justify-center text-primary text-lg">
                @if($item->category == 'Makanan') 🍜
                @elseif($item->category == 'Minuman') 🥤
                @else 📦
                @endif
            </div>
            <div>
                <h4 class="font-bold text-white text-sm group-hover:text-primary transition-colors">{{ $item->name }}</h4>
                <p class="text-xs text-slate-500">SKU: {{ $item->sku }} • {{ $item->category }}</p>
                <p class="text-xs font-medium text-primary mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-lg font-bold {{ $item->stock <= $item->min_stock ? 'text-destructive' : 'text-white' }}">
                {{ $item->stock }}
            </span>
            <p class="text-[10px] text-slate-500">Min: {{ $item->min_stock }}</p>
            <p class="text-[10px] text-primary opacity-0 group-hover:opacity-100 transition-opacity mt-1">Edit ></p>
        </div>
    </div>
    @endforeach
</div>

<div id="addModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="document.getElementById('addModal').classList.add('hidden')"></div>
    
    <div class="absolute bottom-0 left-0 right-0 bg-card rounded-t-3xl p-6 border-t border-border shadow-2xl animate-slide-in-bottom">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-white">Tambah Produk Baru</h2>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="p-2 bg-secondary rounded-full text-slate-400 hover:text-white">✕</button>
        </div>

        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                <div>
                    <label class="text-xs text-slate-400">Nama Produk</label>
                    <input type="text" name="name" required placeholder="Contoh: Kopi Susu" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs text-slate-400">SKU (Kode Unik)</label>
                        <input type="text" name="sku" required placeholder="BRG-001" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs text-slate-400">Kategori</label>
                        <select name="category" required class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="text-xs text-slate-400">Harga Jual (Rp)</label>
                    <input type="number" name="price" required placeholder="15000" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs text-slate-400">Stok Awal</label>
                        <input type="number" name="stock" required placeholder="10" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs text-slate-400">Min. Alert</label>
                        <input type="number" name="min_stock" required placeholder="5" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-emerald-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-emerald-900/20">
                        + Simpan Produk
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
    
    <div class="absolute bottom-0 left-0 right-0 bg-card rounded-t-3xl p-6 border-t border-border shadow-2xl animate-slide-in-bottom">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-white">Edit Produk</h2>
            <button onclick="closeEditModal()" class="p-2 bg-secondary rounded-full text-slate-400 hover:text-white">✕</button>
        </div>

        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                <div>
                    <label class="text-xs text-slate-400">Nama Produk</label>
                    <input type="text" name="name" id="edit_name" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs text-slate-400">SKU/Kode</label>
                        <input type="text" name="sku" id="edit_sku" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs text-slate-400">Kategori</label>
                        <select name="category" id="edit_category" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="text-xs text-slate-400">Harga (Rp)</label>
                    <input type="number" name="price" id="edit_price" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs text-slate-400">Stok Fisik</label>
                        <input type="number" name="stock" id="edit_stock" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs text-slate-400">Min. Alert</label>
                        <input type="number" name="min_stock" id="edit_min_stock" class="w-full mt-1 bg-secondary border border-border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-primary">
                    </div>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-primary hover:bg-emerald-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-emerald-900/20">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

        <form id="deleteForm" method="POST" action="" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Hapus produk ini permanen?')" class="w-full py-3 text-red-500 font-medium hover:bg-red-500/10 rounded-xl transition-colors">
                Hapus Produk Ini
            </button>
        </form>
    </div>
</div>

<script>
    function openEditModal(product) {
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_sku').value = product.sku;
        document.getElementById('edit_category').value = product.category;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_stock').value = product.stock;
        document.getElementById('edit_min_stock').value = product.min_stock;

        let url = "{{ url('/stok') }}/" + product.id; 
        document.getElementById('editForm').action = url;
        document.getElementById('deleteForm').action = url;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Filter Search
    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let cards = document.querySelectorAll("#productList > div");
        cards.forEach(card => {
            let text = card.innerText.toLowerCase();
            card.style.display = text.includes(input) ? "flex" : "none";
        });
    }
</script>
@endsection