<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RumahSakit;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        RumahSakit::create([
            'nama' => 'RSU A',
            'alamat' => 'Jl. A No.1, Jakarta',
            'email' => 'contact@rsua.com',
            'telepon' => '0211234567',
        ]);

        RumahSakit::create([
            'nama' => 'RSU B',
            'alamat' => 'Jl. B No.2, Jakarta',
            'email' => 'contact@rsub.com',
            'telepon' => '0212345678',
        ]);

        RumahSakit::create([
            'nama' => 'RSU C',
            'alamat' => 'Jl. C No.3, Jakarta',
            'email' => 'contact@rsuc.com',
            'telepon' => '0213456789',
        ]);

        RumahSakit::create([
            'nama' => 'RSU D',
            'alamat' => 'Jl. D No.4, Jakarta',
            'email' => 'contact@rsud.com',
            'telepon' => '0214567890',
        ]);

        RumahSakit::create([
            'nama' => 'RSU E',
            'alamat' => 'Jl. E No.5, Jakarta',
            'email' => 'contact@rsoe.com',
            'telepon' => '0215678901',
        ]);
    }
}
