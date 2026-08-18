@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-800 via-emerald-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">🎥 Tambah Video Destinasi</h1>
                <p class="text-slate-300 text-sm mt-1">Unggah video baru dan definisikan caption destinasinya.</p>
            </div>
            <a href="{{ route('admin.destination-videos.index') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm shrink-0">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        @if($errors->any())
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl text-sm text-rose-800 shadow-sm">
                <p class="font-bold mb-1">Terjadi kesalahan input:</p>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <form action="{{ route('admin.destination-videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-slate-700 font-sans text-sm font-semibold mb-2">Judul Destinasi Wisata</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition" placeholder="Contoh: Pantai Karang Jahe" required>
                </div>

                <div>
                    <label class="block text-slate-700 font-sans text-sm font-semibold mb-2">Caption / Deskripsi Destinasi</label>
                    <textarea name="caption" rows="4" class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition" placeholder="Tulis deskripsi singkat atau pesan menarik tentang destinasi ini...">{{ old('caption') }}</textarea>
                </div>

                <div>
                    <label class="block text-slate-700 font-sans text-sm font-semibold mb-2">File Video</label>
                    <input type="file" name="video" accept="video/mp4,video/webm" class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" required>
                    <p class="text-xs text-slate-400 mt-2">Hanya mendukung format: <strong>mp4, webm</strong>. Ukuran maksimum berkas: <strong>20MB</strong>.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-semibold mb-2">Urutan Penampilan (opsional)</label>
                        <input type="number" name="urutan" value="{{ old('urutan') }}" class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none transition" placeholder="Contoh: 1 (Kosongkan untuk otomatis di urutan terakhir)">
                    </div>

                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-semibold mb-2">Status Publikasi</label>
                        <div class="flex items-center gap-4 py-3">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="aktif" value="1" {{ old('aktif', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="relative w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                <span class="ms-3 text-sm font-medium text-slate-700">Tampilkan di Beranda (Aktif)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.destination-videos.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl text-sm shadow transition">
                        Simpan Video
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
