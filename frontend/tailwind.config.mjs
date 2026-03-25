/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{astro,html,js,jsx,ts,tsx}'],
  theme: {
    extend: {
      colors: {
        surface: {
          900: '#0a0a0f',
          800: '#111118',
          700: '#1a1a24',
          600: '#22222f',
          500: '#2a2a3a',
        },
        accent: {
          DEFAULT: '#6ee7b7',
          dim: '#34d399',
          glow: 'rgba(110,231,183,0.15)',
        },
        danger: '#f87171',
        warning: '#fbbf24',
        info: '#60a5fa',
      },
      fontFamily: {
        display: ['Syne', 'sans-serif'],
        body: ['DM Sans', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      boxShadow: {
        glow: '0 0 20px rgba(110,231,183,0.2)',
        'glow-sm': '0 0 10px rgba(110,231,183,0.15)',
      },
    },
  },
  plugins: [],
}