@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Top Welcome Card -->
    <div class="bg-gradient-to-r from-sky-700 via-sky-800 to-slate-900 rounded-xl p-6 text-white shadow-md flex justify-between items-center">
        <div>
            <span class="px-3 py-1 bg-white/10 rounded-full text-xs font-semibold text-sky-200">Panel Administrator</span>
            <h1 class="text-2xl font-bold font-heading mt-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-sky-100 text-sm mt-1">Ringkasan aktivitas dan pengelolaan situs Desa Wisata Punjulharjo.</p>
        </div>
        <a href="{{ route('admin.moderasi.index') }}" class="px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-semibold text-xs rounded-lg shadow transition flex items-center gap-2">
            <i class="fa-solid fa-shield-halved"></i> Moderasi Gabungan
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-center text-slate-500">
                <span class="text-xs font-semibold uppercase">Artikel Blog</span>
                <i class="fa-solid fa-newspaper text-sky-600"></i>
            </div>
            <div class="text-2xl font-bold text-slate-800 mt-2 font-heading">{{ number_format($stats['total_blogs']) }}</div>
            <a href="{{ route('admin.blog.index') }}" class="text-xs text-sky-600 hover:underline font-semibold block mt-2">Kelola &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-center text-slate-500">
                <span class="text-xs font-semibold uppercase">Video Wisata</span>
                <i class="fa-solid fa-video text-purple-600"></i>
            </div>
            <div class="text-2xl font-bold text-slate-800 mt-2 font-heading">{{ number_format($stats['total_videos']) }}</div>
            <a href="{{ route('admin.video.index') }}" class="text-xs text-purple-600 hover:underline font-semibold block mt-2">Kelola &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-center text-slate-500">
                <span class="text-xs font-semibold uppercase">Pesan Masuk</span>
                <i class="fa-solid fa-envelope text-blue-600"></i>
            </div>
            <div class="text-2xl font-bold text-slate-800 mt-2 font-heading">{{ number_format($stats['unread_messages']) }}</div>
            <a href="{{ route('admin.pesan.index') }}" class="text-xs text-blue-600 hover:underline font-semibold block mt-2">Lihat Pesan &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-center text-slate-500">
                <span class="text-xs font-semibold uppercase">Testimoni Pending</span>
                <i class="fa-solid fa-comments text-amber-600"></i>
            </div>
            <div class="text-2xl font-bold text-slate-800 mt-2 font-heading">{{ number_format($stats['pending_testimonials']) }}</div>
            <a href="{{ route('admin.testimoni.index') }}" class="text-xs text-amber-600 hover:underline font-semibold block mt-2">Moderasi &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-center text-slate-500">
                <span class="text-xs font-semibold uppercase">Adopsi Verifikasi</span>
                <i class="fa-solid fa-tree text-emerald-600"></i>
            </div>
            <div class="text-2xl font-bold text-slate-800 mt-2 font-heading">{{ number_format($stats['pending_adopsi']) }}</div>
            <a href="{{ route('admin.adopsi.index') }}" class="text-xs text-emerald-600 hover:underline font-semibold block mt-2">Verifikasi &rarr;</a>
        </div>
    </div>

    <!-- Quick Sections Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Blogs -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 space-y-4">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-800 text-base font-heading">Artikel Terbaru</h3>
                <a href="{{ route('admin.blog.index') }}" class="text-xs text-sky-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentBlogs as $blog)
                    <div class="py-2.5 flex justify-between items-center text-sm">
                        <span class="font-medium text-slate-700 truncate max-w-xs">{{ $blog->title }}</span>
                        <span class="text-xs text-slate-400">{{ $blog->created_at->format('d/m/Y') }}</span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 py-4 text-center">Belum ada artikel blog.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Adopsi Transactions -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 space-y-4">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-bold text-slate-800 text-base font-heading">Transaksi Adopsi Terbaru</h3>
                <a href="{{ route('admin.adopsi.index') }}" class="text-xs text-emerald-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentAdopsi as $adopsi)
                    <div class="py-2.5 flex justify-between items-center text-sm">
                        <div>
                            <span class="font-mono font-bold text-slate-800 text-xs">{{ $adopsi->kode_transaksi }}</span>
                            <span class="text-xs text-slate-500 block">{{ $adopsi->nama_pemesan }}</span>
                        </div>
                        <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full 
                            @if($adopsi->status == 'diverifikasi' || $adopsi->status == 'ditanam') bg-emerald-100 text-emerald-800 
                            @elseif($adopsi->status == 'menunggu_verifikasi') bg-amber-100 text-amber-800 
                            @else bg-slate-100 text-slate-600 @endif">
                            {{ ucfirst(str_replace('_', ' ', $adopsi->status)) }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 py-4 text-center">Belum ada transaksi adopsi.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
