<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NilaiSection;

class NilaiSectionSeeder extends Seeder
{
    public function run(): void
    {
        NilaiSection::firstOrCreate(
            ['id' => 1],
            [
                'badge_text'  => 'NILAI - NILAI KAMI',
                'title'       => 'Berdedikasi pada Keunggulan dalam Layanan Kesehatan melalui Kemitraan Terpercaya',
                'logo_1'      => null,
                'logo_1_name' => 'BPJS Kesehatan',
                'logo_2'      => null,
                'logo_2_name' => 'Kementerian Kesehatan Republik Indonesia',
                'logo_3'      => null,
                'logo_3_name' => 'Mitra Kesehatan Puskesmas',
                'is_active'   => true,
            ]
        );
    }
}
