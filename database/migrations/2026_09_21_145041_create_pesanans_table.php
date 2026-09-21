<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->string('kode_pesanan')->unique(); // Contoh: PSN-001
            $table->string('jenis_pesanan'); // Custom / Standar
            $table->string('nama_produk'); // Nama mesin kopi
            $table->text('deskripsi')->nullable(); // Detail pesanan
            $table->decimal('harga', 12, 2); // Harga total
            $table->integer('jumlah')->default(1);
            $table->enum('status', ['pending', 'menunggu_dp', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_pesan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};