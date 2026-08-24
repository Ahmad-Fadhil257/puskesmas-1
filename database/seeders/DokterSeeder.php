<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            [
                'name'      => 'Dr. John Smith',
                'specialty' => 'Ahli Jantung',
                'photo'     => 'assets/dokter/dokter_john.png',
                'is_active' => true,
                'order'     => 1,
            ],
            [
                'name'      => 'Dr. Sarah Johnson',
                'specialty' => 'Dokter Bedah Ortopedi',
                'photo'     => 'assets/dokter/dokter_sarah.png',
                'is_active' => true,
                'order'     => 2,
            ],
            [
                'name'      => 'Dr. Michael Lee',
                'specialty' => 'Dokter Spesialis Anak',
                'photo'     => 'assets/dokter/dokter_michael.png',
                'is_active' => true,
                'order'     => 3,
            ],
            [
                'name'      => 'Dr. Emily Davis',
                'specialty' => 'Ginekolog',
                'photo'     => 'assets/dokter/dokter_emily.png',
                'is_active' => true,
                'order'     => 4,
            ],
        ];

        foreach ($dokters as $data) {
            Dokter::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
