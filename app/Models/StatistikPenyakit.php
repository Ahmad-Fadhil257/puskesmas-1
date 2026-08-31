<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikPenyakit extends Model
{
    use HasFactory;

    protected $table = 'statistik_penyakit';

    protected $fillable = [
        'nama_penyakit',
        'jumlah_kasus',
        'kode_icd',
        'warna',
        'urutan',
        'tahun',
        'bulan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'jumlah_kasus' => 'integer',
        'tahun' => 'integer',
        'bulan' => 'integer',
        'urutan' => 'integer',
    ];

    /** Scope hanya data aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Scope filter by tahun */
    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /** Scope filter by bulan (null = tahunan) */
    public function scopeByBulan($query, $bulan = null)
    {
        return $bulan ? $query->where('bulan', $bulan) : $query->whereNull('bulan');
    }

    /** Ambil tahun-tahun yang tersedia */
    public static function availableTahun()
    {
        return static::distinct()->orderBy('tahun', 'desc')->pluck('tahun');
    }

    /** Warna default pastel jika belum di-set */
    public function getWarnaDisplayAttribute(): string
    {
        return $this->warna ?? '#2DD4BF';
    }
}
