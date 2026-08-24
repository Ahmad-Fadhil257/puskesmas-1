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
    ];

    protected function casts(): array
    {
        return [
            'show_app_name' => 'boolean',
        ];
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
}
