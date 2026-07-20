<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;
use App\Models\CemaraMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $adopsi->update([
            'status' => 'diverifikasi',
            'diverifikasi_at' => now(),
            'catatan_admin' => $request->input('catatan_admin', 'Pembayaran terverifikasi oleh tim admin desa.'),
        ]);

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
            'tanggal' => 'required|date',
            'tinggi_cm' => 'nullable|integer|min:0',
            'jumlah_daun' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'tanggal_tanam' => 'nullable|date',
            'lokasi_teks' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'status_pohon' => 'nullable|in:menunggu_tanam,ditanam,tumbuh,mati',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/adopsi/monitoring');

            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            $file->move($targetDir, $fileName);
            $fotoPath = 'adopsi/monitoring/' . $fileName;
        }

        CemaraMonitoring::create([
            'pohon_id' => $pohon->id,
            'tanggal' => $request->tanggal,
            'tinggi_cm' => $request->tinggi_cm,
            'jumlah_daun' => $request->jumlah_daun,
            'foto' => $fotoPath,
            'catatan' => $request->catatan,
        ]);

        // Update status pohon dan lokasi jika diisi
        $pohonData = [];
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
        if ($request->filled('status_pohon')) {
            $pohonData['status'] = $request->status_pohon;
        } else {
            $pohonData['status'] = 'ditanam';
        }

        $pohon->update($pohonData);

        // Update status adopsi jika semua pohon sudah ditanam
        $adopsi = $pohon->adopsi;
        if ($adopsi && $adopsi->status === 'diverifikasi') {
            $adopsi->update(['status' => 'ditanam']);
        }

        return back()->with('success', 'Catatan perkembangan pohon berhasil disimpan!');
    }
}
