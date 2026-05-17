<?php

namespace Database\Seeders;

use App\Models\Available;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin12345',
            'email'    => 'admin@pixelbarbershop.com',
            'password' => Hash::make('password'),
        ]);

        $karyawans = [
            ['nama' => 'DADANG',          'no_handphone' => '087212131684', 'profesi' => 'Senior Barber'],
            ['nama' => 'ABDUL',           'no_handphone' => '081234567890', 'profesi' => 'Junior Barber'],
            ['nama' => 'ASEP',            'no_handphone' => '089876543210', 'profesi' => 'Senior Barber'],
            ['nama' => 'Arbi',            'no_handphone' => '089876543210', 'profesi' => 'Barber Trainee'],
            ['nama' => 'Faza', 'no_handphone' => '081111222233', 'profesi' => 'Owner'],
            ['nama' => 'Alfi', 'no_handphone' => '081111222234', 'profesi' => 'Cleaning Staff'],
            ['nama' => 'Robi', 'no_handphone' => '081111222233', 'profesi' => 'Admin'],
            ['nama' => 'Romay', 'no_handphone' => '081111222233', 'profesi' => 'Cashier'],
        ];

        foreach ($karyawans as $data) {
            $karyawan = Karyawan::create($data);
            Available::create([
                'karyawan_id' => $karyawan->id,
                'status'      => 'available',
            ]);
        }
    }
}
