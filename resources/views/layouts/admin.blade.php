<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Eiko Coffe Roaster')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        coffee: {
                            50: '#fdf8f0',
                            100: '#f9edd9',
                            200: '#f2d7b0',
                            300: '#e9bb7e',
                            400: '#e19a4d',
                            500: '#db7f2e',
                            600: '#cd6624',
                            700: '#ab4d1f',
                            800: '#8a3e20',
                            900: '#70351d',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        .page { display: none; }
        .page.active { display: block; }
        .stat-card-gradient-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-card-gradient-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-card-gradient-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-card-gradient-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .stat-card-gradient-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dark .glass-card {
            background: rgba(17, 24, 39, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .chart-container {
            position: relative;
            height: 100%;
            width: 100%;
        }
        .metric-bar {
            transition: width 1s ease-out;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 fixed h-full overflow-y-auto z-40">
            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                <div class="w-full flex justify-center py-4">
                    <div class="w-32 h-16 rounded-xl overflow-hidden shadow-lg bg-white flex items-center justify-center p-1 mx-auto">
                        <img src="{{ asset('images/logo_eiko.png') }}" alt="Eiko Logo" class="w-full h-full object-contain">
                    </div>
                </div>
            </div>

            <nav class="p-3 space-y-1">
                <p class="px-3 pt-3 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-home w-5 {{ request()->routeIs('admin.dashboard') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- PERHATIKAN BARIS INI: ada '.index' dan '.*' -->
                <a href="{{ route('admin.pesanan.index') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.pesanan.*') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-shopping-cart w-5 {{ request()->routeIs('admin.pesanan.*') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Pesanan</span>
                    <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">5</span>
                </a>
                
                <a href="{{ route('admin.produk') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.produk') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-coffee w-5 {{ request()->routeIs('admin.produk') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Produk</span>
                </a>
                
                <a href="{{ route('admin.pembayaran') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.pembayaran') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-money-check-alt w-5 {{ request()->routeIs('admin.pembayaran') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Pembayaran</span>
                    <span class="ml-auto bg-yellow-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">3</span>
                </a>
                
                <a href="{{ route('admin.pengiriman') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.pengiriman') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-truck w-5 {{ request()->routeIs('admin.pengiriman') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Pengiriman</span>
                </a>

                <p class="px-3 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</p>
                
                <a href="{{ route('admin.stok') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.stok') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-warehouse w-5 {{ request()->routeIs('admin.stok') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Stok Bahan</span>
                </a>
                
                <a href="{{ route('admin.pelanggan') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.pelanggan') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-users w-5 {{ request()->routeIs('admin.pelanggan') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Pelanggan</span>
                </a>
                
                <a href="{{ route('admin.return') }}" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.return') ? 'bg-coffee-50 dark:bg-coffee-900/20 text-coffee-700 dark:text-coffee-400 border-l-4 border-coffee-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                    <i class="fas fa-undo w-5 {{ request()->routeIs('admin.return') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                    <span>Return & Garansi</span>
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex items-center gap-3 p-2.5 rounded-lg bg-gradient-to-r from-coffee-50 to-orange-50 dark:from-gray-700 dark:to-gray-600">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-coffee-500 to-coffee-700 flex items-center justify-center text-white text-sm font-bold shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                        @csrf
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-500 hover:text-white transition-all" title="Logout">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Top Bar -->
            <header class="sticky top-0 z-30 bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-coffee-600 to-orange-600 bg-clip-text text-transparent" id="page-title">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400" id="page-subtitle">@yield('page-subtitle', 'Ringkasan sistem pesanan mesin kopi')</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="toggleTheme()" class="relative w-12 h-6 bg-gray-200 dark:bg-gray-700 rounded-full transition-colors duration-300 focus:outline-none">
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 dark:translate-x-6 flex items-center justify-center">
                                <i class="fas fa-moon text-gray-600 dark:text-yellow-400 text-[10px]"></i>
                            </div>
                        </button>
                        <button class="relative p-2 text-gray-400 hover:text-coffee-600 dark:hover:text-coffee-400 transition-colors">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </button>
                    </div>
                </div>
            </header>

            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            if (typeof updateChartsTheme === 'function') {
                updateChartsTheme();
            }
        }
        
        window.onload = function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
            if (typeof initCharts === 'function') {
                initCharts();
            }
        };
    </script>
    @stack('scripts')
</body>
</html>