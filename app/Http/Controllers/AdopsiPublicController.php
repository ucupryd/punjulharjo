<?php

namespace App\Http\Controllers;

use App\Models\CemaraPaket;
use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;
use App\Models\TimProklim;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdopsiPublicController extends Controller
{
    /**
     * Landing page My Cemara: Edukasi, Latar Belakang, Alur, Galeri, Statistik, & Paket
     */
    public function index()
    {
        $pakets = CemaraPaket::where('aktif', true)->get();

        $stats = [
            'total_dana'     => CemaraAdopsi::whereIn('status', ['diverifikasi', 'ditanam', 'selesai'])->sum('total_harga'),
            'pohon_tertanam' => CemaraPohon::whereIn('status', ['hidup', 'perlu_penyulaman'])->count(),
            'total_adopter'  => CemaraAdopsi::whereIn('status', ['diverifikasi', 'ditanam', 'selesai'])->distinct('user_id')->count('user_id'),
        ];

        $pohonMap = CemaraPohon::whereNotNull('lat')
            ->whereNotNull('lng')
            ->whereIn('status', ['hidup', 'perlu_penyulaman', 'mati'])
            ->get(['kode_pohon', 'jenis', 'tanggal_tanam', 'status', 'lat', 'lng']);

        $timProklim = TimProklim::orderBy('urutan')->get();

        $galleryAdopsiItemsJson = SiteSetting::getValue('gallery_adopsi_items');
        $galleryAdopsiItems = $galleryAdopsiItemsJson ? json_decode($galleryAdopsiItemsJson, true) : [
            [
                'id' => 1,
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80',
                'title' => 'Penanaman Cemara',
                'aspect_class' => 'aspect-[3/4] md:row-span-2'
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80',
                'title' => 'Tunas Cemara Laut',
                'aspect_class' => 'aspect-[4/3] md:col-span-2'
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80',
                'title' => 'Rimbun Cemara',
                'aspect_class' => 'aspect-square'
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80',
                'title' => 'Ekosistem Pesisir',
                'aspect_class' => 'aspect-square'
            ],
            [
                'id' => 5,
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80',
                'title' => 'Konservasi Pantai',
                'aspect_class' => 'aspect-[4/3]'
            ],
            [
                'id' => 6,
                'image' => 'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Pantai Karangjahe',
                'aspect_class' => 'aspect-[16/9] md:col-span-2'
            ]
        ];

        return view('adopsi.index', compact('pakets', 'stats', 'pohonMap', 'timProklim', 'galleryAdopsiItems'));
    }

    /**
     * Detail Paket Adopsi Publik
     */
    public function show(CemaraPaket $paket)
    {
        if (!$paket->aktif) {
            abort(404);
        }

        return view('adopsi.show', compact('paket'));
    }
}
