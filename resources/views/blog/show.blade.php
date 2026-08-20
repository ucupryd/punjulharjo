@extends('layouts.app')

{{-- SEO Dinamis: diambil dari data artikel $blog --}}
@section('title', $blog->title . ' — Desa Wisata Punjulharjo')
@php
    // Gunakan excerpt jika ada, jika tidak ambil 160 karakter pertama dari konten (strip HTML)
    $_blogDesc = !empty($blog->excerpt)
        ? $blog->excerpt
        : Str::limit(strip_tags($blog->content ?? ''), 160, '...');
    // og:image: pakai gambar artikel jika ada, fallback ke default
    $_blogOgImage = $blog->image
        ? asset('storage/' . ltrim($blog->image, '/'))
        : asset('images/beach-bg.png');
@endphp
@section('meta_description', $_blogDesc)
@section('og_image', $_blogOgImage)

@push('structured_data')
@php
$_articleSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $blog->title,
    'image' => $_blogOgImage,
    'datePublished' => \Carbon\Carbon::parse($blog->published_at ?? $blog->created_at)->toIso8601String(),
    'dateModified' => \Carbon\Carbon::parse($blog->updated_at ?? $blog->created_at)->toIso8601String(),
    'author' => [
        '@type' => 'Organization',
        'name' => 'Desa Wisata Punjulharjo',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Desa Wisata Punjulharjo',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('images/logo-my-cemara.png.png'),
        ],
    ],
];

$_breadcrumbSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Beranda',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Berita & Artikel',
            'item' => route('pustaka'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $blog->title,
            'item' => route('blog.show', $blog->slug),
        ],
    ],
];
@endphp
<script type="application/ld+json">{!! json_encode($_articleSchema, JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($_breadcrumbSchema, JSON_UNESCAPED_SLASHES) !!}</script>
@endpush


@section('content')
<x-detail.layout>
    <x-slot:main>
        <!-- Judul Artikel -->
        <div class="space-y-4">
            @if($blog->categories->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach($blog->categories as $category)
                        <x-blog.category-badge :category="$category" :linkable="true" size="md" />
                    @endforeach
                </div>
            @endif

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
        <x-detail.reactions-comments :model="$blog" contextType="blog" />

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

@endsection
