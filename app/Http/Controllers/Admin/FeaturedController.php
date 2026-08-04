<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeaturedController extends Controller
{
    private array $map = [
        'blog'  => \App\Models\Blog::class,
        'video' => \App\Models\Video::class,
        'ebook' => \App\Models\Ebook::class,
    ];

    /**
     * Simpan mode tampilan Beranda (terbaru / unggulan) untuk satu jenis konten.
     */
    public function updateMode(Request $request, string $type)
    {
        abort_unless(isset($this->map[$type]), 404);

        $request->validate([
            'mode' => 'required|in:terbaru,unggulan',
        ]);

        SiteSetting::setValue('beranda_mode_' . $type, $request->mode);

        return back()->withFragment($type)->with('success', 'Mode tampilan Beranda diperbarui!');
    }

    /**
     * Simpan daftar konten unggulan (maks. 3) untuk satu jenis konten.
     * Mengganti total daftar sebelumnya dalam satu transaksi.
     */
    public function updateItems(Request $request, string $type)
    {
        abort_unless(isset($this->map[$type]), 404);
        $class = $this->map[$type];

        // VALIDASI SERVER — max:3 pada array memvalidasi JUMLAH item.
        // Ini pengaman utama dan tidak boleh dihilangkan.
        $request->validate([
            'featured'       => 'nullable|array|max:3',
            'featured.*'     => 'integer',
            'featured_order' => 'nullable|string',
        ]);

        $checked = collect($request->input('featured', []))
            ->map(fn ($v) => (int) $v)
            ->unique()
            ->values();

        // Tentukan urutan dari featured_order bila ada.
        // featured_order adalah daftar ID dipisah koma sesuai urutan pencentangan.
        $order = collect(explode(',', (string) $request->input('featured_order', '')))
            ->map(fn ($v) => (int) trim($v))
            ->filter()
            ->unique()
            ->values();

        // Hanya ambil ID yang benar-benar dicentang — mencegah ID basi dari
        // featured_order yang tidak ada di pilihan aktif.
        $ordered = $order->filter(fn ($id) => $checked->contains($id))->values();

        // Bila JavaScript mati sehingga featured_order kosong, pakai urutan
        // array featured apa adanya.
        if ($ordered->isEmpty()) {
            $ordered = $checked;
        }

        // Tambahkan ID tercentang yang belum masuk urutan, di belakang.
        $ordered = $ordered->merge($checked->diff($ordered))->values();

        // Pastikan ID benar-benar ada di tabel kontennya — buang konten hantu.
        // Urutan harus dipertahankan.
        $existing = $class::whereIn('id', $ordered)->pluck('id')->all();
        $ids = $ordered->filter(fn ($id) => in_array($id, $existing, true))
            ->take(3)
            ->values()
            ->all();

        // Simpan dalam satu transaksi — GANTI TOTAL daftar untuk tipe ini.
        DB::transaction(function () use ($class, $ids) {
            FeaturedItem::where('featurable_type', $class)->delete();
            foreach (array_values($ids) as $i => $id) {
                FeaturedItem::create([
                    'featurable_type' => $class,
                    'featurable_id'   => $id,
                    'position'        => $i + 1,
                ]);
            }
        });

        return back()->withFragment($type)->with('success', 'Konten unggulan berhasil disimpan!');
    }
}
