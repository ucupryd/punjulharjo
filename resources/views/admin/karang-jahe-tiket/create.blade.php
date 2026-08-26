@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-sky-800 via-sky-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-sky-500/20 text-sky-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-sky-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">🎟️ Tambah Tarif Tiket</h1>
                <p class="text-slate-300 text-sm mt-1">Tambahkan baris tarif tiket atau biaya wahana baru untuk Pantai Karang Jahe.</p>
            </div>
            <a href="{{ route('admin.karang-jahe-tiket.index') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm shrink-0">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Error Alert -->
        @if($errors->any())
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl text-sm text-rose-700 shadow-sm">
                <div class="font-bold mb-1">Terjadi kesalahan pengisian data:</div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <form action="{{ route('admin.karang-jahe-tiket.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
            @csrf
            
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Komponen Tiket / Wahana</label>
                <input type="text" name="komponen" required value="{{ old('komponen') }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Contoh: Tiket & Parkir Motor">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Tarif (Kisaran)</label>
                <input type="text" name="tarif" required value="{{ old('tarif') }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Contoh: Rp 5.000 atau Rp 15.000 – Rp 25.000">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Catatan Kecil (Opsional)</label>
                <input type="text" name="catatan" value="{{ old('catatan') }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Contoh: lebih tinggi saat weekend/libur atau maksimal 10 orang">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Ikon FontAwesome Class (Opsional)</label>
                <input type="text" name="ikon" value="{{ old('ikon', 'fa-solid fa-ticket') }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none placeholder-slate-400 font-mono" 
                       placeholder="Contoh: fa-solid fa-car, fa-solid fa-motorcycle">
                <p class="text-[11px] text-slate-400 mt-1.5">Lihat referensi ikon di website FontAwesome (seperti <code>fa-solid fa-bus</code> atau <code>fa-solid fa-ship</code>).</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Urutan Tampilan (Opsional)</label>
                <input type="number" name="urutan" value="{{ old('urutan') }}" min="1"
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Kosongkan untuk otomatis mengisi di posisi terakhir">
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.karang-jahe-tiket.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm rounded-xl shadow transition">
                    Simpan Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
