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
        $request->merge([
            'tab' => 'blog',
            'kategori' => $slug,
        ]);

        return $this->renderPustaka($request);
    }

    private function renderPustaka(Request $request)
    {
        $ebooks = Ebook::latest()->get();
        $videos = Video::latest()->get();
        $categories = Category::orderBy('name')->get();
        $activeCategory = $request->query('kategori');

        $blogsQuery = Blog::with('categories')->latest();

        if ($activeCategory) {
            $blogsQuery->whereHas('categories', function ($query) use ($activeCategory) {
                $query->where('slug', $activeCategory);
            });
        }

        $blogs = $blogsQuery->get();

        return view('pustaka.index', compact('ebooks', 'videos', 'blogs', 'categories', 'activeCategory'));
    }
}
