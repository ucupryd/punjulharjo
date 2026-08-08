<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\Category;
use App\Models\CemaraAdopsi;
use Illuminate\Http\Request;

class ModerasiController extends Controller
{
    /**
     * Halaman Moderasi Gabungan (Kesan/Testimoni + Pesan Masuk + Verifikasi Adopsi + Kelola Kategori)
     */
    public function index(Request $request)
    {
        $pendingTestimonials = Testimonial::where('is_approved', false)->latest()->get();
        $allTestimonials = Testimonial::latest()->paginate(10);
        $messages = ContactMessage::latest()->get();
        $pendingAdopsis = CemaraAdopsi::where('status', 'menunggu_verifikasi')->with('user', 'paket')->latest()->get();
        $categories = Category::withCount(['blogs', 'videos', 'ebooks'])->orderBy('name')->get();
        $comments = \App\Models\Comment::with('commentable')->latest()->get();

        $activeTab = $request->query('tab', 'testimoni');

        return view('admin.moderasi.index', compact(
            'pendingTestimonials',
            'allTestimonials',
            'messages',
            'pendingAdopsis',
            'categories',
            'comments',
            'activeTab'
        ));
    }
}
