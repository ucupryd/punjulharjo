<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Video;

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
        return view('pustaka.index', compact('ebooks', 'videos'));
    }

    public function destinasi()
    {
        return view('destinasi.index');
    }
}
