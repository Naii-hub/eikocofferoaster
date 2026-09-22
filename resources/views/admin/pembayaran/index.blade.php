@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran - Eiko Coffee Roaster')
@section('page-title', 'Pembayaran')
@section('page-subtitle', 'Kelola dan pantau transaksi pembayaran pelanggan')

@section('content')
<div class="animate-fade-in space-y-6">

    <!-- 2. Section Daftar Pembayaran -->
    <div class="glass-card rounded-2xl p-6 shadow-sm border border-gray-200/80 dark:border-gray-700/60 bg-white/95 dark:bg-gray-800/95 space-y-6">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-gray-100 dark:border-gray-700/60">
            <div>
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white flex items-center gap-2.5">
                    <span class="w-2.5 h-6 rounded bg-coffee-600 inline-block"></span>
                    Daftar Pembayaran
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Pantau status pembayaran dari seluruh pesanan mesin kopi secara real-time
                </p>
            </div>
        </div>

        <!-- Filter dan Pencarian Bar -->
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            <!-- Search Input -->
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input 
                    type="text" 
                    id="searchPaymentInput" 
                    placeholder="Cari kode pesanan atau pelanggan..." 
                    class="w-full pl-11 pr-10 py-2.5 rounded-xl text-sm bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-coffee-500 focus:border-transparent transition-all"
                    onkeyup="filterPayments()"
                >
                <button id="clearPaymentSearch" onclick="clearSearch()" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-sm">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>

            <!-- Filter Controls -->
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                <!-- Filter Status Pembayaran -->
                <div class="relative min-w-[190px] w-full sm:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-info-circle text-xs"></i>
                    </div>
                    <select 
                        id="statusPaymentFilter" 
                        onchange="filterPayments()" 
                        class="w-full pl-8 pr-8 py-2.5 rounded-xl text-sm bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-coffee-500 cursor-pointer appearance-none"
                    >
                        <option value="">Semua Status</option>
                        <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                        <option value="Berhasil">Berhasil</option>
                        <option value="Gagal">Gagal</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>

                <!-- Filter Bank Transfer -->
                <div class="relative min-w-[190px] w-full sm:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-university text-xs"></i>
                    </div>
                    <select 
                        id="methodPaymentFilter" 
                        onchange="filterPayments()" 
                        class="w-full pl-8 pr-8 py-2.5 rounded-xl text-sm bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-coffee-500 cursor-pointer appearance-none"
                    >
                        <option value="">Semua Bank Transfer</option>
                        <option value="BCA">Transfer BCA</option>
                        <option value="Mandiri">Transfer Mandiri</option>
                        <option value="BNI">Transfer BNI</option>
                        <option value="BRI">Transfer BRI</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>

                <!-- Reset Filter Button -->
                <button 
                    onclick="resetFilters()" 
                    title="Reset Filter" 
                    class="p-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 text-gray-500 hover:text-coffee-600 hover:bg-coffee-50 dark:hover:bg-gray-700 transition-colors"
                >
                    <i class="fas fa-redo-alt text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Counter info -->
        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 pt-1">
            <div class="flex items-center gap-2">
                <span>Total Data:</span>
                <span id="paymentCountBadge" class="font-bold text-coffee-600 dark:text-coffee-400 bg-coffee-50 dark:bg-coffee-900/30 px-2.5 py-0.5 rounded-full">
                    7 Transaksi
                </span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Live Filter Aktif</span>
            </div>
        </div>

        <!-- 3. Tabel Pembayaran -->
        <div class="overflow-x-auto rounded-xl border border-gray-200/80 dark:border-gray-700/60">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700/60 text-left text-sm">
                <thead class="bg-gray-50/90 dark:bg-gray-900/60 uppercase text-[11px] font-bold text-gray-500 dark:text-gray-400 tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">Kode Pembayaran</th>
                        <th class="px-5 py-3.5">Kode Pesanan</th>
                        <th class="px-5 py-3.5">Pelanggan</th>
                        <th class="px-5 py-3.5">Total</th>
                        <th class="px-5 py-3.5">Metode</th>
                        <th class="px-5 py-3.5">Tanggal</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="paymentTableBody" class="divide-y divide-gray-200 dark:divide-gray-700/50 bg-white dark:bg-gray-800">
                    
                    <!-- BARIS 1 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0158"
                        data-ordercode="PSN-001"
                        data-customer="Hendra Wijaya"
                        data-outlet="Kopi Kenangan Senopati"
                        data-email="hendra@kenangan.co.id"
                        data-phone="+62 812-8877-6655"
                        data-total="62000000"
                        data-formattedtotal="Rp 62.000.000"
                        data-product="Eiko Espresso Pro (2 Group Head)"
                        data-method="Transfer Bank"
                        data-channel="BCA Virtual Account (8001298471)"
                        data-date="22 Sep 2026, 09:15 WIB"
                        data-status="Menunggu Pembayaran"
                        data-receipt="true"
                        data-receiptimg="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0158
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-001
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Hendra Wijaya</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Kopi Kenangan Senopati</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 62.000.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">BCA Virtual Account</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            22 Sep 2026<br><span class="text-[11px] text-gray-400">09:15 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button onclick="openReceiptModal(this)" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-semibold transition-colors" title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i> Bukti
                                </button>
                                <button onclick="confirmPayment(this)" class="p-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/30 dark:hover:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 text-xs font-semibold transition-colors" title="Konfirmasi Pembayaran">
                                    <i class="fas fa-check"></i> Konfirmasi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS 2 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0157"
                        data-ordercode="PSN-002"
                        data-customer="Siti Rahmawati"
                        data-outlet="Anomali Coffee Roastery"
                        data-email="siti.r@anomali.id"
                        data-phone="+62 821-3344-5566"
                        data-total="48500000"
                        data-formattedtotal="Rp 48.500.000"
                        data-product="Eiko Roaster X1 (Drum 1-2.5 kg)"
                        data-method="Transfer Bank"
                        data-channel="Mandiri Corporate Transfer"
                        data-date="21 Sep 2026, 14:30 WIB"
                        data-status="Berhasil"
                        data-receipt="true"
                        data-receiptimg="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0157
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-002
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Siti Rahmawati</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Anomali Coffee Roastery</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 48.500.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">Mandiri Manual</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            21 Sep 2026<br><span class="text-[11px] text-gray-400">14:30 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                                <i class="fas fa-check-circle text-emerald-500 text-xs"></i>
                                Berhasil
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button onclick="openReceiptModal(this)" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-semibold transition-colors" title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i> Bukti
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS 3 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0156"
                        data-ordercode="PSN-003"
                        data-customer="Budi Santoso"
                        data-outlet="Kopi Tuku Nusantara"
                        data-email="budi@tuku.com"
                        data-phone="+62 813-9900-1122"
                        data-total="28500000"
                        data-formattedtotal="Rp 28.500.000"
                        data-product="Eiko Coffee Master (Batch Brewer 6L)"
                        data-method="Transfer Bank"
                        data-channel="BCA Transfer Manual (8001298471)"
                        data-date="21 Sep 2026, 11:20 WIB"
                        data-status="Berhasil"
                        data-receipt="true"
                        data-receiptimg="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0156
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-003
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Budi Santoso</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Kopi Tuku Nusantara</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 28.500.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">BCA Transfer</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            21 Sep 2026<br><span class="text-[11px] text-gray-400">11:20 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                                <i class="fas fa-check-circle text-emerald-500 text-xs"></i>
                                Berhasil
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button onclick="openReceiptModal(this)" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-semibold transition-colors" title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i> Bukti
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS 4 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0155"
                        data-ordercode="PSN-004"
                        data-customer="Amanda Putri"
                        data-outlet="Tanamera Coffee Hub"
                        data-email="amanda@tanamera.com"
                        data-phone="+62 811-2233-4455"
                        data-total="138000000"
                        data-formattedtotal="Rp 138.000.000"
                        data-product="Eiko Industrial Roaster 5K (Pre-Order)"
                        data-method="Transfer Bank"
                        data-channel="BNI Corporate Account"
                        data-date="20 Sep 2026, 16:45 WIB"
                        data-status="Menunggu Pembayaran"
                        data-receipt="true"
                        data-receiptimg="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0155
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-004
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Amanda Putri</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Tanamera Coffee Hub</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 138.000.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">BNI Corporate (DP 50%)</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            20 Sep 2026<br><span class="text-[11px] text-gray-400">16:45 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button onclick="openReceiptModal(this)" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-semibold transition-colors" title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i> Bukti
                                </button>
                                <button onclick="confirmPayment(this)" class="p-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/30 dark:hover:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 text-xs font-semibold transition-colors" title="Konfirmasi Pembayaran">
                                    <i class="fas fa-check"></i> Konfirmasi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS 5 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0154"
                        data-ordercode="PSN-005"
                        data-customer="Kevin Sanjaya"
                        data-outlet="Fore Artisan Hub"
                        data-email="kevin@fore.id"
                        data-phone="+62 817-4455-6677"
                        data-total="18500000"
                        data-formattedtotal="Rp 18.500.000"
                        data-product="Eiko Precision Grinder Pro"
                        data-method="Transfer Bank"
                        data-channel="BRI Virtual Account (902188219)"
                        data-date="20 Sep 2026, 10:12 WIB"
                        data-status="Gagal"
                        data-receipt="false"
                        data-receiptimg="">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0154
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-005
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Kevin Sanjaya</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Fore Artisan Hub</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 18.500.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">BRI Virtual Account</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            20 Sep 2026<br><span class="text-[11px] text-gray-400">10:12 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800/50">
                                <i class="fas fa-times-circle text-red-500 text-xs"></i>
                                Gagal
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <span class="text-xs text-gray-400 italic px-2">Expired</span>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS 6 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0153"
                        data-ordercode="PSN-006"
                        data-customer="Dewi Lestari"
                        data-outlet="Djournal Artisan"
                        data-email="dewi@djournal.co.id"
                        data-phone="+62 819-0011-2233"
                        data-total="36000000"
                        data-formattedtotal="Rp 36.000.000"
                        data-product="Eiko Barista Pro (E61 Group)"
                        data-method="Transfer Bank"
                        data-channel="Mandiri Transfer Manual (137-00-998877-1)"
                        data-date="19 Sep 2026, 15:00 WIB"
                        data-status="Menunggu Pembayaran"
                        data-receipt="true"
                        data-receiptimg="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0153
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-006
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Dewi Lestari</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Djournal Artisan</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 36.000.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-university"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">Mandiri Transfer</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            19 Sep 2026<br><span class="text-[11px] text-gray-400">15:00 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button onclick="openReceiptModal(this)" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-semibold transition-colors" title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i> Bukti
                                </button>
                                <button onclick="confirmPayment(this)" class="p-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/30 dark:hover:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 text-xs font-semibold transition-colors" title="Konfirmasi Pembayaran">
                                    <i class="fas fa-check"></i> Konfirmasi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS 7 -->
                    <tr class="payment-row hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors"
                        data-paycode="PAY-2026-0152"
                        data-ordercode="PSN-007"
                        data-customer="Farhan Pratama"
                        data-outlet="Ombe Kofie Menteng"
                        data-email="farhan@ombe.com"
                        data-phone="+62 812-7788-9900"
                        data-total="12000000"
                        data-formattedtotal="Rp 12.000.000"
                        data-product="Aksesoris Portafilter & Grinder Burr"
                        data-method="Transfer Bank"
                        data-channel="BCA Refund Settlement"
                        data-date="18 Sep 2026, 13:20 WIB"
                        data-status="Dikembalikan"
                        data-receipt="true"
                        data-receiptimg="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80">
                        <td class="px-5 py-4 font-mono font-bold text-coffee-600 dark:text-coffee-400 whitespace-nowrap">
                            PAY-2026-0152
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                PSN-007
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-900 dark:text-white">Farhan Pratama</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Ombe Kofie Menteng</div>
                        </td>
                        <td class="px-5 py-4 font-extrabold text-gray-900 dark:text-white whitespace-nowrap">
                            Rp 12.000.000
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-undo-alt"></i>
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 dark:text-gray-200 text-xs">Transfer Bank</div>
                                    <div class="text-[11px] text-gray-400">BCA Transfer Balik</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            18 Sep 2026<br><span class="text-[11px] text-gray-400">13:20 WIB</span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50">
                                <i class="fas fa-reply text-purple-500 text-xs"></i>
                                Dikembalikan
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <button onclick="openDetailModal(this)" class="p-2 rounded-lg bg-coffee-50 hover:bg-coffee-100 dark:bg-coffee-900/30 dark:hover:bg-coffee-900/50 text-coffee-700 dark:text-coffee-300 text-xs font-semibold transition-colors" title="Detail Pembayaran">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button onclick="openReceiptModal(this)" class="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 text-xs font-semibold transition-colors" title="Lihat Bukti Refund">
                                    <i class="fas fa-receipt"></i> Bukti
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- 5. Empty State -->
        <div id="noPaymentFound" class="hidden p-12 text-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl bg-gray-50/50 dark:bg-gray-800/50">
            <div class="w-16 h-16 rounded-full bg-coffee-50 dark:bg-coffee-900/30 text-coffee-600 dark:text-coffee-400 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fas fa-receipt"></i>
            </div>
            <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-1">Belum ada data pembayaran</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto mb-5">
                Tidak ditemukan transaksi pembayaran yang sesuai dengan kriteria filter atau pencarian Anda.
            </p>
            <button onclick="resetFilters()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-coffee-600 hover:bg-coffee-700 text-white text-xs font-semibold shadow-md transition-all">
                <i class="fas fa-redo-alt"></i> Reset Pencarian & Filter
            </button>
        </div>

        <!-- Pagination Dummy -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-gray-100 dark:border-gray-700/60 text-xs text-gray-500 dark:text-gray-400">
            <div>
                Menampilkan <span class="font-semibold text-gray-800 dark:text-gray-200" id="showingCount">7</span> dari <span class="font-semibold text-gray-800 dark:text-gray-200">7</span> transaksi
            </div>
            <div class="inline-flex items-center gap-1">
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-400 cursor-not-allowed" disabled>
                    <i class="fas fa-chevron-left text-[10px]"></i>
                </button>
                <button class="px-3 py-1.5 rounded-lg bg-coffee-600 text-white font-bold shadow-sm">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">2</button>
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-chevron-right text-[10px]"></i>
                </button>
            </div>
        </div>

    </div>

