@extends('layouts.app')

@section('title', 'Tentang Desa Punjulharjo — Sejarah, Visi, dan Profil Desa Wisata')
@section('meta_description', 'Kenali lebih dalam Desa Punjulharjo, Kecamatan Rembang, Kabupaten Rembang: sejarah desa, visi dan misi, struktur perangkat desa, potensi wisata alam dan sejarah, serta daftar destinasi unggulan.')
@section('og_image', asset('images/beach-bg.png'))

@section('content')
    @php
        $mottoBg = \App\Models\SiteSetting::getValue('motto_desa_background');
        $mottoBgUrl = $mottoBg 
            ? (str_starts_with($mottoBg, 'http') || str_contains($mottoBg, 'storage/') ? asset($mottoBg) : Storage::url($mottoBg)) 
            : null;
    @endphp

    <div id="hero" class="scroll-mt-24">
        <x-fixed-image-section
            key="hero_tentang"
            :image="asset('images/beach-bg.png')"
            title="TENTANG DESA WISATA PUNJULHARJO"
            subtitle="Mengenal lebih dekat Desa Punjulharjo harmoni sejarah maritim, keindahan pesisir, dan kearifan budaya di pesisir utara Rembang."
            waveColor="text-white"
            hasWave="true">
            <a href="#sekilas-desa" class="inline-flex items-center gap-2 rounded-lg bg-brand-accent px-6 py-3 font-semibold text-brand-dark hover:bg-white transition duration-300">
                <i class="fa-solid fa-arrow-down text-xs"></i> Jelajahi Profil Desa
            </a>
        </x-fixed-image-section>
    </div>


    <!-- =========================================================================
         SECTION 2: SEKILAS DESA (PROFIL UMUM)
         ========================================================================= -->
    <section id="sekilas-desa" class="scroll-mt-24 py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-8">
            <div class="text-center space-y-3 max-w-3xl mx-auto">

                <h2 class="text-3xl md:text-5xl font-heading text-brand-dark tracking-wide">
                    Sekilas Desa Punjulharjo
                </h2>
                <p class="text-slate-600 font-sans text-sm md:text-base">
                    Perpaduan indah antara warisan sejarah bahari Nusantara dan keramahan pesisir utara Jawa.
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-center pt-4">
                <div class="lg:col-span-7 space-y-4 text-slate-700 leading-relaxed text-sm md:text-base text-justify font-sans">
                    <p>
                        <strong>Desa Punjulharjo</strong> adalah sebuah desa pesisir di Kecamatan Rembang, Kabupaten Rembang, Provinsi Jawa Tengah, yang berbatasan langsung dengan Laut Jawa. Terletak sekitar 7,5–8 km di sebelah timur pusat Kota Rembang, tepat di jalur Pantura Rembang–Lasem KM 7,5, desa ini dikenal sebagai salah satu <strong>desa wisata unggulan</strong> di Kabupaten Rembang.
                    </p>
                    <p>
                        Punjulharjo memadukan tiga kekuatan utama: <strong>jejak sejarah maritim</strong> (Situs Perahu Kuno abad ke-7–8), <strong>wisata bahari</strong> (Pantai Karang Jahe), serta <strong>kehidupan masyarakat pesisir</strong> yang religius dan gotong royong dengan mata pencaharian sebagai petani garam, nelayan, dan pelaku UMKM pariwisata.
                    </p>
                </div>

                <div class="lg:col-span-5">
                    <div class="p-8 text-white rounded-none border border-brand-dark shadow-xl space-y-4 relative overflow-hidden group {{ $mottoBgUrl ? '' : 'bg-gradient-to-br from-brand-dark via-slate-900 to-brand-dark' }}"
                         style="{{ $mottoBgUrl ? "background-image: url('{$mottoBgUrl}'); background-size: cover; background-position: center;" : '' }}">
                        
                        @if($mottoBgUrl)
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/80 to-slate-950/70 z-0"></div>
                        @else
                            <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-brand-accent/10 rounded-full blur-2xl z-0"></div>
                        @endif

                        @if(Auth::check() && Auth::user()->isAdmin())
                            <!-- Floating Edit Button on top of everything -->
                            <div class="absolute top-4 right-4 z-20 pointer-events-auto">
                                <button onclick="document.getElementById('edit-motto-bg-modal').classList.remove('hidden')" 
                                        class="bg-white/95 hover:bg-white text-slate-800 p-2 rounded-md shadow border border-slate-200/50 flex items-center justify-center transition hover:scale-105 active:scale-95">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endif

                        <div class="relative z-10 w-12 h-12 bg-brand-accent text-brand-dark rounded-none flex items-center justify-center text-xl font-bold shadow-md">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <h3 class="relative z-10 text-xs font-bold uppercase tracking-widest text-brand-accent">Motto Desa</h3>
                        <blockquote class="relative z-10 text-xl md:text-2xl font-heading text-white leading-snug">
                            "Punjulharjo BERKAH"
                        </blockquote>
                        <p class="relative z-10 text-xs md:text-sm text-slate-300 font-medium leading-relaxed italic border-t border-white/10 pt-3">
                            Bersih, Elok, Rapi, Kerja keras, Amanah, Harmonis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 3: GEOGRAFIS & IKLIM (STATISTIK INFOBOX)
         ========================================================================= -->
    <section class="scroll-mt-24 py-16 bg-slate-50 border-y border-slate-200 px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-2 max-w-2xl mx-auto">

                <h2 class="text-2xl md:text-4xl font-heading text-brand-dark">Geografis & Iklim Desa</h2>
                <p class="text-slate-600 text-xs md:text-sm">Karakteristik fisik dan posisi strategis Punjulharjo di pesisir Pantura.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-5 rounded-none border border-slate-200 shadow-sm space-y-2 hover:border-brand-light transition">
                    <div class="w-10 h-10 rounded-none bg-sky-50 text-sky-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-map-pin"></i>
                    </div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Wilayah & Posisi</span>
                    <h3 class="text-sm font-bold text-slate-800">Kec. Rembang</h3>
                    <p class="text-xs text-slate-500">Kab. Rembang, Jawa Tengah 59219</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-5 rounded-none border border-slate-200 shadow-sm space-y-2 hover:border-brand-light transition">
                    <div class="w-10 h-10 rounded-none bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-mountain-sun"></i>
                    </div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Topografi</span>
                    <h3 class="text-sm font-bold text-slate-800">Dataran Rendah</h3>
                    <p class="text-xs text-slate-500">Ketinggian ±50 mdpl</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-5 rounded-none border border-slate-200 shadow-sm space-y-2 hover:border-brand-light transition">
                    <div class="w-10 h-10 rounded-none bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-temperature-half"></i>
                    </div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Iklim & Suhu</span>
                    <h3 class="text-sm font-bold text-slate-800">±25°C – 33°C</h3>
                    <p class="text-xs text-slate-500">Hujan ±1.200 mm/tahun</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-5 rounded-none border border-slate-200 shadow-sm space-y-2 hover:border-brand-light transition">
                    <div class="w-10 h-10 rounded-none bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Akses Jarak</span>
                    <h3 class="text-sm font-bold text-slate-800">±7,5 km Timur</h3>
                    <p class="text-xs text-slate-500">Jalur Pantura Km 7,5 Rembang</p>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 4: VISI & MISI DESA
         ========================================================================= -->
    <section id="visi-misi" class="scroll-mt-24 py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">

                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark">Visi & Misi Desa</h2>
                <p class="text-slate-600 text-sm">Komitmen pemerintah dan masyarakat dalam membangun Punjulharjo yang maju.</p>
            </div>

            <!-- Visi Banner -->
            <div class="p-8 md:p-10 bg-gradient-to-r from-brand-dark via-slate-900 to-brand-dark text-white rounded-none shadow-xl border border-brand-dark relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-brand-accent/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 max-w-3xl space-y-4">
                    <span class="px-3 py-1 bg-brand-accent/20 text-brand-accent text-xs font-bold uppercase tracking-wider rounded-none border border-brand-accent/30">
                        Visi Pembangunan — "BERKAH"
                    </span>
                    <h3 class="text-xl md:text-3xl font-heading leading-relaxed italic text-brand-accent">
                        "Hadir lebih dekat untuk mengabdi dan melayani masyarakat guna mewujudkan Desa Punjulharjo yang religius, adil, makmur, dan sejahtera."
                    </h3>
                </div>
            </div>

            <!-- Misi Grid -->
            <div>
                <h3 class="text-xl font-bold text-brand-dark mb-6 font-heading flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-brand-accent"></i> Delapan Misi Utama Pembangunan
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    @php
                        $misiList = [
                            "Memberikan pelayanan prima kepada masyarakat.",
                            "Berkoordinasi dengan seluruh unsur kelembagaan desa dan keagamaan.",
                            "Meningkatkan kesejahteraan dan taraf hidup masyarakat.",
                            "Memaksimalkan potensi wisata Desa Punjulharjo.",
                            "Menjaga dan melestarikan kegiatan keagamaan sebagai karakter desa.",
                            "Membangun infrastruktur publik pendukung ekonomi desa.",
                            "Meningkatkan mutu pelayanan kesehatan dan pendidikan.",
                            "Mengembangkan UMKM, BUMDes, dan pengelolaan sumber daya alam yang berkelanjutan."
                        ];
                    @endphp

                    @foreach($misiList as $index => $misi)
                        <div class="flex items-start gap-4 p-4 rounded-none border border-slate-200 bg-slate-50/50 hover:bg-white transition duration-200">
                            <div class="w-8 h-8 rounded-none bg-brand-dark text-white font-bold flex items-center justify-center shrink-0 text-sm">
                                {{ $index + 1 }}
                            </div>
                            <p class="text-xs md:text-sm text-slate-700 font-sans leading-relaxed pt-1">
                                {{ $misi }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 5: PEMERINTAHAN DESA (PERANGKAT)
         ========================================================================= -->
    <section id="pemerintahan" class="scroll-mt-24 py-10 md:py-14 bg-white px-6">
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="max-w-6xl mx-auto flex justify-end mb-6">
                <a href="{{ route('admin.perangkat-desa.index') }}"
                   class="inline-flex items-center gap-2 bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark transition-colors font-semibold px-4 py-2 rounded-none text-sm shadow">
                    <i class="fa-solid fa-pen"></i> Edit Perangkat Desa
                </a>
            </div>
        @endif
        <div class="max-w-6xl mx-auto space-y-6">
            <div class="text-center space-y-3 max-w-2xl mx-auto">

                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark">Pemerintahan Desa</h2>
                <p class="text-slate-600 text-sm">Jajaran Perangkat Desa yang melayani masyarakat Desa Punjulharjo.</p>
            </div>

            @php
                $perangkat3dTotal = $perangkat->count();
                $perangkat3dCardWidth = 170;
                $perangkat3dCardHeight = 220;
                $perangkat3dRadius = $perangkat3dTotal > 0
                    ? round(($perangkat3dCardWidth * $perangkat3dTotal) / (2 * M_PI * 0.55))
                    : 190;
                $perangkat3dRadius = max(190, $perangkat3dRadius);
                $perangkat3dStageSize = $perangkat3dCardHeight + 110;
                $perangkat3dPerspective = max(1200, $perangkat3dRadius * 3);
                $perangkat3dDuration = max(30, round($perangkat3dTotal * 5.5));
            @endphp

            <div class="perangkat-3d-fullbleed">
                <div class="perangkat-3d-stage" style="height: {{ $perangkat3dStageSize }}px; perspective: {{ $perangkat3dPerspective }}px;">
                    <div class="perangkat-3d-ring" style="--total: {{ $perangkat3dTotal }}; --radius: {{ $perangkat3dRadius }}px; --duration: {{ $perangkat3dDuration }}s;">
                        @foreach($perangkat as $index => $p)
                            <div class="perangkat-3d-card"
                                 style="--i: {{ $index }};"
                                 tabindex="0">
                                <div class="perangkat-3d-card__face">
                                    @if($p->foto)
                                        <img src="{{ (str_starts_with($p->foto, 'http') || str_contains($p->foto, 'storage/')) ? asset($p->foto) : Storage::url($p->foto) }}" alt="Foto {{ $p->nama }}">
                                    @else
                                        <div class="perangkat-3d-card__fallback">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="perangkat-3d-card__name-badge">{{ $p->nama }}</div>
                                <div class="perangkat-3d-card__overlay">
                                    <span class="perangkat-3d-card__jabatan">{{ $p->jabatan }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <p class="text-[10px] text-center text-slate-400 italic font-sans">
                * Data resmi Perangkat Desa Punjulharjo (dapat diperbarui berkala).
            </p>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 6: POTENSI WISATA UNGGULAN
         ========================================================================= -->
    <section id="potensi" class="scroll-mt-24 py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">

                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark">Potensi Wisata Unggulan</h2>
                <p class="text-slate-600 text-sm">Destinasi wisata kebanggaan Punjulharjo yang selalu ramai dikunjungi wisatawan.</p>
            </div>

            @php
                $pantaiImg = \App\Models\SiteSetting::getValue('potensi_pantai_image', 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80');
                $pantaiImgUrl = (str_starts_with($pantaiImg, 'http') || str_contains($pantaiImg, 'storage/')) ? asset($pantaiImg) : Storage::url($pantaiImg);

                $situsImg = \App\Models\SiteSetting::getValue('potensi_situs_image', 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80');
                $situsImgUrl = (str_starts_with($situsImg, 'http') || str_contains($situsImg, 'storage/')) ? asset($situsImg) : Storage::url($situsImg);

                $cemaraImg = \App\Models\SiteSetting::getValue('potensi_cemara_image', 'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=800&q=80');
                $cemaraImgUrl = (str_starts_with($cemaraImg, 'http') || str_contains($cemaraImg, 'storage/')) ? asset($cemaraImg) : Storage::url($cemaraImg);
            @endphp

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1: Pantai Karang Jahe (KJB) -->
                <div class="bg-white rounded-none border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition border-t-4 border-t-sky-600">
                    <div>
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="{{ $pantaiImgUrl }}" 
                                 alt="Pantai Karang Jahe Punjulharjo" 
                                 class="w-full h-full object-cover" loading="lazy">
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <div class="absolute top-3 right-3 z-20">
                                    <button type="button" onclick="document.getElementById('edit-potensi-modal-potensi_pantai_image').classList.remove('hidden')" 
                                            class="bg-white/90 hover:bg-white text-slate-800 p-2 rounded-md shadow border border-slate-200/50 flex items-center justify-center transition hover:scale-105 active:scale-95">
                                        <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold font-heading text-brand-dark">Pantai Karang Jahe (KJB)</h3>
                            <p class="text-xs text-slate-600 leading-relaxed font-sans">
                                Membentang sejauh ±3 km dengan pasir putih halus, ombak tenang, dan deretan ribuan pohon cemara laut rindang (±1 km). Dilengkapi wahana ATV, perahu karet, kereta pantai, & suvenir khas.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-slate-500">
                        <span><i class="fa-regular fa-clock"></i> 06.00 – 17.30 WIB</span>
                        <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="text-sky-600 font-bold hover:text-sky-700 transition">Detail &rarr;</a>
                    </div>
                </div>

                <!-- Card 2: Edu Park Situs Perahu Kuno -->
                <div class="bg-white rounded-none border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition border-t-4 border-t-brand-accent">
                    <div>
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="{{ $situsImgUrl }}" 
                                 alt="Edu Park Situs Perahu Kuno" 
                                 class="w-full h-full object-cover" loading="lazy">
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <div class="absolute top-3 right-3 z-20">
                                    <button type="button" onclick="document.getElementById('edit-potensi-modal-potensi_situs_image').classList.remove('hidden')" 
                                            class="bg-white/95 hover:bg-white text-slate-800 p-2 rounded-md shadow border border-slate-200/50 flex items-center justify-center transition hover:scale-105 active:scale-95">
                                        <i class="fa-solid fa-pencil text-xs text-brand-accent"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold font-heading text-brand-dark">Edu Park Perahu Kuno</h3>
                            <p class="text-xs text-slate-600 leading-relaxed font-sans">
                                Kawasan wisata edukasi sejarah tempat bersemayamnya perahu kayu abad ke-7–8 M. Pusat ilmu pengetahuan bahari Nusantara bagi pelajar, mahasiswa, dan wisatawan.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-slate-500">
                        <span><i class="fa-solid fa-graduation-cap"></i> Edukasi Sejarah</span>
                        <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="text-amber-600 font-bold hover:text-brand-accent transition">Detail &rarr;</a>
                    </div>
                </div>

                <!-- Card 3: My Cemara Adopsi Pohon -->
                <div class="bg-white rounded-none border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition border-t-4 border-t-emerald-600">
                    <div>
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="{{ $cemaraImgUrl }}" 
                                 alt="Program My Cemara Punjulharjo" 
                                 class="w-full h-full object-cover" loading="lazy">
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <div class="absolute top-3 right-3 z-20">
                                    <button type="button" onclick="document.getElementById('edit-potensi-modal-potensi_cemara_image').classList.remove('hidden')" 
                                            class="bg-white/90 hover:bg-white text-slate-800 p-2 rounded-md shadow border border-slate-200/50 flex items-center justify-center transition hover:scale-105 active:scale-95">
                                        <i class="fa-solid fa-pencil text-xs text-emerald-600"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold font-heading text-brand-dark">My Cemara (Adopsi Pohon)</h3>
                            <p class="text-xs text-slate-600 leading-relaxed font-sans">
                                Program penghijauan pesisir di mana pengunjung dapat mengadopsi bibit cemara laut yang ditanam & dirawat langsung oleh tim desa dengan sertifikat digital resmi.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-slate-500">
                        <span><i class="fa-solid fa-tree"></i> Program Adopsi</span>
                        <a href="{{ route('adopsi.index') }}" class="text-emerald-600 font-bold hover:text-emerald-700 transition hover:underline">Ikut Adopsi &rarr;</a>
                    </div>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->isAdmin())
                @foreach(['potensi_pantai_image' => 'Pantai Karang Jahe', 'potensi_situs_image' => 'Situs Perahu Kuno', 'potensi_cemara_image' => 'My Cemara'] as $mKey => $mTitle)
                    <!-- Edit Modal for {{ $mTitle }} -->
                    <div id="edit-potensi-modal-{{ $mKey }}" class="hidden fixed inset-0 z-[100] overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all text-slate-800">
                            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                                <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Gambar {{ $mTitle }}</h3>
                                <button type="button" onclick="document.getElementById('edit-potensi-modal-{{ $mKey }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                                    <i class="fa-solid fa-xmark text-xl"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.hero.update-custom') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="hero_key" value="{{ $mKey }}">
                                <div class="p-6 space-y-4">
                                    <div>
                                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Gambar Baru</label>
                                        <input type="file" name="hero_image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                        <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 5MB.</p>
                                    </div>
                                </div>
                                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                                    <button type="button" onclick="document.getElementById('edit-potensi-modal-{{ $mKey }}').classList.add('hidden')" 
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
                                $backup = \App\Models\SiteSetting::getValue($mKey . '_backup');
                            @endphp
                            @if($backup)
                                <div class="p-6 border-t border-slate-100 bg-slate-50">
                                    <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                                    <div class="flex items-center gap-3">
                                        <img src="{{ (str_starts_with($backup, 'http') || str_contains($backup, 'storage/')) ? asset($backup) : Storage::url($backup) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                                        <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="hero_key" value="{{ $mKey }}">
                                            <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                                <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

            @if(Auth::check() && Auth::user()->isAdmin())
                <!-- Edit Motto Background Modal -->
                <div id="edit-motto-bg-modal" class="hidden fixed inset-0 z-[100] overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                    <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all text-slate-800">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                            <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Background Motto Desa</h3>
                            <button type="button" onclick="document.getElementById('edit-motto-bg-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                                <i class="fa-solid fa-xmark text-xl"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.motto-desa-background.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="p-6 space-y-4">
                                <div>
                                    <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Gambar Baru</label>
                                    <input type="file" name="motto_desa_background" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                    <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 5MB.</p>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                                <button type="button" onclick="document.getElementById('edit-motto-bg-modal').classList.add('hidden')" 
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
                            $backupMottoBg = \App\Models\SiteSetting::getValue('motto_desa_background_backup');
                        @endphp
                        @if($backupMottoBg)
                            <div class="p-6 border-t border-slate-100 bg-slate-50">
                                <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                                <div class="flex items-center gap-3">
                                    <img src="{{ (str_starts_with($backupMottoBg, 'http') || str_contains($backupMottoBg, 'storage/')) ? asset($backupMottoBg) : Storage::url($backupMottoBg) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                                    <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="hero_key" value="motto_desa_background">
                                        <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                            <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>


    <!-- =========================================================================
         SECTION 7: EKONOMI & WISATA EDUKASI
         ========================================================================= -->
    <section id="ekonomi-budaya" class="scroll-mt-24 py-16 bg-slate-50 border-y border-slate-200 px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-2 max-w-2xl mx-auto">

                <h2 class="text-2xl md:text-4xl font-heading text-brand-dark">Ekonomi & Wisata Edukasi</h2>
                <p class="text-slate-600 text-xs md:text-sm">Pengalaman belajar langsung dari mata pencaharian & produksi khas warga Punjulharjo.</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-white p-6 rounded-none border border-slate-200 shadow-sm space-y-3 text-center hover:border-brand-light transition">
                    <div class="w-12 h-12 rounded-none bg-brand-dark/10 text-brand-dark flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-cubes-stacked"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Pembuatan Garam</h3>
                    <p class="text-xs text-slate-500 font-sans leading-relaxed">Proses pembuatan garam tradisional di ladang tambak garam pesisir.</p>
                </div>

                <div class="bg-white p-6 rounded-none border border-slate-200 shadow-sm space-y-3 text-center hover:border-brand-light transition">
                    <div class="w-12 h-12 rounded-none bg-brand-dark/10 text-brand-dark flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-fish"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Bandeng Presto</h3>
                    <p class="text-xs text-slate-500 font-sans leading-relaxed">Pengolahan & pemrosesan kuliner olahan ikan bandeng presto gurih.</p>
                </div>

                <div class="bg-white p-6 rounded-none border border-slate-200 shadow-sm space-y-3 text-center hover:border-brand-light transition">
                    <div class="w-12 h-12 rounded-none bg-brand-dark/10 text-brand-dark flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-lemon"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Manisan Kraih (Kraiku)</h3>
                    <p class="text-xs text-slate-500 font-sans leading-relaxed">Pembuatan manisan olahan buah kraih khas pesisir Punjulharjo.</p>
                </div>

                <div class="bg-white p-6 rounded-none border border-slate-200 shadow-sm space-y-3 text-center hover:border-brand-light transition">
                    <div class="w-12 h-12 rounded-none bg-brand-dark/10 text-brand-dark flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-masks-theater"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Seni & Budaya</h3>
                    <p class="text-xs text-slate-500 font-sans leading-relaxed">Pembelajaran tari tradisional & atraksi kebudayaan lokal desa.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 8: SENI & BUDAYA KHAS
         ========================================================================= -->
    <section class="scroll-mt-24 py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-3 max-w-2xl mx-auto">

                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark">Kesenian & Budaya Desa</h2>
                <p class="text-slate-600 text-sm">Kesenian khas yang terus dijaga dan dilestarikan oleh masyarakat Punjulharjo.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-6 bg-slate-50 border border-slate-200 rounded-none text-center space-y-2 hover:border-brand-dark transition">
                    <div class="w-10 h-10 bg-brand-dark text-brand-accent rounded-none flex items-center justify-center mx-auto text-base font-bold">
                        <i class="fa-solid fa-drum"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Tari Kepak</h3>
                    <p class="text-xs text-slate-500">Tarian kreasi khas Punjulharjo</p>
                </div>

                <div class="p-6 bg-slate-50 border border-slate-200 rounded-none text-center space-y-2 hover:border-brand-dark transition">
                    <div class="w-10 h-10 bg-brand-dark text-brand-accent rounded-none flex items-center justify-center mx-auto text-base font-bold">
                        <i class="fa-solid fa-person-dots-from-line"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Tari Sufi</h3>
                    <p class="text-xs text-slate-500">Tarian spiritual keagamaan</p>
                </div>

                <div class="p-6 bg-slate-50 border border-slate-200 rounded-none text-center space-y-2 hover:border-brand-dark transition">
                    <div class="w-10 h-10 bg-brand-dark text-brand-accent rounded-none flex items-center justify-center mx-auto text-base font-bold">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Tong Tong Lek</h3>
                    <p class="text-xs text-slate-500">Musik bambu tradisional</p>
                </div>

                <div class="p-6 bg-slate-50 border border-slate-200 rounded-none text-center space-y-2 hover:border-brand-dark transition">
                    <div class="w-10 h-10 bg-brand-dark text-brand-accent rounded-none flex items-center justify-center mx-auto text-base font-bold">
                        <i class="fa-solid fa-dragon"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">Barongan</h3>
                    <p class="text-xs text-slate-500">Seni pertunjukan rakyat</p>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 9: PRESTASI & PENGAKUAN
         ========================================================================= -->
    <section class="scroll-mt-24 py-16 bg-gradient-to-r from-brand-dark via-slate-900 to-brand-dark text-white px-6 shadow-xl border-y border-brand-dark">
        <div class="max-w-6xl mx-auto text-center space-y-8">
            <div class="space-y-2">
                <span class="px-3 py-1 bg-brand-accent/20 text-brand-accent text-xs font-bold uppercase tracking-wider rounded-none border border-brand-accent/30">
                    Penghargaan & Pengakuan Nasional
                </span>
                <h2 class="text-3xl md:text-4xl font-heading text-white">Prestasi Desa Wisata</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                <div class="p-6 bg-white/5 backdrop-blur-md rounded-none border border-white/10 space-y-2 text-left">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-trophy text-3xl text-brand-accent"></i>
                        <div>
                            <h3 class="text-lg font-bold text-white">500 Besar ADWI 2023</h3>
                            <p class="text-xs text-slate-300">Anugerah Desa Wisata Indonesia Kemenparekraf RI</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white/5 backdrop-blur-md rounded-none border border-white/10 space-y-2 text-left">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-award text-3xl text-brand-accent"></i>
                        <div>
                            <h3 class="text-lg font-bold text-white">15 Besar LDWN 2025</h3>
                            <p class="text-xs text-slate-300">Lomba Desa Wisata Nusantara (Kategori Desa Maju/Mandiri)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 11: LAYANAN KONTAK & LOKASI KANTOR DESA
         ========================================================================= -->
    <section id="kontak" class="scroll-mt-24 py-16 md:py-24 bg-slate-50 border-t border-slate-200 px-6">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">

                <h2 class="text-3xl md:text-5xl font-heading text-brand-dark tracking-wide leading-tight">
                    Kontak & Peta Kantor Desa
                </h2>
                <p class="text-slate-600 font-sans text-sm md:text-base leading-relaxed">
                    Hubungi kami untuk informasi wisata, reservasi paket, event budaya, atau kunjungi langsung Kantor Balai Desa Punjulharjo.
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 md:gap-12 items-start">
                <!-- Info Kontak & Peta (Left) -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="space-y-3 font-sans text-sm text-slate-700">
                        <div class="flex items-start gap-3 p-4 bg-white rounded-xl shadow-sm border border-slate-200">
                            <i class="fa-solid fa-location-dot text-brand-accent text-xl mt-0.5 shrink-0"></i>
                            <div>
                                <strong class="block text-brand-dark font-semibold mb-0.5">Alamat Kantor Desa:</strong>
                                <span class="text-slate-600">Desa Punjulharjo, Kec. Rembang, Kab. Rembang, Jawa Tengah 59219</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="flex items-start gap-3 p-4 bg-white rounded-xl shadow-sm border border-slate-200">
                                <i class="fa-solid fa-phone text-brand-accent text-lg mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="block text-brand-dark font-semibold mb-0.5 text-xs">Telepon / WhatsApp:</strong>
                                    <span class="text-slate-600 font-mono text-xs">089673988491</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-4 bg-white rounded-xl shadow-sm border border-slate-200">
                                <i class="fa-solid fa-envelope text-brand-accent text-lg mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="block text-brand-dark font-semibold mb-0.5 text-xs">Email Resmi:</strong>
                                    <span class="text-slate-600 text-xs">punjulharjo.berkah@gmail.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 bg-white rounded-xl shadow-sm border border-slate-200">
                            <i class="fa-solid fa-clock text-brand-accent text-xl mt-0.5 shrink-0"></i>
                            <div>
                                <strong class="block text-brand-dark font-semibold mb-0.5">Jam Operasional Kantor:</strong>
                                <span class="text-slate-600">08.00 - 17.00 WIB (Setiap Hari)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps iFrame -->
                    <div class="space-y-3">
                        <div class="w-full aspect-video rounded-xl overflow-hidden border border-slate-200 shadow-sm bg-white p-1">
                            <iframe src="https://maps.google.com/maps?q=-6.69102,%20111.41467&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none w-full h-full rounded-lg"></iframe>
                        </div>
                        <div class="flex justify-between items-center pt-1">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Sosial Media:</span>
                                <a href="https://www.instagram.com/desawisatapunjulharjo/" target="_blank" 
                                   class="w-8 h-8 rounded-full bg-white text-slate-700 flex items-center justify-center hover:bg-[#e1306c] hover:text-white transition duration-300 shadow-sm border border-slate-200" title="Instagram">
                                    <i class="fa-brands fa-instagram text-xs"></i>
                                </a>
                                <a href="https://www.youtube.com/@desawisatapunjulharjo9639" target="_blank" 
                                   class="w-8 h-8 rounded-full bg-white text-slate-700 flex items-center justify-center hover:bg-[#ff0000] hover:text-white transition duration-300 shadow-sm border border-slate-200" title="YouTube">
                                    <i class="fa-brands fa-youtube text-xs"></i>
                                </a>
                                <a href="https://www.tiktok.com/@desawisata.punjul" target="_blank" 
                                   class="w-8 h-8 rounded-full bg-white text-slate-700 flex items-center justify-center hover:bg-black hover:text-white transition duration-300 shadow-sm border border-slate-200" title="TikTok">
                                    <i class="fa-brands fa-tiktok text-xs"></i>
                                </a>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query=-6.69102,111.41467" 
                               target="_blank" 
                               class="inline-flex items-center justify-center bg-brand-dark hover:bg-brand-accent hover:text-brand-dark text-white font-bold px-4 py-2 rounded-lg text-xs shadow transition duration-300">
                                <i class="fa-solid fa-map-location-dot mr-1.5"></i> Buka Rute
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form Kirim Pesan (Right) -->
                <div class="lg:col-span-6 bg-white rounded-2xl shadow-md p-6 md:p-8 border border-slate-200">
                    <h3 class="text-2xl font-heading text-brand-dark mb-2">Kirim Pesan</h3>
                    <p class="text-xs text-slate-500 mb-6 font-sans">Sampaikan pertanyaan, masukan, atau permintaan informasi langsung kepada pengelola desa.</p>

                    @if(session('success'))
                        <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl mb-4 text-xs font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-4 font-sans text-sm">
                        @csrf

                        <div>
                            <label class="block text-slate-700 font-semibold mb-1.5" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-brand-accent focus:border-brand-accent outline-none transition"
                                placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-semibold mb-1.5" for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-brand-accent focus:border-brand-accent outline-none transition"
                                placeholder="nama@email.com" required>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-semibold mb-1.5" for="message">Pesan Anda</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full border border-slate-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-brand-accent focus:border-brand-accent outline-none transition"
                                placeholder="Tuliskan pertanyaan atau saran Anda secara rinci..." required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-brand-dark hover:bg-brand-accent hover:text-brand-dark text-white font-semibold py-3 rounded-xl transition duration-300 shadow-md flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 12: DAFTAR SUMBER INFORMASI
         ========================================================================= -->
    <section class="py-12 bg-white px-6 text-xs text-slate-500 border-t border-slate-200">
        <div class="max-w-6xl mx-auto space-y-3">
            <h4 class="font-bold text-slate-700 text-sm font-heading">Daftar Sumber Informasi:</h4>
            <ol class="list-decimal list-inside space-y-1 font-sans leading-relaxed">
                <li>Website Resmi Desa Punjulharjo (Visi & Misi, Perangkat Desa, Kontak).</li>
                <li>Visit Jawa Tengah — "Nelisik Sejarah Perahu Kuno Punjulharjo Rembang".</li>
                <li>Wikipedia — "Perahu Kuno Rembang" & "Pantai Karang Jahe".</li>
                <li>Dinas Kebudayaan & Pariwisata Kab. Rembang — Situs Perahu Kuno & Pantai Karangjahe; Berita LDWN 2025.</li>
                <li>Jadesta Kemenparekraf — Profil "Desa Wisata Punjulharjo" & Produk Wisata.</li>
                <li>Riset Lapangan & Publikasi Berita Arkeologi (idsejarah.net, Traveloka, detikJateng).</li>
            </ol>
        </div>
    </section>

    @push('styles')
    <style>
    .perangkat-3d-fullbleed {
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        width: 100vw;
    }
    .perangkat-3d-stage {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    .perangkat-3d-ring {
        position: relative;
        width: 170px;
        height: 220px;
        transform-style: preserve-3d;
        animation: perangkat3dSpin var(--duration, 40s) linear infinite;
    }
    .perangkat-3d-ring:hover,
    .perangkat-3d-ring:focus-within {
        animation-play-state: paused;
    }
    @keyframes perangkat3dSpin {
        from { transform: rotateY(0deg); }
        to { transform: rotateY(360deg); }
    }
    .perangkat-3d-card {
        position: absolute;
        inset: 0;
        border-radius: 0.75rem;
        overflow: hidden;
        border: 2px solid rgba(255,255,255,0.8);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        cursor: pointer;
        transform:
            rotateY(calc(360deg / var(--total) * var(--i)))
            translateZ(var(--radius));
        transition: filter 0.3s ease;
    }
    .perangkat-3d-card__face {
        width: 100%;
        height: 100%;
        background: #e2e8f0;
    }
    .perangkat-3d-card__face img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .perangkat-3d-card__fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #1e293b;
        background: rgba(30,41,59,0.08);
    }
    .perangkat-3d-card__name-badge {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 0.4rem 0.35rem;
        background: rgba(15,23,42,0.82);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        text-align: center;
        line-height: 1.15;
        z-index: 2;
    }
    .perangkat-3d-card__overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        text-align: center;
        padding: 0.5rem;
        padding-bottom: 2.2rem;
        background: rgba(15,23,42,0.55);
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 3;
    }
    .perangkat-3d-card:hover .perangkat-3d-card__overlay,
    .perangkat-3d-card:focus .perangkat-3d-card__overlay,
    .perangkat-3d-card.is-active .perangkat-3d-card__overlay {
        opacity: 1;
    }
    .perangkat-3d-card__jabatan {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #93c5fd;
        font-weight: 700;
    }
    @media (max-width: 768px) {
        .perangkat-3d-ring { transform: scale(0.65); }
        .perangkat-3d-ring:hover, .perangkat-3d-ring:focus-within { transform: scale(0.65); animation-play-state: paused; }
    }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sections = [
                document.getElementById('hero'),
                document.getElementById('sekilas-desa'), // Fallback trigger close to hero
                document.getElementById('visi-misi'),
                document.getElementById('pemerintahan'),
                document.getElementById('potensi'),
                document.getElementById('ekonomi-budaya'),
                document.getElementById('kontak')
            ].filter(Boolean);

            const options = {
                root: null,
                rootMargin: '-30% 0px -40% 0px', // check elements intersecting middle of screen
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        let id = entry.target.getAttribute('id');
                        if (id === 'sekilas-desa') id = 'hero'; // redirect sekilas-desa to hero link
                        
                        // Find all links ending with the current section hash
                        document.querySelectorAll(`a.profile-sub-link[href$="#${id}"]`).forEach(link => {
                            link.classList.add('text-emerald-700', 'bg-emerald-50/70');
                            if (link.closest('.border-l-2')) {
                                link.classList.add('text-sky-600', 'font-bold');
                            }
                        });

                        // Remove styling from all other sections
                        sections.forEach(sec => {
                            let secId = sec.getAttribute('id');
                            if (secId === 'sekilas-desa') secId = 'hero';
                            if (secId !== id) {
                                document.querySelectorAll(`a.profile-sub-link[href$="#${secId}"]`).forEach(link => {
                                    link.classList.remove('text-emerald-700', 'bg-emerald-50/70');
                                    if (link.closest('.border-l-2')) {
                                        link.classList.remove('text-sky-600', 'font-bold');
                                    }
                                });
                            }
                        });
                    }
                });
            }, options);

            sections.forEach(section => observer.observe(section));

            // 3D Carousel Card Click/Tap Handler
            document.querySelectorAll('.perangkat-3d-card').forEach(function (card) {
                card.addEventListener('click', function (e) {
                    const alreadyActive = card.classList.contains('is-active');
                    document.querySelectorAll('.perangkat-3d-card.is-active').forEach(function (c) {
                        c.classList.remove('is-active');
                    });
                    if (!alreadyActive) {
                        card.classList.add('is-active');
                    }
                });
            });
        });
    </script>
    @endpush

@endsection