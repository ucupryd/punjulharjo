@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-sky-800 via-sky-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-sky-500/20 text-sky-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-sky-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">✨ Kelola Sorotan & Fasilitas Pantai</h1>
                <p class="text-slate-300 text-sm mt-1">Mengatur item daya tarik, fasilitas, foto pendukung, dan urutan penampilan di halaman Pantai Karang Jahe.</p>
            </div>
            <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm shrink-0">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Destinasi
            </a>
        </div>

        <!-- Action Card -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pintasan Manajemen</span>
                <h2 class="text-lg font-bold text-slate-800 font-title mt-0.5">Daftar Sorotan & Fasilitas</h2>
            </div>
            <div>
                <a href="{{ route('admin.karang-jahe-sorotan.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition shadow">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Item
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-sm text-emerald-800 shadow-sm flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            @if($sorotan->isEmpty())
                <div class="text-center text-slate-500 py-16 px-4">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 text-xl mb-3">
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <p class="text-sm font-medium">Belum ada data sorotan. Silakan tambahkan item pertama.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-left">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-24">Visual</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider">Judul</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-32">Ikon Fallback</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-20">Urutan</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider text-right w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($sorotan as $item)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4">
                                        @if($item->gambar)
                                            <img src="{{ (str_starts_with($item->gambar, 'http') || str_contains($item->gambar, 'storage/')) ? asset($item->gambar) : Storage::url($item->gambar) }}" 
                                                 class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm" 
                                                 alt="{{ $item->judul }}">
                                        @else
                                            <div class="w-12 h-12 bg-sky-50 text-sky-600 rounded-xl flex items-center justify-center border border-slate-200">
                                                <i class="{{ $item->icon ?? 'fa-solid fa-star' }} text-lg"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-slate-800">
                                        {{ $item->judul }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                        {{ $item->deskripsi }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">
                                        {{ $item->icon ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-800">
                                            {{ $item->urutan }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.karang-jahe-sorotan.edit', $item->id) }}"
                                               class="inline-flex items-center justify-center min-h-[38px] min-w-[38px] px-3 py-2 bg-slate-100 hover:bg-sky-50 hover:text-sky-700 text-slate-600 rounded-xl text-xs font-semibold transition"
                                               title="Edit {{ $item->judul }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.karang-jahe-sorotan.destroy', $item->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus item sorotan {{ $item->judul }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center min-h-[38px] min-w-[38px] px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-xs font-semibold transition"
                                                        title="Hapus {{ $item->judul }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
