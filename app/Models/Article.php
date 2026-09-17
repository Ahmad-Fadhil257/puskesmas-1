<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'thumbnail',
        'author',
        'reading_time',
        'views_count',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count'  => 'integer',
    ];

    /**
     * Boot helper untuk auto generate slug jika belum ada
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if (empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    /**
     * Scope untuk artikel yang dipublikasikan
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now())
                     ->orderBy('published_at', 'desc');
    }

    /**
     * Helper URL Thumbnail yang aman
     */
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return asset('assets/blog/blog-1.png');
        }

        if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
            return $this->thumbnail;
        }

        if (file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        }

        if (file_exists(public_path('storage/' . $this->thumbnail))) {
            return asset('storage/' . $this->thumbnail);
        }

        return asset($this->thumbnail);
    }

    /**
     * Format tanggal bahasa Indonesia
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->translatedFormat('d F Y') : $this->created_at->translatedFormat('d F Y');
    }
}
