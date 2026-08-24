<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';

    protected $fillable = [
        'alamat',
        'email',
        'telepon',
    ];

    public static function data(): self
    {
        return static::firstOrCreate([], [
            'alamat' => '',
            'email' => '',
            'telepon' => '',
        ]);
    }

    public function getWaLinkAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->telepon);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return 'https://api.whatsapp.com/send?phone=' . $phone;
    }
}
