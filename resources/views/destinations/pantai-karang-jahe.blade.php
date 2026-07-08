@extends('layouts.app')

@section('content')
    <!-- Hero Banner Section -->
    <section class="relative text-center min-h-[60vh] flex flex-col justify-center items-center bg-transparent">
        <!-- Background Banner -->
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-transform duration-[10000ms]"
             style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');">
        </div>
        <div class="absolute inset-0 bg-slate-950/50"></div>

        <div class="relative z-10 px-6 mt-20 max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-500/20 backdrop-blur-sm text-sky-300 text-sm font-semibold uppercase tracking-wider mb-4 border border-sky-400/20">
                <i class="fa-solid fa-umbrella-beach"></i> Destinasi Wisata
            </div>
            <h1 class="text-5xl md:text-7xl font-heading text-white mb-6 drop-shadow-lg leading-tight">
                Pantai Karang Jahe
            </h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto drop-shadow opacity-95">
                Pesona pasir putih bersih dibalut keasrian ribuan cemara laut yang rindang di pesisir Punjulharjo.
            </p>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[80px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,90 C320,130,420,40,740,70 C1040,95,1120,60,1200,80 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.5)"></path>
                <path d="M0,60 C240,90,380,30,700,60 C1000,85,1080,45,1200,55 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.7)"></path>
                <path d="M0,30 C150,60,350,10,600,40 C850,70,1050,30,1200,40 L1200,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="bg-white py-16 md:py-24 px-6 relative z-10">
        <div class="max-w-4xl mx-auto space-y-12">
            <!-- Back Button -->
            <div>
                <a href="{{ route('home') }}#tentang" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-800 font-semibold transition-all duration-300 transform hover:-translate-x-1">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

            <!-- Content Grid/Card -->
            <div class="bg-slate-50/50 backdrop-blur-sm p-8 md:p-12 rounded-[2rem] border border-slate-100 shadow-xl space-y-8">
                <div class="prose prose-slate max-w-none space-y-6 text-slate-700 leading-relaxed text-justify">
                    <h2 class="text-3xl font-heading text-slate-800 mb-6 border-b pb-4">
                        Tentang Pantai Karang Jahe
                    </h2>
                    <p class="text-base md:text-lg">
                        Pantai Karang Jahe merupakan salah satu destinasi wisata paling ikonik dan populer di pesisir Kabupaten Rembang, tepatnya berada di wilayah Desa Punjulharjo. Dinamakan "Karang Jahe" karena di sekitar pantai ini dulunya banyak ditemukan terumbu karang berbentuk karang-karang kecil yang jika dilihat sekilas sangat menyerupai jahe.
                    </p>
                    <p class="text-base md:text-lg">
                        Berbeda dengan pantai utara Jawa pada umumnya, Pantai Karang Jahe menyuguhkan hamparan pasir putih bersih yang membentang sangat luas. Karakteristik air lautnya cenderung tenang dengan ombak yang landai, menjadikannya destinasi yang sangat ramah dan aman bagi rekreasi keluarga, terutama untuk anak-anak bermain pasir dan air.
                    </p>
                    <p class="text-base md:text-lg">
                        Keunikan utama pantai ini terletak pada vegetasi ribuan pohon cemara laut (Casuarina equisetifolia) yang sengaja ditanam berjejer rapi di sepanjang bibir pantai. Pepohonan cemara yang rimbun ini memberikan suasana yang luar biasa teduh, sejuk, dan asri, menghadirkan nuansa eksotis yang menenangkan bagi siapa saja yang ingin bersantai melepas penat di tepi pantai.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
