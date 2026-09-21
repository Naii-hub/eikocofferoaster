<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_pesanan',
        'jenis_pesanan',
        'nama_produk',
        'deskripsi',
        'harga',
        'jumlah',
        'status',
        'catatan',
        'tanggal_pesan',
    ];

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'harga' => 'decimal:2',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}