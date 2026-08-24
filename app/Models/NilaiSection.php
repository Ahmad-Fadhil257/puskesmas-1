<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSection extends Model
{
    use HasFactory;

    protected $table = 'nilai_sections';

    protected $fillable = [
        'badge_text',
        'title',
        'logo_1',
        'logo_1_name',
        'logo_2',
        'logo_2_name',
        'logo_3',
        'logo_3_name',
        'is_active',
    ];

    /**
     * URL Foto Logo 1
     */
    public function getLogo1UrlAttribute(): string
    {
        if ($this->logo_1 && file_exists(public_path($this->logo_1))) {
            return asset($this->logo_1);
        }
        return asset('assets/nilai-nilai/logo-bpjs.png');
    }

    /**
     * URL Foto Logo 2
     */
    public function getLogo2UrlAttribute(): string
    {
        if ($this->logo_2 && file_exists(public_path($this->logo_2))) {
            return asset($this->logo_2);
        }
        return asset('assets/nilai-nilai/logo-kemenkes.png');
    }

    /**
     * URL Foto Logo 3
     */
    public function getLogo3UrlAttribute(): string
    {
        if ($this->logo_3 && file_exists(public_path($this->logo_3))) {
            return asset($this->logo_3);
        }
        return asset('assets/nilai-nilai/logo-puskesmas.png');
    }
}
