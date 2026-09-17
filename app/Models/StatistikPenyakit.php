<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama_penyakit
 * @property int $jumlah_kasus
 * @property string|null $kode_icd
 * @property string|null $warna
 * @property int $urutan
 * @property int $tahun
 * @property int|null $bulan
 * @property bool $is_active
 * @property string $warna_display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
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
