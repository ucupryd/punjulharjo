@extends('layouts.app')

@section('content')
    <x-fixed-image-section
        key="hero_pustaka"
        :image="'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=1920&q=80'"
        eyebrow="PUSTAKA MEDIA DESA" eyebrowIcon="fa-solid fa-book-open"
        title="PUSTAKA DIGITAL & DOKUMENTASI"
        subtitle="Telusuri koleksi buku panduan wisata interaktif kami dan saksikan kumpulan video dokumentasi keindahan Desa Wisata Punjulharjo."
        waveColor="text-slate-100"
        hasWave="true" />

<div x-data="{ 
    activeTab: '{{ $activeTab }}',
    init() {
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            if (['ebook', 'video', 'blog'].includes(hash)) {
                this.activeTab = hash;
            }
        }
    }
}" class="bg-slate-100 font-sans">

{{-- Notifikasi sesi & error validasi untuk form unggulan admin --}}
@if(session('success'))
    <div class="max-w-6xl mx-auto px-6 pt-6">
        <div class="bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    </div>
@endif
@if($errors->any())
    <div class="max-w-6xl mx-auto px-6 pt-6">
        <div class="bg-red-50 border border-red-200 text-red-800 text-sm px-4 py-3">
            <div class="flex items-center gap-2 font-semibold mb-1">
                <i class="fa-solid fa-circle-xmark text-red-500"></i> Terjadi kesalahan:
            </div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

    <!-- E-BOOK TAB PANEL -->
    <div x-show="activeTab === 'ebook'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 relative">
            <div class="text-center md:text-left space-y-2">
                <h2 class="text-3xl font-heading text-brand-dark">Buku Panduan Desa Wisata</h2>
                <p class="text-slate-500 text-sm">Buka lembaran interaktif di bawah ini untuk menjelajahi potensi keindahan alam, sejarah nusantara, dan kebudayaan di Desa Wisata Punjulharjo.</p>
            </div>
            
            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="mt-4 md:mt-0 flex flex-wrap gap-2 justify-center md:justify-end">
                    <form method="POST" action="{{ route('admin.featured.mode', 'ebook') }}">
                        @csrf
                        <input type="hidden" name="mode" value="terbaru">
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-semibold border shadow-sm transition-all min-h-[44px] {{ $featuredModes['ebook'] === 'terbaru' ? 'bg-sky-600 text-white border-sky-600' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-clock-rotate-left mr-1"></i> Terbaru
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.featured.mode', 'ebook') }}">
                        @csrf
                        <input type="hidden" name="mode" value="unggulan">
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-semibold border shadow-sm transition-all min-h-[44px] {{ $featuredModes['ebook'] === 'unggulan' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-star mr-1"></i> Pilih Unggulan
                        </button>
                    </form>
                    <button type="button" onclick="document.getElementById('add-ebook-modal').classList.remove('hidden')" 
                            class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-none shadow transition-all flex items-center gap-2 text-sm font-semibold min-h-[44px]">
                        <i class="fa-solid fa-plus"></i> Tambah Ebook
                    </button>
                </div>
            @endif
        </div>

        @if($featuredSelecting['ebook'])
            <div class="max-w-6xl mx-auto mb-4 p-3 bg-amber-50 border border-amber-200 text-amber-800 text-xs flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Filter kategori dinonaktifkan saat memilih konten unggulan, agar seluruh konten terlihat.
            </div>
        @else
            <x-blog.category-filter :categories="$categories ?? collect()" :activeCategory="$activeCategory ?? null" />
        @endif

        @if($ebooks->isNotEmpty() || (Auth::check() && Auth::user()->isAdmin()))
            @if($featuredSelecting['ebook'])
            <form method="POST" action="{{ route('admin.featured.items', 'ebook') }}" id="featured-form-ebook">
                @csrf
                <input type="hidden" name="featured_order" id="featured-order-ebook" value="">
            @endif
            <div class="eb-grid" id="featured-grid-ebook"
                 data-featured-order="{{ implode(',', $featuredIds['ebook']) }}">


                @if($ebooks->isNotEmpty())
                    @foreach($ebooks as $ebook)
                        @php
                            $likesVal = (int)($ebook->id * 7 + 15) % 89 + 12;
                            $commentsVal = (int)($ebook->id * 3 + 8) % 43 + 4;
                            $viewsVal = (int)($ebook->id * 43 + 124) % 890 + 112;
                        @endphp
                        <div class="eb-main relative">
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <div class="absolute top-4 left-4 z-30 flex gap-1.5" onclick="event.stopPropagation();">
                                    <button type="button" onclick="openEditEbookModal({{ json_encode($ebook) }})" 
                                            class="bg-white/95 hover:bg-white text-slate-700 w-7 h-7 rounded shadow flex items-center justify-center border border-slate-100 transition duration-200" title="Edit Ebook">
                                        <i class="fa-solid fa-pencil text-[10px] text-sky-600"></i>
                                    </button>
                                    <button type="button" onclick="confirmDeleteEbook({{ $ebook->id }})"
                                            class="bg-white/95 hover:bg-red-50 text-red-600 w-7 h-7 rounded shadow flex items-center justify-center border border-slate-100 transition duration-200" title="Hapus Ebook">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </div>
                                @if($featuredSelecting['ebook'])
                                    <label class="absolute top-4 right-4 z-30 cursor-pointer" onclick="event.stopPropagation();">
                                        <input type="checkbox"
                                               name="featured[]"
                                               value="{{ $ebook->id }}"
                                               class="featured-check-ebook sr-only"
                                               @checked(in_array($ebook->id, $featuredIds['ebook']))>
                                        <span class="featured-badge-number inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-200 text-slate-500 text-xs font-bold border-2 border-slate-300 transition-all duration-200"></span>
                                    </label>
                                @endif
                            @endif
                            {{-- Badge kategori — overlay pojok kiri atas foto --}}
                            @if($ebook->categories->isNotEmpty())
                                <div class="absolute left-2 z-20 flex flex-wrap gap-1 max-w-[75%] {{ (Auth::check() && Auth::user()->isAdmin()) ? 'top-14' : 'top-2' }}">
                                    @foreach($ebook->categories as $category)
                                        <x-blog.category-badge :category="$category" />
                                    @endforeach
                                </div>
                            @endif
                            <a href="{{ route('ebook.show', $ebook->id) }}" class="eb-card-wrapper block no-underline text-current">
                                <div class="eb-card">
                                    <div class="eb-fl">
                                        <div class="eb-fullscreen">
                                            <svg class="eb-fullscreen-svg" viewBox="0 0 100 100" aria-hidden="true">
                                                <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.7 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="eb-cover-container">
                                        <img class="eb-cover-img" src="{{ $ebook->cover_path ? Storage::url($ebook->cover_path) : asset('images/ebook-placeholder.png') }}"
                                             alt="Sampul {{ $ebook->title }}" loading="lazy">
                                    </div>
                                </div>

                                <div class="eb-content-bottom">
                                    <div class="eb-data">
                                        <div class="eb-date-badge">
                                            <span class="eb-date-day">{{ $ebook->created_at->format('d') }}</span>
                                            <span class="eb-date-month">{{ $ebook->created_at->format('M') }}</span>
                                        </div>
                                        <div class="eb-text">
                                            @if($ebook->categories->isEmpty())
                                                <div class="flex flex-wrap gap-1 mb-1.5">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-500 ring-1 ring-slate-200">E-Book</span>
                                                </div>
                                            @endif
                                            <div class="eb-text-m" title="{{ $ebook->title }}">{{ $ebook->title }}</div>
                                            <div class="eb-text-s">{{ $ebook->description ?? 'Desa Wisata Punjulharjo' }}</div>
                                        </div>
                                    </div>

                                    <div class="eb-btns">
                                        <div class="eb-likes">
                                            <svg viewBox="-2 0 105 92" class="eb-likes-svg" aria-hidden="true"><path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path></svg>
                                            <span class="eb-likes-text">{{ $likesVal }}</span>
                                        </div>
                                        <div class="eb-comments">
                                            <svg viewBox="-405.9 238 56.3 54.8" class="eb-comments-svg" aria-hidden="true"><path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path></svg>
                                            <span class="eb-comments-text">{{ $commentsVal }}</span>
                                        </div>
                                        <div class="eb-views">
                                            <svg viewBox="0 0 30.5 16.5" class="eb-views-svg" aria-hidden="true"><path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path></svg>
                                            <span class="eb-views-text">{{ $viewsVal }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            @if($featuredSelecting['ebook'])
                <div class="mt-6 flex items-center justify-center gap-4">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 text-sm font-semibold shadow transition-all flex items-center gap-2">
                        <i class="fa-solid fa-star"></i> Simpan Pilihan Unggulan E-Book
                    </button>
                    <span id="featured-count-ebook" class="text-xs text-slate-500">0 dari 3 dipilih</span>
                </div>
            </form>
            @endif
        @else
            <!-- Static 3D Flipbook component when empty/guest fallback -->
            <div class="flipbook-container">
                <div class="flipbook-viewport mb-6">
                    <div id="flipbook" class="flipbook-wrapper">
                        <div class="flipbook-page cover-page select-none flex flex-col justify-between items-center text-center border-4 border-amber-500/30 rounded-lg p-8 h-full" data-density="hard">
                            <div class="w-full flex justify-between items-center border-b border-white/10 pb-4">
                                <span class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Desa Punjulharjo</span>
                                <i class="fa-solid fa-dharmachakra text-amber-400 text-lg"></i>
                            </div>
                            <div class="my-auto space-y-6">
                                <div class="w-20 h-20 mx-auto rounded-full bg-white/10 flex items-center justify-center border border-white/20 shadow-inner">
                                    <i class="fa-solid fa-map text-amber-400 text-3xl"></i>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-heading text-white tracking-wider leading-snug drop-shadow-lg">BUKU PANDUAN<br>WISATA</h3>
                                <p class="text-sm font-sans text-slate-300 max-w-xs mx-auto leading-relaxed uppercase tracking-wider">Panduan Lengkap Penjelajahan Alam, Sejarah & Budaya</p>
                            </div>
                            <div class="w-full border-t border-white/10 pt-4 flex flex-col items-center">
                                <span class="text-[10px] uppercase tracking-widest text-slate-400">Edisi Eksklusif</span>
                                <div class="text-amber-400/90 mt-1 flex gap-0.5 justify-center">
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Inside content pages -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Kata Pengantar</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-6">Selamat Datang</h3>
                                    <div class="space-y-4 text-sm text-slate-600 leading-relaxed text-justify">
                                        <p>Selamat datang di Desa Wisata Punjulharjo, Kabupaten Rembang. Buku panduan praktis ini dirancang untuk memudahkan Anda menjelajahi keindahan alam, menelusuri sejarah bahari nusantara, dan merasakan kehangatan budaya masyarakat pesisir kami.</p>
                                        <p>Kami berharap setiap lembar informasi di dalam e-book interaktif ini dapat menginspirasi dan membantu Anda merencanakan kunjungan yang tak terlupakan.</p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Daftar Isi & Sambutan</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pantai Karang Jahe -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Alam</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Pantai Karang Jahe</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=400&q=85" alt="Pantai Karang Jahe" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">Menawarkan hamparan pasir putih bersih yang membentang luas di sepanjang garis pantai utara Jawa, dihiasi ribuan pohon cemara laut yang rindang. Destinasi wisata keluarga yang teduh dan menenangkan.</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Pesona Bahari</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 2</span>
                                </div>
                            </div>
                        </div>

                        <!-- Situs Perahu Kuno -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Sejarah</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Situs Perahu Kuno</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?auto=format&fit=crop&w=400&q=85" alt="Situs Perahu Kuno" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">Penemuan arkeologi luar biasa berupa perahu kayu utuh dari abad ke-7 Masehi. Situs purbakala ini menjadi bukti nyata majunya teknologi perkapalan dan sejarah kemaritiman perdagangan nusantara.</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Warisan Maritim</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 3</span>
                                </div>
                            </div>
                        </div>

                        <!-- Batik Canting -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Edukasi</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Batik Canting Punjulharjo</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=400&q=85" alt="Batik Tulis" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">Melihat langsung dan belajar seni membatik tulis tradisional canting dengan motif pesisiran yang unik. Aktivitas edukatif ini memberdayakan pengrajin wanita desa dan melestarikan budaya bangsa.</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Kreativitas Lokal</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 4</span>
                                </div>
                            </div>
                        </div>

                        <!-- Back cover -->
                        <div class="flipbook-page back-page select-none flex flex-col justify-between items-center text-center border-4 border-amber-500/30 rounded-lg p-8 h-full" data-density="hard">
                            <div class="w-full flex justify-between items-center border-b border-white/10 pb-4">
                                <i class="fa-solid fa-dharmachakra text-amber-400 text-lg"></i>
                                <span class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Sampai Jumpa</span>
                            </div>
                            <div class="my-auto space-y-4">
                                <h3 class="text-2xl font-heading text-white tracking-wider">KUNJUNGI KAMI</h3>
                                <p class="text-xs text-slate-300 max-w-xs mx-auto leading-relaxed">Mulai petualangan Anda hari ini dan rasakan pengalaman unik di setiap jengkal Desa Wisata Punjulharjo.</p>
                                <div class="text-[10px] text-amber-300 font-mono tracking-wider space-y-1 bg-white/5 py-3 px-4 rounded-xl border border-white/10">
                                    <div>Email: info@desapunjulharjo.id</div>
                                    <div>Instagram: @desawisatapunjulharjo</div>
                                    <div>Web: desapunjulharjo.id</div>
                                </div>
                            </div>
                            <div class="w-full border-t border-white/10 pt-4 flex flex-col items-center">
                                <span class="text-[10px] uppercase tracking-widest text-slate-400">Copyright © {{ date('Y') }}</span>
                                <span class="text-[9px] text-slate-500 mt-1">Desa Wisata Punjulharjo. All Rights Reserved.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <div class="mt-8 flex items-center justify-center gap-6 z-10 font-sans">
                    <button id="btn-prev" class="w-12 h-12 rounded-full bg-white hover:bg-sky-500 hover:text-white text-slate-700 shadow-md border border-slate-100 flex items-center justify-center transition-all duration-300 transform hover:-translate-x-1 hover:scale-105 active:scale-95 focus:outline-none" aria-label="Halaman Sebelumnya">
                        <i class="fa-solid fa-chevron-left text-lg"></i>
                    </button>
                    <span id="page-indicator" class="glass-panel px-6 py-2.5 rounded-full text-slate-700 font-semibold text-sm shadow-sm border border-slate-200">
                        Sampul Depan
                    </span>
                    <button id="btn-next" class="w-12 h-12 rounded-full bg-white hover:bg-sky-500 hover:text-white text-slate-700 shadow-md border border-slate-100 flex items-center justify-center transition-all duration-300 transform hover:translate-x-1 hover:scale-105 active:scale-95 focus:outline-none" aria-label="Halaman Berikutnya">
                        <i class="fa-solid fa-chevron-right text-lg"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- VIDEO TAB PANEL -->
    <div x-show="activeTab === 'video'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="max-w-6xl mx-auto px-6 py-12" style="display: none;">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 relative">
            <div class="text-center md:text-left space-y-2">
                <h2 class="text-3xl font-heading text-brand-dark">Kumpulan Video Wisata</h2>
                <p class="text-slate-500 text-sm">Saksikan ragam keindahan dokumentasi video pariwisata Desa Punjulharjo.</p>
            </div>
            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="mt-4 md:mt-0 flex flex-wrap gap-2 justify-center md:justify-end">
                    <form method="POST" action="{{ route('admin.featured.mode', 'video') }}">
                        @csrf
                        <input type="hidden" name="mode" value="terbaru">
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-semibold border shadow-sm transition-all min-h-[44px] {{ $featuredModes['video'] === 'terbaru' ? 'bg-sky-600 text-white border-sky-600' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-clock-rotate-left mr-1"></i> Terbaru
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.featured.mode', 'video') }}">
                        @csrf
                        <input type="hidden" name="mode" value="unggulan">
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-semibold border shadow-sm transition-all min-h-[44px] {{ $featuredModes['video'] === 'unggulan' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-star mr-1"></i> Pilih Unggulan
                        </button>
                    </form>
                    <button type="button" onclick="document.getElementById('add-video-modal').classList.remove('hidden')" 
                            class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-none shadow transition-all flex items-center gap-2 text-sm font-semibold min-h-[44px]">
                        <i class="fa-solid fa-plus"></i> Tambah Video
                    </button>
                </div>
            @endif
        </div>

        @if($featuredSelecting['video'])
            <div class="max-w-6xl mx-auto mb-4 p-3 bg-amber-50 border border-amber-200 text-amber-800 text-xs flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Filter kategori dinonaktifkan saat memilih konten unggulan, agar seluruh konten terlihat.
            </div>
        @else
            <x-blog.category-filter :categories="$categories ?? collect()" :activeCategory="$activeCategory ?? null" />
        @endif

        @php
            if (!function_exists('getYoutubeId')) {
                function getYoutubeId($url) {
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                    return $match[1] ?? null;
                }
            }
        @endphp
        @if($videos->count())
            @if($featuredSelecting['video'])
            <form method="POST" action="{{ route('admin.featured.items', 'video') }}" id="featured-form-video">
                @csrf
                <input type="hidden" name="featured_order" id="featured-order-video" value="">
            @endif
            <div class="eb-grid" id="featured-grid-video"
                 data-featured-order="{{ implode(',', $featuredIds['video']) }}">
                @foreach($videos as $video)
                    @php
                        $videoId = getYoutubeId($video->video_url);
                        $thumbnailUrl = $videoId 
                            ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
                            : ($video->thumbnail ? Storage::disk('public_direct')->url($video->thumbnail) : asset('images/default-video.jpg'));
                        $likesVal = (int)($video->id * 7 + 15) % 89 + 12;
                        $commentsVal = (int)($video->id * 3 + 8) % 43 + 4;
                        $viewsVal = (int)($video->id * 43 + 124) % 890 + 112;
                    @endphp
                    <div class="eb-main relative group">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <div class="absolute top-4 left-4 z-30" onclick="event.stopPropagation();">
                                <button type="button" onclick="openEditVideoModal(event, {{ json_encode($video) }})" 
                                        class="bg-white/95 hover:bg-white text-slate-700 w-7 h-7 rounded shadow flex items-center justify-center border border-slate-100 transition duration-200" title="Edit Video">
                                    <i class="fa-solid fa-pencil text-[10px] text-sky-600"></i>
                                </button>
                            </div>
                            @if($featuredSelecting['video'])
                                <label class="absolute top-4 right-4 z-30 cursor-pointer" onclick="event.stopPropagation();">
                                    <input type="checkbox"
                                           name="featured[]"
                                           value="{{ $video->id }}"
                                           class="featured-check-video sr-only"
                                           @checked(in_array($video->id, $featuredIds['video']))>
                                    <span class="featured-badge-number inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-200 text-slate-500 text-xs font-bold border-2 border-slate-300 transition-all duration-200"></span>
                                </label>
                            @endif
                        @endif
                        {{-- Badge kategori — overlay pojok kiri atas foto --}}
                        @if($video->categories->isNotEmpty())
                            <div class="absolute left-2 z-20 flex flex-wrap gap-1 max-w-[75%] {{ (Auth::check() && Auth::user()->isAdmin()) ? 'top-14' : 'top-2' }}">
                                @foreach($video->categories as $category)
                                    <x-blog.category-badge :category="$category" />
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('video.show', $video->slug) }}" class="eb-card-wrapper block no-underline text-current">
                            <div class="eb-card">
                                <div class="eb-fl">
                                    <div class="eb-fullscreen">
                                        <svg class="eb-fullscreen-svg" viewBox="0 0 100 100" aria-hidden="true">
                                            <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.7 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="eb-cover-container">
                                    <img class="eb-cover-img" src="{{ $thumbnailUrl }}"
                                         alt="Sampul {{ $video->title }}" loading="lazy">
                                </div>
                            </div>

                            <div class="eb-content-bottom">
                                <div class="eb-data">
                                    <div class="eb-date-badge">
                                        <span class="eb-date-day">{{ $video->created_at->format('d') }}</span>
                                        <span class="eb-date-month">{{ $video->created_at->format('M') }}</span>
                                    </div>
                                    <div class="eb-text">
                                        @if($video->categories->isEmpty())
                                            <div class="flex flex-wrap gap-1 mb-1.5">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-500 ring-1 ring-slate-200">Video</span>
                                            </div>
                                        @endif
                                        <div class="eb-text-m" title="{{ $video->title }}">{{ $video->title }}</div>
                                        @if($video->description)
                                            <div class="eb-text-s">{{ $video->description }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="eb-btns">
                                    <div class="eb-likes">
                                        <svg viewBox="-2 0 105 92" class="eb-likes-svg" aria-hidden="true"><path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path></svg>
                                        <span class="eb-likes-text">{{ $likesVal }}</span>
                                    </div>
                                    <div class="eb-comments">
                                        <svg viewBox="-405.9 238 56.3 54.8" class="eb-comments-svg" aria-hidden="true"><path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path></svg>
                                        <span class="eb-comments-text">{{ $commentsVal }}</span>
                                    </div>
                                    <div class="eb-views">
                                        <svg viewBox="0 0 30.5 16.5" class="eb-views-svg" aria-hidden="true"><path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path></svg>
                                        <span class="eb-views-text">{{ $viewsVal }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @if($featuredSelecting['video'])
                <div class="mt-6 flex items-center justify-center gap-4">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 text-sm font-semibold shadow transition-all flex items-center gap-2">
                        <i class="fa-solid fa-star"></i> Simpan Pilihan Unggulan Video
                    </button>
                    <span id="featured-count-video" class="text-xs text-slate-500">0 dari 3 dipilih</span>
                </div>
            </form>
            @endif
        @else
            <div class="text-center py-16 bg-white border border-slate-200">
                <i class="fa-solid fa-film text-4xl text-slate-300 mb-3 block"></i>
                <p class="text-gray-600 text-sm">Belum ada video pariwisata yang tersedia.</p>
            </div>
        @endif
    </div>

    <!-- BLOG TAB PANEL -->
    <div x-show="activeTab === 'blog'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="max-w-6xl mx-auto px-6 py-12" style="display: none;">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 relative">
            <div class="text-center md:text-left space-y-2">
                <h2 class="text-3xl font-heading text-brand-dark">Artikel & Berita Desa</h2>
                <p class="text-slate-500 text-sm">Temukan artikel menarik seputar kegiatan, budaya, dan pengumuman Desa Wisata Punjulharjo.</p>
            </div>
            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="mt-4 md:mt-0 flex flex-wrap gap-2 justify-center md:justify-end">
                    <form method="POST" action="{{ route('admin.featured.mode', 'blog') }}">
                        @csrf
                        <input type="hidden" name="mode" value="terbaru">
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-semibold border shadow-sm transition-all min-h-[44px] {{ $featuredModes['blog'] === 'terbaru' ? 'bg-sky-600 text-white border-sky-600' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-clock-rotate-left mr-1"></i> Terbaru
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.featured.mode', 'blog') }}">
                        @csrf
                        <input type="hidden" name="mode" value="unggulan">
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-semibold border shadow-sm transition-all min-h-[44px] {{ $featuredModes['blog'] === 'unggulan' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-star mr-1"></i> Pilih Unggulan
                        </button>
                    </form>
                    <a href="{{ route('admin.blog.create') }}" 
                       class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-none shadow transition-all flex items-center gap-2 text-sm font-semibold min-h-[44px]">
                        <i class="fa-solid fa-plus"></i> Tambah Artikel
                    </a>
                </div>
            @endif
        </div>

        @if($featuredSelecting['blog'])
            <div class="max-w-6xl mx-auto mb-4 p-3 bg-amber-50 border border-amber-200 text-amber-800 text-xs flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Filter kategori dinonaktifkan saat memilih konten unggulan, agar seluruh konten terlihat.
            </div>
        @else
            <x-blog.category-filter :categories="$categories ?? collect()" :activeCategory="$activeCategory ?? null" />
        @endif

        @if($blogs->count() > 0)
            @if($featuredSelecting['blog'])
            <form method="POST" action="{{ route('admin.featured.items', 'blog') }}" id="featured-form-blog">
                @csrf
                <input type="hidden" name="featured_order" id="featured-order-blog" value="">
            @endif
            <div class="eb-grid" id="featured-grid-blog"
                 data-featured-order="{{ implode(',', $featuredIds['blog']) }}">
                @foreach ($blogs as $blog)
                    @php
                        $blogImgUrl = $blog->image ? Storage::url($blog->image) : 'https://via.placeholder.com/400x250?text=Desa+Punjulharjo';
                        $likesVal = (int)($blog->id * 7 + 15) % 89 + 12;
                        $commentsVal = (int)($blog->id * 3 + 8) % 43 + 4;
                        $viewsVal = (int)($blog->id * 43 + 124) % 890 + 112;
                    @endphp
                    <div class="eb-main relative group">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <div class="absolute top-4 left-4 z-30" onclick="event.stopPropagation();">
                                <a href="{{ route('admin.blog.edit', $blog) }}" 
                                   class="bg-white/95 hover:bg-white text-slate-700 w-7 h-7 rounded shadow flex items-center justify-center border border-slate-100 transition duration-200" title="Edit Artikel">
                                    <i class="fa-solid fa-pencil text-[10px] text-sky-600"></i>
                                </a>
                            </div>
                            @if($featuredSelecting['blog'])
                                <label class="absolute top-4 right-4 z-30 cursor-pointer" onclick="event.stopPropagation();">
                                    <input type="checkbox"
                                           name="featured[]"
                                           value="{{ $blog->id }}"
                                           class="featured-check-blog sr-only"
                                           @checked(in_array($blog->id, $featuredIds['blog']))>
                                    <span class="featured-badge-number inline-flex items-center justify-center w-7 h-7 rounded-full bg-slate-200 text-slate-500 text-xs font-bold border-2 border-slate-300 transition-all duration-200"></span>
                                </label>
                            @endif
                        @endif
                        {{-- Badge kategori — overlay pojok kiri atas foto --}}
                        @if($blog->categories->isNotEmpty())
                            <div class="absolute left-2 z-20 flex flex-wrap gap-1 max-w-[75%] {{ (Auth::check() && Auth::user()->isAdmin()) ? 'top-14' : 'top-2' }}">
                                @foreach($blog->categories as $category)
                                    <x-blog.category-badge :category="$category" />
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('blog.show', $blog->slug) }}" class="eb-card-wrapper block no-underline text-current animate-fade-in">
                            <div class="eb-card">
                                <div class="eb-fl">
                                    <div class="eb-fullscreen">
                                        <svg class="eb-fullscreen-svg" viewBox="0 0 100 100" aria-hidden="true">
                                            <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.7 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="eb-cover-container">
                                    <img class="eb-cover-img" src="{{ $blogImgUrl }}"
                                         alt="Sampul {{ $blog->title }}" loading="lazy">
                                </div>
                            </div>

                            <div class="eb-content-bottom">
                                <div class="eb-data mb-3">
                                    <div class="eb-date-badge">
                                        @php
                                            $pubDate = $blog->published_at ? \Carbon\Carbon::parse($blog->published_at) : $blog->created_at;
                                        @endphp
                                        <span class="eb-date-day">{{ $pubDate->format('d') }}</span>
                                        <span class="eb-date-month">{{ $pubDate->format('M') }}</span>
                                    </div>
                                    <div class="eb-text">
                                        @if($blog->categories->isEmpty())
                                            <div class="flex flex-wrap gap-1 mb-1.5">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-500 ring-1 ring-slate-200">Berita</span>
                                            </div>
                                        @endif
                                        <div class="eb-text-m" title="{{ $blog->title }}">{{ $blog->title }}</div>
                                        <div class="eb-text-s">
                                            {{ $blog->auto_excerpt }}
                                        </div>
                                    </div>
                                </div>
                                <div class="eb-btns mb-3">
                                    <div class="eb-likes">
                                        <svg viewBox="-2 0 105 92" class="eb-likes-svg" aria-hidden="true"><path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path></svg>
                                        <span class="eb-likes-text">{{ $likesVal }}</span>
                                    </div>
                                    <div class="eb-comments">
                                        <svg viewBox="-405.9 238 56.3 54.8" class="eb-comments-svg" aria-hidden="true"><path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path></svg>
                                        <span class="eb-comments-text">{{ $commentsVal }}</span>
                                    </div>
                                    <div class="eb-views">
                                        <svg viewBox="0 0 30.5 16.5" class="eb-views-svg" aria-hidden="true"><path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path></svg>
                                        <span class="eb-views-text">{{ $viewsVal }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @if($featuredSelecting['blog'])
                <div class="mt-6 flex items-center justify-center gap-4">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 text-sm font-semibold shadow transition-all flex items-center gap-2">
                        <i class="fa-solid fa-star"></i> Simpan Pilihan Unggulan Artikel
                    </button>
                    <span id="featured-count-blog" class="text-xs text-slate-500">0 dari 3 dipilih</span>
                </div>
            </form>
            @endif
        @else
            <div class="text-center py-16 bg-white border border-slate-200">
                <i class="fa-solid fa-newspaper text-4xl text-slate-300 mb-3 block"></i>
                <p class="text-gray-600 text-sm">
                    @if(!empty($activeCategory))
                        Belum ada artikel untuk kategori ini.
                    @else
                        Belum ada artikel yang tersedia.
                    @endif
                </p>
            </div>
        @endif
    </div>

</div>



@auth
    <!-- Add Ebook Modal -->
    <div id="add-ebook-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Upload E-Book PDF Baru</h3>
                <button type="button" onclick="document.getElementById('add-ebook-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.ebook.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Ebook</label>
                        <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Contoh: Ebook Panduan Desa Punjulharjo" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" maxlength="150" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Jelaskan isi e-book ini secara ringkas..."></textarea>
                    </div>
                    <div>
                        @include('partials.category-picker', [
                            'categories' => $categories,
                            'selected' => old('categories', []),
                            'label' => 'Kategori E-Book',
                            'inputIdPrefix' => 'add-eb'
                        ])
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih File PDF</label>
                        <input type="file" name="pdf" accept=".pdf" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                        <p class="text-xs text-slate-400 mt-1">Hanya file PDF. Ukuran maks: 15MB.</p>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Sampul Card Ebook (Opsional)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                        <p class="text-xs text-slate-400 mt-1">Format gambar. Ukuran maks: 5MB.</p>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-ebook-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Upload Ebook
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Ebook Modal -->
    <div id="edit-ebook-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit E-Book PDF</h3>
                <button type="button" onclick="document.getElementById('edit-ebook-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form id="edit-ebook-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Ebook</label>
                        <input type="text" id="edit-ebook-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Singkat</label>
                        <textarea id="edit-ebook-description" name="description" rows="3" maxlength="150" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm"></textarea>
                    </div>
                    <div>
                        @include('partials.category-picker', [
                            'categories' => $categories,
                            'selected' => [],
                            'label' => 'Kategori E-Book',
                            'inputIdPrefix' => 'edit-eb'
                        ])
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti File PDF (Opsional)</label>
                        <input type="file" name="pdf" accept=".pdf" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah file PDF.</p>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Sampul Card Ebook (Opsional)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah sampul.</p>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('edit-ebook-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Video Modal -->
    <div id="add-video-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Tambah Video Baru</h3>
                <button type="button" onclick="document.getElementById('add-video-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.video.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Video</label>
                        <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Judul..." required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">URL Video Embed (YouTube)</label>
                        <input type="text" name="video_url" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Contoh: https://www.youtube.com/watch?v=..." required>
                        <p class="text-xs text-slate-400 mt-1">Gunakan link watch YouTube standar.</p>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Deskripsi video..."></textarea>
                    </div>
                    <div>
                        @include('partials.category-picker', [
                            'categories' => $categories,
                            'selected' => old('categories', []),
                            'label' => 'Kategori Video',
                            'inputIdPrefix' => 'add-vi'
                        ])
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-video-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Tambah Video
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Video Modal -->
    <div id="edit-video-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit Video</h3>
                <button type="button" onclick="document.getElementById('edit-video-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form id="edit-video-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Video</label>
                        <input type="text" id="edit-video-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">URL Video Embed (YouTube)</label>
                        <input type="text" id="edit-video-url" name="video_url" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi</label>
                        <textarea id="edit-video-desc" name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm"></textarea>
                    </div>
                    <div>
                        @include('partials.category-picker', [
                            'categories' => $categories,
                            'selected' => [],
                            'label' => 'Kategori Video',
                            'inputIdPrefix' => 'edit-vi'
                        ])
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                    <button type="button" onclick="confirmDeleteVideo()"
                            class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                        Hapus
                    </button>
                    
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('edit-video-modal').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-video-form" action="" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    {{-- Hidden form untuk hapus ebook via JS (di luar form unggulan agar tidak bersarang) --}}
    {{-- data-template menyimpan URL template agar tidak tertimpa saat hapus kedua --}}
    <form id="delete-ebook-form" action="" method="POST" class="hidden"
          data-template="{{ route('admin.ebook.destroy', ['id' => '__ID__']) }}">
        @csrf
        @method('DELETE')
    </form>

@endauth

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>

        /* Interactive 3D CSS Book animations */
        .flipbook-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            perspective: 2000px;
            padding: 2rem 0;
            position: relative;
            z-index: 10;
        }
        .flipbook-viewport {
            width: 100%;
            max-width: 900px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .flipbook-wrapper {
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.45);
            background: transparent;
            border-radius: 8px;
            overflow: visible;
        }
        .flipbook-page {
            background-color: #ffffff;
            color: #1e293b;
            box-shadow: inset 3px 0 20px rgba(0, 0, 0, 0.08);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            box-sizing: border-box;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }
        @media (min-width: 768px) {
            .flipbook-page {
                padding: 2.5rem;
            }
        }
        .flipbook-page p { color: #475569; }
        .cover-page, .back-page {
            background: linear-gradient(135deg, #0d355e 0%, #1e293b 100%);
            color: #ffffff;
            box-shadow: inset -3px 0 20px rgba(0, 0, 0, 0.25);
            border: none;
        }
        .cover-page p, .back-page p { color: #cbd5e1; }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flipContainer = document.getElementById('flipbook');
            if (flipContainer && typeof St !== 'undefined') {
                const pageFlip = new St.PageFlip(flipContainer, {
                    width: 550,
                    height: 580,
                    size: "stretch",
                    minWidth: 280,
                    maxWidth: 1000,
                    minHeight: 295,
                    maxHeight: 1050,
                    maxShadowOpacity: 0.35,
                    showCover: true,
                    mobileScrollSupport: false,
                    usePortrait: true
                });

                pageFlip.loadFromHTML(document.querySelectorAll('.flipbook-page'));

                const btnPrev = document.getElementById('btn-prev');
                const btnNext = document.getElementById('btn-next');
                const pageIndicator = document.getElementById('page-indicator');

                function updateIndicator() {
                    const total = pageFlip.getPageCount();
                    const current = pageFlip.getCurrentPageIndex();
                    
                    if (pageFlip.getOrientation() === 'portrait') {
                        if (current === 0) {
                            pageIndicator.textContent = "Sampul Depan";
                        } else if (current === total - 1) {
                            pageIndicator.textContent = "Sampul Belakang";
                        } else {
                            pageIndicator.textContent = `Halaman ${current} dari ${total - 2}`;
                        }
                    } else {
                        if (current === 0) {
                            pageIndicator.textContent = "Sampul Depan";
                        } else if (current === total - 1 || current === total - 2) {
                            pageIndicator.textContent = "Sampul Belakang";
                        } else {
                            const leftPage = current;
                            const rightPage = current + 1;
                            pageIndicator.textContent = `Halaman ${leftPage} & ${rightPage}`;
                        }
                    }
                }

                btnPrev.addEventListener('click', () => pageFlip.flipPrev());
                btnNext.addEventListener('click', () => pageFlip.flipNext());

                pageFlip.on('flip', () => { updateIndicator(); });
                pageFlip.on('changeOrientation', () => { updateIndicator(); });

                setTimeout(updateIndicator, 150);
            }
        });

        @auth
            // ============================================================
            // KONTROL UNGGULAN — satu fungsi per tipe konten
            // ============================================================
            function setupFeaturedPanel(type) {
                const grid = document.getElementById('featured-grid-' + type);
                if (!grid) return; // Panel ini tidak dalam mode memilih unggulan

                const orderInput = document.getElementById('featured-order-' + type);
                const countEl   = document.getElementById('featured-count-' + type);
                // Selector PER TIPE — tidak menggunakan querySelectorAll global
                const getChecks = () => Array.from(grid.querySelectorAll('.featured-check-' + type));

                // Inisialisasi order dari atribut data-featured-order (urutan position dari controller).
                // JANGAN menggunakan urutan DOM karena grid dirender dengan latest() bukan order by position.
                let order = (grid.dataset.featuredOrder || '')
                    .split(',')
                    .map(function (v) { return parseInt(v); })
                    .filter(function (v) { return !isNaN(v); });

                // Buang ID yang kartunya tidak ada di halaman ini, lalu tambahkan
                // kotak tercentang yang belum masuk urutan (untuk keamanan).
                var checkedIds = getChecks()
                    .filter(function (cb) { return cb.checked; })
                    .map(function (cb) { return parseInt(cb.value); });
                order = order.filter(function (id) { return checkedIds.indexOf(id) !== -1; });
                checkedIds.forEach(function (id) {
                    if (order.indexOf(id) === -1) order.push(id);
                });

                function update() {
                    const checks = getChecks();
                    const checkedCount = checks.filter(function(cb) { return cb.checked; }).length;

                    checks.forEach(function(cb) {
                        const id    = parseInt(cb.value);
                        const label = cb.closest('label');
                        const badge = label ? label.querySelector('.featured-badge-number') : null;
                        if (!badge) return;

                        const pos = order.indexOf(id);

                        if (cb.checked && pos !== -1) {
                            badge.textContent = pos + 1;
                            badge.classList.remove('bg-slate-200', 'text-slate-500', 'border-slate-300');
                            badge.classList.add('bg-amber-400', 'text-white', 'border-amber-500');
                        } else {
                            badge.textContent = '';
                            badge.classList.remove('bg-amber-400', 'text-white', 'border-amber-500');
                            badge.classList.add('bg-slate-200', 'text-slate-500', 'border-slate-300');
                        }

                        // Disable kotak BELUM tercentang bila kuota penuh.
                        // Kotak yang SUDAH tercentang JANGAN di-disable
                        // (input[disabled] tidak terkirim ke server).
                        if (!cb.checked) {
                            cb.disabled = checkedCount >= 3;
                            badge.style.opacity = checkedCount >= 3 ? '0.4' : '1';
                        } else {
                            cb.disabled = false;
                            badge.style.opacity = '1';
                        }
                    });

                    if (orderInput) orderInput.value = order.join(',');
                    if (countEl)    countEl.textContent = checkedCount + ' dari 3 dipilih';
                }

                update(); // Tampilkan state awal

                getChecks().forEach(function(cb) {
                    cb.addEventListener('change', function() {
                        var id = parseInt(this.value);
                        if (this.checked) {
                            if (order.indexOf(id) === -1) order.push(id);
                        } else {
                            order = order.filter(function(v) { return v !== id; });
                        }
                        update();
                    });
                });
            }

            // Jalankan untuk setiap panel (hanya aktif bila kontainernya ada di DOM)
            setupFeaturedPanel('ebook');
            setupFeaturedPanel('video');
            setupFeaturedPanel('blog');

            function confirmDeleteEbook(id) {
                if (!confirm('Apakah Anda yakin ingin menghapus e-book ini?')) return;
                var form = document.getElementById('delete-ebook-form');
                form.action = form.dataset.template.replace('__ID__', id);
                form.submit();
            }

            function openEditEbookModal(ebook) {
                const modal = document.getElementById('edit-ebook-modal');
                modal.querySelector('#edit-ebook-form').action = '/admin/ebook/' + ebook.id;
                modal.querySelector('#edit-ebook-title').value = ebook.title;
                modal.querySelector('#edit-ebook-description').value = ebook.description || '';
                
                modal.querySelectorAll('input[name="categories[]"]').forEach(cb => cb.checked = false);
                if (ebook.categories) {
                    ebook.categories.forEach(cat => {
                        const cb = modal.querySelector('#edit-eb-' + cat.id);
                        if (cb) cb.checked = true;
                    });
                }
                
                modal.classList.remove('hidden');
            }

            function openEditVideoModal(e, video) {
                e.stopPropagation();
                const modal = document.getElementById('edit-video-modal');
                modal.querySelector('#edit-video-form').action = '/admin/video/' + video.id;
                modal.querySelector('#edit-video-title').value = video.title;
                modal.querySelector('#edit-video-url').value = video.video_url;
                modal.querySelector('#edit-video-desc').value = video.description || '';
                modal.querySelector('#delete-video-form').action = '/admin/video/' + video.id;
                
                modal.querySelectorAll('input[name="categories[]"]').forEach(cb => cb.checked = false);
                if (video.categories) {
                    video.categories.forEach(cat => {
                        const cb = modal.querySelector('#edit-vi-' + cat.id);
                        if (cb) cb.checked = true;
                    });
                }
                
                modal.classList.remove('hidden');
            }

            function confirmDeleteVideo() {
                if (confirm('Apakah Anda yakin ingin menghapus video ini?')) {
                    document.getElementById('delete-video-form').submit();
                }
            }
        @endauth
    </script>
@endpush
@endsection
