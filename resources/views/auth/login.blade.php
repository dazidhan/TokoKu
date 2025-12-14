<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TokoKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Copy CSS Variable Dark Mode dari app.css sebelumnya disini agar konsisten */
        :root { --background: 224 30% 8%; --primary: 160 70% 50%; }
        body { background-color: hsl(var(--background)); color: white; font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center px-4">
    
    <div class="w-full max-w-sm">
        <div class="flex justify-center mb-8">
            <div class="h-16 w-16 bg-[#10b981] rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(16,185,129,0.3)]">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
            </div>
        </div>

        <div class="bg-[#1a2332] p-8 rounded-3xl border border-gray-800 shadow-2xl">
            <h2 class="text-2xl font-bold text-center mb-1">Selamat Datang</h2>
            <p class="text-gray-400 text-center text-sm mb-6">Masuk untuk mengelola tokomu</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Email</label>
                    <input type="email" name="email" required autofocus 
                        class="w-full bg-[#0f1419] border border-gray-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] transition-all"
                        placeholder="admin@tokoku.com">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Password</label>
                    <input type="password" name="password" required 
                        class="w-full bg-[#0f1419] border border-gray-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] transition-all"
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-[#10b981] hover:bg-[#059669] text-white font-bold py-3 rounded-xl shadow-lg shadow-emerald-900/20 active:scale-95 transition-transform mt-2">
                    Masuk Aplikasi
                </button>
            </form>
        </div>
        
        <p class="text-center text-gray-500 text-xs mt-8">© 2025 TokoKu POS System</p>
    </div>
</body>
</html>