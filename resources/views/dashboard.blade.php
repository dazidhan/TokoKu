@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <div id="install-banner" class="hidden animate-fade-in mb-4 bg-gradient-to-r from-primary/20 to-primary/5 border border-primary/20 p-4 rounded-2xl flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-primary/20 p-2 rounded-lg">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-sm text-foreground">Install TokoKu</h3>
                <p class="text-xs text-muted-foreground">Akses lebih cepat tanpa browser</p>
            </div>
        </div>
        <button id="btn-install" class="bg-primary text-primary-foreground text-xs font-bold px-4 py-2 rounded-lg shadow-lg">
            Install
        </button>
    </div>

    <div class="animate-fade-in">
        <p class="text-sm text-muted-foreground">Selamat Pagi 👋</p>
        <h1 class="text-xl font-bold text-foreground">Ahmad Store</h1>
    </div>

    <div class="grid grid-cols-2 gap-3">
        @foreach($stats as $index => $stat)
        <div class="animate-slide-up rounded-2xl border border-border bg-card p-4 shadow-card hover:shadow-card-hover transition-all duration-200" 
             style="animation-delay: {{ $index * 50 }}ms">
            <div class="flex items-start justify-between mb-2">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-muted-foreground">{{ $stat['title'] }}</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stat['value'] }}</p>
                </div>
                <div class="rounded-xl p-2.5 {{ $stat['bg'] }}">
                     @if($stat['icon'] == 'wallet')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    @elseif($stat['icon'] == 'cart')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    @elseif($stat['icon'] == 'package')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    @endif
                </div>
            </div>
            <p class="text-xs font-medium {{ $stat['type'] == 'positive' ? 'text-success' : ($stat['type'] == 'negative' ? 'text-destructive' : 'text-muted-foreground') }}">
                {{ $stat['change'] }}
            </p>
        </div>
        @endforeach
    </div>

    <div class="animate-slide-up" style="animation-delay: 100ms;">
        <h2 class="mb-3 px-1 text-base font-bold text-foreground">Aksi Cepat</h2>
        <div class="grid grid-cols-4 gap-2">
            <a href="{{ route('kasir') }}" class="flex flex-col items-center gap-2 rounded-2xl border border-border bg-card p-3 shadow-card transition-all duration-200 hover:shadow-card-hover active:scale-95">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary text-primary-foreground">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="text-[10px] font-medium text-muted-foreground text-center leading-tight">Transaksi</span>
            </a>
            
            <a href="{{ route('stok') }}" class="flex flex-col items-center gap-2 rounded-2xl border border-border bg-card p-3 shadow-card transition-all duration-200 hover:shadow-card-hover active:scale-95">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-info/10 text-info">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                </div>
                <span class="text-[10px] font-medium text-muted-foreground text-center leading-tight">Scan</span>
            </a>

            <button class="flex flex-col items-center gap-2 rounded-2xl border border-border bg-card p-3 shadow-card transition-all duration-200 hover:shadow-card-hover active:scale-95">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-warning/10 text-warning">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 011.414.586l2.828 2.828a1 1 0 01.586 1.414V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="text-[10px] font-medium text-muted-foreground text-center leading-tight">Laporan</span>
            </button>

            <button class="flex flex-col items-center gap-2 rounded-2xl border border-border bg-card p-3 shadow-card transition-all duration-200 hover:shadow-card-hover active:scale-95">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-success/10 text-success">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="text-[10px] font-medium text-muted-foreground text-center leading-tight">Analitik</span>
            </button>
        </div>
    </div>

    <div class="animate-slide-up space-y-3" style="animation-delay: 200ms;">
        <div class="flex items-center justify-between px-1">
            <h2 class="text-base font-bold text-foreground">Transaksi Terakhir</h2>
            <button class="flex items-center gap-1 text-xs font-medium text-primary hover:underline">
                Lihat Semua
            </button>
        </div>

        <div class="space-y-2">
            @forelse($recentTransactions as $trx)
            <div class="flex items-center gap-3 rounded-2xl border border-border bg-card p-4 shadow-card hover:shadow-card-hover transition-all">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent text-accent-foreground">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="truncate text-sm font-semibold text-foreground">{{ $trx->customer_name }}</p>
                    <p class="text-xs text-muted-foreground">{{ $trx->total_items }} item • {{ $trx->created_at->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-foreground">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</p>
                    <span class="inline-block rounded-full bg-success/10 px-2 py-0.5 text-[10px] font-medium text-success">Selesai</span>
                </div>
            </div>
            @empty
            <div class="text-center py-6 text-muted-foreground text-sm">
                Belum ada transaksi hari ini
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection