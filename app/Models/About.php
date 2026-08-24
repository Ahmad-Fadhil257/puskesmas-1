<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    protected $fillable = [
        'badge_label',
        'title',
        'description',
        'image_main',
        'image_accent',
        'visi_title',
        'visi_text',
        'misi_title',
        'misi_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * URL Foto Utama (image_main)
     */
    public function getImageMainUrlAttribute()
    {
        if (empty($this->image_main)) {
            return asset('assets/about/about-1.jpg');
        }

        if (Str::startsWith($this->image_main, ['http://', 'https://'])) {
            return $this->image_main;
        }

        if (file_exists(public_path($this->image_main))) {
            return asset($this->image_main);
        }

        if (file_exists(public_path('uploads/about/' . basename($this->image_main)))) {
            return asset('uploads/about/' . basename($this->image_main));
        }

        return asset('assets/about/about-1.jpg');
    }

    /**
     * URL Foto Aksen (image_accent)
     */
    public function getImageAccentUrlAttribute()
    {
        if (empty($this->image_accent)) {
            return asset('assets/about/about-2.jpg');
        }

        if (Str::startsWith($this->image_accent, ['http://', 'https://'])) {
            return $this->image_accent;
        }

        if (file_exists(public_path($this->image_accent))) {
            return asset($this->image_accent);
        }

        if (file_exists(public_path('uploads/about/' . basename($this->image_accent)))) {
            return asset('uploads/about/' . basename($this->image_accent));
        }

        return asset('assets/about/about-2.jpg');
    }

    /**
     * Helper fallback singleton data
     */
    public static function getActive()
    {
        return static::where('is_active', true)->first() ?: static::firstOrCreate([], [
            'badge_label' => 'Tentang Kami',
            'title' => 'Puskesmas CareLink Menciptakan Pelayanan Aman, Kesehatan Adalah Prioritas Kami',
            'description' => 'Puskesmas CareLink menyediakan layanan kesehatan berkualitas tinggi dengan dokter berpengalaman, layanan gawat darurat, dan dukungan sepanjang waktu. Mitra tepercaya Anda untuk hidup yang lebih sehat.',
            'image_main' => null,
            'image_accent' => null,
            'visi_title' => 'Visi Kami',
            'visi_text' => 'Menjadi pemimpin tepercaya dalam layanan kesehatan yang berkualitas, mudah diakses, dan penuh kepedulian.',
            'misi_title' => 'Misi Kami',
            'misi_text' => 'CareLink menghadirkan layanan ahli yang berfokus pada pasien, didukung oleh teknologi canggih dan layanan 24/7, serta berorientasi pada kesehatan dan kesejahteraan.',
            'is_active' => true,
        ]);
    }
}
