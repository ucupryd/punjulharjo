@extends('layouts.app')

@section('content')
<x-detail.layout>
    <x-slot:main>
        <!-- Info E-book -->
        <div class="space-y-6">
            <div class="space-y-4">
                <h1 class="text-3xl lg:text-5xl font-extrabold font-heading text-brand-dark leading-tight">
                    {{ $ebook->title }}
                </h1>
                
                <div class="flex flex-wrap gap-1 mt-2">
                    @forelse($ebook->categories as $category)
                        <x-blog.category-badge :category="$category" />
                    @empty
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-500 ring-1 ring-slate-200">E-Book</span>
                    @endforelse
                </div>
                
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-200 text-xs text-slate-500 font-sans">
                    <div>
                        Diunggah pada 
                        <span class="font-semibold text-slate-700">
                            {{ $ebook->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tampilan Detail (Cover + Deskripsi + Aksi) -->
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <!-- Cover -->
                <div class="w-full md:w-64 bg-slate-100 overflow-hidden shadow-md flex-shrink-0 border border-slate-200">
                    <img src="{{ $ebook->cover_path ? Storage::url($ebook->cover_path) : asset('images/ebook-placeholder.png') }}" 
                         alt="Cover {{ $ebook->title }}" 
                         class="w-full h-auto object-cover"
                         loading="lazy">
                </div>

                <!-- Deskripsi & Aksi -->
                <div class="flex-grow space-y-6">
                    <div class="prose max-w-none text-slate-700 font-sans leading-relaxed">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Deskripsi Buku</h3>
                        <p class="text-base text-slate-600">
                            {{ $ebook->description ?? 'Tidak ada deskripsi untuk e-book ini.' }}
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <!-- Primary Action: Buka File PDF -->
                        <a href="{{ Storage::url($ebook->pdf_path) }}" 
                           target="_blank"
                           class="group inline-flex items-center gap-2.5 bg-brand-dark hover:bg-sky-950 text-white font-semibold px-6 py-3.5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 text-sm tracking-wide transform active:scale-95">
                            <i class="fa-solid fa-book-open text-sky-400 group-hover:scale-105 transition-transform"></i>
                            <span>Buka Lembaran PDF</span>
                        </a>

                        <!-- Secondary Action: Unduh E-Book -->
                        <a href="{{ route('ebook.download', $ebook->id) }}" 
                           class="group inline-flex items-center gap-2.5 bg-white hover:bg-slate-50 text-slate-750 hover:text-brand-dark border border-slate-300 hover:border-slate-400 font-semibold px-6 py-3.5 rounded-lg shadow-sm transition-all duration-200 text-sm tracking-wide transform active:scale-95">
                            <i class="fa-solid fa-download text-slate-400 group-hover:text-brand-dark group-hover:translate-y-0.5 transition-all"></i>
                            <span>Unduh E-Book</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Reaksi & Komentar -->
        <x-detail.reactions-comments contextType="ebook" />

        <!-- E-book Lainnya -->
        <x-detail.more 
            title="Baca E-Book Lainnya" 
            :items="$moreItems" 
            :backUrl="route('pustaka') . '#ebook'" 
            backLabel="Kembali ke daftar e-book" />
    </x-slot:main>

    <x-slot:sidebar>
        <x-detail.sidebar :items="$sidebarItems" title="Rekomendasi & Promo" />
    </x-slot:sidebar>
</x-detail.layout>
@endsection
