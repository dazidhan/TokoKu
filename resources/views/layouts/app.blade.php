<!DOCTYPE html>
<html lang="id" class="dark"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>TokoKu - Store Management</title>
    
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f1419">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        background: '#0f1419', // Gelap pekat sesuai offline.html
                        card: '#1a2332',       // Agak terang dikit
                        primary: '#10b981',    // Emerald Green
                        accent: '#1f2937',
                    },
                    animation: {
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .safe-bottom { padding-bottom: env(safe-area-inset-bottom); }
        .safe-top { padding-top: env(safe-area-inset-top); }
    </style>
</head>
<body class="bg-background text-gray-100 min-h-screen">

    <header class="fixed top-0 left-0 right-0 z-50 border-b border-gray-800 bg-card/95 backdrop-blur-xl safe-top">
        <div class="mx-auto flex h-14 max-w-lg items-center justify-between px-4">
            <div class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-primary text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                </div>
                <span class="text-lg font-bold text-white">TokoKu</span>
            </div>

            <div class="flex items-center gap-1">
                <button onclick="toggleTheme()" class="h-9 w-9 flex items-center justify-center rounded-xl hover:bg-white/5 transition">
                    <svg id="moon-icon" class="h-4 w-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg id="sun-icon" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
                <button class="relative h-9 w-9 flex items-center justify-center rounded-xl hover:bg-white/5 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1.5 right-1.5 flex h-2 w-2 rounded-full bg-red-500"></span>
                </button>
            </div>
        </div>
    </header>

    <main class="pt-20 pb-24 max-w-lg mx-auto px-4 min-h-screen">
        @yield('content')
    </main>

    <nav class="fixed bottom-0 left-0 right-0 z-50 border-t border-gray-800 bg-card/95 backdrop-blur-xl safe-bottom">
        <div class="mx-auto flex max-w-lg items-center justify-around px-2 py-1">
            <a href="{{ route('dashboard') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-gray-500' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('dashboard') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span class="{{ request()->routeIs('dashboard') ? 'font-semibold' : '' }}">Dashboard</span>
            </a>
            
            <a href="{{ route('kasir') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('kasir') ? 'text-primary' : 'text-gray-500' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('kasir') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('kasir') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="{{ request()->routeIs('kasir') ? 'font-semibold' : '' }}">Kasir</span>
            </a>

            <a href="{{ route('stok') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('stok') ? 'text-primary' : 'text-gray-500' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('stok') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('stok') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="{{ request()->routeIs('stok') ? 'font-semibold' : '' }}">Stok</span>
            </a>

            <a href="{{ route('karyawan') }}" class="flex flex-1 flex-col items-center gap-1 py-3 text-xs font-medium transition-all duration-200 {{ request()->routeIs('karyawan') ? 'text-primary' : 'text-gray-500' }}">
                <div class="flex h-8 w-8 items-center justify-center rounded-xl {{ request()->routeIs('karyawan') ? 'bg-primary/10' : '' }}">
                    <svg class="h-5 w-5 {{ request()->routeIs('karyawan') ? 'scale-110' : '' }} transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="{{ request()->routeIs('karyawan') ? 'font-semibold' : '' }}">Karyawan</span>
            </a>
        </div>
    </nav>

    <script>
        // Register Service Worker ala main.tsx
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('SW registered:', registration);
                    })
                    .catch((error) => {
                        console.log('SW registration failed:', error);
                    });
            });
        }
    </script>

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js');
        }

        function toggleTheme() {
            const html = document.documentElement;
            const moon = document.getElementById('moon-icon');
            const sun = document.getElementById('sun-icon');
            
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                moon.classList.remove('hidden');
                sun.classList.add('hidden');
            } else {
                html.classList.add('dark');
                moon.classList.add('hidden');
                sun.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>