<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Video;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use App\Models\CemaraAdopsi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_blogs' => Blog::count(),
            'total_videos' => Video::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'pending_testimonials' => Testimonial::where('is_approved', false)->count(),
            'pending_adopsi' => CemaraAdopsi::where('status', 'menunggu_verifikasi')->count(),
        ];

        $recentBlogs = Blog::latest()->take(5)->get();
        $recentAdopsi = CemaraAdopsi::with('user', 'paket')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBlogs', 'recentAdopsi'));
    }
}