</div>

<!-- MODAL DETAIL TRANSAKSI PEMBAYARAN -->
<div id="paymentDetailModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-gray-200 dark:border-gray-700 transform transition-all duration-300 scale-95 opacity-0 space-y-5" id="paymentDetailCard">
        <!-- Header Modal -->
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-coffee-50 dark:bg-coffee-900/30 text-coffee-600 dark:text-coffee-400 flex items-center justify-center text-lg">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white" id="modalPayCode">PAY-2026-0000</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Rincian invoice transaksi pembayaran</p>
                </div>
            </div>
            <button onclick="closeDetailModal()" class="w-8 h-8 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Body Details -->
        <div class="space-y-4 text-xs">
            <div class="grid grid-cols-2 gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700">
                <div>
                    <span class="text-gray-400 block mb-0.5">Kode Pesanan</span>
                    <span class="font-bold text-gray-800 dark:text-gray-200 text-sm" id="modalOrderCode">-</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Status Pembayaran</span>
                    <span id="modalStatusBadge" class="inline-block font-semibold"></span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Tanggal & Waktu</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" id="modalDate">-</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Metode Bayar</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" id="modalMethod">-</span>
                </div>
            </div>

            <!-- Customer & Product info -->
            <div class="p-4 rounded-xl border border-gray-100 dark:border-gray-700 space-y-2">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-gray-400 uppercase text-[10px] tracking-wider font-bold block">Pelanggan</span>
                        <p class="font-bold text-sm text-gray-900 dark:text-white mt-0.5" id="modalCustomer">-</p>
                        <p class="text-gray-500 dark:text-gray-400" id="modalOutlet">-</p>
                    </div>
                    <div class="text-right">
                        <span class="text-gray-400 uppercase text-[10px] tracking-wider font-bold block">Kontak</span>
                        <p class="text-gray-700 dark:text-gray-300 font-mono" id="modalPhone">-</p>
                        <p class="text-gray-500 dark:text-gray-400" id="modalEmail">-</p>
                    </div>
                </div>
                <div class="pt-2 border-t border-gray-100 dark:border-gray-700">
                    <span class="text-gray-400 uppercase text-[10px] tracking-wider font-bold block">Item Pesanan Terkait</span>
                    <p class="font-semibold text-gray-800 dark:text-gray-200 mt-0.5" id="modalProduct">-</p>
                </div>
            </div>

            <!-- Total Settlement -->
            <div class="p-4 rounded-xl bg-coffee-50/80 dark:bg-coffee-900/20 border border-coffee-200/60 dark:border-coffee-800/40 flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-coffee-800 dark:text-coffee-300 font-medium">Total Tagihan Dibayar</span>
                    <p class="text-xs text-coffee-600/80 dark:text-coffee-400" id="modalChannel">-</p>
                </div>
                <div class="text-xl font-extrabold text-coffee-700 dark:text-coffee-300" id="modalTotal">
                    Rp 0
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="pt-2 flex justify-end gap-2.5">
            <button onclick="closeDetailModal()" class="px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 text-xs font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Tutup
            </button>
            <button onclick="printReceiptMock()" class="px-4 py-2 rounded-xl bg-coffee-600 hover:bg-coffee-700 text-white text-xs font-semibold shadow-md transition-all flex items-center gap-1.5">
                <i class="fas fa-print"></i> Cetak Invoice
            </button>
        </div>
    </div>
