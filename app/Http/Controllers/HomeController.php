<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Video;

use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function pustaka()
    {
        $ebooks = Ebook::latest()->get();
        $videos = Video::latest()->get();
        $blogs = Blog::latest()->get();
        return view('pustaka.index', compact('ebooks', 'videos', 'blogs'));
    }

    public function destinasi()
    {
        return view('destinasi.index');
    }
}
