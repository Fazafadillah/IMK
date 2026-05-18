<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Info Barbershop
        $settings = [
            'nama_toko'    => 'Pixel Barbershop',
            'alamat'       => 'Jl. Contoh No. 123, Kota',
            'no_telp'      => '08123456789',
            'jam_buka'     => '09:00',
            'jam_tutup'    => '21:00',
            'hari_buka'    => 'Senin - Sabtu',
            'tema_warna'   => 'green',
            'bahasa'       => 'id',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // Layanan default
        $layanans = [
            ['nama' => 'Haircut',         'harga' => 35000,  'durasi_menit' => 30],
            ['nama' => 'Shave',           'harga' => 25000,  'durasi_menit' => 20],
            ['nama' => 'Haircut + Shave', 'harga' => 55000,  'durasi_menit' => 45],
            ['nama' => 'Hair Coloring',   'harga' => 150000, 'durasi_menit' => 90],
            ['nama' => 'Hair Treatment',  'harga' => 75000,  'durasi_menit' => 60],
        ];

        foreach ($layanans as $data) {
            Layanan::create($data);
        }
    }
}
