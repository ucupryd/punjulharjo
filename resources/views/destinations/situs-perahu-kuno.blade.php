@extends('layouts.app')

@section('title', 'Situs Perahu Kuno Punjulharjo — Desa Wisata Punjulharjo')

@section('content')
    @php
        // Dynamic Hero Background image check
        $heroImage = file_exists(public_path('images/destinasi/perahu-kuno-hero.jpg')) 
            ? asset('images/destinasi/perahu-kuno-hero.jpg') 
            : 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=1600&q=80';
            
        $tentangImage = file_exists(public_path('images/destinasi/perahu-kuno-tentang.jpg')) 
            ? asset('images/destinasi/perahu-kuno-tentang.jpg') 
            : 'https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?auto=format&fit=crop&w=800&q=80';
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
        <div class="absolute inset-0 bg-slate-950/60"></div>

        <!-- Hero Content -->
        <div class="relative z-10 px-4 mt-20 md:mt-24 max-w-5xl mx-auto space-y-4 md:space-y-6">
            <!-- Breadcrumb Navigation -->
            <nav class="flex justify-center mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-slate-300 text-[10px] md:text-sm font-medium">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-200">
                            <i class="fa-solid fa-house mr-1"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right mx-1 text-[7px] text-slate-400"></i>
                            <a href="{{ route('destinasi') }}" class="hover:text-white transition-colors duration-200">Destinasi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right mx-1 text-[7px] text-slate-400"></i>
                            <span class="text-white">Situs Perahu Kuno</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Eyebrow Chip -->

            <!-- Title in heading font -->
            <h1 class="text-2xl md:text-7xl font-heading text-white drop-shadow-lg leading-tight">
                Situs Perahu Kuno Punjulharjo
            </h1>

            <!-- Subtitle -->
            <p class="text-xs md:text-xl text-slate-100 max-w-3xl mx-auto leading-relaxed drop-shadow opacity-95">
                Jejak kejayaan maritim Nusantara abad ke-7 — perahu kayu tertua di Indonesia, lebih tua dari Candi Borobudur.
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
    </section>

    <!-- =========================================================================
         SECTION 2: Quick Facts [quickfacts]
         ========================================================================= -->
    <section class="relative z-20 px-3 md:px-6 max-w-6xl mx-auto -mt-6 md:-mt-16">
        <div class="bg-white p-3.5 md:p-8 rounded-none border border-slate-200 shadow-lg">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 md:gap-4 divide-y sm:divide-y-0 lg:divide-x divide-slate-100">
                <!-- Location -->
                <div class="flex flex-col items-center text-center p-1 md:p-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-location-dot text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Lokasi</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Dusun Jetakbelah, Punjulharjo</p>
                </div>
                <!-- Age -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-hourglass-half text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Perkiraan Usia</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Abad ke-7–8 Masehi</p>
                </div>
                <!-- Size -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-ruler-combined text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Ukuran Perahu</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">± 15 m &times; ± 4,6–5 m</p>
                </div>
                <!-- Status -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-landmark text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Status</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Cagar Budaya (2022)</p>
                </div>
                <!-- Discovered -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-calendar-day text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Ditemukan</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Sabtu, 26 Juli 2008</p>
                </div>
                <!-- Visitors -->
                <div class="flex flex-col items-center text-center p-1 md:p-2 pt-2 sm:pt-2 lg:pt-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 mb-2 md:mb-3" aria-hidden="true">
                        <i class="fa-solid fa-globe text-xs md:text-sm"></i>
                    </div>
                    <span class="text-[9px] md:text-xs font-bold text-slate-400 uppercase tracking-wide">Pengunjung</span>
                    <p class="text-[10px] md:text-xs text-slate-700 font-semibold mt-0.5 leading-snug">Lokal & Mancanegara</p>
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
                        Tentang Situs Perahu Kuno
                    </h2>
                    <div class="space-y-3 text-slate-600 leading-relaxed text-justify text-[11px] md:text-base">
                        <p>
                            Situs Perahu Kuno Punjulharjo menyimpan salah satu bukti kejayaan maritim Nusantara paling berharga: sebuah perahu kayu berusia lebih dari 1.200 tahun. Berlokasi di Dusun Jetakbelah, Desa Punjulharjo, Kecamatan Rembang, situs ini berada sekitar 500 meter dari Pantai Karangjahe, di tengah kawasan tambak garam milik warga. Ditemukan secara tidak sengaja pada 2008, perahu ini kini diakui sebagai temuan perahu kuno paling utuh di Asia Tenggara sekaligus perahu kayu tertua yang pernah ditemukan di Indonesia.
                        </p>
                        <p>
                            Berdasarkan uji radiokarbon terhadap tali ijuknya, perahu berasal dari abad ke-7–8 Masehi — sezaman dengan pembangunan Candi Borobudur serta masa kejayaan Kerajaan Sriwijaya dan Mataram Kuno. Keberadaannya menjadikan Punjulharjo bukan sekadar desa pesisir, melainkan saksi hidup ramainya jalur perdagangan laut Nusantara pada masa klasik.
                        </p>
                    </div>
                </div>

                <!-- Graphic/Photo Right -->
                <div class="relative">
                    <div class="absolute -inset-1.5 bg-gradient-to-tr from-amber-100 to-stone-100 rounded-none z-0 opacity-70"></div>
                    <div class="relative z-10 border border-slate-200 bg-white p-2 md:p-3 shadow-md">
                        <!-- TODO: ganti gambar dengan foto lokal perahu kuno asli jika sudah tersedia -->
                        <img src="{{ $tentangImage }}" 
                             alt="Situs Cagar Budaya Perahu Kuno Punjulharjo" 
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
                    Lokasi & Akses Menuju Situs
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Kemudahan rute dan akses bagi para pelajar, peneliti, dan wisatawan sejarah.
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-4 lg:gap-8 items-start">
                <!-- Info Left -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-white p-4 md:p-8 rounded-none border border-slate-200 shadow-sm space-y-3 md:space-y-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-route text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Dari pusat Kota Rembang</h3>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-snug">ambil arah Lasem ± 6 km, lalu berbelok ke utara ± 1 km menuju Desa Punjulharjo.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-person-walking text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Dari Pantai Karangjahe</h3>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-snug">hanya ± 500 meter — bisa berjalan kaki atau berkendara singkat (cocok satu paket kunjungan).</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-car text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Dari Kota Semarang</h3>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-snug">± 125–134 km atau sekitar 3 jam via jalur Pantura.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-compass text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Titik Koordinat & Air</h3>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-snug">Sekira 111°24′30.7″ BT, 6°41′35.3″ LS. Sungai Kiringan (pelabuhan Majapahit) & Sungai Babagan/Lasem (pelabuhan Kolonial).</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Right -->
                <div class="lg:col-span-7 space-y-3">
                    <div class="border border-slate-200 p-1 bg-white shadow-sm aspect-video md:h-96">
                        <iframe src="https://maps.google.com/maps?q=Situs%20Perahu%20Kuno%20Punjulharjo%20Rembang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-none"></iframe>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 justify-between items-center bg-white p-3 border border-slate-200">
                        <div class="flex items-center gap-2.5 text-left w-full sm:w-auto">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-location-crosshairs text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <span class="text-[10px] md:text-xs font-bold text-slate-700 block">Situs Perahu Kuno Punjulharjo</span>
                                <span class="text-[9px] text-slate-400">Jetakbelah, Punjulharjo, Kab. Rembang</span>
                            </div>
                        </div>
                        <a href="https://maps.app.goo.gl/8EWdaGPWj1ngEgvL7" 
                           target="_blank" 
                           rel="noopener"
                           class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-dark hover:bg-brand-accent hover:text-brand-dark text-white text-[10px] md:text-xs font-bold px-4 py-2 transition duration-300">
                            Buka di Google Maps
                            <i class="fa-solid fa-arrow-up-right-from-square ml-1.5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 5: Kronologi [sejarah]
         ========================================================================= -->
    <section id="sejarah" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Kronologi Penemuan
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Jejak kronologis penemuan arkeologi maritim hingga proses pelestariannya.
                </p>
            </div>

            <!-- Vertical Timeline (Muted Heritage Amber) -->
            <div class="relative border-l-2 border-amber-200 ml-2 sm:ml-6 space-y-6 md:space-y-10 py-2">
                <!-- 26 Juli 2008 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-amber-700 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-amber-700 font-bold text-xs md:text-base block">26 Juli 2008 — Penemuan Tak Sengaja</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Seorang warga menggali tambak garam; pada kedalaman ± 1,5–2 m cangkulnya mengenai kerangka perahu kayu besar yang masih relatif utuh (Sabtu, ± 07.30 WIB).
                        </p>
                    </div>
                </div>

                <!-- 2008-2010 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-amber-700 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-amber-700 font-bold text-xs md:text-base block">2008–2010 — Penelitian Awal</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Balai Arkeologi Yogyakarta meneliti temuan; uji radiokarbon pada tali ijuk menunjukkan usia abad ke-7–8 Masehi.
                        </p>
                    </div>
                </div>

                <!-- 2011-2018 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-amber-700 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-amber-700 font-bold text-xs md:text-base block">2011–2018 — Konservasi Bertahap</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Perendaman PEG (polyethylene glycol), pembuatan tanggul penahan air pasang & pengaman erosi. Ditangani oleh Balai Konservasi Borobudur.
                        </p>
                    </div>
                </div>

                <!-- Penelitian Internasional -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-amber-700 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-amber-700 font-bold text-xs md:text-base block">Penelitian Internasional</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Ahli maritim Pierre-Yves Manguin (EFEO, Prancis) turut mengkaji; belakangan dikaji ulang lewat rekonstruksi eksperimental oleh BRIN & akademisi Italia.
                        </p>
                    </div>
                </div>

                <!-- 2022 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-amber-700 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-amber-700 font-bold text-xs md:text-base block">2022 — Naik Status</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Resmi berubah dari “benda cagar budaya” menjadi “situs”, dengan pembagian zona inti, penyangga, dan pengembangan.
                        </p>
                    </div>
                </div>

                <!-- 2 Oktober 2023 -->
                <div class="relative pl-5 sm:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-amber-700 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-3 sm:p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-amber-700 font-bold text-xs md:text-base block">2 Oktober 2023 — Museum/Edu Park</span>
                        <p class="text-[10px] md:text-sm text-slate-600 mt-1 leading-relaxed text-justify">
                            Museum mini diresmikan sebagai sarana edukasi penunjang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 6: Keunikan [keunikan]
         ========================================================================= -->
    <section id="dayatarik" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Apa yang Membuatnya Istimewa
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Keunikan konstruksi perkapalan purba dan pembuktian peradaban bahari bangsa Indonesia.
                </p>
            </div>

            <!-- Features Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-hourglass-half text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Perahu Kayu Tertua</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Berasal dari abad ke-7–8 M berdasarkan penanggalan radiokarbon.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-award text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Terlengkap se-ASEAN</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Lebih utuh dibanding temuan serupa di Sumatra, Malaysia, dan Filipina.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-link text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Teknik Papan Ikat</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Teknik papan ikat/kupingan pengikat (sewn-plank): ijuk + pasak, tanpa paku.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-gears text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Galangan Kuno</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Terlihat tumbuku (ikat), gading (rangka), lunas, haluan, buritan.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-tree text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Kayu Ulin (Kalimantan)</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Kayu besi Kalimantan tahan air, bukti jaringan bahan lintas pulau.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-route text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Jalur Dagang Maritim</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Kapal pelayaran jarak jauh antarpulau (Jawa-Sumatra-Sulawesi-Kalimantan) hingga luar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 7: Artefak [artefak]
         ========================================================================= -->
    <section id="artefak" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Artefak yang Ditemukan
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Benda-benda bersejarah pendukung muatan kapal yang ditemukan di sekitar kerangka perahu.
                </p>
            </div>

            <!-- Artifact Cards Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-4">
                <!-- Arca -->
                <div class="bg-slate-50 p-3 md:p-5 border border-slate-200 hover:border-amber-300 hover:bg-amber-50/10 transition duration-300 text-center flex flex-col items-center justify-center space-y-2 md:space-y-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-white flex items-center justify-center text-amber-700 shadow-sm shrink-0">
                        <i class="fa-solid fa-chess-queen text-sm md:text-lg"></i>
                    </div>
                    <span class="text-[10px] md:text-sm font-bold text-slate-800">Arca Wanita</span>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-relaxed">Kepala arca wanita batu berparas etnis Tionghoa.</p>
                </div>

                <!-- Tongkat -->
                <div class="bg-slate-50 p-3 md:p-5 border border-slate-200 hover:border-amber-300 hover:bg-amber-50/10 transition duration-300 text-center flex flex-col items-center justify-center space-y-2 md:space-y-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-white flex items-center justify-center text-amber-700 shadow-sm shrink-0">
                        <i class="fa-solid fa-staff-snake text-sm md:text-lg"></i>
                    </div>
                    <span class="text-[10px] md:text-sm font-bold text-slate-800">Tongkat Kayu</span>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-relaxed">Patahan tongkat kayu (kemando) ± 40 cm.</p>
                </div>

                <!-- Tulang -->
                <div class="bg-slate-50 p-3 md:p-5 border border-slate-200 hover:border-amber-300 hover:bg-amber-50/10 transition duration-300 text-center flex flex-col items-center justify-center space-y-2 md:space-y-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-white flex items-center justify-center text-amber-700 shadow-sm shrink-0">
                        <i class="fa-solid fa-bone text-sm md:text-lg"></i>
                    </div>
                    <span class="text-[10px] md:text-sm font-bold text-slate-800">Tulang Manusia</span>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-relaxed">Tulang purba dari bagian awak kapal terdahulu.</p>
                </div>

                <!-- Dapur -->
                <div class="bg-slate-50 p-3 md:p-5 border border-slate-200 hover:border-amber-300 hover:bg-amber-50/10 transition duration-300 text-center flex flex-col items-center justify-center space-y-2 md:space-y-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-white flex items-center justify-center text-amber-700 shadow-sm shrink-0">
                        <i class="fa-solid fa-mortar-pestle text-sm md:text-lg"></i>
                    </div>
                    <span class="text-[10px] md:text-sm font-bold text-slate-800">Peralatan Dapur</span>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-relaxed">Peralatan dapur & gerabah perlengkapan berlayar.</p>
                </div>

                <!-- Rempah -->
                <div class="bg-slate-50 p-3 md:p-5 border border-slate-200 hover:border-amber-300 hover:bg-amber-50/10 transition duration-300 text-center flex flex-col items-center justify-center space-y-2 md:space-y-3 col-span-2 lg:col-span-1">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-white flex items-center justify-center text-amber-700 shadow-sm shrink-0">
                        <i class="fa-solid fa-boxes-stacked text-sm md:text-lg"></i>
                    </div>
                    <span class="text-[10px] md:text-sm font-bold text-slate-800">Rempah-Rempah</span>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-relaxed">Muatan rempah-rempah penunjuk jalur dagang bahari.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 8: Kondisi & Fasilitas [fasilitas]
         ========================================================================= -->
    <section id="fasilitas" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Keadaan & Fasilitas
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Informasi fasilitas penunjang yang tersedia untuk kenyamanan kunjungan Anda.
                </p>
            </div>

            <!-- Facilities Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4">
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-200 bg-white shadow-sm">
                    <span class="text-amber-700 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-landmark"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Ruang Pamer Aula</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-200 bg-white shadow-sm">
                    <span class="text-amber-700 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Museum / Edu Park</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-200 bg-white shadow-sm">
                    <span class="text-amber-700 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-shield-halved"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Lambung Utuh</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-200 bg-white shadow-sm">
                    <span class="text-amber-700 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-user-tie"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Juru Pelihara</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-200 bg-white shadow-sm">
                    <span class="text-amber-700 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-clock"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Jam Kunjung Terjadwal</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-200 bg-white shadow-sm">
                    <span class="text-amber-700 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-amber-50 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-square-parking"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Area Parkir Rapi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 9: Aktivitas [aktivitas]
         ========================================================================= -->
    <section id="aktivitas" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Aktivitas untuk Pengunjung
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Berbagai aktivitas interaktif bernilai edukasi sejarah tinggi yang dapat Anda ikuti.
                </p>
            </div>

            <!-- Activity Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                <!-- Activity 1 -->
                <div class="bg-slate-50 border border-slate-200 p-3 md:p-6 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-eye text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-base font-bold text-slate-900 mb-0.5">Saksikan Perahu</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">Melihat perahu kuno abad ke-7 dari dekat.</p>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="bg-slate-50 border border-slate-200 p-3 md:p-6 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-book-open text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-base font-bold text-slate-900 mb-0.5">Belajar Sejarah</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">Studi panel kronologi & konservasi sejarah.</p>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="bg-slate-50 border border-slate-200 p-3 md:p-6 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-user-group text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-base font-bold text-slate-900 mb-0.5">Tur Terpandu</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">Edukasi sejarah terpandu juru pelihara.</p>
                    </div>
                </div>

                <!-- Activity 4 -->
                <div class="bg-slate-50 border border-slate-200 p-3 md:p-6 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-camera text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-base font-bold text-slate-900 mb-0.5">Dokumentasi</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">Berfoto dengan latar cagar budaya nasional.</p>
                    </div>
                </div>

                <!-- Activity 5 -->
                <div class="bg-slate-50 border border-slate-200 p-3 md:p-6 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-school text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-base font-bold text-slate-900 mb-0.5">Riset & Studi</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">Karyawisata sekolah & riset akademisi.</p>
                    </div>
                </div>

                <!-- Activity 6 -->
                <div class="bg-slate-50 border border-slate-200 p-3 md:p-6 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-circle-nodes text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-base font-bold text-slate-900 mb-0.5">Satu Paket Wisata</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">Paket terpadu Pantai Karangjahe (± 500 m).</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 10: Event [event]
         ========================================================================= -->
    <section id="event" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Event & Kegiatan
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Kegiatan berskala nasional and program edukasi yang berpusat di situs.
                </p>
            </div>

            <!-- Events List -->
            <div class="space-y-4 md:space-y-6">
                <div class="p-4 md:p-6 bg-white border-l-4 border-amber-700 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Pameran Temporer</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Pameran temporer & kegiatan peringatan Hari Museum / Hari Purbakala.</p>
                    </div>
                </div>

                <div class="p-4 md:p-6 bg-white border-l-4 border-amber-700 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Literasi Sejarah Pelajar</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Kegiatan literasi dan edukasi sejarah bersama pelajar.</p>
                    </div>
                </div>

                <div class="p-4 md:p-6 bg-white border-l-4 border-amber-700 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Kunjungan Peneliti</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Kunjungan peneliti dalam & luar negeri.</p>
                    </div>
                </div>

                <div class="p-4 md:p-6 bg-white border-l-4 border-amber-700 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div class="space-y-0.5">
                        <h3 class="text-sm md:text-lg font-bold text-slate-900">Integrasi Budaya Rembang</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Terintegrasi dengan agenda budaya Desa Wisata Punjulharjo & Dinbudpar Kab. Rembang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 11: Tata Kelola & Ekonomi [ekonomi]
         ========================================================================= -->
    <section id="ekonomi" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <h2 class="text-lg md:text-4xl font-heading text-slate-900 tracking-wide">
                    Tata Kelola & Nilai Ekonomi
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Sistem pemanfaatan cagar budaya secara lestari demi pemberdayaan masyarakat.
                </p>
            </div>

            <!-- Narration & Model Pengelolaan -->
            <div class="bg-slate-50 p-4 md:p-8 border border-slate-200 shadow-sm space-y-3">
                <h3 class="text-xs md:text-lg font-heading text-slate-800 border-b pb-2 md:pb-3">Sistem Pengelolaan Sinergis</h3>
                <p class="text-slate-600 leading-relaxed text-justify text-[10px] md:text-sm">
                    Perlindungan cagar budaya di bawah pembinaan Dinas Kebudayaan dan Pariwisata Kab. Rembang bersama instansi pelestarian; pemanfaatan wisata bersinergi dengan Pemerintah Desa Punjulharjo & BUMDes dalam kerangka Desa Wisata Punjulharjo. Sejak 2022 berstatus “situs” dengan zona inti, penyangga, dan pengembangan. Tiket masuk berkisar antara Rp 2.000 – Rp 5.000/orang (menyesuaikan kebijakan pengelola).
                </p>
                <div class="bg-amber-50/50 p-3 border border-amber-100 text-[10px] text-amber-800 rounded-none italic">
                    * Nilai ekonomi utamanya tidak langsung: memperpanjang durasi kunjungan di Punjulharjo & mendorong belanja UMKM, memperkuat ekosistem wisata Karangjahe–Punjulharjo.
                </div>
            </div>

            <!-- Stats Counters / Fact Cards (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                <!-- Stat 1 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">800–1.500</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Pengunjung / Bulan</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Didominasi oleh masyarakat umum, pelajar sekolah, dan mahasiswa.</p>
                </div>

                <!-- Stat 2 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">Mancanegara</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Jangkauan Turis</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Kedatangan wisatawan asing dari Belanda, Prancis, dan Jepang.</p>
                </div>

                <!-- Stat 3 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">3 Zona</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Zona Cagar Budaya</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Tata kelola resmi terbagi menjadi zona inti, penyangga, dan pengembangan.</p>
                </div>

                <!-- Stat 4 -->
                <div class="bg-emerald-50/50 p-3 md:p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-sm md:text-xl block">&gt; 1.200 Tahun</span>
                    <span class="text-[8px] md:text-[10px] text-slate-400 font-bold uppercase mt-1.5 md:mt-2 tracking-wider block">Usia Perahu</span>
                    <p class="text-[10px] md:text-[11px] text-slate-600 mt-1 leading-snug">Perkiraan usia berdasarkan uji sampel laboratorium arkeologi.</p>
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
                    Manfaat bagi Masyarakat
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Sinergi pariwisata sejarah dalam memajukan peradaban edukasi dan perekonomian warga lokal.
                </p>
            </div>

            <!-- Impact Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-flag text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Kebanggaan & Identitas</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Warga menjadi penjaga warisan maritim bertaraf nasional & internasional.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-graduation-cap text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Pusat Edukasi & Riset</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Rujukan utama bagi pelajar, mahasiswa, dan peneliti lokal maupun asing.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-people-carry-box text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Pelibatan Tenaga Lokal</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Warga diperbantukan sebagai juru pelihara, pemandu wisata, and tim pengelola.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-store text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Sinergi Ekonomi</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Mendorong pertumbuhan unit UMKM, homestay, dan kuliner pesisir.
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-shield-halved text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Pelestarian Budaya</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Status situs menjaga pelestarian tata ruang kawasan secara berkelanjutan.
                        </p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-bullhorn text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Promosi Daerah</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Mengangkat citra pariwisata Rembang di kancah sejarah purbakala nasional.
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
                Selami Jejak Maritim Nusantara
            </h2>
            <p class="text-slate-300 font-sans max-w-2xl mx-auto leading-relaxed text-[11px] md:text-base">
                Saksikan langsung perahu kuno berusia lebih dari 1.200 tahun dan rasakan kebesaran bangsa bahari kita. Lengkapi kunjunganmu dengan pesona Pantai Karangjahe di dekatnya.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center pt-2 md:pt-4">
                <a href="{{ route('temukan') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-accent hover:bg-yellow-500 text-brand-dark font-bold px-6 py-2.5 text-xs shadow-md transition duration-300 min-h-[40px] md:min-h-[44px]">
                    Lihat Lokasi
                    <i class="fa-solid fa-map-location-dot ml-2"></i>
                </a>
                <a href="{{ route('destinasi.pantai-karang-jahe') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-2.5 text-xs border border-white/20 transition duration-300 min-h-[40px] md:min-h-[44px]">
                    Kunjungi Pantai Karangjahe
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
                <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="group block bg-white border border-slate-200 overflow-hidden hover:border-sky-400 transition-colors duration-300 shadow-sm hover:shadow-md">
                    <div class="grid sm:grid-cols-12 gap-0">
                        <div class="sm:col-span-5 h-36 sm:h-full min-h-[140px] overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" 
                                 alt="Pantai Karang Jahe Punjulharjo" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 loading="lazy">
                        </div>
                        <div class="sm:col-span-7 p-4 md:p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] md:text-xs font-bold text-sky-600 uppercase tracking-wider block mb-0.5">Destinasi Wisata Pantai</span>
                                <h4 class="text-sm md:text-lg font-heading text-slate-900 group-hover:text-sky-600 transition-colors duration-200">Pantai Karang Jahe</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-1 md:mt-2 leading-relaxed text-justify">
                                    Pesona pasir putih bersih dibalut keasrian ribuan cemara laut yang rindang di pesisir utara Punjulharjo. Berjarak ± 500 meter dari situs.
                                </p>
                            </div>
                            <div class="mt-2 md:mt-4 pt-1 flex items-center text-[10px] md:text-xs font-bold text-sky-600 uppercase gap-1">
                                Kunjungi Pantai <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Source Credits / Footnote -->
    <footer class="bg-slate-50 border-t border-slate-100 py-6 text-center text-slate-400 text-[8px] md:text-xs relative z-10 px-4 md:px-6">
        <div class="max-w-4xl mx-auto space-y-2 leading-relaxed">
            <p><strong>Sumber Data Referensi:</strong> Dinas Kebudayaan & Pariwisata Kab. Rembang — dinbudpar.rembangkab.go.id (profil & kronologi) • Pemerintah Kab. Rembang — rembangkab.go.id (perubahan status situs & peresmian museum) • Visit Jawa Tengah — visitjawatengah.jatengprov.go.id (sejarah & konservasi) • Wikipedia Bahasa Indonesia — “Perahu Kuno Rembang” • KeMuseum.or.id — profil & museum virtual Situs Perahu Punjulharjo • Times Indonesia, Suara Merdeka, Murianews, Detik — kondisi terkini & data kunjungan • Jurnal: Titian (UNJA 2018), Multikultura (UI), APCONF/BRIN, ResearchGate (identifikasi kayu).</p>
            <p>Laporan Pendapatan, Kunjungan, dan Jumlah Pelaku UMKM bersifat estimasi/periodik sesuai data pembukuan pengelola.</p>
        </div>
    </footer>
@endsection
