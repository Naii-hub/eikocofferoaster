@extends('layouts.admin')

@section('title', 'Tambah Pesanan')
@section('page-title', 'Tambah Pesanan Baru')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <div class="glass-card rounded-xl p-8 shadow-lg">
        <form action="{{ route('admin.pesanan.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pilih Pelanggan -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pelanggan</label>
                    <select name="user_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('user_id') border-red-500 @enderror">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Jenis Pesanan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Pesanan</label>
                    <select name="jenis_pesanan" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('jenis_pesanan') border-red-500 @enderror">
                        <option value="Standar" {{ old('jenis_pesanan') == 'Standar' ? 'selected' : '' }}>Standar</option>
                        <option value="Custom" {{ old('jenis_pesanan') == 'Custom' ? 'selected' : '' }}>Custom</option>
                    </select>
                    @error('jenis_pesanan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Produk -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Produk / Mesin</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('nama_produk') border-red-500 @enderror" placeholder="Contoh: Mesin Espresso Breville">
                    @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga Total (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('harga') border-red-500 @enderror" placeholder="0">
                    @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Jumlah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Unit</label>
                    <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('jumlah') border-red-500 @enderror">
                    @error('jumlah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pesanan</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="menunggu_dp" {{ old('status') == 'menunggu_dp' ? 'selected' : '' }}>Menunggu DP</option>
                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi / Catatan Khusus</label>
                    <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-coffee-500 focus:border-coffee-500 @error('deskripsi') border-red-500 @enderror" placeholder="Detail spesifikasi custom, dll...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.pesanan.index') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-coffee-600 text-white rounded-lg hover:bg-coffee-700 transition-colors shadow-md">
                    Simpan Pesanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection