<?php

namespace App\Http\Controllers;

use App\Models\CemaraPaket;
use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;
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
            'pohon_tertanam' => CemaraPohon::whereIn('status', ['ditanam', 'tumbuh'])->count(),
            'total_adopter'  => CemaraAdopsi::whereIn('status', ['diverifikasi', 'ditanam', 'selesai'])->distinct('user_id')->count('user_id'),
        ];

        $pohonMap = CemaraPohon::whereNotNull('lat')
            ->whereNotNull('lng')
            ->whereIn('status', ['ditanam', 'tumbuh', 'mati'])
            ->get(['kode_pohon', 'jenis', 'tanggal_tanam', 'status', 'lat', 'lng']);

        return view('adopsi.index', compact('pakets', 'stats', 'pohonMap'));
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
