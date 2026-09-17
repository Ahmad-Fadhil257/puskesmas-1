<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $tahun
 * @property int $bulan
 * @property string $bulan_label
 * @property int $jumlah_kunjungan
 * @property int $kunjungan_baru
 * @property int $kunjungan_lama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class StatistikKunjungan extends Model
{
    use HasFactory;

    protected $table = 'statistik_kunjungan';

    protected $fillable = [
        'tahun',
        'bulan',
        'bulan_label',
        'jumlah_kunjungan',
        'kunjungan_baru',
        'kunjungan_lama',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'bulan' => 'integer',
        'jumlah_kunjungan' => 'integer',
        'kunjungan_baru' => 'integer',
        'kunjungan_lama' => 'integer',
    ];

    /** Scope filter by tahun */
    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /** Ambil tahun-tahun yang tersedia */
    public static function availableTahun()
    {
        return static::distinct()->orderBy('tahun', 'desc')->pluck('tahun');
    }

    /** Total kunjungan dalam satu tahun */
    public static function totalByTahun($tahun): int
    {
        return (int) static::where('tahun', $tahun)->sum('jumlah_kunjungan');
    }
}
