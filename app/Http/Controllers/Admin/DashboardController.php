<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Video;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalBlog = Blog::count();
        $totalVideo = Video::count();
        $totalMessage = ContactMessage::count();

        // Data terbaru (3 item terakhir)
        $latestBlogs = Blog::latest()->take(3)->get();
        $latestVideos = Video::latest()->take(3)->get();
        $latestMessages = ContactMessage::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalBlog',
            'totalVideo',
            'totalMessage',
            'latestBlogs',
            'latestVideos',
            'latestMessages'
        ));
    }
}