</div>

<!-- MODAL BUKTI PEMBAYARAN -->
<div id="receiptModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-200 dark:border-gray-700 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-coffee-600"></i> Bukti Transfer Pelanggan
            </h3>
            <button onclick="closeReceiptModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 relative">
            <img id="receiptImage" src="" alt="Bukti Transfer" class="w-full h-72 object-cover object-center">
            <div class="absolute bottom-2 left-2 right-2 bg-black/60 backdrop-blur-sm text-white p-2 rounded-lg text-xs flex justify-between items-center">
                <span id="receiptPayCode" class="font-mono font-bold"></span>
                <span class="text-emerald-400 text-[11px]"><i class="fas fa-shield-alt"></i> Verified Receipt</span>
            </div>
        </div>

        <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
            <div class="flex justify-between">
                <span>Pengirim:</span>
                <span class="font-semibold text-gray-800 dark:text-gray-200" id="receiptSender">-</span>
            </div>
            <div class="flex justify-between">
                <span>Nominal Tertera:</span>
                <span class="font-bold text-coffee-600 dark:text-coffee-400" id="receiptAmount">-</span>
            </div>
        </div>

        <div class="pt-2 flex justify-end gap-2">
            <button onclick="closeReceiptModal()" class="px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 text-xs font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Tutup
            </button>
            <a id="downloadReceiptBtn" href="#" target="_blank" class="px-4 py-2 rounded-xl bg-coffee-600 hover:bg-coffee-700 text-white text-xs font-semibold shadow-md transition-all flex items-center gap-1.5">
                <i class="fas fa-download"></i> Unduh Struk
            </a>
        </div>
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
    // Live Filter & Search Logic
    function filterPayments() {
        const query = document.getElementById('searchPaymentInput').value.toLowerCase().trim();
        const status = document.getElementById('statusPaymentFilter').value;
        const method = document.getElementById('methodPaymentFilter').value;
        const clearBtn = document.getElementById('clearPaymentSearch');
        const rows = document.querySelectorAll('.payment-row');
        const emptyState = document.getElementById('noPaymentFound');
        const counter = document.getElementById('paymentCountBadge');
        const showingCount = document.getElementById('showingCount');

        if (query.length > 0) {
            clearBtn.classList.remove('hidden');
        } else {
            clearBtn.classList.add('hidden');
        }

        let visibleCount = 0;

        rows.forEach(row => {
            const paycode = row.getAttribute('data-paycode').toLowerCase();
            const ordercode = row.getAttribute('data-ordercode').toLowerCase();
            const customer = row.getAttribute('data-customer').toLowerCase();
            const outlet = row.getAttribute('data-outlet').toLowerCase();
            const rowStatus = row.getAttribute('data-status');
            const rowMethod = row.getAttribute('data-method');
            const rowChannel = (row.getAttribute('data-channel') || '').toLowerCase();

            const matchesQuery = !query || paycode.includes(query) || ordercode.includes(query) || customer.includes(query) || outlet.includes(query);
            const matchesStatus = !status || rowStatus === status;
            const matchesMethod = !method || rowChannel.includes(method.toLowerCase()) || rowMethod.toLowerCase().includes(method.toLowerCase());

            if (matchesQuery && matchesStatus && matchesMethod) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        counter.textContent = `${visibleCount} Transaksi`;
        showingCount.textContent = visibleCount;

        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    function clearSearch() {
        document.getElementById('searchPaymentInput').value = '';
        filterPayments();
    }

    function resetFilters() {
        document.getElementById('searchPaymentInput').value = '';
        document.getElementById('statusPaymentFilter').value = '';
        document.getElementById('methodPaymentFilter').value = '';
        filterPayments();
        showToast('Filter pembayaran telah di-reset!');
    }

    // Modal Detail Handler
    function openDetailModal(button) {
        const row = button.closest('tr');
        document.getElementById('modalPayCode').textContent = row.getAttribute('data-paycode');
        document.getElementById('modalOrderCode').textContent = row.getAttribute('data-ordercode');
        document.getElementById('modalCustomer').textContent = row.getAttribute('data-customer');
        document.getElementById('modalOutlet').textContent = row.getAttribute('data-outlet');
        document.getElementById('modalEmail').textContent = row.getAttribute('data-email');
        document.getElementById('modalPhone').textContent = row.getAttribute('data-phone');
        document.getElementById('modalTotal').textContent = row.getAttribute('data-formattedtotal');
        document.getElementById('modalProduct').textContent = row.getAttribute('data-product');
        document.getElementById('modalMethod').textContent = row.getAttribute('data-method');
        document.getElementById('modalChannel').textContent = row.getAttribute('data-channel');
        document.getElementById('modalDate').textContent = row.getAttribute('data-date');

        const status = row.getAttribute('data-status');
        const badge = document.getElementById('modalStatusBadge');
        if (status === 'Berhasil') {
            badge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400';
            badge.innerHTML = '<i class="fas fa-check-circle"></i> Berhasil';
        } else if (status === 'Menunggu Pembayaran') {
            badge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400';
            badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu Pembayaran';
        } else if (status === 'Gagal') {
            badge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400';
            badge.innerHTML = '<i class="fas fa-times-circle"></i> Gagal';
        } else {
            badge.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400';
            badge.innerHTML = '<i class="fas fa-reply"></i> Dikembalikan';
        }

        const modal = document.getElementById('paymentDetailModal');
        const card = document.getElementById('paymentDetailCard');
        modal.classList.remove('hidden');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDetailModal() {
        const modal = document.getElementById('paymentDetailModal');
        const card = document.getElementById('paymentDetailCard');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // Modal Bukti Handler
    function openReceiptModal(button) {
        const row = button.closest('tr');
        const hasReceipt = row.getAttribute('data-receipt') === 'true';
        const imgUrl = row.getAttribute('data-receiptimg');
        const paycode = row.getAttribute('data-paycode');
        const customer = row.getAttribute('data-customer');
        const total = row.getAttribute('data-formattedtotal');

        if (!hasReceipt || !imgUrl) {
            showToast('Bukti pembayaran belum diunggah untuk transaksi ini.');
            return;
        }

        document.getElementById('receiptPayCode').textContent = paycode;
        document.getElementById('receiptImage').src = imgUrl;
        document.getElementById('receiptSender').textContent = customer;
        document.getElementById('receiptAmount').textContent = total;
        document.getElementById('downloadReceiptBtn').href = imgUrl;

        document.getElementById('receiptModal').classList.remove('hidden');
    }

    function closeReceiptModal() {
        document.getElementById('receiptModal').classList.add('hidden');
    }

    // Konfirmasi Pembayaran Handler
    function confirmPayment(button) {
        const row = button.closest('tr');
        const paycode = row.getAttribute('data-paycode');
        const customer = row.getAttribute('data-customer');

        if (confirm(`Konfirmasi verifikasi pembayaran ${paycode} dari pelanggan "${customer}"?`)) {
            // Update status row to Berhasil
            row.setAttribute('data-status', 'Berhasil');
            const statusCell = row.cells[6];
            statusCell.innerHTML = `
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                    <i class="fas fa-check-circle text-emerald-500 text-xs"></i>
                    Berhasil
                </span>
            `;
            // Remove confirm button from row
            button.remove();
            showToast(`Pembayaran ${paycode} berhasil dikonfirmasi dan status pesanan diperbarui!`);
        }
    }

    function printReceiptMock() {
        showToast('Menyiapkan file cetak invoice pembayaran...');
        setTimeout(() => {
            window.print();
        }, 800);
    }

    function downloadReport() {
        showToast('Mengekspor data pembayaran ke format file CSV / Excel...');
    }

    function showToast(message) {
        const toast = document.getElementById('toastNotification');
        const msg = document.getElementById('toastMessage');
        msg.textContent = message;
        toast.classList.remove('hidden');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3500);
    }

    // Close on Escape or click outside
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDetailModal();
            closeReceiptModal();
        }
    });

    document.getElementById('paymentDetailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
    });

    document.getElementById('receiptModal').addEventListener('click', function(e) {
        if (e.target === this) closeReceiptModal();
    });
</script>
@endpush
