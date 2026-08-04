<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function pustaka(Request $request)
    {
        return $this->renderPustaka($request);
    }

    public function pustakaByCategory(Request $request, string $slug)
    {
        $tab = $request->query('tab', 'blog');
        $request->merge([
            'tab' => $tab,
            'kategori' => $slug,
        ]);

        return $this->renderPustaka($request);
    }

    private function renderPustaka(Request $request)
    {
        $activeTab      = $request->query('tab', 'ebook');
        $activeCategory = $request->query('kategori');

        // Peta jenis konten → kelas model
        $featuredClassMap = [
            'blog'  => \App\Models\Blog::class,
            'video' => \App\Models\Video::class,
            'ebook' => \App\Models\Ebook::class,
        ];

        $isAdmin = \Illuminate\Support\Facades\Auth::check()
            && \Illuminate\Support\Facades\Auth::user()->isAdmin();

        // Hitung untuk KETIGA jenis konten sekaligus, bukan hanya tab aktif.
        // Ini memastikan blade selalu punya data lengkap untuk semua panel
        // karena ketiga panel dirender bersamaan di DOM (x-show, bukan x-if).
        $featuredModes     = [];  // ['blog' => 'terbaru', 'video' => 'unggulan', ...]
        $featuredIds       = [];  // ['blog' => [4, 2], 'video' => [1], ...]
        $featuredSelecting = [];  // ['blog' => false, 'video' => true, ...]

        foreach ($featuredClassMap as $key => $class) {
            $featuredModes[$key] = \App\Models\SiteSetting::getValue(
                'beranda_mode_' . $key, 'terbaru'
            );

            $featuredIds[$key] = \App\Models\FeaturedItem::where('featurable_type', $class)
                ->orderBy('position')
                ->pluck('featurable_id')
                ->all();

            // true hanya bila admin DAN mode jenis ini sudah 'unggulan'
            $featuredSelecting[$key] = $featuredModes[$key] === 'unggulan' && $isAdmin;
        }

        $blogsQuery  = Blog::with('categories')->latest();
        $videosQuery = Video::with('categories')->latest();
        $ebooksQuery = Ebook::with('categories')->latest();

        // Filter kategori dimatikan PER JENIS KONTEN yang sedang dalam mode
        // memilih unggulan. Pengunjung biasa ($isAdmin = false) selalu lolos
        // ke filter normal karena $featuredSelecting[$key] selalu false.
        if ($activeCategory) {
            if ($activeTab === 'blog' && ! $featuredSelecting['blog']) {
                $blogsQuery->whereHas('categories', function ($query) use ($activeCategory) {
                    $query->where('slug', $activeCategory);
                });
            } elseif ($activeTab === 'video' && ! $featuredSelecting['video']) {
                $videosQuery->whereHas('categories', function ($query) use ($activeCategory) {
                    $query->where('slug', $activeCategory);
                });
            } elseif ($activeTab === 'ebook' && ! $featuredSelecting['ebook']) {
                $ebooksQuery->whereHas('categories', function ($query) use ($activeCategory) {
                    $query->where('slug', $activeCategory);
                });
            }
        }

        $blogs      = $blogsQuery->get();
        $videos     = $videosQuery->get();
        $ebooks     = $ebooksQuery->get();
        $categories = Category::orderBy('name')->get();

        return view('pustaka.index', compact(
            'ebooks', 'videos', 'blogs', 'categories',
            'activeCategory', 'activeTab',
            'featuredModes', 'featuredIds', 'featuredSelecting'
        ));
    }
}
