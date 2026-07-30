<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Halaman utama (menampilkan 3-4 blog terbaru)
    public function home()
    {
        $blogs = Blog::latest()->take(3)->get();
        return view('welcome', compact('blogs'));
    }

    // Halaman semua blog
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    // Halaman detail blog
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $beritaLain = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(4)
            ->get();
        return view('blog.show', compact('blog', 'beritaLain'));
    }
}
