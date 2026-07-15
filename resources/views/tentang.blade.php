@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    @php
        $heroBg = \App\Models\SiteSetting::getValue('hero_background');
        $heroBgUrl = $heroBg 
            ? (str_starts_with($heroBg, 'http') || str_contains($heroBg, 'storage/') ? asset($heroBg) : Storage::url($heroBg)) 
            : asset('images/hero-bg.jpg');
    @endphp

    <section class="relative text-center min-h-[60vh] flex flex-col justify-center items-center bg-transparent">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat"
             style="background-image: url('{{ $heroBgUrl }}');">
        </div>
        <div class="absolute inset-0 bg-slate-950/40"></div>

        <div class="relative z-10 px-4 mt-16">
            <h1 class="text-3xl md:text-6xl font-heading text-white mb-4 drop-shadow-lg md:whitespace-nowrap">
                Tentang Kami
            </h1>
            <p class="text-base md:text-xl text-gray-100 max-w-2xl mx-auto drop-shadow opacity-90">
                Mengenal lebih dekat Desa Wisata Punjulharjo — harmoni alam, budaya, dan sejarah.
            </p>
        </div>

        <!-- Multi-layered Aesthetic Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[80px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- Layer 1: Back Wave (Translucent Sky-Blue) -->
                <path d="M0,90 C320,130,420,40,740,70 C1040,95,1120,60,1200,80 L1200,120 L0,120 Z" fill="rgba(14, 165, 233, 0.2)"></path>
                <!-- Layer 2: Middle Wave (Translucent White) -->
                <path d="M0,60 C240,90,380,30,700,60 C1000,85,1080,45,1200,55 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.35)"></path>
                <!-- Layer 3: Front Wave (Translucent White/Cream) -->
                <path d="M0,30 C150,60,350,10,600,40 C850,70,1050,30,1200,40 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.5)"></path>
            </svg>
        </div>
    </section>

    <!-- Profil Desa -->
    <section class="py-10 md:py-20 bg-transparent px-4 md:px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-2xl md:text-4xl font-heading text-sky-600 mb-6 md:mb-8">Profil Desa</h2>
            <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto mb-6 md:mb-10 text-sm md:text-base">
                <strong>Desa Punjulharjo</strong> terletak di Kecamatan Rembang, Kabupaten Rembang, Jawa Tengah.
                Desa ini dikenal karena pesonanya yang unik, memadukan keindahan alam pesisir dengan kekayaan budaya
                tradisional.
                Penduduknya yang ramah and gotong royong menjadikan desa ini destinasi wisata yang menarik, baik bagi
                wisatawan lokal maupun mancanegara.
            </p>

            <div class="grid md:grid-cols-2 gap-6 md:gap-10 mt-6 md:mt-10">
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition text-left border border-sky-100">
                    <h3 class="text-xl md:text-2xl font-heading mb-3 text-sky-600">🌿 Visi</h3>
                    <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                        Menjadi desa wisata unggulan berbasis budaya dan kearifan lokal yang berkelanjutan,
                        serta menjadi inspirasi bagi pengembangan desa wisata lainnya di Indonesia.
                    </p>
                </div>
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition text-left border border-sky-100">
                    <h3 class="text-xl md:text-2xl font-semibold mb-3 text-sky-600">🎯 Misi</h3>
                    <ul class="list-disc list-inside text-gray-700 leading-relaxed space-y-2 text-sm md:text-base">
                        <li>Melestarikan warisan budaya dan sejarah desa.</li>
                        <li>Mendorong partisipasi masyarakat dalam pengelolaan wisata.</li>
                        <li>Mengembangkan potensi ekonomi kreatif berbasis wisata.</li>
                        <li>Menjaga kelestarian lingkungan dan keaslian alam desa.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Potensi Wisata -->
    <section class="bg-sky-50/30 backdrop-blur-sm py-10 md:py-20 px-4 md:px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl md:text-4xl font-heading text-sky-600 mb-6 md:mb-12">Potensi Wisata Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-6 md:gap-8">
                <div class="bg-white rounded-none shadow-sm hover:shadow transition p-5 md:p-6 border border-slate-200">
                    <img src="{{ asset('images/perahu-kuno.jpg') }}" alt="Situs Perahu Kuno"
                        class="rounded-none mb-4 w-full h-52 object-cover">
                    <h3 class="text-xl font-semibold mb-2 text-sky-600">Situs Perahu Kuno</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Situs bersejarah peninggalan maritim masa lampau, memberikan wawasan unik tentang
                        perjalanan sejarah perdagangan dan pelayaran di Nusantara.
                    </p>
                </div>
                <div class="bg-white rounded-none shadow-sm hover:shadow transition p-5 md:p-6 border border-slate-200">
                    <img src="{{ asset('images/karang-jahe.jpg') }}" alt="Pantai Karang Jahe"
                        class="rounded-none mb-4 w-full h-52 object-cover">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">Pantai Karang Jahe</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Pantai eksotis dengan pasir putih lembut dan ombak tenang, cocok untuk wisata keluarga dan menikmati
                        matahari terbenam.
                    </p>
                </div>
                <div class="bg-white rounded-none shadow-sm hover:shadow transition p-5 md:p-6 border border-slate-200">
                    <img src="{{ asset('images/kesenian-lokal.jpg') }}" alt="Kesenian Lokal"
                        class="rounded-none mb-4 w-full h-52 object-cover">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">Kesenian & Budaya</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Ragam kesenian seperti tayub, karawitan, dan batik khas Punjulharjo memperkaya pengalaman wisata
                        budaya di desa ini.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Penggerak -->
    <section class="py-10 md:py-20 bg-transparent px-4 md:px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-2xl md:text-4xl font-heading text-sky-600 mb-6 md:mb-8">Tim Penggerak Desa Wisata</h2>
            <p class="text-gray-700 mb-6 md:mb-10 text-sm md:text-base">
                Desa Punjulharjo tidak akan berkembang tanpa kerja sama masyarakat dan dukungan berbagai pihak.
                Berikut adalah tim yang berperan aktif dalam pengembangan desa wisata ini:
            </p>

            <div class="grid md:grid-cols-3 gap-6 md:gap-10 mt-6 md:mt-10">
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition border border-sky-100">
                    <img src="{{ asset('images/team1.jpg') }}" alt="Kepala Desa"
                        class="w-32 h-32 rounded-none mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold">Kepala Desa</h3>
                    <p class="text-gray-600 text-sm">Memimpin dan mengarahkan seluruh kegiatan pengembangan wisata.</p>
                </div>
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition border border-sky-100">
                    <img src="{{ asset('images/team2.jpg') }}" alt="Koordinator Wisata"
                        class="w-32 h-32 rounded-none mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold">Koordinator Wisata</h3>
                    <p class="text-gray-600 text-sm">Mengelola kegiatan promosi, event, dan pelayanan wisata.</p>
                </div>
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition border border-sky-100">
                    <img src="{{ asset('images/team3.jpg') }}" alt="Tim KKN"
                        class="w-32 h-32 rounded-none mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold">Tim KKN-T Undip Unisvet</h3>
                    <p class="text-gray-600 text-sm">Berperan dalam inovasi digital, promosi, dan pembangunan berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection