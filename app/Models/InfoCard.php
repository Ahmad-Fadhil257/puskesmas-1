<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoCard extends Model
{
    use HasFactory;

    protected $table = 'info_cards';

    protected $fillable = [
        'urutan',
        'icon',
        'title',
        'description',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'urutan' => 'integer',
    ];
}
