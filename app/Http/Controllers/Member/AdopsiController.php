<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\CemaraPaket;
use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdopsiController extends Controller
{
    /**
     * Dashboard Member: Daftar transaksi & pohon milik member
     */
    public function dashboard()
    {
        $user = auth()->user();
        $adopsis = CemaraAdopsi::with('paket', 'pohons')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $pohons = CemaraPohon::with('adopsi', 'monitorings')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $pakets = CemaraPaket::where('aktif', true)->get();

        return view('member.adopsi.dashboard', compact('adopsis', 'pohons', 'pakets'));
    }

    /**
     * Form Buat Adopsi Baru
     */
    public function create(CemaraPaket $paket)
    {
        if (!$paket->aktif) {
            return redirect()->route('adopsi.index')->with('error', 'Paket tidak aktif.');
        }

        return view('member.adopsi.create', compact('paket'));
    }

    /**
     * Simpan Pesanan Adopsi Baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'paket_id' => 'required|exists:cemara_pakets,id',
            'nama_pemesan' => 'required|string|max:255',
            'nama_sertifikat' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:30',
            'jumlah' => 'required|integer|min:1|max:50',
        ]);

        $paket = CemaraPaket::findOrFail($data['paket_id']);

        $adopsi = CemaraAdopsi::create([
            'kode_transaksi' => 'MYC-' . strtoupper(Str::random(8)),
            'user_id' => auth()->id(),
            'paket_id' => $paket->id,
            'nama_pemesan' => $data['nama_pemesan'],
            'nama_sertifikat' => $data['nama_sertifikat'],
            'telepon' => $data['telepon'] ?? null,
            'jumlah' => $data['jumlah'],
            'total_harga' => $paket->harga * $data['jumlah'],
            'metode_bayar' => 'transfer_manual',
            'status' => 'menunggu_pembayaran',
        ]);

        return redirect()->route('member.adopsi.bayar', $adopsi)->with('success', 'Pesanan adopsi berhasil dibuat!');
    }

    /**
     * Halaman Instruksi Pembayaran & Upload Bukti
     */
    public function bayar(CemaraAdopsi $adopsi)
    {
        abort_unless($adopsi->user_id === auth()->id(), 403);
        $adopsi->load('paket');

        return view('member.adopsi.bayar', compact('adopsi'));
    }

    /**
     * Proses Upload Bukti Pembayaran
     */
    public function uploadBukti(Request $request, CemaraAdopsi $adopsi)
    {
        abort_unless($adopsi->user_id === auth()->id(), 403);

        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $file = $request->file('bukti_bayar');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/adopsi/bukti');

        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $file->move($targetDir, $fileName);

        $adopsi->update([
            'bukti_bayar' => 'adopsi/bukti/' . $fileName,
            'status' => 'menunggu_verifikasi',
            'dibayar_at' => now(),
        ]);

        return redirect()->route('member.adopsi.show', $adopsi)->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi tim desa.');
    }

    /**
     * Detail Pesanan Adopsi Member
     */
    public function show(CemaraAdopsi $adopsi)
    {
        abort_unless($adopsi->user_id === auth()->id(), 403);
        $adopsi->load('paket', 'pohons.monitorings');

        return view('member.adopsi.show', compact('adopsi'));
    }

    /**
     * Tampilan Sertifikat Digital Pohon
     */
    public function sertifikat(CemaraPohon $pohon)
    {
        abort_unless($pohon->user_id === auth()->id(), 403);
        $pohon->load('adopsi.paket', 'monitorings');

        return view('member.adopsi.sertifikat', compact('pohon'));
    }

    /**
     * Download Sertifikat versi Word (.doc)
     */
    public function sertifikatWord(CemaraPohon $pohon)
    {
        abort_unless($pohon->user_id === auth()->id(), 403);
        $pohon->load('adopsi.paket');

        return response()->view('member.adopsi.sertifikat_word', compact('pohon'))
            ->header('Content-Type', 'application/vnd.ms-word;charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="Sertifikat-' . $pohon->kode_pohon . '.doc"');
    }
}
