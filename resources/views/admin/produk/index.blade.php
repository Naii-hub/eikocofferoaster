@extends('layouts.admin')

@section('title', 'Katalog Produk - Eiko Coffee Roaster')
@section('page-title', 'Produk')
@section('page-subtitle', 'Kelola produk mesin kopi Eiko Coffee Roaster')

@section('content')
<div class="animate-fade-in space-y-6">

    <!-- Top Banner Card & Summary -->
    <div class="bg-gradient-to-r from-coffee-700 via-coffee-800 to-gray-900 rounded-2xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-coffee-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-12 top-1/2 -translate-y-1/2 hidden xl:block opacity-10 pointer-events-none">
            <i class="fas fa-coffee text-9xl"></i>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm text-xs font-semibold text-coffee-200 border border-white/10">
                    <i class="fas fa-cubes"></i> Katalog Komersial & Roastery
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Daftar Produk Mesin Kopi</h2>
                <p class="text-white/80 text-sm max-w-2xl leading-relaxed">
                    Kelola seluruh lini produk mesin sangrai (roaster), mesin espresso komersial, alat seduh otomatis, dan aksesoris resmi Eiko Coffee Roaster.
                </p>
            </div>

            <!-- Tombol Tambah Produk -->
            <div class="flex items-center gap-3">
                <button onclick="openAddModal()" class="inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-coffee-500 to-orange-500 hover:from-coffee-600 hover:to-orange-600 text-white font-semibold px-5 py-3 rounded-xl shadow-lg hover:shadow-orange-500/25 transform hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">
                    <i class="fas fa-plus text-sm"></i>
                    <span>+ Tambah Produk</span>
                </button>
            </div>
        </div>

        <!-- Quick Metrics Bar -->
        <div class="mt-6 pt-6 border-t border-white/10 grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3.5 border border-white/5">
                <p class="text-xs text-white/70">Total Produk</p>
                <p class="text-xl font-bold mt-0.5" id="metricTotal">6 Varian</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3.5 border border-white/5">
                <p class="text-xs text-white/70">Stok Tersedia</p>
                <p class="text-xl font-bold text-emerald-400 mt-0.5">4 Model</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3.5 border border-white/5">
                <p class="text-xs text-white/70">Stok Menipis</p>
                <p class="text-xl font-bold text-amber-400 mt-0.5">1 Model</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3.5 border border-white/5">
                <p class="text-xs text-white/70">Pre-Order</p>
                <p class="text-xl font-bold text-blue-400 mt-0.5">1 Model</p>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="glass-card rounded-2xl p-5 shadow-sm border border-gray-200/80 dark:border-gray-700/60 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm">
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            <!-- Search Input -->
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Cari nama produk, SKU, atau spesifikasi..." 
                    class="w-full pl-11 pr-10 py-2.5 rounded-xl text-sm bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-coffee-500 focus:border-transparent transition-all"
                    onkeyup="filterProducts()"
                >
                <button id="clearSearch" onclick="clearSearchInput()" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>

            <!-- Filter Controls -->
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                <!-- Category Filter -->
                <div class="relative min-w-[170px] w-full sm:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-tag text-xs"></i>
                    </div>
                    <select 
                        id="categoryFilter" 
                        onchange="filterProducts()" 
                        class="w-full pl-8 pr-8 py-2.5 rounded-xl text-sm bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-coffee-500 cursor-pointer appearance-none"
                    >
                        <option value="">Semua Kategori</option>
                        <option value="Artisan Roaster">Artisan Roaster</option>
                        <option value="Industrial Roaster">Industrial Roaster</option>
                        <option value="Espresso Machine">Espresso Machine</option>
                        <option value="Brewing System">Brewing System</option>
                        <option value="Grinder & Aksesoris">Grinder & Aksesoris</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="relative min-w-[150px] w-full sm:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-filter text-xs"></i>
                    </div>
                    <select 
                        id="statusFilter" 
                        onchange="filterProducts()" 
                        class="w-full pl-8 pr-8 py-2.5 rounded-xl text-sm bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-coffee-500 cursor-pointer appearance-none"
                    >
                        <option value="">Semua Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Stok Menipis">Stok Menipis</option>
                        <option value="Pre-Order">Pre-Order</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>

                <!-- Reset Filter Button -->
                <button 
                    onclick="resetAllFilters()" 
                    title="Reset Filter" 
                    class="p-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 text-gray-500 hover:text-coffee-600 hover:bg-coffee-50 dark:hover:bg-gray-700 transition-colors"
                >
                    <i class="fas fa-redo-alt text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Filter Active Counter & Quick Tags -->
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex flex-wrap items-center justify-between gap-2 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-2">
                <span>Menampilkan:</span>
                <span id="productCounter" class="font-bold text-coffee-600 dark:text-coffee-400 bg-coffee-50 dark:bg-coffee-900/30 px-2.5 py-0.5 rounded-full">6 Produk</span>
            </div>
            <div class="flex items-center gap-1.5 overflow-x-auto py-1">
                <span class="text-gray-400">Tag Cepat:</span>
                <button onclick="setCategoryFilter('Artisan Roaster')" class="px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700/50 hover:bg-coffee-50 hover:text-coffee-600 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 transition-colors">Roaster</button>
                <button onclick="setCategoryFilter('Espresso Machine')" class="px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700/50 hover:bg-coffee-50 hover:text-coffee-600 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 transition-colors">Espresso</button>
                <button onclick="setStatusFilter('Tersedia')" class="px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 transition-colors">Siap Kirim</button>
            </div>
        </div>
    </div>

    <!-- Product Card Grid -->
    <div id="productGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- CARD 1: Eiko Espresso Pro -->
        <div class="product-card group glass-card rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700/60 bg-white dark:bg-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
             data-name="Eiko Espresso Pro"
             data-sku="EKE-PRO-2G"
             data-category="Espresso Machine"
             data-status="Tersedia"
             data-price="62000000"
             data-stock="8">
            
            <!-- Image & Badges -->
            <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <img 
                    src="https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=800&auto=format&fit=crop&q=80" 
                    alt="Eiko Espresso Pro" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                
                <!-- Category Pill -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-gray-900/80 text-white backdrop-blur-md border border-white/10 shadow-sm">
                        <i class="fas fa-coffee text-coffee-400 text-[10px]"></i> Espresso Machine
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/90 text-white backdrop-blur-md shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Tersedia
                    </span>
                </div>

                <!-- SKU floating label -->
                <div class="absolute bottom-3 left-3">
                    <span class="text-[11px] font-mono font-medium text-white/90 bg-black/40 backdrop-blur-sm px-2 py-0.5 rounded">
                        SKU: EKE-PRO-2G
                    </span>
                </div>
            </div>

            <!-- Content Details -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-coffee-600 dark:group-hover:text-coffee-400 transition-colors">
                            Eiko Espresso Pro
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        Mesin espresso komersial 2 Group dengan dual boiler independen dan PID controller presisi tinggi untuk kedai kopi sibuk.
                    </p>

                    <!-- Feature Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">2 Group Head</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Dual Boiler 11L</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Rotary Pump</span>
                    </div>
                </div>

                <!-- Price & Stock Info -->
                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Harga Satuan</span>
                            <span class="text-xl font-extrabold text-coffee-600 dark:text-coffee-400">Rp 62.000.000</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Stok</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2.5 py-1 rounded-lg">
                                <i class="fas fa-box text-coffee-500 text-[11px]"></i> 8 Unit
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            onclick="showDetail('Eiko Espresso Pro', 'Espresso Machine', 'Rp 62.000.000', '8 Unit', 'Tersedia', 'EKE-PRO-2G', 'Mesin espresso komersial 2 Group dengan dual boiler independen dan PID controller presisi tinggi untuk kedai kopi sibuk.', 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=800&auto=format&fit=crop&q=80', ['2 Group Head Komersial', 'Dual Boiler Stainless Steel 11 Liter', 'Rotary Pump Fluid-o-Tech', 'PID Digital Temperature Control'])"
                            class="flex-1 py-2 px-3 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-700 dark:text-coffee-300 hover:bg-coffee-600 hover:text-white dark:hover:bg-coffee-600 text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm"
                        >
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </button>
                        <button 
                            onclick="actionDummy('edit', 'Eiko Espresso Pro')" 
                            title="Edit Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            onclick="actionDummy('delete', 'Eiko Espresso Pro')" 
                            title="Hapus Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-600 hover:border-red-300 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: Eiko Roaster X1 -->
        <div class="product-card group glass-card rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700/60 bg-white dark:bg-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
             data-name="Eiko Roaster X1"
             data-sku="EKR-X1-PRO"
             data-category="Artisan Roaster"
             data-status="Tersedia"
             data-price="48500000"
             data-stock="5">
            
            <!-- Image & Badges -->
            <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <img 
                    src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=800&auto=format&fit=crop&q=80" 
                    alt="Eiko Roaster X1" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                
                <!-- Category Pill -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-gray-900/80 text-white backdrop-blur-md border border-white/10 shadow-sm">
                        <i class="fas fa-fire text-orange-400 text-[10px]"></i> Artisan Roaster
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/90 text-white backdrop-blur-md shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Tersedia
                    </span>
                </div>

                <!-- SKU floating label -->
                <div class="absolute bottom-3 left-3">
                    <span class="text-[11px] font-mono font-medium text-white/90 bg-black/40 backdrop-blur-sm px-2 py-0.5 rounded">
                        SKU: EKR-X1-PRO
                    </span>
                </div>
            </div>

            <!-- Content Details -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-coffee-600 dark:group-hover:text-coffee-400 transition-colors">
                            Eiko Roaster X1
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        Mesin sangrai kopi artisan kapasitas 1 - 2.5 kg dengan drum cast-iron double wall dan koneksi USB Artisan Roaster Scope.
                    </p>

                    <!-- Feature Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Kapasitas 1-2.5 kg</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Artisan USB Log</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Dual Burner Gas</span>
                    </div>
                </div>

                <!-- Price & Stock Info -->
                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Harga Satuan</span>
                            <span class="text-xl font-extrabold text-coffee-600 dark:text-coffee-400">Rp 48.500.000</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Stok</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2.5 py-1 rounded-lg">
                                <i class="fas fa-box text-coffee-500 text-[11px]"></i> 5 Unit
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            onclick="showDetail('Eiko Roaster X1', 'Artisan Roaster', 'Rp 48.500.000', '5 Unit', 'Tersedia', 'EKR-X1-PRO', 'Mesin sangrai kopi artisan kapasitas 1 - 2.5 kg dengan drum cast-iron double wall dan koneksi USB Artisan Roaster Scope.', 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=800&auto=format&fit=crop&q=80', ['Kapasitas Batch 1 - 2.5 Kilogram', 'Double Wall Cast Iron Drum', 'Direct USB Datalogging Artisan', 'Dual Blower & Airflow Control'])"
                            class="flex-1 py-2 px-3 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-700 dark:text-coffee-300 hover:bg-coffee-600 hover:text-white dark:hover:bg-coffee-600 text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm"
                        >
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </button>
                        <button 
                            onclick="actionDummy('edit', 'Eiko Roaster X1')" 
                            title="Edit Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            onclick="actionDummy('delete', 'Eiko Roaster X1')" 
                            title="Hapus Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-600 hover:border-red-300 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 3: Eiko Coffee Master -->
        <div class="product-card group glass-card rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700/60 bg-white dark:bg-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
             data-name="Eiko Coffee Master"
             data-sku="EKM-BRW-01"
             data-category="Brewing System"
             data-status="Stok Menipis"
             data-price="28500000"
             data-stock="3">
            
            <!-- Image & Badges -->
            <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <img 
                    src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&auto=format&fit=crop&q=80" 
                    alt="Eiko Coffee Master" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                
                <!-- Category Pill -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-gray-900/80 text-white backdrop-blur-md border border-white/10 shadow-sm">
                        <i class="fas fa-mug-hot text-amber-400 text-[10px]"></i> Brewing System
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/95 text-white backdrop-blur-md shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Stok Menipis
                    </span>
                </div>

                <!-- SKU floating label -->
                <div class="absolute bottom-3 left-3">
                    <span class="text-[11px] font-mono font-medium text-white/90 bg-black/40 backdrop-blur-sm px-2 py-0.5 rounded">
                        SKU: EKM-BRW-01
                    </span>
                </div>
            </div>

            <!-- Content Details -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-coffee-600 dark:group-hover:text-coffee-400 transition-colors">
                            Eiko Coffee Master
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        Sistem seduh otomatis batch brewer komersial 6 liter dengan teknologi bypass showerhead dan kontrol suhu presisi digital.
                    </p>

                    <!-- Feature Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Kapasitas 6L / Batch</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Bypass Sprayhead</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Thermal Urn Server</span>
                    </div>
                </div>

                <!-- Price & Stock Info -->
                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Harga Satuan</span>
                            <span class="text-xl font-extrabold text-coffee-600 dark:text-coffee-400">Rp 28.500.000</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-medium text-amber-500 dark:text-amber-400 uppercase tracking-wider block">Sisa Stok</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-900/30 px-2.5 py-1 rounded-lg">
                                <i class="fas fa-exclamation-circle text-amber-500 text-[11px]"></i> 3 Unit
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            onclick="showDetail('Eiko Coffee Master', 'Brewing System', 'Rp 28.500.000', '3 Unit', 'Stok Menipis', 'EKM-BRW-01', 'Sistem seduh otomatis batch brewer komersial 6 liter dengan teknologi bypass showerhead dan kontrol suhu presisi digital.', 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&auto=format&fit=crop&q=80', ['Kapasitas Tangki 6 Liter', 'Suhu Seduh Presisi 92°C - 96°C', 'Thermal Insulated Urn', 'Digital Programmable Profile'])"
                            class="flex-1 py-2 px-3 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-700 dark:text-coffee-300 hover:bg-coffee-600 hover:text-white dark:hover:bg-coffee-600 text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm"
                        >
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </button>
                        <button 
                            onclick="actionDummy('edit', 'Eiko Coffee Master')" 
                            title="Edit Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            onclick="actionDummy('delete', 'Eiko Coffee Master')" 
                            title="Hapus Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-600 hover:border-red-300 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 4: Eiko Barista Pro -->
        <div class="product-card group glass-card rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700/60 bg-white dark:bg-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
             data-name="Eiko Barista Pro"
             data-sku="EKB-PRO-1G"
             data-category="Espresso Machine"
             data-status="Tersedia"
             data-price="36000000"
             data-stock="11">
            
            <!-- Image & Badges -->
            <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <img 
                    src="https://images.unsplash.com/photo-1511920170033-f8396924c348?w=800&auto=format&fit=crop&q=80" 
                    alt="Eiko Barista Pro" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                
                <!-- Category Pill -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-gray-900/80 text-white backdrop-blur-md border border-white/10 shadow-sm">
                        <i class="fas fa-coffee text-coffee-400 text-[10px]"></i> Espresso Machine
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/90 text-white backdrop-blur-md shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Tersedia
                    </span>
                </div>

                <!-- SKU floating label -->
                <div class="absolute bottom-3 left-3">
                    <span class="text-[11px] font-mono font-medium text-white/90 bg-black/40 backdrop-blur-sm px-2 py-0.5 rounded">
                        SKU: EKB-PRO-1G
                    </span>
                </div>
            </div>

            <!-- Content Details -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-coffee-600 dark:group-hover:text-coffee-400 transition-colors">
                            Eiko Barista Pro
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        Single group compact commercial espresso machine dengan saturasi thermal group E61 dan multi-stage infusion.
                    </p>

                    <!-- Feature Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Group Head E61</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">PID Controller</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Stainless 304</span>
                    </div>
                </div>

                <!-- Price & Stock Info -->
                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Harga Satuan</span>
                            <span class="text-xl font-extrabold text-coffee-600 dark:text-coffee-400">Rp 36.000.000</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Stok</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2.5 py-1 rounded-lg">
                                <i class="fas fa-box text-coffee-500 text-[11px]"></i> 11 Unit
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            onclick="showDetail('Eiko Barista Pro', 'Espresso Machine', 'Rp 36.000.000', '11 Unit', 'Tersedia', 'EKB-PRO-1G', 'Single group compact commercial espresso machine dengan saturasi thermal group E61 dan multi-stage infusion.', 'https://images.unsplash.com/photo-1511920170033-f8396924c348?w=800&auto=format&fit=crop&q=80', ['Group Head Model E61 Legend', 'Dual Boiler 3 Liter & 1.5 Liter', 'Shot Timer Display Digital', 'No-Burn Cool Touch Steam Wand'])"
                            class="flex-1 py-2 px-3 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-700 dark:text-coffee-300 hover:bg-coffee-600 hover:text-white dark:hover:bg-coffee-600 text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm"
                        >
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </button>
                        <button 
                            onclick="actionDummy('edit', 'Eiko Barista Pro')" 
                            title="Edit Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            onclick="actionDummy('delete', 'Eiko Barista Pro')" 
                            title="Hapus Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-600 hover:border-red-300 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 5: Eiko Industrial Roaster 5K -->
        <div class="product-card group glass-card rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700/60 bg-white dark:bg-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
             data-name="Eiko Industrial Roaster 5K"
             data-sku="EKR-IND-5K"
             data-category="Industrial Roaster"
             data-status="Pre-Order"
             data-price="138000000"
             data-stock="2">
            
            <!-- Image & Badges -->
            <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <img 
                    src="https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=800&auto=format&fit=crop&q=80" 
                    alt="Eiko Industrial Roaster 5K" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                
                <!-- Category Pill -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-gray-900/80 text-white backdrop-blur-md border border-white/10 shadow-sm">
                        <i class="fas fa-industry text-indigo-400 text-[10px]"></i> Industrial Roaster
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-600/90 text-white backdrop-blur-md shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Pre-Order
                    </span>
                </div>

                <!-- SKU floating label -->
                <div class="absolute bottom-3 left-3">
                    <span class="text-[11px] font-mono font-medium text-white/90 bg-black/40 backdrop-blur-sm px-2 py-0.5 rounded">
                        SKU: EKR-IND-5K
                    </span>
                </div>
            </div>

            <!-- Content Details -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-coffee-600 dark:group-hover:text-coffee-400 transition-colors">
                            Eiko Industrial Roaster 5K
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        Mesin sangrai skala industri kapasitas 5 - 7 kg per batch dengan PLC touch panel otomatis dan cyclone chaff separator.
                    </p>

                    <!-- Feature Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Kapasitas 5-7 kg</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">PLC Touchscreen</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Cyclone Blower</span>
                    </div>
                </div>

                <!-- Price & Stock Info -->
                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Harga Satuan</span>
                            <span class="text-xl font-extrabold text-coffee-600 dark:text-coffee-400">Rp 138.000.000</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-medium text-indigo-500 uppercase tracking-wider block">Estimasi</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/30 px-2.5 py-1 rounded-lg">
                                <i class="fas fa-clock text-indigo-500 text-[11px]"></i> PO 3 Minggu
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            onclick="showDetail('Eiko Industrial Roaster 5K', 'Industrial Roaster', 'Rp 138.000.000', '2 Unit (Pre-Order)', 'Pre-Order', 'EKR-IND-5K', 'Mesin sangrai skala industri kapasitas 5 - 7 kg per batch dengan PLC touch panel otomatis dan cyclone chaff separator.', 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=800&auto=format&fit=crop&q=80', ['Kapasitas Drum 5 - 7 Kilogram', 'Full Automation PLC Controller', 'Heavy Duty Cooling Bin Agitator', 'Emergency Safety Gas Shutoff'])"
                            class="flex-1 py-2 px-3 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-700 dark:text-coffee-300 hover:bg-coffee-600 hover:text-white dark:hover:bg-coffee-600 text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm"
                        >
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </button>
                        <button 
                            onclick="actionDummy('edit', 'Eiko Industrial Roaster 5K')" 
                            title="Edit Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            onclick="actionDummy('delete', 'Eiko Industrial Roaster 5K')" 
                            title="Hapus Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-600 hover:border-red-300 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 6: Eiko Precision Grinder Pro -->
        <div class="product-card group glass-card rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700/60 bg-white dark:bg-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
             data-name="Eiko Precision Grinder Pro"
             data-sku="EKG-PRC-83"
             data-category="Grinder & Aksesoris"
             data-status="Tersedia"
             data-price="18500000"
             data-stock="14">
            
            <!-- Image & Badges -->
            <div class="relative h-56 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <img 
                    src="https://images.unsplash.com/photo-1589396575653-c09c794ff6a6?w=800&auto=format&fit=crop&q=80" 
                    alt="Eiko Precision Grinder Pro" 
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                
                <!-- Category Pill -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-gray-900/80 text-white backdrop-blur-md border border-white/10 shadow-sm">
                        <i class="fas fa-cogs text-yellow-400 text-[10px]"></i> Grinder & Aksesoris
                    </span>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/90 text-white backdrop-blur-md shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Tersedia
                    </span>
                </div>

                <!-- SKU floating label -->
                <div class="absolute bottom-3 left-3">
                    <span class="text-[11px] font-mono font-medium text-white/90 bg-black/40 backdrop-blur-sm px-2 py-0.5 rounded">
                        SKU: EKG-PRC-83
                    </span>
                </div>
            </div>

            <!-- Content Details -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-coffee-600 dark:group-hover:text-coffee-400 transition-colors">
                            Eiko Precision Grinder Pro
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        Commercial coffee grinder dengan flat burr titanium 83mm, pengatur kehalusan micrometric stepless, dan retensi mendekati nol.
                    </p>

                    <!-- Feature Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Titanium Burr 83mm</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Stepless Dial</span>
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">Low Retention</span>
                    </div>
                </div>

                <!-- Price & Stock Info -->
                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-end justify-between mb-3">
                        <div>
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Harga Satuan</span>
                            <span class="text-xl font-extrabold text-coffee-600 dark:text-coffee-400">Rp 18.500.000</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Stok</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2.5 py-1 rounded-lg">
                                <i class="fas fa-box text-coffee-500 text-[11px]"></i> 14 Unit
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            onclick="showDetail('Eiko Precision Grinder Pro', 'Grinder & Aksesoris', 'Rp 18.500.000', '14 Unit', 'Tersedia', 'EKG-PRC-83', 'Commercial coffee grinder dengan flat burr titanium 83mm, pengatur kehalusan micrometric stepless, dan retensi mendekati nol.', 'https://images.unsplash.com/photo-1589396575653-c09c794ff6a6?w=800&auto=format&fit=crop&q=80', ['Flat Titanium Coated Burrs 83mm', 'Micrometric Stepless Adjustment', 'Cool Grinding System & Fan', 'Dosing Portafilter Fork Handsfree'])"
                            class="flex-1 py-2 px-3 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-700 dark:text-coffee-300 hover:bg-coffee-600 hover:text-white dark:hover:bg-coffee-600 text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm"
                        >
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </button>
                        <button 
                            onclick="actionDummy('edit', 'Eiko Precision Grinder Pro')" 
                            title="Edit Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-blue-600 hover:border-blue-300 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        <button 
                            onclick="actionDummy('delete', 'Eiko Precision Grinder Pro')" 
                            title="Hapus Produk"
                            class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-600 hover:border-red-300 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-xs transition-colors"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- No Match Alert (Hidden by default, shown if filter finds 0 items) -->
    <div id="noMatchState" class="hidden glass-card rounded-2xl p-12 text-center border border-dashed border-gray-300 dark:border-gray-700">
        <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4 text-gray-400 text-2xl">
            <i class="fas fa-search"></i>
        </div>
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-1">Tidak ada produk yang cocok</h4>
        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto mb-4">
            Coba sesuaikan kata kunci pencarian atau ubah filter kategori dan status produk.
        </p>
        <button onclick="resetAllFilters()" class="px-4 py-2 bg-coffee-600 hover:bg-coffee-700 text-white text-xs font-semibold rounded-xl transition-all">
            Reset Pencarian
        </button>
    </div>

