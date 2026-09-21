<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $pesanans = Pesanan::with('user')->latest()->paginate(10);
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Form tambah pesanan
    public function create()
    {
        $users = User::where('role', 'buyer')->get();
        return view('admin.pesanan.create', compact('users'));
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_pesanan' => 'required|in:Custom,Standar',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:pending,menunggu_dp,diproses,dikirim,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        // Generate kode pesanan otomatis (PSN-001, PSN-002, dst)
        $lastPesanan = Pesanan::latest()->first();
        $lastNumber = $lastPesanan ? intval(substr($lastPesanan->kode_pesanan, 4)) : 0;
        $validated['kode_pesanan'] = 'PSN-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        Pesanan::create($validated);

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Tampilkan detail pesanan
    public function show(Pesanan $pesanan)
    {
        return view('admin.pesanan.show', compact('pesanan'));
    }

    // Form edit pesanan
    public function edit(Pesanan $pesanan)
    {
        $users = User::where('role', 'buyer')->get();
        return view('admin.pesanan.edit', compact('pesanan', 'users'));
    }

    // Update pesanan
    public function update(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_pesanan' => 'required|in:Custom,Standar',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:pending,menunggu_dp,diproses,dikirim,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $pesanan->update($validated);

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil diupdate!');
    }

    // Hapus pesanan
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}