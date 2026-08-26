<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'surveys';

    protected $fillable = [
        'name',
        'email_or_phone',
        'poli_name',
        'rating',
        'pesan',
        'avatar',
        'is_approved',
        'is_featured',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'rating'      => 'integer',
    ];

    /**
     * Scope untuk data yang disetujui tampil di publik
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Accessor untuk avatar pasien
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && file_exists(public_path($this->avatar))) {
            return asset($this->avatar);
        }

        // Generate dynamic avatar based on name
        $name = urlencode($this->name ?? 'Pasien');
        return "https://ui-avatars.com/api/?name={$name}&background=0A5C45&color=ffffff&size=128&bold=true";
    }

    /**
     * Hitung rata-rata rating kepuasan (IKM Score)
     */
    public static function getAverageRating(): float
    {
        $avg = static::approved()->avg('rating');
        return $avg ? round($avg, 1) : 4.9;
    }

    /**
     * Hitung persentase kepuasan
     */
    public static function getSatisfactionPercentage(): int
    {
        $total = static::approved()->count();
        if ($total === 0) return 98;
        $satisfied = static::approved()->where('rating', '>=', 4)->count();
        return (int) round(($satisfied / $total) * 100);
    }
}