</div>

<!-- MODAL DETAIL PRODUK (INTERAKTIF PREVIEW) -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-xl w-full overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-700 transform transition-all duration-300 scale-95 opacity-0" id="detailModalCard">
        <div class="relative h-48 sm:h-56 bg-gray-900">
            <img id="modalImg" src="" alt="Detail Produk" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
            <button onclick="closeDetailModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/50 text-white hover:bg-black/80 flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
            <div class="absolute bottom-4 left-6 right-6">
                <span id="modalCategory" class="inline-block px-2.5 py-0.5 rounded text-xs font-semibold bg-coffee-600 text-white mb-1"></span>
                <h3 id="modalTitle" class="text-2xl font-extrabold text-white"></h3>
                <p id="modalSku" class="text-xs text-gray-300 font-mono"></p>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <p id="modalDesc" class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed"></p>

            <div>
                <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Spesifikasi Unggulan</h5>
                <ul id="modalSpecs" class="space-y-1.5 text-xs text-gray-700 dark:text-gray-200">
                </ul>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <span class="text-xs text-gray-400 block">Harga</span>
                    <span id="modalPrice" class="text-xl font-bold text-coffee-600 dark:text-coffee-400"></span>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-400 block">Status Stok</span>
                    <span id="modalStock" class="text-sm font-semibold text-gray-800 dark:text-gray-200"></span>
                </div>
            </div>

            <div class="pt-2 flex justify-end gap-2">
                <button onclick="closeDetailModal()" class="px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 text-sm font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Tutup
                </button>
                <button onclick="actionDummy('edit', document.getElementById('modalTitle').innerText); closeDetailModal();" class="px-5 py-2.5 rounded-xl bg-coffee-600 hover:bg-coffee-700 text-white text-sm font-semibold shadow-md transition-all">
                    <i class="fas fa-edit mr-1"></i> Edit Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH PRODUK DUMMY -->
