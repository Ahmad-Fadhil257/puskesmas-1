<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'logo',
        'show_app_name',
        'phone',
        'email',
        'address',
        'landmark',
        'maps_iframe_url',
        'maps_link',
        'operational_days',
        'operational_hours',
        'emergency_info',
        'show_operational_hours',
    ];

    protected function casts(): array
    {
        return [
            'show_app_name' => 'boolean',
            'show_operational_hours' => 'boolean',
        ];
    }

    /**
     * URL Iframe Embed Google Maps dengan fallback otomatis
     */
    public function getEmbedMapUrlAttribute(): string
    {
        if (!empty($this->maps_iframe_url)) {
            // Jika user memasukkan iframe tag utuh, ekstrak URL src-nya
            if (preg_match('/src="([^"]+)"/', $this->maps_iframe_url, $match)) {
                return $match[1];
            }
            return $this->maps_iframe_url;
        }

        $addressQuery = urlencode($this->address ?? 'Puskesmas');
        return "https://maps.google.com/maps?q={$addressQuery}&t=&z=16&ie=UTF8&iwloc=&output=embed";
    }

    /**
     * URL Direct Google Maps untuk tombol navigasi
     */
    public function getDirectMapsLinkAttribute(): string
    {
        if (!empty($this->maps_link)) {
            return $this->maps_link;
        }
        $addressQuery = urlencode($this->address ?? 'Puskesmas');
        return "https://maps.google.com/?q={$addressQuery}";
    }

    /**
     * URL Gambar Logo dengan fallback default
     */
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo && file_exists(public_path('uploads/logo/' . $this->logo))) {
            return asset('uploads/logo/' . $this->logo);
        }

        if (file_exists(public_path('assets/logo/logo-puskesmas.png'))) {
            return asset('assets/logo/logo-puskesmas.png');
        }

        return asset('admin-assets/img/favicon/favicon.ico');
    }

    /**
     * Singleton instance helper
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'app_name' => 'Puskesmas',
                'show_app_name' => true,
                'phone' => '(021) 555-0123',
                'email' => 'info@puskesmas.go.id',
                'address' => 'Jl. Kesehatan No. 123, Jakarta Selatan, 12345',
            ]
        );
    }

    /**
     * WhatsApp link dari nomor telepon
     */
    public function getWaLinkAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return 'https://api.whatsapp.com/send?phone=' . $phone;
    }
}
