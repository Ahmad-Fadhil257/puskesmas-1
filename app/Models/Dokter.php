<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

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

    /**
     * Mengembalikan jadwal praktik dalam format teks per baris (untuk textarea admin)
     */
    public function getJadwalLinesAttribute(): string
    {
        if (empty($this->jadwal_praktek) || !is_array($this->jadwal_praktek)) {
            return is_string($this->jadwal_praktek) ? $this->jadwal_praktek : '';
        }

        return collect($this->jadwal_praktek)->map(function ($j) {
            if (is_array($j)) {
                $hari = $j['hari'] ?? '';
                $jam = $j['jam'] ?? (($j['jam_mulai'] ?? '') . (!empty($j['jam_selesai']) ? ' - ' . $j['jam_selesai'] : ''));
                return trim($hari . ($jam ? ' : ' . $jam : ''));
            }
            return is_string($j) ? $j : '';
        })->filter()->implode("\n");
    }

    /**
     * Mengembalikan jadwal praktik dalam format string ringkas (untuk tampilan detail / card)
     */
    public function getFormattedJadwalAttribute(): string
    {
        if (empty($this->jadwal_praktek) || !is_array($this->jadwal_praktek)) {
            return is_string($this->jadwal_praktek) ? $this->jadwal_praktek : '';
        }

        return collect($this->jadwal_praktek)->map(function ($j) {
            if (is_array($j)) {
                $hari = $j['hari'] ?? '';
                $jam = $j['jam'] ?? (($j['jam_mulai'] ?? '') . (!empty($j['jam_selesai']) ? ' - ' . $j['jam_selesai'] : ''));
                return trim($hari . ($jam ? ' (' . $jam . ')' : ''));
            }
            return is_string($j) ? $j : '';
        })->filter()->take(3)->implode(', ');
    }
}
