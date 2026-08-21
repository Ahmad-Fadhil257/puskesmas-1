<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaraKerja extends Model
{
    use HasFactory;

    protected $table = 'cara_kerja';

    protected $fillable = [
        'urutan',
        'judul',
        'deskripsi',
    ];
}
