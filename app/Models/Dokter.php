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
}
