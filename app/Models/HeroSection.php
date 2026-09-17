<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $table = 'hero_sections';

    protected $fillable = [
        'badge_text',
        'title',
        'description',
        'btn_primary_text',
        'btn_primary_link',
        'btn_secondary_text',
        'btn_secondary_link',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
    ];

    /**
     * Helper accessor untuk mendapatkan URL foto 1
     */
    public function getImage1UrlAttribute(): string
    {
        if ($this->image_1 && file_exists(public_path($this->image_1))) {
            return asset($this->image_1);
        }
        return asset('assets/hero/image 5.png');
    }

    /**
     * Helper accessor untuk mendapatkan URL foto 2
     */
    public function getImage2UrlAttribute(): string
    {
        if ($this->image_2 && file_exists(public_path($this->image_2))) {
            return asset($this->image_2);
        }
        return asset('assets/hero/image 6.png');
    }

    /**
     * Helper accessor untuk mendapatkan URL foto 3
     */
    public function getImage3UrlAttribute(): string
    {
        if ($this->image_3 && file_exists(public_path($this->image_3))) {
            return asset($this->image_3);
        }
        return asset('assets/hero/image 4.png');
    }

    /**
     * Helper accessor untuk mendapatkan URL foto 4
     */
    public function getImage4UrlAttribute(): string
    {
        if ($this->image_4 && file_exists(public_path($this->image_4))) {
            return asset($this->image_4);
        }
        return asset('assets/hero/image 1.png');
    }
}
