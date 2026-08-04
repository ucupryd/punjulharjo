<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    // Menampilkan halaman detail e-book
    public function show(Ebook $ebook)
    {
        $ebook->load('categories');
        // Ambil e-book lainnya untuk section "more"
        $ebooksLain = Ebook::where('id', '!=', $ebook->id)
            ->latest()
            ->take(4)
            ->get();

        // Map items untuk related content section
        $moreItems = $ebooksLain->map(function ($eb) {
            return [
                'image' => $eb->cover_path ? Storage::url($eb->cover_path) : asset('images/ebook-placeholder.png'),
                'label' => 'E-Book',
                'title' => $eb->title,
                'date' => $eb->created_at->format('d M Y'),
                'url' => route('ebook.show', $eb->id)
            ];
        })->toArray();

        // Rekomendasi di sidebar samping (KJB, Perahu Kuno, Ebook, Video, Adopsi)
        $pantaiImg = \App\Models\SiteSetting::getValue('potensi_pantai_image');
        $pantaiImgUrl = (str_starts_with($pantaiImg, 'http') || str_contains($pantaiImg, 'storage/')) ? asset($pantaiImg) : Storage::url($pantaiImg);

        $situsImg = \App\Models\SiteSetting::getValue('potensi_situs_image');
        $situsImgUrl = (str_starts_with($situsImg, 'http') || str_contains($situsImg, 'storage/')) ? asset($situsImg) : Storage::url($situsImg);

        $cemaraImg = \App\Models\SiteSetting::getValue('potensi_cemara_image');
        $cemaraImgUrl = (str_starts_with($cemaraImg, 'http') || str_contains($cemaraImg, 'storage/')) ? asset($cemaraImg) : Storage::url($cemaraImg);

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
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=80',
                'title' => 'Kabar Desa / Berita',
                'excerpt' => 'Baca berita terbaru seputar kegiatan, agenda, dan perkembangan Desa Punjulharjo.',
                'url' => '/pustaka?tab=blog',
                'ctaLabel' => 'Baca Berita'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                'title' => 'Kumpulan Video Wisata',
                'excerpt' => 'Tonton dokumentasi seru dan keindahan alam pesisir Pantai Punjulharjo secara langsung.',
                'url' => '/pustaka?tab=video',
                'ctaLabel' => 'Tonton Video'
            ]
        ];

        return view('pustaka.ebook-show', compact('ebook', 'sidebarItems', 'moreItems'));
    }

    // Mengunduh file PDF e-book
    public function download(Ebook $ebook)
    {
        $filePath = public_path('storage/' . $ebook->pdf_path);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        abort(404, 'File tidak ditemukan.');
    }
}
