<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::allAsArray();
        $layanans = Layanan::orderBy('id')->get();

        return view('settings.index', compact('settings', 'layanans'));
    }

    // ── Simpan info barbershop ────────────────────────────────────────────
    public function updateInfo(Request $request)
    {
        $request->validate([
            'nama_toko'  => 'required|string|max:100',
            'alamat'     => 'required|string|max:255',
            'no_telp'    => 'required|string|max:20',
            'jam_buka'   => 'required',
            'jam_tutup'  => 'required',
            'hari_buka'  => 'required|string|max:100',
        ]);

        $keys = ['nama_toko', 'alamat', 'no_telp', 'jam_buka', 'jam_tutup', 'hari_buka'];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return back()->with('success_info', 'Informasi barbershop berhasil disimpan.');
    }

    // ── CRUD Layanan ──────────────────────────────────────────────────────
    public function storeLayanan(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:100',
            'harga'        => 'required|integer|min:0',
            'durasi_menit' => 'required|integer|min:1',
        ]);

        Layanan::create([
            'nama'         => $request->nama,
            'harga'        => $request->harga,
            'durasi_menit' => $request->durasi_menit,
            'aktif'        => true,
        ]);

        return back()->with('success_layanan', 'Layanan berhasil ditambahkan.');
    }

    public function updateLayanan(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama'         => 'required|string|max:100',
            'harga'        => 'required|integer|min:0',
            'durasi_menit' => 'required|integer|min:1',
        ]);

        $layanan->update([
            'nama'         => $request->nama,
            'harga'        => $request->harga,
            'durasi_menit' => $request->durasi_menit,
        ]);

        return back()->with('success_layanan', 'Layanan berhasil diperbarui.');
    }

    public function toggleLayanan(Layanan $layanan)
    {
        $layanan->update(['aktif' => !$layanan->aktif]);
        return back()->with('success_layanan', 'Status layanan diperbarui.');
    }

    public function destroyLayanan(Layanan $layanan)
    {
        $layanan->delete();
        return back()->with('success_layanan', 'Layanan berhasil dihapus.');
    }

    // ── Simpan pengaturan tampilan ────────────────────────────────────────
    public function updateTampilan(Request $request)
    {
        $request->validate([
            'tema_warna' => 'required|in:green,blue,maroon,purple,slate',
            'bahasa'     => 'required|in:id,en',
        ]);

        Setting::set('tema_warna', $request->tema_warna);
        Setting::set('bahasa',     $request->bahasa);

        return back()->with('success_tampilan', 'Pengaturan tampilan berhasil disimpan.');
    }
}
