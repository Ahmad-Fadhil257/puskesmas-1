<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'kategori',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    public static function getKategoriList(): array
    {
        return [
            'Umum & Pendaftaran',
            'BPJS & Jaminan Kesehatan',
            'Pelayanan Medis & Poli',
            'UGD & Rujukan',
            'Laboratorium & Farmasi',
        ];
    }
}
