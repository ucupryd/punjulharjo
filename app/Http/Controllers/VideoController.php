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
        $video = Video::with('categories')->where('slug', $slug)->firstOrFail();

        // Record unique view log
        $visitorToken = request()->cookie('visitor_token');
        if ($visitorToken) {
            try {
                \App\Models\ViewLog::create([
                    'viewable_type' => Video::class,
                    'viewable_id' => $video->id,
                    'visitor_token' => $visitorToken
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                // Silent ignore on duplicate index (already viewed)
            }
        }

        $videosLain = Video::where('id', '!=', $video->id)
            ->latest()
            ->take(4)
            ->get();

        $moreItems = $videosLain->map(function ($vid) {
            return [
                'image' => $vid->thumbnail ? (str_starts_with($vid->thumbnail, 'http') ? $vid->thumbnail : \Illuminate\Support\Facades\Storage::url($vid->thumbnail)) : 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                'label' => 'Video',
                'title' => $vid->title,
                'date' => $vid->created_at->format('d M Y'),
                'url' => route('video.show', $vid->slug)
            ];
        })->toArray();

        // Rekomendasi di sidebar samping (KJB, Perahu Kuno, Ebook, Video, Adopsi)
        $pantaiImg = \App\Models\SiteSetting::getValue('potensi_pantai_image');
        $pantaiImgUrl = (str_starts_with($pantaiImg, 'http') || str_contains($pantaiImg, 'storage/')) ? asset($pantaiImg) : \Illuminate\Support\Facades\Storage::url($pantaiImg);

        $situsImg = \App\Models\SiteSetting::getValue('potensi_situs_image');
        $situsImgUrl = (str_starts_with($situsImg, 'http') || str_contains($situsImg, 'storage/')) ? asset($situsImg) : \Illuminate\Support\Facades\Storage::url($situsImg);

        $cemaraImg = \App\Models\SiteSetting::getValue('potensi_cemara_image');
        $cemaraImgUrl = (str_starts_with($cemaraImg, 'http') || str_contains($cemaraImg, 'storage/')) ? asset($cemaraImg) : \Illuminate\Support\Facades\Storage::url($cemaraImg);

        $sidebarItems = [
            [
                'image' => $pantaiImgUrl,
                'title' => 'Pantai Karang Jahe (KJB)',
                'excerpt' => 'Hamparan pasir putih dan ribuan pohon cemara rindang yang menyejukkan.',
                'url' => route('destinasi.pantai-karang-jahe'),
                'ctaLabel' => 'Kunjungi Destinasi'
            ],
            [
                'image' => $situsImgUrl,
                'title' => 'Edu Park Situs Perahu Kuno',
                'excerpt' => 'Sisa peninggalan perahu kayu kuno termegah abad ke-7 hingga ke-8 di Asia Tenggara.',
                'url' => route('destinasi.situs-perahu-kuno'),
                'ctaLabel' => 'Pelajari Selengkapnya'
            ],
            [
                'image' => $cemaraImgUrl,
                'title' => 'Program Adopsi Cemara Laut',
                'excerpt' => 'Kontribusi menjaga kelestarian pesisir pantai desa dengan mengadopsi pohon cemara laut.',
                'url' => route('adopsi.index'),
                'ctaLabel' => 'Adopsi Sekarang'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                'title' => 'E-Book Panduan Wisata',
                'excerpt' => 'Unduh dan baca panduan lengkap tentang kebudayaan, sejarah, dan keindahan alam Punjulharjo.',
                'url' => '/pustaka?tab=ebook',
                'ctaLabel' => 'Buka E-Book'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=80',
                'title' => 'Kabar Desa / Berita',
                'excerpt' => 'Baca berita terbaru seputar kegiatan, agenda, dan perkembangan Desa Punjulharjo.',
                'url' => '/pustaka?tab=blog',
                'ctaLabel' => 'Baca Berita'
            ]
        ];

        return view('video.show', compact('video', 'sidebarItems', 'moreItems'));
    }
}
