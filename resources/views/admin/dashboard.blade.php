@extends('layouts.admin')

@section('title', 'Dashboard - Kopi Mesin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan sistem pesanan mesin kopi')

@section('content')
<div class="page active animate-fade-in" id="page-dashboard">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card-gradient-1 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-xs font-semibold">+12.5%</span>
            </div>
            <h3 class="text-3xl font-bold mb-1">142</h3>
            <p class="text-white/80 text-sm">Total Pesanan</p>
            <div class="mt-4 h-1 bg-white/20 rounded-full overflow-hidden">
                <div class="h-full bg-white/60 rounded-full" style="width: 75%"></div>
            </div>
        </div>

        <div class="stat-card-gradient-2 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-xs font-semibold">Perlu Aksi</span>
            </div>
            <h3 class="text-3xl font-bold mb-1">5</h3>
            <p class="text-white/80 text-sm">Menunggu Verifikasi DP</p>
            <div class="mt-4 h-1 bg-white/20 rounded-full overflow-hidden">
                <div class="h-full bg-yellow-300 rounded-full animate-pulse" style="width: 35%"></div>
            </div>
        </div>

        <div class="stat-card-gradient-3 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-truck text-2xl"></i>
                </div>
                <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
            </div>
            <h3 class="text-3xl font-bold mb-1">18</h3>
            <p class="text-white/80 text-sm">Dalam Pengiriman</p>
            <div class="mt-4 h-1 bg-white/20 rounded-full overflow-hidden">
                <div class="h-full bg-blue-300 rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <div class="stat-card-gradient-4 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
                <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-xs font-semibold">+23.8%</span>
            </div>
            <h3 class="text-3xl font-bold mb-1">Rp 48.5Jt</h3>
            <p class="text-white/80 text-sm">Pendapatan Bulan Ini</p>
            <div class="mt-4 h-1 bg-white/20 rounded-full overflow-hidden">
                <div class="h-full bg-green-300 rounded-full" style="width: 85%"></div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="glass-card rounded-2xl p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-coffee-100 dark:bg-coffee-900/30 flex items-center justify-center">
                        <i class="fas fa-users text-coffee-600 dark:text-coffee-400"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Pelanggan Baru</span>
                </div>
                <span class="text-green-500 text-sm font-semibold">+8</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">1,284</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total pelanggan terdaftar</p>
        </div>

        <div class="glass-card rounded-2xl p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                        <i class="fas fa-box text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Produk Aktif</span>
                </div>
                <span class="text-blue-500 text-sm font-semibold">+3</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">48</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total varian mesin kopi</p>
        </div>

        <div class="glass-card rounded-2xl p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Return/Garansi</span>
                </div>
                <span class="text-red-500 text-sm font-semibold">2</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">12</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total klaim garansi</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 glass-card rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tren Pesanan & Pendapatan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Performa 9 bulan terakhir</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 bg-coffee-600 text-white text-xs rounded-lg font-medium">2026</button>
                    <button class="px-3 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs rounded-lg font-medium">2025</button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Distribusi Status</h3>
            <div class="h-48 mb-4">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Selesai</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">98</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Diproses</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">12</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Pending DP</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">5</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Dikirim</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">18</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics -->
    <div class="glass-card rounded-2xl p-6 mb-8">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Metrik Performa</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Tingkat Konversi</span>
                    <span class="text-sm font-bold text-coffee-600 dark:text-coffee-400">68%</span>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-coffee-500 to-coffee-600 rounded-full metric-bar" style="width: 68%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Rata-rata Order Value</span>
                    <span class="text-sm font-bold text-coffee-600 dark:text-coffee-400">Rp 3.4jt</span>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full metric-bar" style="width: 72%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Waktu Produksi</span>
                    <span class="text-sm font-bold text-coffee-600 dark:text-coffee-400">5.2 hari</span>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full metric-bar" style="width: 85%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Kepuasan Pelanggan</span>
                    <span class="text-sm font-bold text-coffee-600 dark:text-coffee-400">4.8/5</span>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600 rounded-full metric-bar" style="width: 96%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-gray-900 dark:text-white">Pesanan Terbaru</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Perlu ditindaklanjuti</p>
            </div>
            <a href="{{ route('admin.pesanan.index') }}" class="px-4 py-2 bg-coffee-600 hover:bg-coffee-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                <i class="fas fa-shopping-cart w-5 {{ request()->routeIs('admin.pesanan.*') ? 'text-coffee-600' : 'text-coffee-500' }}"></i>
                <span>Pesanan</span>
                <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">5</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Jenis</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-6 py-4 font-bold text-coffee-600 dark:text-coffee-400">#PSN-001</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold">BS</div>
                                <span class="text-gray-900 dark:text-white text-sm font-semibold">Budi Santoso</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">Custom - Mesin Espresso</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">Rp 12.5jt</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-bold rounded-full">Menunggu DP</span></td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">20 Sep 2026</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-6 py-4 font-bold text-coffee-600 dark:text-coffee-400">#PSN-002</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white text-xs font-bold">SA</div>
                                <span class="text-gray-900 dark:text-white text-sm font-semibold">Siti Aminah</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">Standar - Grinder</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">Rp 3.2jt</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold rounded-full">Diproses</span></td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">19 Sep 2026</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-6 py-4 font-bold text-coffee-600 dark:text-coffee-400">#PSN-003</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-xs font-bold">AR</div>
                                <span class="text-gray-900 dark:text-white text-sm font-semibold">Ahmad Rizki</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">Custom - Mesin Kopi</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">Rp 8.75jt</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold rounded-full">Selesai</span></td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">18 Sep 2026</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let ordersChart, statusChart;

