@extends('layouts.app')

@section('title', 'Pantai Karang Jahe — Desa Wisata Punjulharjo')

@section('content')
    @php
        // Dynamic Hero Background image check
        $heroImage = file_exists(public_path('images/destinasi/karangjahe-hero.jpg')) 
            ? asset('images/destinasi/karangjahe-hero.jpg') 
            : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80';
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
                            <span class="text-white">Pantai Karang Jahe</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Eyebrow Chip -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-none bg-sky-500/20 backdrop-blur-sm text-sky-300 text-[10px] md:text-sm font-semibold uppercase tracking-wider border border-sky-400/20">
                <i class="fa-solid fa-umbrella-beach"></i> Destinasi Wisata
            </div>

            <!-- Title in heading font -->
            <h1 class="text-2xl md:text-7xl font-heading text-white drop-shadow-lg leading-tight">
                Pantai Karang Jahe
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
    </section>

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
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                        <i class="fa-solid fa-circle-info"></i> Selaras Alam
                    </div>
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
                <div class="relative">
                    <div class="absolute -inset-1.5 bg-gradient-to-tr from-sky-100 to-indigo-100 rounded-none z-0 opacity-70"></div>
                    <div class="relative z-10 border border-slate-200 bg-white p-2 md:p-3 shadow-md">
                        <!-- TODO: ganti gambar dengan foto lokal Pantai Karang Jahe asli jika sudah tersedia -->
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80" 
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-map-location-dot"></i> Rute Perjalanan
                </div>
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
                                <p class="text-[10px] text-slate-600 mt-0.5 leading-snug">Melalui Jl. Jenderal Sudirman menuju Jl. Raya Semarang–Tuban; di dekat gapura Desa Punjulharjo sudah terpasang arah.</p>
                            </div>
                        </div>

                        <div class="p-3 bg-sky-50/50 border border-sky-100 rounded-none text-[10px] text-slate-600 flex gap-2">
                            <i class="fa-solid fa-circle-exclamation text-sky-600 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <span>Akses jalan telah diperlebar; lokasi mudah ditemukan via GPS. Koordinat: <strong>-6.691075, 111.414719</strong>.</span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Right -->
                <div class="lg:col-span-7 space-y-3">
                    <div class="w-full aspect-video rounded-none overflow-hidden border border-slate-200 shadow-sm bg-white p-1">
                        <iframe src="https://maps.google.com/maps?q=-6.691075,%20111.414719&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none w-full h-full"></iframe>
                    </div>
                    <div class="flex justify-end">
                        <a href="https://www.google.com/maps/search/?api=1&query=-6.691075,111.414719" 
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-timeline text-xs md:text-sm"></i> Garis Waktu
                </div>
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
         SECTION 6: Keunikan [keunikan]
         ========================================================================= -->
    <section id="dayatarik" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-wand-magic-sparkles text-xs md:text-sm"></i> Keistimewaan
                </div>
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Apa yang Membuatnya Istimewa
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Daya tarik geologis, alam, dan nilai budaya pesisir utara Punjulharjo yang tiada duanya.
                </p>
            </div>

            <!-- Features Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-tree text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Hutan Cemara Laut</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Pohon cemara laut rindang sepanjang pantai; suasana teduh hasil konservasi abrasi.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-water text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Pasir Putih 3 KM</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Garis pantai berpasir putih terpanjang dan terbersih di Kabupaten Rembang.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-child-reaching text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Ombak Tenang</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Karakteristik ombak yang tenang dan landai; aman bagi keluarga dan anak-anak.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-camera text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Sunset Estetik</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Lanskap laut, pasir, dan cemara yang sangat elok; favorit prewedding.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-gem text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Karang Jahe</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Bentuk karang pesisir menyerupai jahe yang menjadi asal nama pantai ini.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-3 md:p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-3 md:mb-4" aria-hidden="true">
                            <i class="fa-solid fa-book-open text-sm md:text-lg"></i>
                        </div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Wisata Sejarah</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Berdekatan langsung dengan Situs Perahu Kuno cagar budaya abad ke-7 (± 500 m).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 7: Fasilitas [fasilitas]
         ========================================================================= -->
    <section id="fasilitas" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-square-plus text-xs md:text-sm"></i> Kenyamanan Pengunjung
                </div>
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Fasilitas & Sarana Lengkap
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Dukungan fasilitas memadai untuk menjamin kenyamanan liburan Anda selama berada di area pantai.
                </p>
            </div>

            <!-- Facilities Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-house-flag"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Loket & Sekretariat</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-square-parking"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Area Parkir Luas</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-restroom"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Toilet / MCK Umum</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-mosque"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Musala Nurul Jannah</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-utensils"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Warung Kuliner</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-umbrella"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Gazebo & Kursi</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-campground"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Homestay & Camping</span>
                </div>
                <div class="flex items-center gap-2.5 p-2.5 md:p-4 border border-slate-100 bg-slate-50/50">
                    <span class="text-sky-600 text-sm w-7 h-7 md:w-8 md:h-8 rounded-full bg-white flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-volleyball"></i>
                    </span>
                    <span class="text-[10px] md:text-sm font-semibold text-slate-700 leading-tight">Outbound & Voli</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 8: Aktivitas & Wahana [aktivitas]
         ========================================================================= -->
    <section id="aktivitas" class="bg-slate-50 py-8 md:py-24 px-4 md:px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-compass text-xs md:text-sm"></i> Eksplorasi Seru
                </div>
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Aktivitas Seru untuk Semua
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Pilihan rekreasi pantai interaktif yang seru bagi pengunjung dewasa maupun anak-anak.
                </p>
            </div>

            <!-- Activity Cards Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                <!-- ATV -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80" 
                             alt="Penyewaan ATV menyusuri Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Adventure</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">ATV / Mini Trail</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Menyusuri garis pasir pantai sepanjang 3 km dengan armada ATV atau mini trail.</p>
                        </div>
                    </div>
                </div>

                <!-- Perahu Wisata -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80" 
                             alt="Perahu wisata menyusuri perairan Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Watersport</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Perahu Kayu</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Menikmati tenangnya perairan pesisir dari atas perahu kayu wisata atau perahu karet.</p>
                        </div>
                    </div>
                </div>

                <!-- Banana Boat -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=600&q=80" 
                             alt="Wahana Banana Boat di air laut tenang" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Kelompok</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Banana Boat</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Wahana air seru ditarik perahu cepat untuk sensasi petualangan basah-basahan.</p>
                        </div>
                    </div>
                </div>

                <!-- Kereta Wisata -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=600&q=80" 
                             alt="Kereta wisata keliling area Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Keluarga</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Kereta Wisata</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Keliling menikmati rindangnya barisan cemara laut tanpa perlu kelelahan.</p>
                        </div>
                    </div>
                </div>

                <!-- Berenang -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" 
                             alt="Berenang di Pantai Karang Jahe pasir putih" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Rekreasi</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Berenang & Pasir</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Dengan ombak sangat tenang, aman untuk berenang and bermain pasir keluarga.</p>
                        </div>
                    </div>
                </div>

                <!-- Outbound & Voli -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80" 
                             alt="Kegiatan voli pantai kelompok" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Olahraga</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Outbound & Voli</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Tersedia lahan rindang di bawah cemara untuk gathering corporate and voli pantai.</p>
                        </div>
                    </div>
                </div>

                <!-- Camping -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80" 
                             alt="Camping ground di dekat pepohonan cemara laut" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Akomodasi</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Camping / Homestay</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Berkemah di camping ground pesisir atau homestay nyaman warga Punjulharjo.</p>
                        </div>
                    </div>
                </div>

                <!-- Pulau Gede -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" 
                             alt="Perahu penyeberangan menuju Pulau Gede" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Eksplorasi</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Pulau Gede</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Menyewa perahu nelayan setempat untuk penyeberangan rombongan ke Pulau Gede.</p>
                        </div>
                    </div>
                </div>

                <!-- Sunset Spot -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300 col-span-2 lg:col-span-1">
                    <div class="h-32 md:h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80" 
                             alt="Sunset siluet cemara laut di Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-2 left-2 bg-brand-dark text-white text-[8px] md:text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1">Fotografi</span>
                    </div>
                    <div class="p-3 md:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Berburu Sunset</h3>
                            <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed">Mengabadikan siluet senja romantis di antara sela pepohonan cemara laut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 9: Event & Tradisi [event]
         ========================================================================= -->
    <section id="event" class="bg-white py-8 md:py-24 px-4 md:px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8 md:space-y-12">
            <div class="text-center space-y-2 md:space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-masks-theater text-xs md:text-sm"></i> Ragam Budaya
                </div>
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-receipt text-xs md:text-sm"></i> Informasi Retribusi
                </div>
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-emerald-50 text-emerald-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-emerald-100">
                    <i class="fa-solid fa-chart-line text-xs md:text-sm"></i> Kemakmuran Desa
                </div>
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-none bg-sky-50 text-sky-600 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-people-carry-box text-xs md:text-sm"></i> Aspek Sosial
                </div>
                <h2 class="text-lg md:text-4xl font-heading text-brand-dark tracking-wide">
                    Manfaat Bagi Warga Punjulharjo
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-[11px] md:text-base">
                    Bagaimana pariwisata mengangkat derajat hidup, pelestarian alam, dan memajukan pendidikan desa.
                </p>
            </div>

            <!-- Impact Grid (2 Columns on Mobile) -->
            <div class="grid grid-cols-2 gap-3 md:gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-briefcase text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Tenaga Kerja</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Warga desa diserap aktif sebagai petugas pengelola, kebersihan pantai, parkir, dan operator wahana.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-store text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">UMKM Warga</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Sebanyak ± 41 unit UMKM tumbuh di kuliner laut, cendera mata khas pesisir, and homestay rumah warga.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-leaf text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Restorasi Hijau</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
                            Konservasi penanaman ribuan pohon cemara laut guna menahan ancaman abrasi pesisir utara Jawa.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-3 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-3">
                    <div class="w-9 h-9 md:w-12 md:h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-hand-holding-heart text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xs md:text-lg font-heading text-slate-900 mb-1">Pemberdayaan</h3>
                        <p class="text-[10px] md:text-sm text-slate-600 leading-relaxed text-justify">
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
                <a href="{{ route('destinasi') }}" 
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
@endsection
