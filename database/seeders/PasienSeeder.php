<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pasien;
use App\Models\RumahSakit;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rumahSakitIds = RumahSakit::pluck('id')->toArray(); // Mengambil ID rumah sakit

        Pasien::create([
            'nama' => 'John Doe',
            'alamat' => 'Jl. Example No.10, Jakarta',
            'no_telepon' => '081234567890',
            'rumah_sakit_id' => $rumahSakitIds[array_rand($rumahSakitIds)],
        ]);

        Pasien::create([
            'nama' => 'Jane Smith',
            'alamat' => 'Jl. Contoh No.5, Bandung',
            'no_telepon' => '082345678901',
            'rumah_sakit_id' => $rumahSakitIds[array_rand($rumahSakitIds)],
        ]);

        Pasien::create([
            'nama' => 'Michael Johnson',
            'alamat' => 'Jl. Tes No.7, Surabaya',
            'no_telepon' => '083456789012',
            'rumah_sakit_id' => $rumahSakitIds[array_rand($rumahSakitIds)],
        ]);

        Pasien::create([
            'nama' => 'Sarah Williams',
            'alamat' => 'Jl. Merdeka No.3, Yogyakarta',
            'no_telepon' => '084567890123',
            'rumah_sakit_id' => $rumahSakitIds[array_rand($rumahSakitIds)],
        ]);

        Pasien::create([
            'nama' => 'David Brown',
            'alamat' => 'Jl. Raya No.2, Semarang',
            'no_telepon' => '085678901234',
            'rumah_sakit_id' => $rumahSakitIds[array_rand($rumahSakitIds)], 
        ]);
    }
}
