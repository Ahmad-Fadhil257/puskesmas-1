<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $table = 'infografis';

    protected $fillable = [
        'title',
        'kategori',
        'deskripsi',
        'image_path',
        'thumbnail_path',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope hanya yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * URL gambar infografis (fallback ke placeholder jika null).
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('assets/images/infografis-placeholder.svg');
        }
        return asset($this->image_path);
    }

    /**
     * URL thumbnail (fallback ke image_path atau placeholder).
     */
    public function getThumbnailUrlAttribute(): string
    {
        $path = $this->thumbnail_path ?? $this->image_path;
        if (empty($path)) {
            return asset('assets/images/infografis-placeholder.svg');
        }
        return asset($path);
    }
}
