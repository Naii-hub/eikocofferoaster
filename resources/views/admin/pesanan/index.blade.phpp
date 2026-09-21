@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')
@section('page-title', 'Pesanan')
@section('page-subtitle', 'Kelola semua pesanan mesin kopi')

@section('content')
<div class="animate-fade-in">
    <!-- Header & Tombol Tambah -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Daftar Pesanan</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total {{ $pesanans->total() }} pesanan</p>
        </div>
        <a href="{{ route('admin.pesanan.create') }}" class="bg-coffee-600 hover:bg-coffee-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors shadow-md">
            <i class="fas fa-plus"></i> Tambah Pesanan
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Pesanan -->
    <div class="glass-card rounded-xl overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($pesanans as $pesanan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-coffee-600 dark:text-coffee-400">
                            {{ $pesanan->kode_pesanan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $pesanan->user->name ?? 'User Dihapus' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            <div class="flex flex-col">
                                <span>{{ $pesanan->nama_produk }}</span>
                                <span class="text-xs text-gray-400">{{ $pesanan->jenis_pesanan }} (x{{ $pesanan->jumlah }})</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($pesanan->harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-gray-100 text-gray-800',
                                    'menunggu_dp' => 'bg-yellow-100 text-yellow-800',
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'dikirim' => 'bg-purple-100 text-purple-800',
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                ];
                                $color = $statusColors[$pesanan->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                            <i class="fas fa-box-open text-4xl mb-3 opacity-50"></i>
                            <p>Belum ada data pesanan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            {{ $pesanans->links() }}
        </div>
    </div>
</div>
@endsection