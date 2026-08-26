<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const PAGES = [
        'hero'       => 'Kelola Hero & Fitur',
        'layanan'    => 'Kelola Layanan',
        'articles'   => 'Kelola Berita & Info',
        'cara-kerja' => 'Kelola Cara Kerja',
        'dokter'     => 'Kelola Dokter',
        'about'      => 'Kelola Tentang Kami',
        'nilai'      => 'Kelola Nilai & Mitra',
        'surveys'    => 'Survei & Testimoni',
        'users'      => 'Kelola Pengguna',
        'settings'   => 'Identitas & Logo',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'phone',
        'avatar',
        'accessible_pages',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'accessible_pages' => 'array',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staf';
    }

    public function canAccessPage(string $page): bool
    {
        if ($this->isAdmin()) {
            return true;
        }
        return in_array($page, $this->accessible_pages ?? []);
    }

    public function getAccessiblePageKeys(): array
    {
        if ($this->isAdmin()) {
            return array_keys(self::PAGES);
        }
        return $this->accessible_pages ?? [];
    }
}
