<!DOCTYPE html>
<html lang="id" class="dark"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>TokoKu - Store Management</title>
    
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f1419">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .safe-bottom { padding-bottom: env(safe-area-inset-bottom); }
        .safe-top { padding-top: env(safe-area-inset-top); }
    </style>
</head>
<body class="bg-background text-foreground min-h-screen antialiased">

    <header class="fixed top-0 left-0 right-0 z-50 border-b border-border bg-card/95 backdrop-blur-xl safe-top">
        <div class="mx-auto flex h-14 max-w-lg items-center justify-between px-4">
            <div class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-primary text-primary-foreground">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                </div>
                <span class="text-lg font-bold text-foreground">TokoKu</span>
            </div>

            <div class="flex items-center gap-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="return confirm('Keluar dari aplikasi?')" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-destructive/10 text-muted-foreground hover:text-destructive transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="pt-20 pb-24 max-w-lg mx-auto px-4 min-h-screen">
        @yield('content')
    </main>

    <nav class="fixed bottom-0 left-0 right-0 z-50 border-t border-border bg-card/95 backdrop-blur-xl safe-bottom">
        <div class="mx-auto flex max-w-lg items-center justify-around px-2 py-1">
            <a href="{{ route('dashboard') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('dashboard') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span class="{{ request()->routeIs('dashboard') ? 'font-semibold' : '' }}">Dashboard</span>
            </a>
            
            <a href="{{ route('kasir') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('kasir') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kasir') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('kasir') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="{{ request()->routeIs('kasir') ? 'font-semibold' : '' }}">Kasir</span>
            </a>

            <a href="{{ route('stok') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('stok') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('stok') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('stok') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="{{ request()->routeIs('stok') ? 'font-semibold' : '' }}">Stok</span>
            </a>

            <a href="{{ route('karyawan') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('karyawan') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('karyawan') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('karyawan') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="{{ request()->routeIs('karyawan') ? 'font-semibold' : '' }}">Karyawan</span>
            </a>
        </div>
    </nav>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js');
        }

        // Logic Tombol Install PWA
        let deferredPrompt;
        const installBanner = document.getElementById('install-banner');
        const btnInstall = document.getElementById('btn-install');

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            if(installBanner) installBanner.classList.remove('hidden');
        });

        if(btnInstall) {
            btnInstall.addEventListener('click', async () => {
                if (deferredPrompt) {
                    deferredPrompt.prompt();
                    const { outcome } = await deferredPrompt.userChoice;
                    if (outcome === 'accepted') {
                        installBanner.classList.add('hidden');
                    }
                    deferredPrompt = null;
                }
            });
        }
    </script>
</body>
</html>