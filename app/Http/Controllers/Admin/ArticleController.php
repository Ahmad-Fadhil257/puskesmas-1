<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Tampilkan daftar semua artikel di Dashboard Admin
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Article::query()->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('admin.articles.index', compact('articles', 'search'));
    }

    private function getCategoryList()
    {
        $defaults = ['Tips Kesehatan', 'Info Medis', 'Kesehatan Mental', 'Gizi & Nutrisi', 'Berita Klinik', 'Imunisasi & Anak'];
        $dbCats = Article::distinct()->pluck('category')->filter()->toArray();
        return array_values(array_unique(array_merge($defaults, $dbCats)));
    }

    /**
     * Form tambah artikel baru
     */
    public function create()
    {
        $categories = $this->getCategoryList();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Simpan artikel baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'author'       => 'required|string|max:150',
            'reading_time' => 'required|string|max:50',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_published' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/articles');
            
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $filename);
            $thumbnailPath = 'uploads/articles/' . $filename;
        }

        Article::create([
            'title'        => $validated['title'],
            'slug'         => $slug,
            'category'     => Str::title(trim($validated['category'])),
            'excerpt'      => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 160),
            'content'      => $validated['content'],
            'thumbnail'    => $thumbnailPath ?? 'assets/blog/blog-1.png',
            'author'       => $validated['author'],
            'reading_time' => $validated['reading_time'],
            'views_count'  => 0,
            'is_published' => $request->has('is_published'),
            'published_at' => now(),
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berita berhasil diterbitkan!');
    }

    /**
     * Form edit artikel
     */
    public function edit(Article $article)
    {
        $categories = $this->getCategoryList();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update artikel yang sudah ada
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'author'       => 'required|string|max:150',
            'reading_time' => 'required|string|max:50',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_published' => 'nullable|boolean',
        ]);

        $thumbnailPath = $article->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/articles');
            
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $filename);

            // Hapus file lama jika ada di uploads
            if ($article->thumbnail && Str::startsWith($article->thumbnail, 'uploads/') && file_exists(public_path($article->thumbnail))) {
                @unlink(public_path($article->thumbnail));
            }

            $thumbnailPath = 'uploads/articles/' . $filename;
        }

        $article->update([
            'title'        => $validated['title'],
            'category'     => Str::title(trim($validated['category'])),
            'excerpt'      => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 160),
            'content'      => $validated['content'],
            'thumbnail'    => $thumbnailPath,
            'author'       => $validated['author'],
            'reading_time' => $validated['reading_time'],
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berita berhasil diperbarui!');
    }

    /**
     * Hapus artikel
     */
    public function destroy(Article $article)
    {
        if ($article->thumbnail && Str::startsWith($article->thumbnail, 'uploads/') && file_exists(public_path($article->thumbnail))) {
            @unlink(public_path($article->thumbnail));
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berita berhasil dihapus!');
    }
}
