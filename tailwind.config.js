import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // Penting agar class="dark" bekerja
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            // KITA DEFINISIKAN WARNA LANGSUNG DISINI (HARDCODED HEX)
            colors: {
                // Background Gelap Utama (Sesuai Gambar 1)
                background: '#0f1419', 
                foreground: '#ffffff',

                // Warna Kartu/Card (Sedikit lebih terang dari background)
                card: '#1a2332',
                'card-foreground': '#ffffff',

                // Warna Hijau Emerald (Primary)
                primary: {
                    DEFAULT: '#10b981',
                    foreground: '#ffffff',
                    glow: '#10b981', // Untuk efek shadow
                },

                // Warna Sekunder (Abu-abu gelap untuk tombol/border)
                secondary: {
                    DEFAULT: '#1f2937',
                    foreground: '#e5e7eb',
                },

                // Warna Muted (Teks abu-abu)
                muted: {
                    DEFAULT: '#1f2937',
                    foreground: '#9ca3af',
                },

                // Warna Aksen
                accent: {
                    DEFAULT: '#1f2937',
                    foreground: '#ffffff',
                },

                // Warna Status
                destructive: '#ef4444', // Merah
                success: '#10b981',      // Hijau
                warning: '#f59e0b',      // Kuning
                info: '#3b82f6',         // Biru

                // Border & Input
                border: '#2d3748',
                input: '#2d3748',
                ring: '#10b981',
            },
            boxShadow: {
                'card': '0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -2px rgba(0, 0, 0, 0.3)', // Shadow lebih gelap
                'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -4px rgba(0, 0, 0, 0.3)',
                'glow': '0 0 15px rgba(16, 185, 129, 0.4)', // Efek glow hijau
            }
        },
    },

    plugins: [],
};