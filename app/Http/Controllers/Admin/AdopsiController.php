<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;
use App\Models\CemaraMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Exports\AdopsiMultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;

class AdopsiController extends Controller
{
    /**
     * Listing semua pesanan adopsi untuk admin
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = CemaraAdopsi::with('user', 'paket', 'pohons')->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $adopsis = $query->paginate(15);
        $totalDiverifikasi = CemaraAdopsi::whereIn('status', ['diverifikasi', 'ditanam', 'selesai'])->count();
        $totalMenungguVerifikasi = CemaraAdopsi::where('status', 'menunggu_verifikasi')->count();

        return view('admin.adopsi.index', compact('adopsis', 'totalDiverifikasi', 'totalMenungguVerifikasi', 'status'));
    }

    /**
     * Detail transaksi adopsi untuk verifikasi & monitoring
     */
    public function show(CemaraAdopsi $adopsi)
    {
        $adopsi->load('user', 'paket', 'pohons.monitorings');
        return view('admin.adopsi.show', compact('adopsi'));
    }

    /**
     * Verifikasi Pembayaran & Auto-Generate Kode Pohon
     */
    public function verifikasi(Request $request, CemaraAdopsi $adopsi)
    {
        if ($adopsi->status === 'diverifikasi' || $adopsi->status === 'ditanam' || $adopsi->status === 'selesai') {
            return back()->with('info', 'Transaksi ini sudah diverifikasi sebelumnya.');
        }

        // Jika paket donasi bebas nominal, admin wajib isi jumlah pohon hasil konversi
        if ($adopsi->paket->is_donasi) {
            $request->validate([
                'jumlah_konversi' => 'required|integer|min:1|max:100',
            ]);
            $adopsi->jumlah = $request->input('jumlah_konversi');
        }

        $adopsi->status = 'diverifikasi';
        $adopsi->diverifikasi_at = now();
        $adopsi->catatan_admin = $request->input('catatan_admin', 'Pembayaran terverifikasi oleh tim admin desa.');
        $adopsi->save();

        // Generate unit pohon berdasarkan paket
        $totalPohon = $adopsi->jumlah * $adopsi->paket->jumlah_bibit;
        $tahun = now()->format('y');
        $idFormatted = str_pad($adopsi->id, 4, '0', STR_PAD_LEFT);

        for ($i = 1; $i <= $totalPohon; $i++) {
            CemaraPohon::create([
                'kode_pohon' => "CMR-{$tahun}-{$idFormatted}-{$i}",
                'adopsi_id' => $adopsi->id,
                'user_id' => $adopsi->user_id,
                'nama_sertifikat' => $adopsi->nama_sertifikat,
                'jenis' => $adopsi->paket->jenis_pohon,
                'status' => 'menunggu_tanam',
            ]);
        }

        return back()->with('success', "Pembayaran berhasil diverifikasi. {$totalPohon} kode pohon unik telah dibuat!");
    }

    /**
     * Penolakan Pembayaran
     */
    public function tolak(Request $request, CemaraAdopsi $adopsi)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);

        $adopsi->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('warning', 'Pesanan adopsi telah ditolak.');
    }

    /**
     * Simpan Data Monitoring Perkembangan Pohon
     */
    public function storeMonitoring(Request $request, CemaraPohon $pohon)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status_pohon' => 'required|in:hidup,mati,perlu_penyulaman',
            'perkiraan_tinggi' => 'nullable|string|max:50',
            'kondisi_daun' => 'nullable|in:Segar,Hijau,Menguning Sebagian,Layu,Rontok',
            'cabang_baru' => 'nullable|in:Ada,Tidak Ada',
            'kerusakan' => 'nullable|in:Tidak Ada,Rusak Ringan,Rusak Berat',
            'catatan' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'tanggal_tanam' => 'nullable|date',
            'lokasi_teks' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('monitorings', 'public');
        }

        CemaraMonitoring::create([
            'pohon_id' => $pohon->id,
            'tanggal' => $request->tanggal,
            'nama_petugas' => $request->nama_petugas,
            'perkiraan_tinggi' => $request->perkiraan_tinggi,
            'kondisi_daun' => $request->kondisi_daun,
            'cabang_baru' => $request->cabang_baru,
            'kerusakan' => $request->kerusakan,
            'foto' => $fotoPath,
            'catatan' => $request->catatan,
        ]);

        $pohonData = ['status' => $request->status_pohon];
        if ($request->filled('tanggal_tanam')) {
            $pohonData['tanggal_tanam'] = $request->tanggal_tanam;
        }
        if ($request->filled('lokasi_teks')) {
            $pohonData['lokasi_teks'] = $request->lokasi_teks;
        }
        if ($request->filled('lat')) {
            $pohonData['lat'] = $request->lat;
        }
        if ($request->filled('lng')) {
            $pohonData['lng'] = $request->lng;
        }
        $pohon->update($pohonData);

        $adopsi = $pohon->adopsi;
        if ($adopsi && $adopsi->status === 'diverifikasi') {
            $adopsi->update(['status' => 'ditanam']);
        }

        return back()->with('success', 'Catatan perkembangan pohon berhasil disimpan!');
    }

    public function export()
    {
        $namaFile = 'Data-Adopsi-Cemara-' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new AdopsiMultiSheetExport(), $namaFile);
    }
}
