@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-800 via-emerald-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">🎥 Jelajahi Destinasi</h1>
                <p class="text-slate-300 text-sm mt-1">Mengatur video latar belakang destinasi wisata, caption judul, dan urutan penampilan di halaman Beranda.</p>
            </div>
            <a href="{{ route('home') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm shrink-0">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- Action Card -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pintasan Manajemen</span>
                <h2 class="text-lg font-bold text-slate-800 font-title mt-0.5">Daftar Video Destinasi</h2>
            </div>
            <div>
                <a href="{{ route('admin.destination-videos.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition shadow">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Video
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
            @if($videos->isEmpty())
                <div class="text-center text-slate-500 py-16 px-4">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 text-xl mb-3">
                        <i class="fa-solid fa-video-slash"></i>
                    </div>
                    <p class="text-sm font-medium">Belum ada video destinasi. Silakan tambahkan video pertama.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-left">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-40">Video</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider">Judul Destinasi</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider">Caption / Deskripsi</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-24">Urutan</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-24">Status</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider text-right w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($videos as $video)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-32 rounded-lg overflow-hidden border border-slate-200 shadow-sm bg-slate-900 aspect-video">
                                            <video src="{{ str_starts_with($video->video, 'http') ? $video->video : Storage::disk('public_direct')->url($video->video) }}" class="w-full h-full object-cover" muted controls></video>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-950 align-middle">
                                        {{ $video->judul }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 align-middle">
                                        {{ Str::limit($video->caption ?? '-', 100) }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-650 font-semibold align-middle">
                                        {{ $video->urutan }}
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        @if($video->aktif)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-middle">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.destination-videos.edit', $video->id) }}" class="inline-flex items-center justify-center p-2 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-lg transition border border-amber-200">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.destination-videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video destinasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg transition border border-rose-200">
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
