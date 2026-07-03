<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // Menampilkan daftar semua video
    public function index()
    {
        $videos = Video::latest()->paginate(6);
        return view('video.index', compact('videos'));
    }

    // Menampilkan detail video berdasarkan slug
    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        return view('video.show', compact('video'));
    }
}
