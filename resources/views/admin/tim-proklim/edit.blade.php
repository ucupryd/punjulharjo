@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-800 via-emerald-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">🌱 Edit Anggota Tim ProKlim</h1>
                <p class="text-slate-300 text-sm mt-1">Ubah data profil anggota tim ProKlim program konservasi pesisir.</p>
            </div>
            <a href="{{ route('admin.tim-proklim.index') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm shrink-0">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Anggota
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
        <form action="{{ route('admin.tim-proklim.update', $tim->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Nama Anggota</label>
                <input type="text" name="nama" required value="{{ old('nama', $tim->nama) }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Contoh: Budi Santoso">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Peran</label>
                <input type="text" name="peran" required value="{{ old('peran', $tim->peran) }}" 
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Contoh: Ketua Tim ProKlim / Koordinator Pemeliharaan">
            </div>

            <!-- Preview and File Input -->
            <div class="space-y-3">
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Foto Profil</label>
                @if($tim->foto)
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200 w-fit">
                        <img src="{{ (str_starts_with($tim->foto, 'http') || str_contains($tim->foto, 'storage/')) ? asset($tim->foto) : Storage::url($tim->foto) }}" 
                             class="w-20 h-20 object-cover rounded-xl border border-slate-200" 
                             alt="Foto {{ $tim->nama }}">
                        <div>
                            <span class="text-xs font-semibold text-slate-500 block">Foto Saat Ini</span>
                            <span class="text-[10px] text-slate-400 block font-mono mt-0.5 break-all max-w-[200px]">{{ basename($tim->foto) }}</span>
                        </div>
                    </div>
                @endif
                <input type="file" name="foto" accept="image/*" 
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition cursor-pointer">
                <p class="text-[11px] text-slate-400 mt-1.5">Format: JPG, JPEG, PNG, WEBP. Ukuran file maksimal: 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1.5">Urutan Tampilan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $tim->urutan) }}" min="1" required
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none placeholder-slate-400" 
                       placeholder="Contoh: 1">
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.tim-proklim.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
