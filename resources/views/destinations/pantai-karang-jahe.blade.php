@extends('layouts.app')

@section('title', 'Pantai Karang Jahe — Wisata Pesisir dengan Hutan Cemara Laut, Rembang')
@section('meta_description', 'Pantai Karang Jahe di Desa Punjulharjo, Rembang, terkenal dengan hutan cemara laut hasil konservasi abrasi. Tersedia wahana ATV, motor trail, perahu wisata, gazebo, dan wahana air keluarga di tepi pantai berpasir putih.')
@php
    $_pantaiOgRaw = \App\Models\SiteSetting::getValue('karang_jahe_tentang_image');
    $_pantaiOg = $_pantaiOgRaw
        ? (str_starts_with($_pantaiOgRaw, 'http') ? $_pantaiOgRaw : asset('storage/' . ltrim($_pantaiOgRaw, '/')))
        : asset('images/beach-bg.png');
@endphp
@section('og_image', $_pantaiOg)

@push('structured_data')
@php
$_touristSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'TouristAttraction',
    'name' => 'Pantai Karang Jahe',
    'description' => 'Pantai Karang Jahe di Desa Punjulharjo, Rembang, terkenal dengan hutan cemara laut hasil konservasi abrasi. Tersedia wahana ATV, motor trail, perahu wisata, gazebo, dan wahana air keluarga di tepi pantai berpasir putih.',
    'image' => $_pantaiOg,
    'url' => route('destinasi.pantai-karang-jahe'),
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
            'name' => 'Destinasi',
            'item' => url('/') . '#jelajahi-destinasi',
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => 'Pantai Karang Jahe',
            'item' => route('destinasi.pantai-karang-jahe'),
        ],
    ],
];
@endphp
<script type="application/ld+json">{!! json_encode($_touristSchema, JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($_breadcrumbSchema, JSON_UNESCAPED_SLASHES) !!}</script>
@endpush


@section('content')
    @php
        // Dynamic Hero Background image check
        $customBg = \App\Models\SiteSetting::getValue('hero_detail_pantai_karang_jahe');
        $heroImage = $customBg
            ? (str_starts_with($customBg, 'http') || str_contains($customBg, 'storage/') ? asset($customBg) : Storage::url($customBg))
            : (file_exists(public_path('images/destinasi/karangjahe-hero.jpg')) 
                ? asset('images/destinasi/karangjahe-hero.jpg') 
                : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');

        $customTentang = \App\Models\SiteSetting::getValue('destinasi_karang_jahe_image');
        $tentangImage = $customTentang
            ? (str_starts_with($customTentang, 'http') || str_contains($customTentang, 'storage/') ? asset($customTentang) : Storage::url($customTentang))
            : (file_exists(public_path('images/destinasi/karangjahe-tentang.jpg')) 
                ? asset('images/destinasi/karangjahe-tentang.jpg') 
                : 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80');

        // Carousel & Gallery Data for Pantai Karang Jahe
        $carouselItemsJson = \App\Models\SiteSetting::getValue('carousel_pantai_karang_jahe');
        $carouselItems = $carouselItemsJson ? json_decode($carouselItemsJson, true) : [];

        $galleryItemsJson = \App\Models\SiteSetting::getValue('gallery_pantai_karang_jahe');
        $galleryItems = $galleryItemsJson ? json_decode($galleryItemsJson, true) : [];
    @endphp

    <!-- =========================================================================
         SECTION 1: Hero Banner [hero]
         ========================================================================= -->
    <section class="relative text-center min-h-[50vh] lg:min-h-[80vh] flex flex-col justify-center items-center bg-transparent overflow-hidden">
        <!-- Background Image with zoom/parallax effect -->
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat transform scale-105 transition-transform duration-[10000ms]"
             style="background-image: url('{{ $heroImage }}');">
        </div>
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-slate-950/50"></div>

        <!-- Hero Content -->
        <div class="relative z-10 px-4 mt-20 md:mt-24 max-w-5xl mx-auto space-y-4 md:space-y-6">


            <!-- Eyebrow Chip -->

            <!-- Title in heading font -->
            <h1 class="text-2xl md:text-7xl font-heading text-white drop-shadow-lg leading-tight">
                PANTAI KARANG JAHE
            </h1>

            <!-- Subtitle -->
            <p class="text-xs md:text-xl text-slate-100 max-w-3xl mx-auto leading-relaxed drop-shadow opacity-95">
                Pesona pasir putih bersih dibalut keasrian ribuan cemara laut yang rindang di pesisir Punjulharjo.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center pt-2 md:pt-4">
                <a href="#lokasi" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-accent hover:bg-yellow-500 text-brand-dark transition-colors duration-300 font-bold px-6 py-2.5 md:px-8 md:py-3.5 text-xs md:text-sm shadow-lg min-h-[40px] md:min-h-[44px]">
                    Lihat Lokasi & Rute
                    <i class="fa-solid fa-map-location-dot ml-2"></i>
                </a>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-colors duration-300 font-semibold px-6 py-2.5 md:px-8 md:py-3.5 text-xs md:text-sm border border-white/20 min-h-[40px] md:min-h-[44px]">
                    Kembali ke Beranda
                    <i class="fa-solid fa-arrow-left ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Wave Divider (Synchronized with layout styles) -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[40px] md:h-[80px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,90 C320,130,420,40,740,70 C1040,95,1120,60,1200,80 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.5)"></path>
                <path d="M0,60 C240,90,380,30,700,60 C1000,85,1080,45,1200,55 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.7)"></path>
                <path d="M0,30 C150,60,350,10,600,40 C850,70,1050,30,1200,40 L1200,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>

        @if(Auth::check() && Auth::user()->isAdmin())
            <!-- Floating Edit Button for Component Hero -->
            <div class="absolute top-28 right-8 z-30">
                <button onclick="document.getElementById('edit-hero-modal-hero_detail_pantai_karang_jahe').classList.remove('hidden')" 
                        class="bg-white/80 hover:bg-white text-slate-800 px-4 py-2.5 rounded-none shadow border border-white/20 transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                    <i class="fa-solid fa-pencil text-sky-600"></i> Edit Background Hero
                </button>
            </div>
        @endif
    </section>

    <div id="heroSentinel" aria-hidden="true" class="h-px w-full bg-transparent"></div>

    <!-- =========================================================================
         SECTION 2: Quick Facts [quickfacts]
         ========================================================================= -->
    <section class="relative z-20 px-3 md:px-6 max-w-6xl mx-auto -mt-6 md:-mt-16">
        <div class="bg-white p-3.5 md:p-8 rounded-none border border-slate-200 shadow-lg">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 md:gap-4 divide-y sm:divide-y-0 lg:divide-x divide-slate-100">
                <!-- Location -->
                <div class="flex flex-col items-center text-center p-1 md:p-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-location-dot text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Lokasi</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Punjulharjo, Rembang</p>
                </div>
                <!-- Coast Length -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-ruler-horizontal text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Garis Pantai</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">± 3 km Pasir Putih</p>
                </div>
                <!-- Hours -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-clock text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Jam Buka</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">06.00 – 17.30 WIB</p>
                </div>
                <!-- Ticket -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-ticket text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Tiket/Parkir</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Mulai Rp 5.000 (motor)</p>
                </div>
                <!-- Manager -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-people-group text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Pengelola</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">BUMDes & Pokdarwis</p>
                </div>
                <!-- Award -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-star text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Predikat</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">500 Besar ADWI 2023</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 3: Tentang [tentang]
         ========================================================================= -->
    <section id="tentang" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-12 items-center">
                <!-- Text Content Left -->
                <div class="space-y-4 md:space-y-6">
                    <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                        Tentang Pantai Karang Jahe
                    </h2>
                    <div class="space-y-3 text-slate-600 leading-relaxed text-justify text-[11px] md:text-base">
                        <p>
                            Pantai Karang Jahe merupakan salah satu destinasi wisata paling ikonik dan populer di pesisir Kabupaten Rembang, tepatnya berada di wilayah Desa Punjulharjo, Kecamatan Rembang. Dinamakan "Karang Jahe" karena di sepanjang bibir pantai terdapat banyak karang kecil yang bentuknya menyerupai rimpang tanaman jahe. Pantai ini membentang sejauh kurang lebih 3 kilometer dengan hamparan pasir putih yang lembut dan landai, berpadu dengan air laut jernih dan ombak yang tenang.
                        </p>
                        <p>
                            Berada di kawasan pesisir Laut Jawa, Pantai Karang Jahe menjadi bagian dari Desa Wisata Punjulharjo yang memiliki luas wilayah sekitar 394 hektare, terbagi ke dalam empat dusun (Nggodo, Belah, Jetak, dan Kiringan) dengan jumlah penduduk sekitar 1.767 jiwa. Kombinasi pasir putih, laut biru, dan barisan cemara laut menjadikannya salah satu ikon pariwisata paling dibanggakan di pesisir utara Jawa Tengah.
                        </p>
                    </div>
                </div>

                <!-- Graphic/Photo Right -->
                <div class="relative group">
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <!-- Floating Edit Button on Hover -->
                        <div class="absolute top-4 right-4 z-[50] opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-auto">
                            <button type="button" onclick="document.getElementById('edit-custom-image-modal-destinasi_karang_jahe_image').classList.remove('hidden')" 
                                    class="bg-white/95 hover:bg-white text-slate-800 p-2.5 rounded-md shadow-md border border-slate-200/50 flex items-center justify-center" title="Edit Foto Tentang Pantai Karang Jahe">
                                <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                            </button>
                        </div>
                    @endif
                    <div class="absolute -inset-1.5 bg-gradient-to-tr from-sky-100 to-indigo-100 rounded-none z-0 opacity-70"></div>
                    <div class="relative z-10 border border-slate-200 bg-white p-2 md:p-3 shadow-md">
                        <!-- TODO: ganti gambar dengan foto lokal Pantai Karang Jahe asli jika sudah tersedia -->
                        <img src="{{ $tentangImage }}" 
                             alt="Pohon Cemara Laut Rimbun di Pantai Karang Jahe Punjulharjo" 
                             class="w-full h-56 md:h-96 object-cover rounded-none" 
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 4: Lokasi & Akses [akses]
         ========================================================================= -->
    <section id="lokasi" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Lokasi & Akses Menuju Pantai
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Kemudahan akses transportasi jalan raya utama untuk berkunjung bersama keluarga maupun rombongan bus.
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-4 lg:gap-8 items-start">
                <!-- Info Left -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-white p-4 md:p-8 rounded-none border border-slate-200 shadow-sm space-y-3 md:space-y-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-car text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs md:text-base">Dari Pusat Kota Rembang</h4>
                                <p class="text-[10px] text-slate-600 mt-0.5 leading-snug">Hanya ± 8–10 km atau sekitar 15–20 menit berkendara ke arah timur.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-plane-departure text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs md:text-base">Dari Kota Semarang</h4>
                                <p class="text-[10px] text-slate-600 mt-0.5 leading-snug">± 125–134 km atau sekitar 3 jam menggunakan kendaraan pribadi.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-route text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs md:text-base">Rute Umum</h4>
                                <p class="text-[10px] text-slate-600 mt-0.5 leading-snug">Melalui Jl. Jenderal Sudirman menuju Jl. Raya Semarang–Tuban; di dekat gapura Desa Punjulharjo sudah terpasang arah. Dari Balai Desa Punjulharjo, lurus ke arah barat laut sekitar 500 meter.</p>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Google Maps Right -->
                <div class="lg:col-span-7 space-y-3">
                    <div class="w-full aspect-video rounded-none overflow-hidden border border-slate-200 shadow-sm bg-white p-1">
                        <iframe src="https://maps.google.com/maps?q=Pantai%20Karang%20Jahe%2C%20Punjulharjo%2C%20Rembang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none w-full h-full"></iframe>
                    </div>
                    <div class="flex justify-end">
                        <a href="https://www.google.com/maps/search/?api=1&query=Pantai+Karang+Jahe,+Punjulharjo,+Rembang" 
                           target="_blank" 
                           class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-dark hover:bg-slate-800 text-white font-semibold px-4 py-2 text-[10px] md:text-xs shadow min-h-[40px] md:min-h-[44px]"
                           aria-label="Buka Rute Pantai Karang Jahe di Google Maps">
                            <i class="fa-solid fa-map-location-dot mr-1.5"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 5: Sejarah [sejarah]
         ========================================================================= -->
    <section id="sejarah" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Jejak Sejarah Karang Jahe
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Dari penemuan arkeologi hingga meraih predikat destinasi terpopuler di Rembang.
                </p>
            </div>

            <!-- Vertical Timeline -->
            <div class="relative border-l-2 border-sky-200 ml-2 sm:ml-6 space-y-6 md:space-y-10 py-2">
                <!-- 2008 -->
                <div class="relative pl-5 sm:pl-10">
                    <!-- Bullet dot -->
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-xs md:text-base block">2008 — Temuan Perahu Kuno</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Warga menemukan bangkai perahu kayu kuno saat menggali tambak (± 500 m dari pantai). Uji radiokarbon menunjukkan usia abad ke-7–8 Masehi, setara masa pembangunan Candi Borobudur — diyakini salah satu perahu kayu tertua & terlengkap di Indonesia.
                        </p>
                    </div>
                </div>

                <!-- 2009 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-xs md:text-base block">2009 — Gerakan Penghijauan</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Pemuda desa M. Ali Mustofa bersama warga mulai menanam ribuan pohon cemara laut untuk menahan abrasi. Inilah cikal-bakal lanskap khas Karang Jahe.
                        </p>
                    </div>
                </div>

                <!-- 2013 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-xs md:text-base block">2013 — Dibuka untuk Umum</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Kawasan pantai resmi dibuka bagi wisatawan.
                        </p>
                    </div>
                </div>

                <!-- 2015 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-xs md:text-base block">2015 — Peresmian Pengelolaan</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Pengelolaan dikukuhkan oleh Pemerintah Desa Punjulharjo; berkembang dari gerakan pemuda menjadi tata kelola desa terstruktur.
                        </p>
                    </div>
                </div>

                <!-- 2023 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-xs md:text-base block">2023 — Pengakuan Nasional</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Desa Wisata Punjulharjo masuk 500 Besar Anugerah Desa Wisata Indonesia (ADWI).
                        </p>
                    </div>
                </div>

                <!-- 2024 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-xs md:text-base block">2024 — Kunjungan Terbanyak</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Menjadi objek wisata dengan pengunjung terbanyak di Kabupaten Rembang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 5B: Galeri Foto [galeri]
         ========================================================================= -->
    <section id="galeri" class="bg-white py-12 md:py-24 px-4 md:px-6 relative z-10 border-b border-slate-100">
        <div class="max-w-6xl mx-auto relative">
            @if(Auth::check() && Auth::user()->isAdmin())
                <!-- Floating Add Button for Gallery -->
                <div class="absolute top-0 right-4 sm:right-6 lg:right-8 z-30">
                    <button onclick="document.getElementById('add-gallery-modal-karang-jahe').classList.remove('hidden')" 
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-none shadow transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                        <i class="fa-solid fa-plus"></i> Tambah Foto
                    </button>
                </div>
            @endif

            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Dokumentasi</span>
                <h2 class="text-3xl font-bold text-slate-800 font-title mt-1">Galeri Pantai Karang Jahe</h2>
                <p class="text-slate-600 mt-2">Aktivitas pengunjung & keindahan alam di sekitar Pantai Karang Jahe.</p>
            </div>

            @if(empty($galleryItems))
                @php
                    $galleryGridClassesFb = [
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-1',
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-3',
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-1',
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-2',
                        'col-span-2 row-span-1 md:col-span-2 md:row-span-2 md:col-start-3 md:row-start-1',
                        'col-span-2 row-span-1 md:col-span-3 md:row-span-2 md:col-start-2 md:row-start-3',
                    ];
                    $fallbackGallery = [
                        ['title' => 'Pantai Karang Jahe', 'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80'],
                        ['title' => 'Hutan Cemara Laut',  'image' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=600&q=80'],
                        ['title' => 'Wahana ATV',         'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80'],
                        ['title' => 'Ombak Pesisir',      'image' => 'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?auto=format&fit=crop&w=600&q=80'],
                        ['title' => 'Sunset Pantai',      'image' => 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?auto=format&fit=crop&w=800&q=80'],
                        ['title' => 'Perahu Wisata',      'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80'],
                    ];
                @endphp
                <div x-data="{ activePhoto: null, activePhotoAlt: '' }" class="relative">
                    <div class="w-full h-auto md:h-[100vh] grid grid-cols-2 md:grid-cols-4 auto-rows-[120px] sm:auto-rows-[180px] md:auto-rows-auto md:grid-rows-4 gap-0 overflow-hidden bg-black rounded-2xl">
                        @foreach($fallbackGallery as $fi => $fbPhoto)
                            <div @click="activePhoto = '{{ $fbPhoto['image'] }}'; activePhotoAlt = '{{ $fbPhoto['title'] }}'"
                                 class="relative w-full h-full group {{ $galleryGridClassesFb[$fi] ?? 'hidden' }} overflow-hidden cursor-pointer">
                                <img src="{{ $fbPhoto['image'] }}"
                                     alt="{{ $fbPhoto['title'] }}"
                                     class="absolute inset-0 w-full h-full object-cover rounded-none">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 pointer-events-none z-10">
                                    <span class="text-white font-medium text-lg leading-tight">{{ $fbPhoto['title'] }}</span>
                                </div>
                                {{-- Tidak ada tombol edit di foto fallback --}}
                            </div>
                        @endforeach
                    </div>
                    <!-- Lightbox -->
                    <div x-show="activePhoto" x-cloak @click="activePhoto = null"
                         class="fixed inset-0 bg-black/90 z-[150] flex items-center justify-center p-4 cursor-zoom-out" style="display: none;">
                        <img :src="activePhoto" :alt="activePhotoAlt" class="max-h-full max-w-full object-contain">
                    </div>
                </div>
            @else
                @php
                    $galleryGridClasses = [
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-1',
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-3',
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-1',
                        'col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-2',
                        'col-span-2 row-span-1 md:col-span-2 md:row-span-2 md:col-start-3 md:row-start-1',
                        'col-span-2 row-span-1 md:col-span-3 md:row-span-2 md:col-start-2 md:row-start-3',
                    ];
                @endphp
                <div x-data="{ activePhoto: null, activePhotoAlt: '' }" class="relative">
                    <div class="w-full h-auto md:h-[100vh] grid grid-cols-2 md:grid-cols-4 auto-rows-[120px] sm:auto-rows-[180px] md:auto-rows-auto md:grid-rows-4 gap-0 overflow-hidden bg-black rounded-2xl">
                        @foreach(array_slice($galleryItems, 0, 6) as $index => $item)
                            @php
                                $imageUrl = str_starts_with($item['image'], 'http') ? $item['image'] : Storage::url($item['image']);
                            @endphp
                            <div @click="activePhoto = '{{ $imageUrl }}'; activePhotoAlt = '{{ $item['title'] }}'"
                                 class="relative w-full h-full group {{ $galleryGridClasses[$index] ?? 'hidden' }} overflow-hidden cursor-pointer">
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $item['title'] }}"
                                     class="absolute inset-0 w-full h-full object-cover rounded-none">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 pointer-events-none z-10">
                                    <span class="text-white font-medium text-lg leading-tight">{{ $item['title'] }}</span>
                                </div>
                                @if(Auth::check() && Auth::user()->isAdmin())
                                    <button onclick="openEditGalleryModal_karangJahe(event, {{ json_encode($item) }})"
                                            class="absolute top-2 right-2 z-20 bg-white/90 hover:bg-white text-slate-700 w-8 h-8 rounded-full flex items-center justify-center shadow">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <!-- Lightbox -->
                    <div x-show="activePhoto" x-cloak @click="activePhoto = null"
                         class="fixed inset-0 bg-black/90 z-[150] flex items-center justify-center p-4 cursor-zoom-out" style="display: none;">
                        <img :src="activePhoto" :alt="activePhotoAlt" class="max-h-full max-w-full object-contain">
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- =========================================================================
         SECTION 6: Sorotan & Fasilitas [sorotan]
         ========================================================================= -->
    <section id="sorotan" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="relative">
                @if(Auth::check() && Auth::user()->isAdmin())
                    <div class="absolute top-0 right-0 z-30">
                        <a href="{{ route('admin.karang-jahe-sorotan.index') }}" 
                           class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-semibold px-4 py-2 text-xs transition shadow-sm">
                            <i class="fa-solid fa-pen"></i> Edit Sorotan & Fasilitas
                        </a>
                    </div>
                @endif
                <div class="text-center space-y-2 md:space-y-4">
                    <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                        Sorotan & Fasilitas Pantai
                    </h2>
                    <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                        Daya tarik dan fasilitas unggulan yang membuat kunjungan Anda semakin nyaman dan berkesan.
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach($sorotanKarangJahe as $item)
                    <div class="bg-white border border-slate-200 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between">
                        <div>
                            @if($item->gambar)
                                <img src="{{ (str_starts_with($item->gambar, 'http') || str_contains($item->gambar, 'storage/')) ? asset($item->gambar) : Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-28 md:h-36 object-cover">
                            @else
                                <div class="w-full h-28 md:h-36 bg-sky-50 flex items-center justify-center text-sky-600">
                                    <i class="{{ $item->icon ?? 'fa-solid fa-star' }} text-2xl"></i>
                                </div>
                            @endif
                            <div class="p-3 md:p-4">
                                <h3 class="text-xs md:text-base font-heading text-slate-900 mb-1">{{ $item->judul }}</h3>
                                <p class="text-[10px] md:text-xs text-slate-600 leading-relaxed text-justify">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>    <!-- =========================================================================
         SECTION 8: 3D Coverflow Experience (Aktivitas Pantai)
         ========================================================================= -->
    <section id="aktivitas" class="bg-slate-50 py-8 md:py-24 px-4 md:px-12 relative overflow-hidden z-10 border-y border-slate-100">
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-sky-200/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-200/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <!-- Header -->
            <div class="space-y-2 md:space-y-4 mb-8 md:mb-16 max-w-3xl mx-auto relative">
                <h2 class="text-xl sm:text-2xl md:text-5xl font-heading text-gray-900 tracking-wide leading-tight">
                    Jelajahi Aktivitas
                </h2>
                <p class="text-gray-600 font-sans text-xs sm:text-sm md:text-lg">
                    Klik kartu di kanan/kiri untuk memutar dan memfokuskan petualangan seru yang dapat Anda nikmati di destinasi kami.
                </p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <!-- Floating Add Button for Carousel -->
                    <div class="absolute top-0 right-0">
                        <button onclick="document.getElementById('add-carousel-modal-karang-jahe').classList.remove('hidden')" 
                                class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-none shadow transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                            <i class="fa-solid fa-plus"></i> Tambah Aktivitas
                        </button>
                    </div>
                @endif
            </div>

            {{-- Tentukan items yang akan ditampilkan: data asli dari DB, atau fallback statis --}}
            @php
                if (!empty($carouselItems)) {
                    $displayItems   = $carouselItems;
                    $isFallback     = false;
                } else {
                    $isFallback     = true;
                    $displayItems   = [
                        [
                            'id'          => 0,
                            'title'       => 'ATV',
                            'description' => 'Menyusuri garis pasir pantai sepanjang 3 km dengan menggunakan armada ATV.',
                            'image'       => \App\Models\SiteSetting::getValue('pantai_act_atv_image',
                                'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80'),
                        ],
                        [
                            'id'          => 0,
                            'title'       => 'Motor Trail',
                            'description' => 'Petualangan seru memacu adrenalin dengan motor trail di area trek berpasir.',
                            'image'       => \App\Models\SiteSetting::getValue('pantai_act_trail_image',
                                'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=600&q=80'),
                        ],
                        [
                            'id'          => 0,
                            'title'       => 'Wahana Ban',
                            'description' => 'Bermain air seru dan santai di tepi pantai yang dangkal menggunakan ban pelampung.',
                            'image'       => \App\Models\SiteSetting::getValue('pantai_act_ban_image',
                                'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=600&q=80'),
                        ],
                        [
                            'id'          => 0,
                            'title'       => 'Mandi Bola',
                            'description' => 'Wahana bermain anak yang seru dan aman penuh keceriaan mandi bola warna-warni.',
                            'image'       => \App\Models\SiteSetting::getValue('pantai_act_mandi_bola_image',
                                'https://images.unsplash.com/photo-1596464716127-f2a82984de30?auto=format&fit=crop&w=600&q=80'),
                        ],
                        [
                            'id'          => 0,
                            'title'       => 'Perahu',
                            'description' => 'Menyusuri perairan pantai tenang dengan menyewa perahu wisata tradisional bersama keluarga.',
                            'image'       => \App\Models\SiteSetting::getValue('pantai_act_perahu_image',
                                'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80'),
                        ],
                        [
                            'id'          => 0,
                            'title'       => 'Gazebo',
                            'description' => 'Sewa gazebo kayu yang nyaman untuk bersantai menikmati hembusan angin laut di bawah keteduhan cemara.',
                            'image'       => \App\Models\SiteSetting::getValue('pantai_act_gazebo_image',
                                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80'),
                        ],
                    ];
                }
            @endphp

            {{-- Viewport for 3D Carousel --}}
            <div class="coverflow-viewport">
                @foreach($displayItems as $item)
                    <div class="coverflow-card rounded-xl overflow-hidden shadow bg-slate-900 border border-white/10 flex flex-col justify-end p-5 md:p-8 select-none relative group/card">
                        <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : Storage::url($item['image']) }}"
                             alt="{{ $item['title'] }}"
                             class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0 transition-transform duration-700 group-hover/card:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none opacity-0 group-hover/card:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-20 text-left space-y-2 pointer-events-none opacity-0 translate-y-3 group-hover/card:opacity-100 group-hover/card:translate-y-0 transition-all duration-500">
                            <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">{{ $item['title'] }}</h4>
                            <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">{{ $item['description'] }}</p>
                        </div>
                        @if(!$isFallback && Auth::check() && Auth::user()->isAdmin())
                            <div class="absolute top-4 right-4 z-30 opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                                <button onclick="openEditCarouselModal_karangJahe(event, {{ json_encode($item) }})" 
                                        class="bg-white/90 hover:bg-white text-slate-800 p-2.5 rounded-none shadow border border-slate-200/50 flex items-center justify-center">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Bullet indicators --}}
            <div class="mt-4 md:mt-8 flex justify-center items-center gap-2" id="coverflow-dots-karang-jahe">
                @foreach($displayItems as $index => $item)
                    <button class="h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-sky-500 w-6' : 'bg-slate-300 w-2' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 9: Event & Tradisi [event]
         ========================================================================= -->
    <section id="event" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Event Tahunan & Tradisi Lokal
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Kemeriahan pagelaran adat pesisir dan festival berkala yang melestarikan seni budaya luhur.
                </p>
            </div>

            <!-- Events List -->
            <div class="space-y-4 md:space-y-6">
                <!-- Event 1 -->
                <div class="p-4 md:p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Lomba Layang-Layang</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Digelar rutin secara berkala diikuti puluhan peserta dari berbagai daerah Jawa Tengah.</p>
                    </div>
                    <span class="bg-sky-100 text-sky-800 text-[8px] md:text-[10px] font-bold uppercase px-2.5 py-0.5 md:px-3 md:py-1 rounded-full shrink-0">Tahunan</span>
                </div>

                <!-- Event 2 -->
                <div class="p-4 md:p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Sedekah Laut / Nyadran</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Tradisi syukuran budaya turun-temurun masyarakat nelayan pesisir atas limpahan hasil laut.</p>
                    </div>
                    <span class="bg-amber-100 text-amber-800 text-[8px] md:text-[10px] font-bold uppercase px-2.5 py-0.5 md:px-3 md:py-1 rounded-full shrink-0">Budaya</span>
                </div>

                <!-- Event 3 -->
                <div class="p-4 md:p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Pentas Seni Tradisional</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Pagelaran seni tradisional khas Punjulharjo seperti Thong-thong Lek, Barongan, dan Tari Kepak.</p>
                    </div>
                    <span class="bg-emerald-100 text-emerald-800 text-[8px] md:text-[10px] font-bold uppercase px-2.5 py-0.5 md:px-3 md:py-1 rounded-full shrink-0">Seni</span>
                </div>

                <!-- Event 4 -->
                <div class="p-4 md:p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Musik & Kepramukaan</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Berbagai kegiatan olahraga massal, perkemahan kepramukaan, serta hiburan panggung musik rakyat.</p>
                    </div>
                    <span class="bg-indigo-100 text-indigo-800 text-[8px] md:text-[10px] font-bold uppercase px-2.5 py-0.5 md:px-3 md:py-1 rounded-full shrink-0">Hiburan</span>
                </div>

                <!-- Kearifan Lokal Note -->
                <div class="p-4 border border-sky-100 bg-sky-50/50 rounded-none text-[10px] text-slate-600 flex gap-2">
                    <i class="fa-solid fa-circle-exclamation text-sky-600 shrink-0 mt-0.5" aria-hidden="true"></i>
                    <span><strong>Catatan Operasional (Kearifan Lokal):</strong> Pada bulan suci Ramadan, kawasan wisata pantai pernah ditutup total untuk umum agar masyarakat sekitar dan pengunjung dapat lebih khusyuk fokus menjalankan ibadah puasa dan aktivitas keagamaan.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 10: Harga Tiket & Tarif [tarif]
         ========================================================================= -->
    <section id="tarif" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Harga Tiket & Tarif Masuk
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Rincian perkiraan biaya masuk, retribusi parkir kendaraan, dan sewa wahana penyeberangan di Pantai Karang Jahe.
                </p>
            </div>

            <!-- Responsive Table Wrapper -->
            <div class="bg-white border border-slate-200 shadow-sm overflow-hidden rounded-none">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[400px]">
                        <thead>
                            <tr class="bg-brand-dark text-white text-[10px] md:text-sm font-semibold uppercase tracking-wider">
                                <th class="p-3 md:p-4 pl-4 md:pl-6">Komponen Tiket / Wahana</th>
                                <th class="p-3 md:p-4 pr-4 md:pr-6 text-right">Tarif (Kisaran)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-[10px] md:text-sm font-medium text-slate-700">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3 md:p-4 pl-4 md:pl-6">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-motorcycle text-slate-400 text-xs shrink-0" aria-hidden="true"></i>
                                        <span>Tiket & Parkir Motor</span>
                                    </div>
                                </td>
                                <td class="p-3 md:p-4 pr-4 md:pr-6 text-right text-brand-dark font-bold">Rp 5.000</td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3 md:p-4 pl-4 md:pl-6">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-car text-slate-400 text-xs shrink-0" aria-hidden="true"></i>
                                        <span>Tiket & Parkir Mobil</span>
                                    </div>
                                </td>
                                <td class="p-3 md:p-4 pr-4 md:pr-6 text-right text-brand-dark font-bold">Rp 15.000 – Rp 25.000 <span class="text-[8px] text-slate-400 font-normal block mt-0.5">(lebih tinggi saat weekend/libur)</span></td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3 md:p-4 pl-4 md:pl-6">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-bus text-slate-400 text-xs shrink-0" aria-hidden="true"></i>
                                        <span>Bus / Rombongan Besar</span>
                                    </div>
                                </td>
                                <td class="p-3 md:p-4 pr-4 md:pr-6 text-right text-brand-dark font-bold">Rp 25.000 – Rp 130.000 <span class="text-[8px] text-slate-400 font-normal block mt-0.5">(tergantung dimensi bus)</span></td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3 md:p-4 pl-4 md:pl-6">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-person text-slate-400 text-xs shrink-0" aria-hidden="true"></i>
                                        <span>Estimasi Per Orang</span>
                                    </div>
                                </td>
                                <td class="p-3 md:p-4 pr-4 md:pr-6 text-right text-brand-dark font-bold">± Rp 10.000 – Rp 15.000</td>
                            </tr>
                            <!-- Row 5 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3 md:p-4 pl-4 md:pl-6">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-ship text-slate-400 text-xs shrink-0" aria-hidden="true"></i>
                                        <span>Perahu ke Pulau Gede</span>
                                    </div>
                                </td>
                                <td class="p-3 md:p-4 pr-4 md:pr-6 text-right text-brand-dark font-bold">± Rp 300.000 / Perahu <span class="text-[8px] text-slate-400 font-normal block mt-0.5">(maksimal 10 orang)</span></td>
                            </tr>
                            <!-- Row 6 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-3 md:p-4 pl-4 md:pl-6">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-monument text-slate-400 text-xs shrink-0" aria-hidden="true"></i>
                                        <span>Situs Perahu Kuno Tiket</span>
                                    </div>
                                </td>
                                <td class="p-3 md:p-4 pr-4 md:pr-6 text-right text-brand-dark font-bold">Mulai ± Rp 2.000 – Rp 5.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 bg-slate-50 border-t border-slate-200 text-[10px] text-slate-500 font-sans italic text-center">
                    * Sewa wahana individu (ATV, sewa perahu karet, kereta wisata, banana boat) bervariasi terpisah sesuai jenis.
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 11: Ekonomi & Tata Kelola [ekonomi]
         ========================================================================= -->
    <section id="ekonomi" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-slate-900 tracking-wide">
                    Tata Kelola & Dampak Ekonomi
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Model pemberdayaan kolaboratif yang berkontribusi nyata pada pendapatan desa dan warga.
                </p>
            </div>

            <!-- Narration & Model Pengelolaan -->
            <div class="bg-slate-50 p-4 md:p-8 border border-slate-200 shadow-sm space-y-3">
                <h3 class="text-xs md:text-lg font-heading text-slate-800 border-b pb-2">Sistem Tata Kelola Kolaboratif</h3>
                <p class="text-slate-600 leading-relaxed text-justify text-[10px] md:text-sm">
                    Dikelola kolaboratif berbasis masyarakat — Badan Pengelola Pantai Karang Jahe (BPPKJ) bersama Pokdarwis, terintegrasi dalam BUMDes "Abimantrana". Sumber dana operasional kawasan berasal dari tiket parkir kendaraan, retribusi karcis, sewa warung/kios pedagang, biaya sewa fasilitas penunjang, serta mendapat dukungan stimulan APBD Kabupaten Rembang.
                </p>
            </div>

            <!-- Stats Counters / Fact Cards (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-6">
                <!-- Stat 1 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">± Rp 2 Miliar</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Perputaran Uang</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Per tahun di kawasan masuk langsung ke masyarakat (warung, wahana, homestay).</p>
                </div>

                <!-- Stat 2 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">± Rp 150 Juta</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">PADes Desa</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Kontribusi bersih ke PADes Punjulharjo (unit usaha KJB, data laporan 2019).</p>
                </div>

                <!-- Stat 3 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">88.450</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Pengunjung 2024</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Jumlah kunjungan tertinggi di antara semua objek wisata di Rembang.</p>
                </div>

                <!-- Stat 4 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">&gt; 46.090</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Libur Nataru</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Pengunjung selama libur Nataru 2024/2025 (puncak 13.034 orang pada 1 Jan 2025).</p>
                </div>

                <!-- Stat 5 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between col-span-2 lg:col-span-1">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">± 41 UMKM</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">UMKM Lokal</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">UMKM warga lokal yang tumbuh subur di sepanjang kawasan perbelanjaan wisata.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 12: Dampak Sosial [dampak]
         ========================================================================= -->
    <section id="dampaksosial" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Manfaat Bagi Warga Punjulharjo
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Bagaimana pariwisata mengangkat derajat hidup, pelestarian alam, dan memajukan pendidikan desa.
                </p>
            </div>

            <!-- Impact Grid (1 Column on Mobile) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-4 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-briefcase text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base md:text-lg font-heading text-slate-900 mb-1">Tenaga Kerja</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed text-justify">
                            Warga desa diserap aktif sebagai petugas pengelola, kebersihan pantai, parkir, dan operator wahana.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-4 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-store text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base md:text-lg font-heading text-slate-900 mb-1">UMKM Warga</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed text-justify">
                            Sebanyak ± 41 unit UMKM tumbuh di kuliner laut, cendera mata khas pesisir, and homestay rumah warga.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-4 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-leaf text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base md:text-lg font-heading text-slate-900 mb-1">Restorasi Hijau</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed text-justify">
                            Konservasi penanaman ribuan pohon cemara laut guna menahan ancaman abrasi pesisir utara Jawa.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-4 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-hand-holding-heart text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base md:text-lg font-heading text-slate-900 mb-1">Pemberdayaan</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed text-justify">
                            Melalui BUMDes & Pokdarwis, warga bertindak sebagai pemilik sekaligus pengelola cagar wisata.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 13: CTA Penutup [cta]
         ========================================================================= -->
    <section class="relative bg-gradient-to-r from-brand-dark to-slate-900 text-white py-10 md:py-24 px-4 md:px-6 overflow-hidden relative z-10">
        <!-- Subtle Background Pattern Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/5 via-transparent to-transparent pointer-events-none" aria-hidden="true"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center space-y-4 md:space-y-6">
            <h2 class="text-xl md:text-5xl font-heading text-white tracking-wide">
                Rencanakan Kunjunganmu ke Karang Jahe
            </h2>
            <p class="text-slate-300 font-sans max-w-2xl mx-auto leading-relaxed text-[11px] md:text-base">
                Nikmati pasir putih, teduhnya cemara laut, and hangatnya keramahan warga Punjulharjo. Sampai jumpa di Pantai Karang Jahe!
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center pt-2 md:pt-4">
                <a href="#lokasi" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-accent hover:bg-yellow-500 text-brand-dark font-bold px-6 py-2.5 text-xs shadow-md transition duration-300 min-h-[40px] md:min-h-[44px]">
                    Lihat Lokasi Wisata
                    <i class="fa-solid fa-map-location-dot ml-2"></i>
                </a>
                <a href="{{ route('destinasi.situs-perahu-kuno') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-2.5 text-xs border border-white/20 transition duration-300 min-h-[40px] md:min-h-[44px]">
                    Jelajahi Destinasi Lain
                    <i class="fa-solid fa-compass ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 14: Destinasi Terkait [related]
         ========================================================================= -->
    <section class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-6 md:space-y-8">
            <h3 class="text-lg md:text-2xl font-heading text-slate-800 text-center font-bold">Destinasi Terkait</h3>
            
            <div class="max-w-xl mx-auto">
                <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="group block bg-white border border-slate-200 overflow-hidden hover:border-indigo-400 transition-colors duration-300 shadow-sm hover:shadow-md">
                    <div class="grid sm:grid-cols-12 gap-0">
                        <div class="sm:col-span-5 h-36 sm:h-full min-h-[140px] overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=600&q=80" 
                                 alt="Situs Cagar Budaya Perahu Kuno Punjulharjo" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 loading="lazy">
                        </div>
                        <div class="sm:col-span-7 p-4 md:p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] md:text-xs font-bold text-indigo-600 uppercase tracking-wider block mb-0.5">Cagar Budaya & Sejarah</span>
                                <h4 class="text-sm md:text-lg font-heading text-slate-900 group-hover:text-indigo-600 transition-colors duration-200">Situs Perahu Kuno</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-1 md:mt-2 leading-relaxed text-justify">
                                    Situs arkeologi nasional perahu kayu kuno utuh abad ke-7–8 Masehi yang merupakan salah satu perahu tertua di Indonesia. Hanya berjarak ± 500 meter dari pantai.
                                </p>
                            </div>
                            <div class="mt-2 md:mt-4 pt-1 flex items-center text-[10px] md:text-xs font-bold text-indigo-600 uppercase gap-1">
                                Kunjungi Situs <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Source Credits (Optional / Footnote) -->
    <footer class="bg-slate-50 border-t border-slate-100 py-6 text-center text-slate-400 text-[8px] md:text-xs relative z-10 px-4 md:px-6">
        <div class="max-w-4xl mx-auto space-y-2 leading-relaxed">
            <p><strong>Sumber Data Referensi:</strong> Profil Desa Wisata Punjulharjo & Pantai Karang Jahe Kemenparekraf (Jadesta) • Data Kunjungan Pemkab Rembang • Dinas Kebudayaan & Pariwisata Kab. Rembang • Wikipedia Bahasa Indonesia • Jurnal Ilmiah (Publika UNESA, JIANA, SENTRIKOM Polines, UMS, UB, Undip) • Akun Media Sosial Resmi @karangjahe_beach & @desawisatapunjulharjo.</p>
            <p>Laporan Pendapatan, Kunjungan, dan Jumlah Pelaku UMKM bersifat estimasi/periodik sesuai data pembukuan pengelola.</p>
        </div>
    </footer>

    @if(Auth::check() && Auth::user()->isAdmin())
        <!-- Edit Custom Hero Modal (Only Image, max 5MB) -->
        <div id="edit-hero-modal-hero_detail_pantai_karang_jahe" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Background Hero</h3>
                    <button type="button" onclick="document.getElementById('edit-hero-modal-hero_detail_pantai_karang_jahe').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.hero.update-custom') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hero_key" value="hero_detail_pantai_karang_jahe">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Gambar Baru</label>
                            <input type="file" name="hero_image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 5MB.</p>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('edit-hero-modal-hero_detail_pantai_karang_jahe').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
                @php
                    $backupBgDetail = \App\Models\SiteSetting::getValue('hero_detail_pantai_karang_jahe_backup');
                @endphp
                @if($backupBgDetail)
                    <div class="p-6 border-t border-slate-100 bg-slate-50">
                        <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                        <div class="flex items-center gap-3">
                            <img src="{{ (str_starts_with($backupBgDetail, 'http') || str_contains($backupBgDetail, 'storage/')) ? asset($backupBgDetail) : Storage::url($backupBgDetail) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                            <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="hero_key" value="hero_detail_pantai_karang_jahe">
                                <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                    <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Edit Custom Image Modal for Pantai Karang Jahe Tentang -->
        <div id="edit-custom-image-modal-destinasi_karang_jahe_image" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Foto Tentang Pantai Karang Jahe</h3>
                    <button type="button" onclick="document.getElementById('edit-custom-image-modal-destinasi_karang_jahe_image').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.hero.update-custom') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hero_key" value="destinasi_karang_jahe_image">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Gambar Baru</label>
                            <input type="file" name="hero_image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 5MB.</p>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('edit-custom-image-modal-destinasi_karang_jahe_image').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
                @php
                    $backupKarangJahe = \App\Models\SiteSetting::getValue('destinasi_karang_jahe_image_backup');
                @endphp
                @if($backupKarangJahe)
                    <div class="p-6 border-t border-slate-100 bg-slate-50">
                        <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                        <div class="flex items-center gap-3">
                            <img src="{{ (str_starts_with($backupKarangJahe, 'http') || str_contains($backupKarangJahe, 'storage/')) ? asset($backupKarangJahe) : Storage::url($backupKarangJahe) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                            <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="hero_key" value="destinasi_karang_jahe_image">
                                <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                    <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- =========================================================================
             MODALS & SCRIPTS FOR CAROUSEL & GALLERY (Pantai Karang Jahe)
             ========================================================================= -->
        <!-- Add Carousel Modal -->
        <div id="add-carousel-modal-karang-jahe" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800 font-bold">Tambah Aktivitas Pantai</h3>
                    <button type="button" onclick="document.getElementById('add-carousel-modal-karang-jahe').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="carousel_key" value="carousel_pantai_karang_jahe">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Gambar Aktivitas</label>
                            <input type="file" name="image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Maks 4MB.</p>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Aktivitas</label>
                            <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required placeholder="Contoh: Susur Pantai">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Singkat</label>
                            <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required placeholder="Deskripsikan keseruan aktivitas ini..."></textarea>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('add-carousel-modal-karang-jahe').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Tambah Aktivitas
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Carousel Modal -->
        <div id="edit-carousel-modal-karang-jahe" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Aktivitas Pantai</h3>
                    <button type="button" onclick="document.getElementById('edit-carousel-modal-karang-jahe').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="carousel_key" value="carousel_pantai_karang_jahe">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar. Maks 4MB.</p>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Aktivitas</label>
                            <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Singkat</label>
                            <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required></textarea>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between items-center">
                        <button type="button" onclick="confirmDeleteCarousel_karangJahe()" 
                                class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-4 py-2 rounded-none text-sm transition">
                            Hapus Aktivitas
                        </button>
                        <div class="flex gap-3">
                            <button type="button" onclick="document.getElementById('edit-carousel-modal-karang-jahe').classList.add('hidden')" 
                                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                                Batal
                            </button>
                            <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
                <form id="delete-carousel-form-karang-jahe" action="" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="carousel_key" value="carousel_pantai_karang_jahe">
                </form>
            </div>
        </div>

        <!-- Add Gallery Modal -->
        <div id="add-gallery-modal-karang-jahe" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800 font-bold">Tambah Foto Galeri</h3>
                    <button type="button" onclick="document.getElementById('add-gallery-modal-karang-jahe').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.gallery-adopsi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="gallery_key" value="gallery_pantai_karang_jahe">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">File Foto</label>
                            <input type="file" name="image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Maks 4MB.</p>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Label / Judul Foto</label>
                            <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required placeholder="Contoh: Sunset Karang Jahe">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ukuran / Proporsi Grid (Layout Masonry)</label>
                            <select name="aspect_class" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-1">Item 1 (Vertikal Tinggi)</option>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-3">Item 2 (Vertikal Tinggi)</option>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-1">Item 3 (Kotak Standar)</option>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-2">Item 4 (Kotak Standar)</option>
                                <option value="col-span-2 row-span-1 md:col-span-2 md:row-span-2 md:col-start-3 md:row-start-1">Item 5 (Besar Lebar)</option>
                                <option value="col-span-2 row-span-1 md:col-span-3 md:row-span-2 md:col-start-2 md:row-start-3">Item 6 (Sangat Lebar Bawah)</option>
                            </select>
                            <p class="text-[10px] text-slate-400 mt-1">Sesuaikan dengan posisi grid kosong dari 1 s.d 6.</p>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('add-gallery-modal-karang-jahe').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Tambah Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Gallery Modal -->
        <div id="edit-gallery-modal-karang-jahe" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Foto Galeri</h3>
                    <button type="button" onclick="document.getElementById('edit-gallery-modal-karang-jahe').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="gallery_key" value="gallery_pantai_karang_jahe">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah foto. Maks 4MB.</p>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Label / Judul Foto</label>
                            <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ukuran / Proporsi Grid (Layout Masonry)</label>
                            <select name="aspect_class" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-1">Item 1 (Vertikal Tinggi)</option>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-3">Item 2 (Vertikal Tinggi)</option>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-1">Item 3 (Kotak Standar)</option>
                                <option value="col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-2">Item 4 (Kotak Standar)</option>
                                <option value="col-span-2 row-span-1 md:col-span-2 md:row-span-2 md:col-start-3 md:row-start-1">Item 5 (Besar Lebar)</option>
                                <option value="col-span-2 row-span-1 md:col-span-3 md:row-span-2 md:col-start-2 md:row-start-3">Item 6 (Sangat Lebar Bawah)</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between items-center">
                        <button type="button" onclick="confirmDeleteGallery_karangJahe()" 
                                class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-4 py-2 rounded-none text-sm transition">
                            Hapus Foto
                        </button>
                        <div class="flex gap-3">
                            <button type="button" onclick="document.getElementById('edit-gallery-modal-karang-jahe').classList.add('hidden')" 
                                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                                Batal
                            </button>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
                <form id="delete-gallery-form-karang-jahe" action="" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="gallery_key" value="gallery_pantai_karang_jahe">
                </form>
            </div>
        </div>

        <script>
            // Namespaced Carousel & Modal Helpers
            function openEditCarouselModal_karangJahe(event, item) {
                event.stopPropagation();
                const modal = document.getElementById('edit-carousel-modal-karang-jahe');
                const form = modal.querySelector('form');
                form.action = '/admin/carousel/' + item.id;
                modal.querySelector('input[name="title"]').value = item.title;
                modal.querySelector('textarea[name="description"]').value = item.description;
                document.getElementById('delete-carousel-form-karang-jahe').action = '/admin/carousel/' + item.id;
                modal.classList.remove('hidden');
            }

            function confirmDeleteCarousel_karangJahe() {
                if (confirm('Apakah Anda yakin ingin menghapus aktivitas ini?')) {
                    document.getElementById('delete-carousel-form-karang-jahe').submit();
                }
            }

            function openEditGalleryModal_karangJahe(event, item) {
                event.stopPropagation();
                const modal = document.getElementById('edit-gallery-modal-karang-jahe');
                const form = modal.querySelector('form');
                form.action = '/admin/gallery-adopsi/' + item.id;
                modal.querySelector('input[name="title"]').value = item.title;
                modal.querySelector('select[name="aspect_class"]').value = item.aspect_class;
                document.getElementById('delete-gallery-form-karang-jahe').action = '/admin/gallery-adopsi/' + item.id;
                modal.classList.remove('hidden');
            }

            function confirmDeleteGallery_karangJahe() {
                if (confirm('Apakah Anda yakin ingin menghapus foto galeri ini?')) {
                    document.getElementById('delete-gallery-form-karang-jahe').submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const cfCards_karangJahe = document.querySelectorAll('#aktivitas .coverflow-card');
                const cfDots_karangJahe = document.querySelectorAll('#coverflow-dots-karang-jahe button');
                let cfActiveIndex_karangJahe = 0;
                const cfTotal_karangJahe = cfCards_karangJahe.length;

                function updateCoverflow_karangJahe() {
                    if (cfTotal_karangJahe === 0) return;
                    cfCards_karangJahe.forEach((card, index) => {
                        card.classList.remove('active', 'left', 'right', 'hidden-left', 'hidden-right');
                        let diff = index - cfActiveIndex_karangJahe;
                        while (diff < -Math.floor(cfTotal_karangJahe / 2)) diff += cfTotal_karangJahe;
                        while (diff > Math.floor(cfTotal_karangJahe / 2)) diff -= cfTotal_karangJahe;

                        if (diff === 0) {
                            card.classList.add('active');
                        } else if (diff === -1) {
                            card.classList.add('left');
                        } else if (diff === 1) {
                            card.classList.add('right');
                        } else if (diff < 0) {
                            card.classList.add('hidden-left');
                        } else {
                            card.classList.add('hidden-right');
                        }
                    });

                    cfDots_karangJahe.forEach((dot, index) => {
                        if (index === cfActiveIndex_karangJahe) {
                            dot.className = "h-2 rounded-full transition-all duration-300 bg-sky-500 w-6";
                        } else {
                            dot.className = "h-2 rounded-full transition-all duration-300 bg-slate-300 w-2";
                        }
                    });
                }

                cfCards_karangJahe.forEach((card, index) => {
                    card.addEventListener('click', () => {
                        if (cfActiveIndex_karangJahe !== index) {
                            let diff = index - cfActiveIndex_karangJahe;
                            while (diff < -Math.floor(cfTotal_karangJahe / 2)) diff += cfTotal_karangJahe;
                            while (diff > Math.floor(cfTotal_karangJahe / 2)) diff -= cfTotal_karangJahe;
                            
                            if (Math.abs(diff) === 1) {
                                cfActiveIndex_karangJahe = index;
                                updateCoverflow_karangJahe();
                            }
                        }
                    });
                });

                cfDots_karangJahe.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        cfActiveIndex_karangJahe = index;
                        updateCoverflow_karangJahe();
                    });
                });

                updateCoverflow_karangJahe();
            });
        </script>
    @endif
@endsection