<div id="addModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-gray-200 dark:border-gray-700 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-plus-circle text-coffee-600"></i> Tambah Produk Mesin Kopi
            </h3>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Formulir ini disiapkan untuk integrasi database nanti. Anda dapat mencoba input data di bawah:
        </p>

        <form onsubmit="handleDummySubmit(event)" class="space-y-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama Mesin / Produk</label>
                <input type="text" placeholder="Contoh: Eiko Artisan 3K" required class="w-full px-3.5 py-2 rounded-xl text-sm bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-coffee-500 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                    <select class="w-full px-3 py-2 rounded-xl text-sm bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-coffee-500 outline-none">
                        <option>Artisan Roaster</option>
                        <option>Industrial Roaster</option>
                        <option>Espresso Machine</option>
                        <option>Brewing System</option>
                        <option>Grinder & Aksesoris</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select class="w-full px-3 py-2 rounded-xl text-sm bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-coffee-500 outline-none">
                        <option>Tersedia</option>
                        <option>Stok Menipis</option>
                        <option>Pre-Order</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Harga (Rp)</label>
                    <input type="number" placeholder="50000000" required class="w-full px-3.5 py-2 rounded-xl text-sm bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-coffee-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Stok (Unit)</label>
                    <input type="number" placeholder="5" required class="w-full px-3.5 py-2 rounded-xl text-sm bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-coffee-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Deskripsi Singkat</label>
                <textarea rows="2" placeholder="Spesifikasi drum, kontrol suhu, atau keunggulan mesin..." class="w-full px-3.5 py-2 rounded-xl text-sm bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-coffee-500 outline-none"></textarea>
            </div>

            <div class="pt-3 flex justify-end gap-2">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 text-sm font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-coffee-600 hover:bg-coffee-700 text-white text-sm font-semibold shadow-md transition-all">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div id="toastNotification" class="fixed bottom-6 right-6 z-50 hidden bg-gray-900 text-white px-4 py-3 rounded-xl shadow-2xl border border-gray-700 flex items-center gap-3 animate-slide-up">
    <div class="w-7 h-7 rounded-full bg-emerald-500 flex items-center justify-center text-white text-xs">
        <i class="fas fa-check"></i>
    </div>
    <span id="toastMessage" class="text-sm font-medium">Aksi berhasil!</span>
