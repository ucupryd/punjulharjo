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
    <section class="relative text-center min-h-[70vh] lg:min-h-[80vh] flex flex-col justify-center items-center bg-transparent overflow-hidden">
        <!-- Background Image with zoom/parallax effect -->
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat transform scale-105 transition-transform duration-[10000ms]"
             style="background-image: url('{{ $heroImage }}');">
        </div>
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-slate-950/50"></div>

        <!-- Hero Content -->
        <div class="relative z-10 px-6 mt-24 max-w-5xl mx-auto space-y-6">
            <!-- Breadcrumb Navigation -->
            <nav class="flex justify-center mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs md:text-sm font-medium text-slate-300">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-200">
                            <i class="fa-solid fa-house mr-1"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right mx-2 text-[8px] text-slate-400"></i>
                            <a href="{{ route('destinasi') }}" class="hover:text-white transition-colors duration-200">Destinasi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right mx-2 text-[8px] text-slate-400"></i>
                            <span class="text-white">Pantai Karang Jahe</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Eyebrow Chip -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-500/20 backdrop-blur-sm text-sky-300 text-xs md:text-sm font-semibold uppercase tracking-wider border border-sky-400/20">
                <i class="fa-solid fa-umbrella-beach"></i> Destinasi Wisata
            </div>

            <!-- Title in heading font -->
            <h1 class="text-5xl md:text-7xl font-heading text-white drop-shadow-lg leading-tight">
                Pantai Karang Jahe
            </h1>

            <!-- Subtitle -->
            <p class="text-base md:text-xl text-slate-100 max-w-3xl mx-auto leading-relaxed drop-shadow opacity-95">
                Pesona pasir putih bersih dibalut keasrian ribuan cemara laut yang rindang di pesisir Punjulharjo.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4">
                <a href="#lokasi" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-accent hover:bg-yellow-500 text-brand-dark transition-colors duration-300 font-bold px-8 py-3.5 text-sm shadow-lg min-h-[44px]">
                    Lihat Lokasi & Rute
                    <i class="fa-solid fa-map-location-dot ml-2"></i>
                </a>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition-colors duration-300 font-semibold px-8 py-3.5 text-sm border border-white/20 min-h-[44px]">
                    Kembali ke Beranda
                    <i class="fa-solid fa-arrow-left ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Wave Divider (Synchronized with layout styles) -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[80px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,90 C320,130,420,40,740,70 C1040,95,1120,60,1200,80 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.5)"></path>
                <path d="M0,60 C240,90,380,30,700,60 C1000,85,1080,45,1200,55 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.7)"></path>
                <path d="M0,30 C150,60,350,10,600,40 C850,70,1050,30,1200,40 L1200,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 2: Quick Facts [quickfacts]
         ========================================================================= -->
    <section class="relative z-20 px-6 max-w-6xl mx-auto -mt-12 md:-mt-16">
        <div class="bg-white p-6 md:p-8 rounded-none border border-slate-200 shadow-lg">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-4 divide-y md:divide-y-0 lg:divide-x divide-slate-100">
                <!-- Location -->
                <div class="flex flex-col items-center text-center p-2">
                    <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-3" aria-hidden="true">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Lokasi</span>
                    <p class="text-xs text-slate-700 font-semibold mt-1 leading-snug">Punjulharjo, Rembang</p>
                </div>
                <!-- Coast Length -->
                <div class="flex flex-col items-center text-center p-2 pt-6 md:pt-2 lg:pt-2">
                    <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-3" aria-hidden="true">
                        <i class="fa-solid fa-ruler-horizontal"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Garis Pantai</span>
                    <p class="text-xs text-slate-700 font-semibold mt-1 leading-snug">± 3 km Pasir Putih</p>
                </div>
                <!-- Hours -->
                <div class="flex flex-col items-center text-center p-2 pt-6 md:pt-2 lg:pt-2">
                    <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-3" aria-hidden="true">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Jam Buka</span>
                    <p class="text-xs text-slate-700 font-semibold mt-1 leading-snug">06.00 – 17.30 WIB</p>
                </div>
                <!-- Ticket -->
                <div class="flex flex-col items-center text-center p-2 pt-6 md:pt-6 lg:pt-2">
                    <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-3" aria-hidden="true">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Tiket/Parkir</span>
                    <p class="text-xs text-slate-700 font-semibold mt-1 leading-snug">Mulai Rp 5.000 (motor)</p>
                </div>
                <!-- Manager -->
                <div class="flex flex-col items-center text-center p-2 pt-6 md:pt-6 lg:pt-2">
                    <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-3" aria-hidden="true">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Pengelola</span>
                    <p class="text-xs text-slate-700 font-semibold mt-1 leading-snug">BUMDes & Pokdarwis</p>
                </div>
                <!-- Award -->
                <div class="flex flex-col items-center text-center p-2 pt-6 md:pt-6 lg:pt-2">
                    <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 mb-3" aria-hidden="true">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Predikat</span>
                    <p class="text-xs text-slate-700 font-semibold mt-1 leading-snug">500 Besar ADWI 2023</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 3: Tentang [tentang]
         ========================================================================= -->
    <section id="tentang" class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content Left -->
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                        <i class="fa-solid fa-circle-info"></i> Selaras Alam
                    </div>
                    <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                        Tentang Pantai Karang Jahe
                    </h2>
                    <div class="space-y-4 text-slate-600 leading-relaxed text-justify text-sm md:text-base">
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
                    <div class="absolute -inset-2 bg-gradient-to-tr from-sky-100 to-indigo-100 rounded-none z-0 opacity-70"></div>
                    <div class="relative z-10 border border-slate-200 bg-white p-3 shadow-md">
                        <!-- TODO: ganti gambar dengan foto lokal Pantai Karang Jahe asli jika sudah tersedia -->
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80" 
                             alt="Pohon Cemara Laut Rimbun di Pantai Karang Jahe Punjulharjo" 
                             class="w-full h-80 md:h-96 object-cover rounded-none" 
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 4: Lokasi & Akses [akses]
         ========================================================================= -->
    <section id="lokasi" class="bg-slate-50 py-16 md:py-24 px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-map-location-dot"></i> Rute Perjalanan
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Lokasi & Akses Menuju Pantai
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Kemudahan akses transportasi jalan raya utama untuk berkunjung bersama keluarga maupun rombongan bus.
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-start">
                <!-- Info Left -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white p-6 md:p-8 rounded-none border border-slate-200 shadow-sm space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-car"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Dari Pusat Kota Rembang</h4>
                                <p class="text-xs md:text-sm text-slate-600 mt-1">Hanya ± 8–10 km atau sekitar 15–20 menit berkendara ke arah timur.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-plane-departure"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Dari Kota Semarang</h4>
                                <p class="text-xs md:text-sm text-slate-600 mt-1">± 125–134 km atau sekitar 3 jam menggunakan kendaraan pribadi.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0" aria-hidden="true">
                                <i class="fa-solid fa-route"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Rute Umum</h4>
                                <p class="text-xs md:text-sm text-slate-600 mt-1">Melalui Jl. Jenderal Sudirman menuju Jl. Raya Semarang–Tuban; di dekat gapura Desa Punjulharjo sudah terpasang papan penunjuk arah.</p>
                            </div>
                        </div>

                        <div class="p-4 bg-sky-50/50 border border-sky-100 rounded-none text-xs text-slate-600 flex gap-2">
                            <i class="fa-solid fa-circle-exclamation text-sky-600 shrink-0 mt-0.5" aria-hidden="true"></i>
                            <span>Akses jalan menuju kawasan telah diperlebar oleh pengelola; lokasi mudah ditemukan via aplikasi peta digital. Koordinat kira-kira: <strong>-6.691075, 111.414719</strong>.</span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Right -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="w-full aspect-video rounded-none overflow-hidden border border-slate-200 shadow-sm bg-white p-2">
                        <iframe src="https://maps.google.com/maps?q=-6.691075,%20111.414719&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none w-full h-full"></iframe>
                    </div>
                    <div class="flex justify-end">
                        <a href="https://www.google.com/maps/search/?api=1&query=-6.691075,111.414719" 
                           target="_blank" 
                           class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-dark hover:bg-slate-800 text-white font-semibold px-6 py-3 text-xs shadow min-h-[44px]"
                           aria-label="Buka Rute Pantai Karang Jahe di Google Maps">
                            <i class="fa-solid fa-map-location-dot mr-2"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 5: Sejarah [sejarah]
         ========================================================================= -->
    <section id="sejarah" class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-timeline"></i> Garis Waktu
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Jejak Sejarah Karang Jahe
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Dari penemuan arkeologi hingga meraih predikat destinasi terpopuler di Rembang.
                </p>
            </div>

            <!-- Vertical Timeline -->
            <div class="relative border-l-2 border-sky-200 ml-4 md:ml-6 space-y-10 py-4">
                <!-- 2008 -->
                <div class="relative pl-8 md:pl-10">
                    <!-- Bullet dot -->
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-sm md:text-base block">2008 — Temuan Perahu Kuno</span>
                        <p class="text-xs md:text-sm text-slate-600 mt-2 leading-relaxed text-justify">
                            Warga menemukan bangkai perahu kayu kuno saat menggali tambak (± 500 m dari pantai). Uji radiokarbon menunjukkan usia abad ke-7–8 Masehi, setara masa pembangunan Candi Borobudur — diyakini salah satu perahu kayu tertua & terlengkap di Indonesia.
                        </p>
                    </div>
                </div>

                <!-- 2009 -->
                <div class="relative pl-8 md:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-sm md:text-base block">2009 — Gerakan Penghijauan</span>
                        <p class="text-xs md:text-sm text-slate-600 mt-2 leading-relaxed text-justify">
                            Pemuda desa M. Ali Mustofa bersama warga mulai menanam ribuan pohon cemara laut untuk menahan abrasi. Inilah cikal-bakal lanskap khas Karang Jahe.
                        </p>
                    </div>
                </div>

                <!-- 2013 -->
                <div class="relative pl-8 md:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-sm md:text-base block">2013 — Dibuka untuk Umum</span>
                        <p class="text-xs md:text-sm text-slate-600 mt-2 leading-relaxed text-justify">
                            Kawasan pantai resmi dibuka bagi wisatawan.
                        </p>
                    </div>
                </div>

                <!-- 2015 -->
                <div class="relative pl-8 md:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-sm md:text-base block">2015 — Peresmian Pengelolaan</span>
                        <p class="text-xs md:text-sm text-slate-600 mt-2 leading-relaxed text-justify">
                            Pengelolaan dikukuhkan oleh Pemerintah Desa Punjulharjo; berkembang dari gerakan pemuda menjadi tata kelola desa terstruktur.
                        </p>
                    </div>
                </div>

                <!-- 2023 -->
                <div class="relative pl-8 md:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-sm md:text-base block">2023 — Pengakuan Nasional</span>
                        <p class="text-xs md:text-sm text-slate-600 mt-2 leading-relaxed text-justify">
                            Desa Wisata Punjulharjo masuk 500 Besar Anugerah Desa Wisata Indonesia (ADWI).
                        </p>
                    </div>
                </div>

                <!-- 2024 -->
                <div class="relative pl-8 md:pl-10">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                    <div class="bg-white p-5 border border-slate-200 shadow-sm relative hover:shadow-md transition duration-300">
                        <span class="text-sky-600 font-bold text-sm md:text-base block">2024 — Kunjungan Terbanyak</span>
                        <p class="text-xs md:text-sm text-slate-600 mt-2 leading-relaxed text-justify">
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
    <section id="dayatarik" class="bg-slate-50 py-16 md:py-24 px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Keistimewaan
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Apa yang Membuatnya Istimewa
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Daya tarik geologis, alam, dan nilai budaya pesisir utara Punjulharjo yang tiada duanya.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-4" aria-hidden="true">
                            <i class="fa-solid fa-tree text-lg"></i>
                        </div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Hutan Cemara Laut</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Ribuan cemara laut yang rindang sepanjang pantai; suasana teduh yang jarang ditemui di pantai pantura lain. Lahir dari gerakan penghijauan melawan abrasi (nilai ekologis + estetis).
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-4" aria-hidden="true">
                            <i class="fa-solid fa-water text-lg"></i>
                        </div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Pasir Putih 3 KM</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Salah satu garis pantai berpasir putih terpanjang & terbersih di Rembang.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-4" aria-hidden="true">
                            <i class="fa-solid fa-child-reaching text-lg"></i>
                        </div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Ombak Tenang & Landai</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Aman dan ramah untuk anak serta keluarga.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-4" aria-hidden="true">
                            <i class="fa-solid fa-camera text-lg"></i>
                        </div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Sunset & Spot Instagramable</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Lanskap laut, pasir, dan cemara; favorit foto hingga prewedding.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-4" aria-hidden="true">
                            <i class="fa-solid fa-gem text-lg"></i>
                        </div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Karang Berbentuk Jahe</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Ciri khas geologis asal-usul nama pantai.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-6 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-full bg-sky-100/60 text-sky-600 flex items-center justify-center mb-4" aria-hidden="true">
                            <i class="fa-solid fa-book-open text-lg"></i>
                        </div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Wisata Edukasi–Sejarah</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Kedekatan dengan Situs Perahu Kuno abad ke-7 yang hanya berjarak ± 500 meter.
                        </p>
                    </div>
                    <div class="mt-4 pt-2">
                        <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="inline-flex items-center gap-1.5 text-xs text-sky-600 hover:text-sky-800 font-bold uppercase tracking-wider">
                            Info Cagar Budaya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 7: Fasilitas [fasilitas]
         ========================================================================= -->
    <section id="fasilitas" class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-square-plus"></i> Kenyamanan Pengunjung
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Fasilitas & Sarana Lengkap
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Dukungan fasilitas memadai untuk menjamin kenyamanan liburan Anda selama berada di area pantai.
                </p>
            </div>

            <!-- Facilities Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Fasilitas 1 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-house-flag"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Loket & Sekretariat</span>
                </div>

                <!-- Fasilitas 2 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-square-parking"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Area Parkir Luas</span>
                </div>

                <!-- Fasilitas 3 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-restroom"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Toilet / MCK Umum</span>
                </div>

                <!-- Fasilitas 4 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-mosque"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Musala Nurul Jannah</span>
                </div>

                <!-- Fasilitas 5 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-utensils"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Warung Kuliner</span>
                </div>

                <!-- Fasilitas 6 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-umbrella"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Gazebo & Kursi Pantai</span>
                </div>

                <!-- Fasilitas 7 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-campground"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Homestay & Camping</span>
                </div>

                <!-- Fasilitas 8 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-volleyball"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Outbound & Voli</span>
                </div>

                <!-- Fasilitas 9 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-puzzle-piece"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Area Bermain Anak</span>
                </div>

                <!-- Fasilitas 10 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-gift"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Toko Suvenir & Oleh-oleh</span>
                </div>

                <!-- Fasilitas 11 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-circle-info"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Pusat Informasi</span>
                </div>

                <!-- Fasilitas 12 -->
                <div class="flex items-center gap-3.5 p-4 border border-slate-100 hover:border-slate-200 bg-slate-50/50 transition duration-300">
                    <span class="text-sky-600 text-lg w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-motorcycle"></i>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-700 leading-tight">Persewaan Wahana</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 8: Aktivitas & Wahana [aktivitas]
         ========================================================================= -->
    <section id="aktivitas" class="bg-slate-50 py-16 md:py-24 px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-compass"></i> Eksplorasi Seru
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Aktivitas Seru untuk Semua
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Pilihan rekeasi pantai interaktif yang seru bagi pengunjung dewasa maupun anak-anak.
                </p>
            </div>

            <!-- Activity Cards Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- ATV -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80" 
                             alt="Penyewaan ATV menyusuri Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Adventure</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">ATV / Mini Trail</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Menyusuri garis pasir pantai sepanjang 3 kilometer dengan armada motor roda empat (ATV) atau mini trail yang memacu adrenalin.</p>
                        </div>
                    </div>
                </div>

                <!-- Perahu Wisata -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80" 
                             alt="Perahu wisata menyusuri perairan Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Watersport</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Perahu Wisata & Perahu Karet</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Menikmati tenangnya perairan pesisir utara Rembang dari atas perahu wisata kayu tradisional atau mendayung perahu karet santai.</p>
                        </div>
                    </div>
                </div>

                <!-- Banana Boat -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=600&q=80" 
                             alt="Wahana Banana Boat di air laut tenang" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Kelompok</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Banana Boat</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Wahana air seru bersama rombongan yang ditarik perahu cepat untuk menciptakan sensasi petualangan basah-basahan di laut.</p>
                        </div>
                    </div>
                </div>

                <!-- Kereta Wisata -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=600&q=80" 
                             alt="Kereta wisata keliling area Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Keluarga</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Kereta Wisata</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Pilihan tepat bagi keluarga yang ingin berkeliling menikmati rindangnya jalur pepohonan cemara laut tanpa perlu kelelahan berjalan kaki.</p>
                        </div>
                    </div>
                </div>

                <!-- Berenang -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" 
                             alt="Berenang di Pantai Karang Jahe pasir putih" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Rekreasi</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Berenang & Bermain Pasir</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Dengan ombak yang sangat tenang dan landai, pantai ini aman dan nyaman untuk berenang serta membangun istana pasir bagi anak-anak.</p>
                        </div>
                    </div>
                </div>

                <!-- Outbound & Voli -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80" 
                             alt="Kegiatan voli pantai kelompok" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Olahraga</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Outbound & Voli Pantai</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Tersedia lahan berumput dan berpasir yang teduh di bawah cemara untuk kegiatan outbound korporat, gathering, atau voli pantai bersama rekan.</p>
                        </div>
                    </div>
                </div>

                <!-- Camping -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80" 
                             alt="Camping ground di dekat pepohonan cemara laut" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Akomodasi</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Camping & Homestay</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Menghabiskan malam di tepi pantai dengan berkemah di area camping ground khusus atau menginap di homestay milik warga lokal Punjulharjo.</p>
                        </div>
                    </div>
                </div>

                <!-- Pulau Gede -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" 
                             alt="Perahu penyeberangan menuju Pulau Gede" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Eksplorasi</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Wisata Perahu ke Pulau Gede</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Menyewa perahu nelayan setempat berkapasitas ± 10 orang untuk menyeberang dan mengeksplorasi keindahan eksotis Pulau Gede (tarif ± Rp 300.000/perahu).</p>
                        </div>
                    </div>
                </div>

                <!-- Sunset Spot -->
                <div class="bg-white border border-slate-200 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80" 
                             alt="Sunset siluet cemara laut di Pantai Karang Jahe" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                        <span class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1">Fotografi</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-heading text-slate-900 mb-2">Berburu Sunset & Spot Foto</h3>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Mengabadikan momen senja romantis di antara sela-sela jajaran pohon cemara laut dengan beragam instalasi spot foto kreatif yang estetik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 9: Event & Tradisi [event]
         ========================================================================= -->
    <section id="event" class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-masks-theater"></i> Ragam Budaya
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Event Tahunan & Tradisi Lokal
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Kemeriahan pagelaran adat pesisir dan festival berkala yang melestarikan seni budaya luhur.
                </p>
            </div>

            <!-- Events List -->
            <div class="space-y-6">
                <!-- Event 1 -->
                <div class="p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-slate-900">Festival / Lomba Layang-Layang</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Digelar rutin secara berkala (contoh: September 2025, diikuti puluhan peserta dari berbagai daerah Jawa Tengah, dengan hadiah jutaan rupiah).</p>
                    </div>
                    <span class="bg-sky-100 text-sky-800 text-[10px] font-bold uppercase px-3 py-1 rounded-full shrink-0">Tahunan</span>
                </div>

                <!-- Event 2 -->
                <div class="p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-slate-900">Sedekah Laut / Nyadran (Hajatan Pantai)</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Tradisi syukuran budaya turun-temurun masyarakat nelayan pesisir atas limpahan hasil laut.</p>
                    </div>
                    <span class="bg-amber-100 text-amber-800 text-[10px] font-bold uppercase px-3 py-1 rounded-full shrink-0">Budaya</span>
                </div>

                <!-- Event 3 -->
                <div class="p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-slate-900">Pentas Seni Tradisional</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Pagelaran seni tradisional khas Punjulharjo seperti kesenian Thong-thong Lek, kesenian Barongan, Tari Kepak Punjulharjo, dan tarian Sufi.</p>
                    </div>
                    <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase px-3 py-1 rounded-full shrink-0">Seni</span>
                </div>

                <!-- Event 4 -->
                <div class="p-6 bg-slate-50 border-l-4 border-brand-accent shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-slate-900">Olahraga, Kepramukaan & Panggung Musik</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed">Berbagai kegiatan olahraga massal, perkemahan kepramukaan daerah, serta hiburan panggung musik rakyat diselenggarakan berkala oleh pengelola dan pemerintah kabupaten.</p>
                    </div>
                    <span class="bg-indigo-100 text-indigo-800 text-[10px] font-bold uppercase px-3 py-1 rounded-full shrink-0">Hiburan</span>
                </div>

                <!-- Kearifan Lokal Note -->
                <div class="p-5 border border-sky-100 bg-sky-50/50 rounded-none text-xs text-slate-600 flex gap-2">
                    <i class="fa-solid fa-circle-exclamation text-sky-600 shrink-0 mt-0.5" aria-hidden="true"></i>
                    <span><strong>Catatan Operasional (Kearifan Lokal):</strong> Pada bulan suci Ramadan, kawasan wisata pantai pernah ditutup total untuk umum agar masyarakat sekitar dan pengunjung dapat lebih khusyuk fokus menjalankan ibadah puasa dan aktivitas keagamaan.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 10: Harga Tiket & Tarif [tarif]
         ========================================================================= -->
    <section id="tarif" class="bg-slate-50 py-16 md:py-24 px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-4xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-receipt"></i> Informasi Retribusi
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Harga Tiket & Tarif Masuk
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Rincian perkiraan biaya masuk, retribusi parkir kendaraan, dan sewa wahana penyeberangan di Pantai Karang Jahe.
                </p>
            </div>

            <!-- Responsive Table Wrapper -->
            <div class="bg-white border border-slate-200 shadow-sm overflow-hidden rounded-none">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead>
                            <tr class="bg-brand-dark text-white text-xs md:text-sm font-semibold uppercase tracking-wider">
                                <th class="p-4 pl-6">Komponen Tiket / Wahana</th>
                                <th class="p-4 pr-6 text-right">Tarif (Kisaran)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-xs md:text-sm font-medium text-slate-700">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-motorcycle text-slate-400" aria-hidden="true"></i>
                                        <span>Tiket & Parkir Motor (Roda Dua)</span>
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right text-brand-dark font-bold">Rp 5.000</td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-car text-slate-400" aria-hidden="true"></i>
                                        <span>Tiket & Parkir Mobil (Roda Empat)</span>
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right text-brand-dark font-bold">Rp 15.000 – Rp 25.000 <span class="text-[10px] text-slate-400 font-normal block mt-0.5">(lebih tinggi saat akhir pekan/libur)</span></td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-bus text-slate-400" aria-hidden="true"></i>
                                        <span>Bus / Kendaraan Rombongan Besar</span>
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right text-brand-dark font-bold">Rp 25.000 – Rp 130.000 <span class="text-[10px] text-slate-400 font-normal block mt-0.5">(tergantung ukuran dimensi bus)</span></td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-person text-slate-400" aria-hidden="true"></i>
                                        <span>Estimasi Biaya Per Orang <span class="text-xs text-slate-400 font-normal">(termasuk parkir)</span></span>
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right text-brand-dark font-bold">± Rp 10.000 – Rp 15.000</td>
                            </tr>
                            <!-- Row 5 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-ship text-slate-400" aria-hidden="true"></i>
                                        <span>Wisata Perahu Penyeberangan ke Pulau Gede</span>
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right text-brand-dark font-bold">± Rp 300.000 / Perahu <span class="text-[10px] text-slate-400 font-normal block mt-0.5">(kapasitas maksimal 10 orang)</span></td>
                            </tr>
                            <!-- Row 6 -->
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-monument text-slate-400" aria-hidden="true"></i>
                                        <span>Tiket Edu Park Cagar Budaya Situs Perahu Kuno</span>
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right text-brand-dark font-bold">Mulai ± Rp 2.000 – Rp 5.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-slate-50 border-t border-slate-200 text-xs text-slate-500 font-sans italic text-center">
                    * Sewa wahana individu (ATV, sewa perahu karet, kereta wisata, banana boat) bervariasi terpisah sesuai jenis.
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 11: Ekonomi & Tata Kelola [ekonomi]
         ========================================================================= -->
    <section id="ekonomi" class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-emerald-50 text-emerald-600 text-sm font-semibold uppercase tracking-wider border border-emerald-100">
                    <i class="fa-solid fa-chart-line"></i> Kemakmuran Desa
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-slate-900 tracking-wide">
                    Tata Kelola & Dampak Ekonomi
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Model pemberdayaan kolaboratif yang berkontribusi nyata pada pendapatan desa dan warga.
                </p>
            </div>

            <!-- Narration & Model Pengelolaan -->
            <div class="bg-slate-50 p-6 md:p-8 border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-lg font-heading text-slate-800 border-b pb-3">Sistem Tata Kelola Kolaboratif</h3>
                <p class="text-slate-600 leading-relaxed text-justify text-xs md:text-sm">
                    Dikelola kolaboratif berbasis masyarakat — Badan Pengelola Pantai Karang Jahe (BPPKJ) bersama Kelompok Sadar Wisata (Pokdarwis), terintegrasi dalam Badan Usaha Milik Desa (BUMDes) "Abimantrana". Sumber dana operasional kawasan berasal dari tiket parkir kendaraan, retribusi karcis, sewa warung/kios pedagang, biaya sewa fasilitas penunjang, serta mendapat dukungan stimulan APBD Kabupaten Rembang.
                </p>
            </div>

            <!-- Stats Counters / Fact Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Stat 1 -->
                <div class="bg-emerald-50/50 p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-lg md:text-xl block">± Rp 2 Miliar</span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase mt-2 tracking-wider block">Perputaran Uang</span>
                    <p class="text-[11px] text-slate-600 mt-1 leading-snug">Per tahun di kawasan masuk langsung ke masyarakat (warung, suvenir, wahana, homestay).</p>
                </div>

                <!-- Stat 2 -->
                <div class="bg-emerald-50/50 p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-lg md:text-xl block">± Rp 150 Juta</span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase mt-2 tracking-wider block">PADes Desa</span>
                    <p class="text-[11px] text-slate-600 mt-1 leading-snug">Kontribusi bersih ke PADes Punjulharjo (unit usaha KJB, data laporan tahun 2019).</p>
                </div>

                <!-- Stat 3 -->
                <div class="bg-emerald-50/50 p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-lg md:text-xl block">88.450</span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase mt-2 tracking-wider block">Pengunjung 2024</span>
                    <p class="text-[11px] text-slate-600 mt-1 leading-snug">Jumlah kunjungan tertinggi di antara semua objek wisata di Kabupaten Rembang.</p>
                </div>

                <!-- Stat 4 -->
                <div class="bg-emerald-50/50 p-5 border border-emerald-100 text-center flex flex-col justify-between">
                    <span class="text-emerald-700 font-bold text-lg md:text-xl block">&gt; 46.090</span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase mt-2 tracking-wider block">Libur Nataru</span>
                    <p class="text-[11px] text-slate-600 mt-1 leading-snug">Pengunjung selama libur Nataru 2024/2025 (rata-rata harian 3.000–5.000, puncak 13.034 orang pada 1 Jan 2025).</p>
                </div>

                <!-- Stat 5 -->
                <div class="bg-emerald-50/50 p-5 border border-emerald-100 text-center flex flex-col justify-between col-span-2 md:col-span-1">
                    <span class="text-emerald-700 font-bold text-lg md:text-xl block">± 41 UMKM</span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase mt-2 tracking-wider block">Unit Usaha Lokal</span>
                    <p class="text-[11px] text-slate-600 mt-1 leading-snug">UMKM warga lokal yang tumbuh subur di sepanjang kawasan perbelanjaan wisata.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 12: Dampak Sosial [dampak]
         ========================================================================= -->
    <section id="dampaksosial" class="bg-slate-50 py-16 md:py-24 px-6 border-y border-slate-100 relative z-10">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-people-carry-box"></i> Aspek Sosial
                </div>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark tracking-wide">
                    Manfaat Bagi Warga Punjulharjo
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Bagaimana pariwisata mengangkat derajat hidup, pelestarian alam, dan memajukan pendidikan desa.
                </p>
            </div>

            <!-- Impact Grid (4 items) -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-6 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-briefcase text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Penyerapan Tenaga Kerja</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Warga desa setempat diserap bekerja aktif sebagai petugas pengelola teknis, kebersihan area pantai, keamanan kawasan, operator wahana permainan, hingga petugas penjaga parkir. Ibu-ibu rumah tangga yang dulunya hanya di rumah kini memiliki pekerjaan dan berjualan aktif di tepi pantai.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-store text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Peluang UMKM Baru</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Sebanyak ± 41 unit UMKM tumbuh di sektor kuliner laut, pembuatan kerajinan dan cendera mata khas pesisir, toko kelontong kebutuhan, serta jasa persewaan. Terbentuk Kelompok khusus olahan makanan khas bernama "Kartini", serta usaha penginapan homestay rumah warga yang terus berkembang.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-leaf text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Pelestarian Lingkungan Pesisir</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Kawasan wisata ini murni lahir dari gerakan penghijauan penanaman ribuan pohon cemara laut guna menahan ancaman abrasi pantai utara Jawa. Proyek restorasi hijau ini kini menjadi model percontohan ekowisata bahari berkelanjutan yang diakui luas.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 md:p-8 border border-slate-200 shadow-sm hover:shadow-md transition duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0" aria-hidden="true">
                        <i class="fa-solid fa-hand-holding-heart text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-heading text-slate-900 mb-2">Pemberdayaan Masyarakat</h3>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed text-justify">
                            Melalui struktur kepengurusan BUMDes & Pokdarwis, warga bertindak langsung sebagai pemilik sekaligus pengelola. Hal ini meningkatkan kesadaran pentingnya pendidikan tinggi; saat ini makin banyak pemuda-pemudi desa Punjulharjo yang menempuh pendidikan perguruan tinggi. Desa ini sukses meraih 500 Besar ADWI 2023.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 13: CTA Penutup [cta]
         ========================================================================= -->
    <section class="relative bg-gradient-to-r from-brand-dark to-slate-900 text-white py-16 md:py-24 px-6 overflow-hidden relative z-10">
        <!-- Subtle Background Pattern Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/5 via-transparent to-transparent pointer-events-none" aria-hidden="true"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center space-y-6">
            <h2 class="text-3xl md:text-5xl font-heading text-white tracking-wide">
                Rencanakan Kunjunganmu ke Karang Jahe
            </h2>
            <p class="text-slate-300 font-sans max-w-2xl mx-auto leading-relaxed text-sm md:text-base">
                Nikmati pasir putih, teduhnya cemara laut, dan hangatnya keramahan warga Punjulharjo. Sampai jumpa di Pantai Karang Jahe!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4">
                <a href="#lokasi" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-brand-accent hover:bg-yellow-500 text-brand-dark font-bold px-8 py-3.5 text-sm shadow-md transition duration-300 min-h-[44px]">
                    Lihat Lokasi Wisata
                    <i class="fa-solid fa-map-location-dot ml-2"></i>
                </a>
                <a href="{{ route('destinasi') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white font-semibold px-8 py-3.5 text-sm border border-white/20 transition duration-300 min-h-[44px]">
                    Jelajahi Destinasi Lain
                    <i class="fa-solid fa-compass ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 14: Destinasi Terkait [related]
         ========================================================================= -->
    <section class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-8">
            <h3 class="text-xl md:text-2xl font-heading text-slate-800 text-center font-bold">Destinasi Terkait</h3>
            
            <div class="max-w-xl mx-auto">
                <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="group block bg-white border border-slate-200 overflow-hidden hover:border-indigo-400 transition-colors duration-300 shadow-sm hover:shadow-md">
                    <div class="grid sm:grid-cols-12 gap-0">
                        <div class="sm:col-span-5 h-48 sm:h-full min-h-[160px] overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=600&q=80" 
                                 alt="Situs Cagar Budaya Perahu Kuno Punjulharjo" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 loading="lazy">
                        </div>
                        <div class="sm:col-span-7 p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block mb-1">Cagar Budaya & Sejarah</span>
                                <h4 class="text-lg font-heading text-slate-900 group-hover:text-indigo-600 transition-colors duration-200">Situs Perahu Kuno</h4>
                                <p class="text-xs text-slate-500 mt-2 leading-relaxed text-justify">
                                    Situs arkeologi nasional perahu kayu kuno utuh abad ke-7–8 Masehi yang merupakan salah satu perahu tertua di Indonesia. Hanya berjarak ± 500 meter dari pantai.
                                </p>
                            </div>
                            <div class="mt-4 pt-2 flex items-center text-xs font-bold text-indigo-600 uppercase gap-1">
                                Kunjungi Situs <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Source Credits (Optional / Footnote) -->
    <footer class="bg-slate-50 border-t border-slate-100 py-8 text-center text-slate-400 text-[10px] md:text-xs relative z-10 px-6">
        <div class="max-w-4xl mx-auto space-y-2 leading-relaxed">
            <p><strong>Sumber Data Referensi:</strong> Profil Desa Wisata Punjulharjo & Pantai Karang Jahe Kemenparekraf (Jadesta) • Data Kunjungan Pemkab Rembang • Dinas Kebudayaan & Pariwisata Kab. Rembang • Wikipedia Bahasa Indonesia • Jurnal Ilmiah (Publika UNESA, JIANA, SENTRIKOM Polines, UMS, UB, Undip) • Akun Media Sosial Resmi @karangjahe_beach & @desawisatapunjulharjo.</p>
            <p>Laporan Pendapatan, Kunjungan, dan Jumlah Pelaku UMKM bersifat estimasi/periodik sesuai data pembukuan pengelola.</p>
        </div>
    </footer>
@endsection
