@extends('layouts.app')

@section('content')
<x-detail.layout>
    <x-slot:main>
        <!-- Judul Artikel -->
        <div class="space-y-4">
            <h1 class="text-3xl lg:text-5xl font-extrabold font-heading text-brand-dark leading-tight">
                {{ $blog->title }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-200 text-xs text-slate-500 font-sans">
                <div>
                    Dipublikasikan pada 
                    <span class="font-semibold text-slate-700">
                        {{ ($blog->published_at ? \Carbon\Carbon::parse($blog->published_at) : $blog->created_at)->format('d M Y') }}
                    </span> 
                    oleh 
                    <span class="font-semibold text-slate-700">
                        {{ $blog->author->name ?? 'Admin' }}
                    </span>
                </div>
                
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('admin.blog.edit', $blog) }}" 
                       class="bg-white hover:bg-slate-100 text-slate-800 px-3 py-1.5 rounded-none border border-slate-200 shadow-sm text-xs font-semibold flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-pencil text-sky-600"></i> Edit Artikel
                    </a>
                @endif
            </div>
        </div>

        <!-- Gambar Utama -->
        @if($blog->image)
            <div class="w-full bg-slate-100 overflow-hidden rounded-none shadow-sm">
                <img src="{{ Storage::url($blog->image) }}" 
                     alt="{{ $blog->title }}" 
                     class="w-full h-auto object-cover rounded-none"
                     loading="lazy">
            </div>
        @endif

        <!-- Isi Artikel -->
        <div class="text-slate-800 leading-relaxed prose max-w-none font-sans text-base lg:text-lg">
            {!! $blog->content !!}
        </div>

        <!-- Area Reaksi & Komentar -->
        <x-detail.reactions-comments contextType="berita" />

        <!-- Berita Lainnya / Baca Juga -->
        <x-detail.more 
            title="Baca Juga (Berita Lainnya)" 
            :items="$moreItems" 
            :backUrl="route('blog.index')" 
            backLabel="Kembali ke semua artikel" />
    </x-slot:main>

    <x-slot:sidebar>
        <x-detail.sidebar :items="$sidebarItems" title="Rekomendasi & Promo" />
    </x-slot:sidebar>
</x-detail.layout>

<style>
    /* Styling overrides for WYSIWYG editor content */
    .prose h2 {
        font-size: 1.875rem !important; /* 30px */
        font-weight: 700 !important;
        line-height: 1.25 !important;
        margin-top: 2rem !important;
        margin-bottom: 0.75rem !important;
        color: #0d355e !important; /* brand-dark */
        font-family: 'Playfair Display', serif !important;
    }
    .prose h3 {
        font-size: 1.5rem !important; /* 24px */
        font-weight: 600 !important;
        line-height: 1.3 !important;
        margin-top: 1.75rem !important;
        margin-bottom: 0.5rem !important;
        color: #0d355e !important; /* brand-dark */
        font-family: 'Playfair Display', serif !important;
    }
    .prose h4 {
        font-size: 1.25rem !important; /* 20px */
        font-weight: 600 !important;
        line-height: 1.4 !important;
        margin-top: 1.5rem !important;
        margin-bottom: 0.5rem !important;
        color: #1e293b !important;
        font-family: 'Playfair Display', serif !important;
    }
    .prose p {
        margin-bottom: 1.25rem !important;
        line-height: 1.75 !important;
        color: #334155 !important; /* slate-700 */
    }
    .prose img {
        max-width: 100% !important;
        height: auto !important;
        margin: 2rem auto !important;
        border-radius: 0px !important; /* Siku corners */
    }
    
    /* Centering images when wrapped in styled blocks */
    .prose [style*="text-align: center"] {
        text-align: center !important;
    }
    .prose [style*="text-align: center"] img {
        display: inline-block !important;
    }
    .prose [style*="text-align: right"] {
        text-align: right !important;
    }
    .prose [style*="text-align: right"] img {
        display: inline-block !important;
    }
</style>
@endsection
