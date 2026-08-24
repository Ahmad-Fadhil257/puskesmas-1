<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'variant',
        'btn_text',
        'btn_link',
        'is_active',
    ];

    /**
     * Helper accessor untuk ikon
     */
    public function getIconHtmlAttribute(): string
    {
        $iconClass = $this->icon ?? 'bx bx-plus-medical';
        return '<i class="' . e($iconClass) . '"></i>';
    }
}
