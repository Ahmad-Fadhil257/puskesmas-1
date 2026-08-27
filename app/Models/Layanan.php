<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $fillable = [
        'order',
        'title',
        'slug',
        'kategori',
        'description',
        'image',
        'icon',
        'custom_icon',
        'variant',
        'tipe_jaminan',
        'jam_operasional',
        'jadwal_pendaftaran',
        'dokter_ids',
        'tindakan_medis',
        'persyaratan',
        'btn_text',
        'btn_link',
        'is_active',
    ];

    protected static function booted()
    {
        static::saving(function ($layanan) {
            if (empty($layanan->slug) && !empty($layanan->title)) {
                $baseSlug = \Illuminate\Support\Str::slug($layanan->title);
                $slug = $baseSlug;
                $counter = 1;
                while (static::where('slug', $slug)->where('id', '!=', $layanan->id ?? 0)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }
                $layanan->slug = $slug;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'http')) {
                return $this->image;
            }
            if (file_exists(public_path('uploads/layanan/' . $this->image))) {
                return asset('uploads/layanan/' . $this->image);
            }
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
        }
        return asset('admin-assets/img/illustrations/man-with-laptop-light.png');
    }

    public static function getKategoriList(): array
    {
        return [
            'Rawat Jalan (BPJS & Umum)' => [
                'variant' => 'default',
                'badge'   => 'BPJS & UMUM',
            ],
            'Poli Unggulan (Spesialis)' => [
                'variant' => 'featured',
                'badge'   => 'POLI UNGGULAN',
            ],
            'Gawat Darurat (UGD 24 Jam)' => [
                'variant' => 'emergency',
                'badge'   => '24 JAM / GAWAT DARURAT',
            ],
            'Kesehatan Ibu & Anak (KIA)' => [
                'variant' => 'default',
                'badge'   => 'KIA & IMUNISASI',
            ],
            'Laboratorium & Diagnostik' => [
                'variant' => 'default',
                'badge'   => 'LABORATORIUM',
            ],
            'Farmasi & Apotek' => [
                'variant' => 'default',
                'badge'   => 'FARMASI & APOTEK',
            ],
            'Konsultasi Kesehatan' => [
                'variant' => 'default',
                'badge'   => 'KONSULTASI KESEHATAN',
            ],
        ];
    }

    protected $casts = [
        'dokter_ids' => 'array',
        'is_active'  => 'boolean',
    ];

    /**
     * Helper accessor untuk ikon
     */
    public function getIconHtmlAttribute(): string
    {
        if (!empty($this->custom_icon)) {
            return '<img src="' . asset($this->custom_icon) . '" alt="' . e($this->title) . '" class="layanan-custom-icon-img">';
        }
        $iconClass = $this->icon ?? 'bx bx-plus-medical';
        return '<i class="' . e($iconClass) . '"></i>';
    }

    /**
     * Mengambil koleksi model Dokter yang ditugaskan ke layanan ini
     */
    public function getDoktersAttribute()
    {
        if (empty($this->dokter_ids) || !is_array($this->dokter_ids)) {
            return collect();
        }
        return Dokter::whereIn('id', $this->dokter_ids)->where('is_active', true)->get();
    }

    /**
     * Memecah string tindakan_medis menjadi array daftar tindakan
     */
    public function getTindakanListAttribute(): array
    {
        if (empty($this->tindakan_medis)) {
            return [];
        }
        $items = preg_split('/[,\n\r]+/', $this->tindakan_medis);
        return array_values(array_filter(array_map('trim', $items)));
    }
}
