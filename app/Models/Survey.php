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

        // Generate fast inline SVG data URI avatar (0 network calls, 0 latency)
        $char = strtoupper(substr($this->name ?? 'P', 0, 1));
        return "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewBox='0 0 64 64'><circle cx='32' cy='32' r='32' fill='%230A5C45'/><text x='32' y='39' font-size='26' font-weight='bold' fill='white' text-anchor='middle' font-family='sans-serif'>{$char}</text></svg>";
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
