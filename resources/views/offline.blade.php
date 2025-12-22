<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Offline - TokoKu</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: '#0f1419',
                        foreground: '#ffffff',
                        primary: '#10b981',
                        card: '#1a2332',
                    }
                }
            }
        }
    </script>
    <style>body { font-family: sans-serif; }</style>
</head>
<body class="bg-background text-foreground min-h-screen flex flex-col items-center justify-center p-6 text-center">

    <div class="animate-bounce mb-6">
        <div class="h-24 w-24 bg-card rounded-full flex items-center justify-center shadow-lg border border-gray-800">
            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
        </div>
    </div>

    <h1 class="text-2xl font-bold mb-2">Kamu Sedang Offline</h1>
    <p class="text-gray-400 mb-8 max-w-xs mx-auto">Koneksi internet terputus. Periksa wifi atau data seluler kamu.</p>

    <button onclick="window.location.reload()" class="bg-primary text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:opacity-90 transition active:scale-95">
        Coba Lagi
    </button>

    <p class="text-xs text-gray-600 mt-10">TokoKu PWA System</p>

</body>
</html>