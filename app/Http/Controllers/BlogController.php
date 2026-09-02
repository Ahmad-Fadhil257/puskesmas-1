<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Menampilkan katalog seluruh berita & artikel kesehatan
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $query = Article::published();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        $articles = $query->paginate(10)->withQueryString();

        // Ambil daftar kategori unik
        $categories = Article::published()->distinct()->pluck('category')->filter()->values();

        // Artikel populer untuk sidebar / banner rekomendasi
        $popularArticles = Article::published()
            ->orderBy('views_count', 'desc')
            ->take(4)
            ->get();

        return view('blog.index', compact('articles', 'categories', 'search', 'category', 'popularArticles'));
    }

    /**
     * Menampilkan detail satu artikel
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Increment jumlah views secara aman
        $article->increment('views_count');

        // Artikel terkait: utamakan kategori yang sama persis dengan yang sedang dibaca (maks 6 artikel)
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Jika artikel dalam kategori yang sama kurang dari 6, tambahkan artikel published lainnya hingga total 6
        if ($relatedArticles->count() < 6) {
            $additional = Article::published()
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->orderBy('published_at', 'desc')
                ->take(6 - $relatedArticles->count())
                ->get();
            $relatedArticles = $relatedArticles->merge($additional);
        }

        return view('blog.show', compact('article', 'relatedArticles'));
    }
}
