<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'photo',
        'jadwal_praktek',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'jadwal_praktek' => 'array',
        ];
    }

    /**
     * Scope a query to only include active doctors.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor URL foto dokter yang aman
     */
    public function getPhotoUrlAttribute(): string
    {
        if (empty($this->photo)) {
            return asset('assets/dokter/dokter_john.png');
        }

        if (\Illuminate\Support\Str::startsWith($this->photo, ['http://', 'https://'])) {
            return $this->photo;
        }

        if (file_exists(public_path($this->photo))) {
            return asset($this->photo);
        }

        if (file_exists(public_path('storage/' . $this->photo))) {
            return asset('storage/' . $this->photo);
        }

        return asset($this->photo);
    }
}
