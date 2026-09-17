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
                'name'      => 'dr. Muhammad Arsyi, Sp.JP-FIHA',
                'specialty' => 'Spesialis Jantung dan Pembuluh Darah',
                'photo'     => 'assets/dokter/dokter_john.png',
                'is_active' => true,
                'jadwal_praktek' => [
                    ['hari' => 'Rabu',  'jam' => '08:30 - 12:00'],
                    ['hari' => 'Kamis', 'jam' => '08:30 - 12:00'],
                    ['hari' => 'Sabtu', 'jam' => '08:30 - 12:00'],
                ],
            ],
            [
                'name'      => 'dr. Sarah Johnson, Sp.B',
                'specialty' => 'Spesialis Bedah Umum',
                'photo'     => 'assets/dokter/dokter_sarah.png',
                'is_active' => true,
                'jadwal_praktek' => [
                    ['hari' => 'Senin', 'jam' => '09:00 - 12:00'],
                    ['hari' => 'Rabu',  'jam' => '09:00 - 12:00'],
                    ['hari' => 'Jumat', 'jam' => '09:00 - 12:00'],
                ],
            ],
            [
                'name'      => 'dr. Michael Lee, Sp.A',
                'specialty' => 'Spesialis Anak',
                'photo'     => 'assets/dokter/dokter_michael.png',
                'is_active' => true,
                'jadwal_praktek' => [
                    ['hari' => 'Selasa', 'jam' => '08:00 - 11:00'],
                    ['hari' => 'Kamis',  'jam' => '08:00 - 11:00'],
                    ['hari' => 'Sabtu',  'jam' => '08:00 - 11:00'],
                ],
            ],
            [
                'name'      => 'dr. Emily Davis, Sp.OG',
                'specialty' => 'Spesialis Kandungan',
                'photo'     => 'assets/dokter/dokter_emily.png',
                'is_active' => true,
                'jadwal_praktek' => [
                    ['hari' => 'Senin', 'jam' => '10:00 - 13:00'],
                    ['hari' => 'Rabu',  'jam' => '10:00 - 13:00'],
                    ['hari' => 'Jumat', 'jam' => '10:00 - 13:00'],
                ],
            ],
        ];

        foreach ($dokters as $data) {
            Dokter::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