function initCharts() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#f9fafb' : '#1f2937';
    const gridColor = isDark ? '#374151' : '#e5e7eb';

    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const gradient1 = ordersCtx.createLinearGradient(0, 0, 0, 320);
    gradient1.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
    gradient1.addColorStop(1, 'rgba(99, 102, 241, 0)');
    
    const gradient2 = ordersCtx.createLinearGradient(0, 0, 0, 320);
    gradient2.addColorStop(0, 'rgba(219, 127, 46, 0.4)');
    gradient2.addColorStop(1, 'rgba(219, 127, 46, 0)');

    ordersChart = new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
            datasets: [{
                label: 'Pesanan',
                data: [8, 12, 15, 14, 18, 16, 20, 22, 19],
                borderColor: '#6366f1',
                backgroundColor: gradient1,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }, {
                label: 'Pendapatan (Jt)',
                data: [24, 36, 45, 42, 54, 48, 60, 66, 57],
                borderColor: '#db7f2e',
                backgroundColor: gradient2,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#db7f2e',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    display: true,
                    position: 'top',
                    labels: { 
                        color: textColor,
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 12, family: 'Plus Jakarta Sans' }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: gridColor }, 
                    ticks: { color: textColor, font: { size: 11, family: 'Plus Jakarta Sans' } } 
                },
                x: { 
                    grid: { display: false }, 
                    ticks: { color: textColor, font: { size: 11, family: 'Plus Jakarta Sans' } } 
                }
            }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Diproses', 'Pending DP', 'Dikirim'],
            datasets: [{
                data: [98, 12, 5, 18],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { display: false }
            }
        }
    });
}

function updateChartsTheme() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#f9fafb' : '#1f2937';
    const gridColor = isDark ? '#374151' : '#e5e7eb';
    if (ordersChart) {
        ordersChart.options.scales.y.grid.color = gridColor;
        ordersChart.options.scales.y.ticks.color = textColor;
        ordersChart.options.scales.x.ticks.color = textColor;
        ordersChart.options.plugins.legend.labels.color = textColor;
        ordersChart.update();
    }
    if (statusChart) {
        statusChart.update();
    }
}
</script>
@endpush