@extends('layouts.app')

@section('content')
<div id="kasir-app" class="mx-auto max-w-lg px-4 py-4 min-h-screen pb-32">
    
    <div class="animate-fade-in relative mb-4 sticky top-20 z-30">
        <svg class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <input type="text" id="search-input" placeholder="Cari produk..." 
            class="flex h-12 w-full rounded-xl border-2 border-input bg-card px-4 py-3 pl-11 text-base font-medium transition-all duration-200 placeholder:text-muted-foreground/60 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 shadow-sm text-foreground">
    </div>

    <div class="animate-slide-up mb-4 flex gap-2 overflow-x-auto pb-2 scrollbar-hide snap-x" style="animation-delay: 50ms;">
        @foreach(['Semua', 'Makanan', 'Minuman', 'Kebersihan', 'Dapur'] as $cat)
        <button onclick="filterCategory('{{ $cat }}')" 
            class="category-btn snap-start shrink-0 rounded-full px-4 py-2 text-sm font-medium transition-all duration-200 {{ $loop->first ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-secondary text-secondary-foreground hover:bg-secondary/80' }}" 
            data-category="{{ $cat }}">
            {{ $cat }}
        </button>
        @endforeach
    </div>

    <div id="product-list" class="animate-slide-up grid grid-cols-2 gap-3" style="animation-delay: 100ms;">
        </div>

    {{-- <div id="cart-container" class="fixed bottom-20 left-0 right-0 z-40 animate-slide-in-bottom px-4 hidden">
        <div class="mx-auto max-w-lg overflow-hidden rounded-2xl border border-border bg-card shadow-lg">
            
            <div id="cart-items-wrapper" class="max-h-48 overflow-y-auto p-4 space-y-2 scrollbar-thin">
                </div>

            <div class="border-t border-border p-4 bg-card">
                <button class="inline-flex w-full items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-primary text-primary-foreground h-12 px-8 text-base font-semibold shadow-card hover:bg-primary/90 hover:shadow-glow transition-all active:scale-[0.98]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span id="checkout-text">Bayar</span>
                </button>
            </div>
        </div>
    </div> --}}

    <div id="cart-container" class="fixed bottom-20 left-0 right-0 z-40 animate-slide-in-bottom px-4 hidden">
        <div class="mx-auto max-w-lg overflow-hidden rounded-2xl border border-border bg-card shadow-lg">
            
            <div id="cart-items-wrapper" class="max-h-48 overflow-y-auto p-4 space-y-2 scrollbar-thin">
                </div>

            <div class="border-t border-border p-4 bg-card">
                <button onclick="openCheckoutModal()" class="inline-flex w-full items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-primary text-primary-foreground h-12 px-8 text-base font-semibold shadow-card hover:bg-primary/90 hover:shadow-glow transition-all active:scale-[0.98]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span id="checkout-text">Bayar</span>
                </button>
            </div>
        </div>
    </div>

    <div id="checkoutModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeCheckoutModal()"></div>
        <div class="absolute bottom-0 left-0 right-0 bg-card rounded-t-3xl p-6 animate-slide-in-bottom max-w-lg mx-auto border-t border-border shadow-2xl">
            <h2 class="text-lg font-bold text-foreground mb-4">Konfirmasi Pembayaran</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-medium text-muted-foreground">Nama Pelanggan</label>
                    <input type="text" id="customer_name" value="Pelanggan Umum" class="w-full rounded-xl bg-background border border-border px-4 py-3 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary text-foreground">
                </div>
                
                <div class="bg-secondary/20 p-4 rounded-xl">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-muted-foreground">Total Item</span>
                        <span id="modal-total-items" class="font-bold text-foreground">0</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold text-primary">
                        <span>Total Bayar</span>
                        <span id="modal-total-price">Rp 0</span>
                    </div>
                </div>

                <button onclick="processCheckout()" id="btn-process" class="w-full bg-primary text-primary-foreground font-bold py-3 rounded-xl shadow-lg active:scale-95 transition-transform">
                    Proses Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    // 1. Data Produk dari Database Laravel
    const products = @json($products);

    // 2. State Aplikasi
    let cart = [];
    let activeCategory = 'Semua';
    let searchQuery = '';

    // 3. Render Produk
    function renderProducts() {
        const container = document.getElementById('product-list');
        container.innerHTML = '';

        const filtered = products.filter(p => {
            const matchSearch = p.name.toLowerCase().includes(searchQuery.toLowerCase());
            const matchCategory = activeCategory === 'Semua' || p.category === activeCategory;
            return matchSearch && matchCategory;
        });

        filtered.forEach(p => {
            const el = document.createElement('button');
            el.className = "group rounded-2xl border border-border bg-card p-4 text-left shadow-card transition-all duration-200 hover:shadow-card-hover active:scale-[0.98] relative overflow-hidden";
            el.onclick = () => addToCart(p);
            
            el.innerHTML = `
                <div class="mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-accent text-lg">
                   ${getIcon(p.category)}
                </div>
                <p class="truncate text-sm font-semibold text-foreground">${p.name}</p>
                <p class="text-xs text-muted-foreground">Stok: ${p.stock}</p>
                <p class="mt-1 text-sm font-bold text-primary">Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</p>
            `;
            container.appendChild(el);
        });
    }

    function getIcon(category) {
        if(category === 'Makanan') return '🍜';
        if(category === 'Minuman') return '🥤';
        if(category === 'Kebersihan') return '🧼';
        return '📦';
    }

    // 4. Logic Cart
    function addToCart(product) {
        const existing = cart.find(item => item.id === product.id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ ...product, qty: 1 });
        }
        renderCart();
    }

    function updateQty(id, delta) {
        cart = cart.map(item => {
            if (item.id === id) return { ...item, qty: item.qty + delta };
            return item;
        }).filter(item => item.qty > 0);
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart-container');
        const list = document.getElementById('cart-items-wrapper');
        const checkoutText = document.getElementById('checkout-text');

        if (cart.length === 0) {
            container.classList.add('hidden');
            return;
        }

        container.classList.remove('hidden');
        list.innerHTML = '';

        let total = 0;
        let totalItems = 0;

        cart.forEach(item => {
            total += item.price * item.qty;
            totalItems += item.qty;

            const div = document.createElement('div');
            div.className = "mb-2 flex items-center justify-between last:mb-0 bg-secondary/30 p-2 rounded-xl";
            div.innerHTML = `
                <div class="flex-1 min-w-0">
                    <p class="truncate text-sm font-medium text-foreground">${item.name}</p>
                    <p class="text-xs text-muted-foreground">Rp ${new Intl.NumberFormat('id-ID').format(item.price)} x ${item.qty}</p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="updateQty(${item.id}, -1)" class="flex h-8 w-8 items-center justify-center rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80">
                        ${item.qty === 1 ? '<svg class="h-4 w-4 text-destructive" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>' : '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>'}
                    </button>
                    <span class="w-6 text-center text-sm font-semibold text-foreground">${item.qty}</span>
                    <button onclick="updateQty(${item.id}, 1)" class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-primary-foreground hover:bg-primary/90">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            `;
            list.appendChild(div);
        });

        checkoutText.innerText = `Bayar (${totalItems} item) - Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
    }

    // 5. Logic Filter Category
    function filterCategory(cat) {
        activeCategory = cat;
        // Update UI Button
        document.querySelectorAll('.category-btn').forEach(btn => {
            if(btn.dataset.category === cat) {
                btn.className = "category-btn snap-start shrink-0 rounded-full px-4 py-2 text-sm font-medium transition-all duration-200 bg-primary text-primary-foreground shadow-sm";
            } else {
                btn.className = "category-btn snap-start shrink-0 rounded-full px-4 py-2 text-sm font-medium transition-all duration-200 bg-secondary text-secondary-foreground hover:bg-secondary/80";
            }
        });
        renderProducts();
    }

    // 6. Listener Search
    document.getElementById('search-input').addEventListener('input', (e) => {
        searchQuery = e.target.value;
        renderProducts();
    });

    // Init
    renderProducts();
</script> --}}

<script>
    // --- SETUP DATA ---
    const products = @json($products);
    let cart = [];
    let activeCategory = 'Semua';
    let searchQuery = '';

    // --- RENDER PRODUK ---
    function renderProducts() {
        const container = document.getElementById('product-list');
        container.innerHTML = '';

        const filtered = products.filter(p => {
            const matchSearch = p.name.toLowerCase().includes(searchQuery.toLowerCase());
            const matchCategory = activeCategory === 'Semua' || p.category === activeCategory;
            return matchSearch && matchCategory;
        });

        filtered.forEach(p => {
            const el = document.createElement('button');
            el.className = "group rounded-2xl border border-border bg-card p-4 text-left shadow-card transition-all duration-200 hover:shadow-card-hover active:scale-[0.98] relative overflow-hidden";
            el.onclick = () => addToCart(p);
            
            el.innerHTML = `
                <div class="mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-accent text-lg">
                   ${getIcon(p.category)}
                </div>
                <p class="truncate text-sm font-semibold text-foreground">${p.name}</p>
                <p class="text-xs text-muted-foreground">Stok: ${p.stock}</p>
                <p class="mt-1 text-sm font-bold text-primary">Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</p>
            `;
            container.appendChild(el);
        });
    }

    function getIcon(category) {
        if(category === 'Makanan') return '🍜';
        if(category === 'Minuman') return '🥤';
        if(category === 'Kebersihan') return '🧼';
        return '📦';
    }

    // --- CART LOGIC ---
    function addToCart(product) {
        const existing = cart.find(item => item.id === product.id);
        if (existing) {
            if(existing.qty < product.stock) {
                existing.qty += 1;
            } else {
                alert('Stok tidak cukup!');
            }
        } else {
            cart.push({ ...product, qty: 1 });
        }
        renderCart();
    }

    function updateQty(id, delta) {
        cart = cart.map(item => {
            if (item.id === id) {
                // Cek stok saat nambah
                const product = products.find(p => p.id === id);
                if (delta > 0 && item.qty >= product.stock) {
                    alert('Maksimal stok tercapai');
                    return item;
                }
                return { ...item, qty: item.qty + delta };
            }
            return item;
        }).filter(item => item.qty > 0);
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart-container');
        const list = document.getElementById('cart-items-wrapper');
        const checkoutText = document.getElementById('checkout-text');

        if (cart.length === 0) {
            container.classList.add('hidden');
            return;
        }

        container.classList.remove('hidden');
        list.innerHTML = '';

        let total = 0;
        let totalItems = 0;

        cart.forEach(item => {
            total += item.price * item.qty;
            totalItems += item.qty;

            const div = document.createElement('div');
            div.className = "mb-2 flex items-center justify-between last:mb-0 bg-secondary/30 p-2 rounded-xl";
            div.innerHTML = `
                <div class="flex-1 min-w-0">
                    <p class="truncate text-sm font-medium text-foreground">${item.name}</p>
                    <p class="text-xs text-muted-foreground">Rp ${new Intl.NumberFormat('id-ID').format(item.price)} x ${item.qty}</p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="updateQty(${item.id}, -1)" class="flex h-8 w-8 items-center justify-center rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                    </button>
                    <span class="w-6 text-center text-sm font-semibold text-foreground">${item.qty}</span>
                    <button onclick="updateQty(${item.id}, 1)" class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-primary-foreground hover:bg-primary/90">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            `;
            list.appendChild(div);
        });

        checkoutText.innerText = `Bayar (${totalItems} item) - Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
        
        // Update Modal Data also
        document.getElementById('modal-total-items').innerText = totalItems;
        document.getElementById('modal-total-price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }

    // --- CHECKOUT LOGIC ---
    function openCheckoutModal() {
        document.getElementById('checkoutModal').classList.remove('hidden');
    }

    function closeCheckoutModal() {
        document.getElementById('checkoutModal').classList.add('hidden');
    }

    async function processCheckout() {
        const customerName = document.getElementById('customer_name').value;
        const btn = document.getElementById('btn-process');
        
        // Loading State
        btn.disabled = true;
        btn.innerHTML = 'Memproses...';

        try {
            const response = await fetch("/kasir/checkout", { 
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Pastikan token ini tetap ada
                },
                body: JSON.stringify({
                    customer_name: customerName,
                    cart: cart.map(item => ({ id: item.id, qty: item.qty }))
                })
            });
            // const response = await fetch("{{ route('kasir.store') }}", {
            //     method: "POST",
            //     headers: {
            //         "Content-Type": "application/json",
            //         "X-CSRF-TOKEN": "{{ csrf_token() }}"
            //     },
            //     body: JSON.stringify({
            //         customer_name: customerName,
            //         cart: cart.map(item => ({ id: item.id, qty: item.qty }))
            //     })
            // });

            const result = await response.json();

            if (response.ok) {
                alert('Transaksi Berhasil! Invoice: ' + result.invoice);
                cart = [];
                renderCart();
                closeCheckoutModal();
                window.location.reload(); // Reload untuk update stok di tampilan
            } else {
                alert('Gagal: ' + result.message);
            }

        } catch (error) {
            console.error(error);
            alert('Terjadi kesalahan sistem');
        } finally {
            btn.disabled = false;
            btn.innerHTML = 'Proses Pembayaran';
        }
    }

    // --- UTILS ---
    function filterCategory(cat) {
        activeCategory = cat;
        document.querySelectorAll('.category-btn').forEach(btn => {
            if(btn.dataset.category === cat) {
                btn.className = "category-btn snap-start shrink-0 rounded-full px-4 py-2 text-sm font-medium transition-all duration-200 bg-primary text-primary-foreground shadow-sm";
            } else {
                btn.className = "category-btn snap-start shrink-0 rounded-full px-4 py-2 text-sm font-medium transition-all duration-200 bg-secondary text-secondary-foreground hover:bg-secondary/80";
            }
        });
        renderProducts();
    }

    document.getElementById('search-input').addEventListener('input', (e) => {
        searchQuery = e.target.value;
        renderProducts();
    });

    renderProducts();
</script>
@endsection