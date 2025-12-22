<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>TokoKu - Store Management</title>
    
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f1419">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        // Warna Utama Gelap
                        background: '#0f1419',
                        foreground: '#ffffff',
                        
                        // Warna Kartu
                        card: '#1a2332',
                        'card-foreground': '#ffffff',
                        
                        // Warna Border/Garis
                        border: '#2d3748',
                        input: '#2d3748',
                        
                        // Warna Brand (Emerald Green)
                        primary: {
                            DEFAULT: '#10b981',
                            foreground: '#ffffff',
                            glow: '#10b981',
                        },
                        // Warna Sekunder
                        secondary: {
                            DEFAULT: '#1f2937',
                            foreground: '#e5e7eb',
                        },
                        // Warna Status
                        muted: { DEFAULT: '#1f2937', foreground: '#9ca3af' },
                        accent: { DEFAULT: '#1f2937', foreground: '#ffffff' },
                        destructive: { DEFAULT: '#ef4444', foreground: '#ffffff' }, // Merah
                        success: { DEFAULT: '#10b981', foreground: '#ffffff' },      // Hijau
                        warning: { DEFAULT: '#f59e0b', foreground: '#ffffff' },      // Kuning
                        info: { DEFAULT: '#3b82f6', foreground: '#ffffff' },         // Biru
                    },
                    boxShadow: {
                        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -2px rgba(0, 0, 0, 0.3)',
                        'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -4px rgba(0, 0, 0, 0.3)',
                        'glow': '0 0 15px rgba(16, 185, 129, 0.4)',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(20px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } }
                    }
                }
            }
        }
    </script>

    <style>
        /* CSS Tambahan Kecil */
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .safe-bottom { padding-bottom: env(safe-area-inset-bottom); }
        .safe-top { padding-top: env(safe-area-inset-top); }
        
        /* Scrollbar biar rapi */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(156, 163, 175, 0.3); border-radius: 99px; }
    </style>
</head>
<body class="bg-background text-foreground min-h-screen antialiased">

    <header class="fixed top-0 left-0 right-0 z-50 border-b border-border bg-card/95 backdrop-blur-xl safe-top">
        <div class="mx-auto flex h-14 max-w-lg items-center justify-between px-4">
            <div class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-primary text-primary-foreground shadow-glow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                </div>
                <span class="text-lg font-bold tracking-tight">TokoKu</span>
            </div>

            <div class="flex items-center gap-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="return confirm('Keluar dari aplikasi?')" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-destructive/20 text-muted-foreground hover:text-destructive transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
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
            <a href="{{ route('dashboard') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-[10px] font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('dashboard') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('kasir') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-[10px] font-medium transition-all duration-200 {{ request()->routeIs('kasir') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kasir') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('kasir') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span>Kasir</span>
            </a>

            <a href="{{ route('stok') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-[10px] font-medium transition-all duration-200 {{ request()->routeIs('stok') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('stok') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('stok') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span>Stok</span>
            </a>

            <a href="{{ route('karyawan') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-[10px] font-medium transition-all duration-200 {{ request()->routeIs('karyawan') ? 'text-primary' : 'text-muted-foreground' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('karyawan') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('karyawan') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span>Karyawan</span>
            </a>
        </div>
    </nav>


    <div id="offline-toast" class="fixed top-0 left-0 right-0 z-[100] transform -translate-y-full transition-transform duration-300">
        <div class="bg-destructive text-white text-center py-2 text-sm font-medium shadow-lg">
            <span class="flex justify-center items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414"></path></svg>
                Koneksi Terputus. Mode Offline.
            </span>
        </div>
    </div>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js');
        }
        
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


            // FITUR DETEKSI LIVE
        const offlineToast = document.getElementById('offline-toast');

        function updateOnlineStatus() {
            if (!navigator.onLine) {
                // Jika Offline: Munculkan Toast Merah dari atas
                offlineToast.classList.remove('-translate-y-full');
            } else {
                // Jika Online: Sembunyikan Toast
                offlineToast.classList.add('-translate-y-full');
            }
        }

        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);
        
        // Cek status saat pertama kali load
        updateOnlineStatus();
    </script>
</body>
</html>