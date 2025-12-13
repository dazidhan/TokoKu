/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ["class"],
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      container: {
        center: true,
        padding: "1rem",
        screens: {
          "2xl": "1400px",
        },
      },
      extend: {
        fontFamily: {
          sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
        },
        colors: {
          border: "hsl(var(--border))",
          input: "hsl(var(--input))",
          ring: "hsl(var(--ring))",
          background: "hsl(var(--background))",
          foreground: "hsl(var(--foreground))",
          primary: {
            DEFAULT: "hsl(var(--primary))",
            foreground: "hsl(var(--primary-foreground))",
            glow: "hsl(var(--primary-glow))",
          },
          secondary: {
            DEFAULT: "hsl(var(--secondary))",
            foreground: "hsl(var(--secondary-foreground))",
          },
          destructive: {
            DEFAULT: "hsl(var(--destructive))",
            foreground: "hsl(var(--destructive-foreground))",
          },
          muted: {
            DEFAULT: "hsl(var(--muted))",
            foreground: "hsl(var(--muted-foreground))",
          },
          accent: {
            DEFAULT: "hsl(var(--accent))",
            foreground: "hsl(var(--accent-foreground))",
          },
          popover: {
            DEFAULT: "hsl(var(--popover))",
            foreground: "hsl(var(--popover-foreground))",
          },
          card: {
            DEFAULT: "hsl(var(--card))",
            foreground: "hsl(var(--card-foreground))",
          },
          // Custom Semantic Colors
          success: {
            DEFAULT: "hsl(var(--success))",
            foreground: "hsl(0 0% 100%)",
          },
          warning: {
            DEFAULT: "hsl(var(--warning))",
            foreground: "hsl(0 0% 100%)",
          },
          info: {
            DEFAULT: "hsl(var(--info))",
            foreground: "hsl(0 0% 100%)",
          },
        },
        borderRadius: {
          lg: "var(--radius)",
          md: "calc(var(--radius) - 2px)",
          sm: "calc(var(--radius) - 4px)",
          xl: "calc(var(--radius) + 4px)",
          "2xl": "calc(var(--radius) + 8px)",
        },
        boxShadow: {
            'card': 'var(--shadow-md)',
            'card-hover': 'var(--shadow-lg)',
            'glow': 'var(--shadow-glow)',
        },
        keyframes: {
          "accordion-down": {
            from: { height: "0" },
            to: { height: "var(--radix-accordion-content-height)" },
          },
          "accordion-up": {
            from: { height: "var(--radix-accordion-content-height)" },
            to: { height: "0" },
          },
          "fade-in": {
            from: { opacity: "0" },
            to: { opacity: "1" },
          },
          "slide-up": {
            from: { transform: "translateY(20px)", opacity: "0" },
            to: { transform: "translateY(0)", opacity: "1" },
          }
        },
        animation: {
          "accordion-down": "accordion-down 0.2s ease-out",
          "accordion-up": "accordion-up 0.2s ease-out",
          "fade-in": "fade-in 0.3s ease-out forwards",
          "slide-up": "slide-up 0.4s ease-out forwards",
        },
      },
    },
    plugins: [],
  }