</div>
@endsection

@push('scripts')
<script>
    // Live Search & Filter Logic
    function filterProducts() {
        const query = document.getElementById('searchInput').value.toLowerCase().trim();
        const category = document.getElementById('categoryFilter').value;
        const status = document.getElementById('statusFilter').value;
        const clearBtn = document.getElementById('clearSearch');
        const cards = document.querySelectorAll('.product-card');
        const noMatchState = document.getElementById('noMatchState');
        const counter = document.getElementById('productCounter');

        // Toggle clear search button
        if (query.length > 0) {
            clearBtn.classList.remove('hidden');
        } else {
            clearBtn.classList.add('hidden');
        }

        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name').toLowerCase();
            const sku = card.getAttribute('data-sku').toLowerCase();
            const cardCategory = card.getAttribute('data-category');
            const cardStatus = card.getAttribute('data-status');

            const matchesQuery = !query || name.includes(query) || sku.includes(query);
            const matchesCategory = !category || cardCategory === category;
            const matchesStatus = !status || cardStatus === status;

            if (matchesQuery && matchesCategory && matchesStatus) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update counter & empty state
        counter.textContent = `${visibleCount} Produk`;

        if (visibleCount === 0) {
            noMatchState.classList.remove('hidden');
        } else {
            noMatchState.classList.add('hidden');
        }
    }

    function clearSearchInput() {
        document.getElementById('searchInput').value = '';
        filterProducts();
    }

    function setCategoryFilter(category) {
        document.getElementById('categoryFilter').value = category;
        filterProducts();
    }

    function setStatusFilter(status) {
        document.getElementById('statusFilter').value = status;
        filterProducts();
    }

    function resetAllFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('categoryFilter').value = '';
        document.getElementById('statusFilter').value = '';
        filterProducts();
    }

    // Modal Detail Handler
    function showDetail(title, category, price, stock, status, sku, desc, imgUrl, specs) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalCategory').innerText = category;
        document.getElementById('modalPrice').innerText = price;
        document.getElementById('modalStock').innerText = `${stock} (${status})`;
        document.getElementById('modalSku').innerText = `SKU: ${sku}`;
        document.getElementById('modalDesc').innerText = desc;
        document.getElementById('modalImg').src = imgUrl;

        const specsList = document.getElementById('modalSpecs');
        specsList.innerHTML = '';
        if (specs && Array.isArray(specs)) {
            specs.forEach(spec => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-2';
                li.innerHTML = `<i class="fas fa-check text-coffee-500 text-xs"></i> <span>${spec}</span>`;
                specsList.appendChild(li);
            });
        }

        const modal = document.getElementById('detailModal');
        const card = document.getElementById('detailModalCard');
        modal.classList.remove('hidden');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        const card = document.getElementById('detailModalCard');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // Modal Tambah Handler
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function handleDummySubmit(event) {
        event.preventDefault();
        closeAddModal();
        showToast('Produk baru berhasil disimpan ke dalam katalog preview!');
    }

    function actionDummy(action, name) {
        if (action === 'edit') {
            showToast(`Membuka mode edit untuk "${name}"`);
        } else if (action === 'delete') {
            if (confirm(`Apakah Anda yakin ingin menghapus produk "${name}" dari katalog?`)) {
                showToast(`Produk "${name}" berhasil dihapus dari preview!`);
            }
        }
    }

    function showToast(message) {
        const toast = document.getElementById('toastNotification');
        const msg = document.getElementById('toastMessage');
        msg.textContent = message;
        toast.classList.remove('hidden');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    // Close modals on Escape key or outside click
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDetailModal();
            closeAddModal();
        }
    });

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
    });

    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) closeAddModal();
    });
</script>
@endpush
