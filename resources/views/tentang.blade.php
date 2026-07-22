@extends('layouts.app')

@section('content')

    <x-fixed-image-section
        :image="asset('images/beach-bg.png')"
        eyebrow="Tentang Kami" eyebrowIcon="fa-solid fa-compass"
        title="Tentang Desa Wisata Punjulharjo"
        subtitle="Mengenal lebih dekat Desa Punjulharjo — harmoni sejarah maritim, keindahan pesisir, dan kearifan budaya di pesisir utara Rembang."
        waveColor="text-white"
        hasWave="true">
        <a href="#sekilas-desa" class="inline-flex items-center gap-2 rounded-lg bg-brand-accent px-6 py-3 font-semibold text-brand-dark hover:bg-white transition duration-300">
            <i class="fa-solid fa-arrow-down text-xs"></i> Jelajahi Profil Desa
        </a>
    </x-fixed-image-section>


    <!-- =========================================================================
         SECTION 2: SEKILAS DESA (PROFIL UMUM)
         ========================================================================= -->
    <section id="sekilas-desa" class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-8">
            <div class="text-center space-y-3 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-brand-dark/10 text-brand-dark text-xs font-bold uppercase tracking-wider border border-brand-dark/20">
                    <i class="fa-solid fa-compass"></i> Profil Umum
                </div>
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
                    <div class="p-8 bg-gradient-to-br from-brand-dark via-slate-900 to-brand-dark text-white rounded-none border border-brand-dark shadow-xl space-y-4 relative overflow-hidden">
                        <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-brand-accent/10 rounded-full blur-2xl"></div>
                        <div class="w-12 h-12 bg-brand-accent text-brand-dark rounded-none flex items-center justify-center text-xl font-bold shadow-md">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <h3 class="text-xs font-bold uppercase tracking-widest text-brand-accent">Motto Desa</h3>
                        <blockquote class="text-xl md:text-2xl font-heading text-white leading-snug">
                            "Punjulharjo BERKAH"
                        </blockquote>
                        <p class="text-xs md:text-sm text-slate-300 font-medium leading-relaxed italic border-t border-white/10 pt-3">
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
    <section class="py-16 bg-slate-50 border-y border-slate-200 px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-2 max-w-2xl mx-auto">
                <span class="text-brand-dark font-semibold uppercase text-xs tracking-wider">Data Wilayah</span>
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
    <section class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="text-brand-dark font-semibold uppercase text-xs tracking-wider">Arah Pembangunan</span>
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
         SECTION 5: SEJARAH & CAGAR BUDAYA: SITUS PERAHU KUNO
         ========================================================================= -->
    <section class="py-16 md:py-24 bg-slate-900 text-white px-6 relative overflow-hidden border-y border-slate-800">
        <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=1920&q=80');"></div>

        <div class="max-w-6xl mx-auto relative z-10 space-y-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-slate-800 pb-8">
                <div class="space-y-3 max-w-2xl">
                    <span class="px-3 py-1 bg-brand-accent/20 text-brand-accent text-xs font-bold uppercase tracking-wider rounded-none border border-brand-accent/30 inline-flex items-center gap-2">
                        <i class="fa-solid fa-landmark"></i> Cagar Budaya Nasional
                    </span>
                    <h2 class="text-3xl md:text-5xl font-heading text-white tracking-wide">
                        Situs Perahu Kuno Punjulharjo
                    </h2>
                    <p class="text-slate-300 text-sm md:text-base">
                        Temuan mahakarya arkeologi maritim terlengkap se-Asia Tenggara yang membuktikan kejayaan pelayaran Nusantara.
                    </p>
                </div>
                <div class="px-4 py-2 bg-brand-accent/10 border border-brand-accent/30 text-brand-accent font-bold text-xs md:text-sm rounded-none shrink-0">
                    <i class="fa-solid fa-clock-history"></i> Abad ke-7 – 8 Masehi (Lebih Tua dari Borobudur)
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-center">
                <!-- Info Left -->
                <div class="lg:col-span-7 space-y-6 text-slate-300 text-sm md:text-base leading-relaxed text-justify font-sans">
                    <p>
                        Pada <strong>Sabtu, 26 Juli 2008</strong> (±pukul 07.30 WIB), warga Desa Punjulharjo secara tidak sengaja menemukan struktur kayu kuno saat menggali tanah untuk pembuatan tambak garam pada kedalaman ±2 meter di sekitar 500 meter dari garis Pantai Karang Jahe.
                    </p>
                    <p>
                        Penelitian mendalam oleh Balai Arkeologi Yogyakarta dan penanggalan radiokarbon atas sampel tali ijuk di <em>Beta Analytic Radiocarbon Laboratory, Miami, Florida, AS</em> memastikan bahwa perahu kayu sepanjang ±15 meter ini berasal dari <strong>abad ke-7 hingga ke-8 Masehi</strong> — menjadikannya lebih tua dibandingkan Candi Borobudur (abad ke-9 M).
                    </p>
                    <p>
                        Perahu ini dibuat dengan teknologi khas Asia Tenggara kuno yaitu <strong>“papan ikat”</strong> (<em>sewn plank and lashed lug</em>), di mana papan-papan kayu disambung menggunakan ikatan tali ijuk dan pasak kayu tanpa paku besi sama sekali. Kini situs ini dilestarikan sebagai kawasan <strong>Edu Park Situs Perahu Kuno</strong>.
                    </p>
                </div>

                <!-- Facts Card Right -->
                <div class="lg:col-span-5 bg-brand-dark/90 p-6 md:p-8 rounded-none border border-slate-700 shadow-2xl space-y-4">
                    <h3 class="text-lg font-bold text-brand-accent font-heading border-b border-slate-700 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-circle-info"></i> Ringkasan Fakta Arkeologi
                    </h3>
                    <ul class="space-y-3 text-xs md:text-sm text-slate-300 font-sans">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-calendar-check text-brand-accent mt-1"></i>
                            <span><strong>Ditemukan:</strong> 26 Juli 2008 oleh petani garam lokal</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-ruler-combined text-brand-accent mt-1"></i>
                            <span><strong>Ukuran:</strong> Panjang ±15 meter pada kedalaman 2 meter</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-hammer text-brand-accent mt-1"></i>
                            <span><strong>Teknologi:</strong> Papan ikat ijuk (<em>sewn plank & lashed lug</em>)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-flask text-brand-accent mt-1"></i>
                            <span><strong>Uji Laboratorium:</strong> Beta Analytic Radiocarbon Lab, Miami (AS)</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-award text-brand-accent mt-1"></i>
                            <span><strong>Status:</strong> Temuan perahu kayu kuno terlengkap se-Asia Tenggara</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 6: POTENSI WISATA UNGGULAN
         ========================================================================= -->
    <section class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="text-brand-dark font-semibold uppercase text-xs tracking-wider">Destinasi Favorit</span>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark">Potensi Wisata Unggulan</h2>
                <p class="text-slate-600 text-sm">Destinasi wisata kebanggaan Punjulharjo yang selalu ramai dikunjungi wisatawan.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1: Pantai Karang Jahe -->
                <div class="bg-white rounded-none border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition border-t-4 border-t-sky-600">
                    <div>
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80" 
                                 alt="Pantai Karang Jahe Punjulharjo" 
                                 class="w-full h-full object-cover" loading="lazy">
                            <span class="absolute top-3 left-3 bg-sky-700 text-white text-[10px] font-bold uppercase px-3 py-1 rounded-none shadow">
                                Wisata Bahari
                            </span>
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
                        <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="text-brand-dark font-bold hover:text-brand-accent transition">Detail &rarr;</a>
                    </div>
                </div>

                <!-- Card 2: Edu Park Situs Perahu Kuno -->
                <div class="bg-white rounded-none border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition border-t-4 border-t-brand-dark">
                    <div>
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80" 
                                 alt="Edu Park Situs Perahu Kuno" 
                                 class="w-full h-full object-cover" loading="lazy">
                            <span class="absolute top-3 left-3 bg-brand-dark text-brand-accent text-[10px] font-bold uppercase px-3 py-1 rounded-none shadow">
                                Wisata Sejarah
                            </span>
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
                        <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="text-brand-dark font-bold hover:text-brand-accent transition">Detail &rarr;</a>
                    </div>
                </div>

                <!-- Card 3: My Cemara Adopsi Pohon -->
                <div class="bg-white rounded-none border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition border-t-4 border-t-emerald-600">
                    <div>
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=800&q=80" 
                                 alt="Program My Cemara Punjulharjo" 
                                 class="w-full h-full object-cover" loading="lazy">
                            <span class="absolute top-3 left-3 bg-emerald-700 text-white text-[10px] font-bold uppercase px-3 py-1 rounded-none shadow">
                                Konservasi Pesisir
                            </span>
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
                        <a href="{{ route('adopsi.index') }}" class="text-emerald-700 font-bold hover:underline">Ikut Adopsi &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 7: EKONOMI & WISATA EDUKASI
         ========================================================================= -->
    <section class="py-16 bg-slate-50 border-y border-slate-200 px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-2 max-w-2xl mx-auto">
                <span class="text-brand-dark font-semibold uppercase text-xs tracking-wider">Kearifan Lokal</span>
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
    <section class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="text-brand-dark font-semibold uppercase text-xs tracking-wider">Warisan Tradisi</span>
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
    <section class="py-16 bg-gradient-to-r from-brand-dark via-slate-900 to-brand-dark text-white px-6 shadow-xl border-y border-brand-dark">
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
         SECTION 10: PEMERINTAHAN DESA (PERANGKAT)
         ========================================================================= -->
    <section class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-6xl mx-auto space-y-10">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="text-brand-dark font-semibold uppercase text-xs tracking-wider">Struktur Organisasi</span>
                <h2 class="text-3xl md:text-4xl font-heading text-brand-dark">Pemerintahan Desa</h2>
                <p class="text-slate-600 text-sm">Jajaran Perangkat Desa yang melayani masyarakat Desa Punjulharjo.</p>
            </div>

            @php
                $perangkat = [
                    ['jabatan' => 'Kepala Desa', 'nama' => 'Moh. Akrom'],
                    ['jabatan' => 'Sekretaris Desa', 'nama' => 'Ubaidillah'],
                    ['jabatan' => 'Kasi Pemerintahan', 'nama' => 'Akhsan'],
                    ['jabatan' => 'Kasi Kesejahteraan', 'nama' => 'Mulyo Santoso, SE'],
                    ['jabatan' => 'Kasi Pelayanan', 'nama' => 'Sholihul Ma’arif, S.Pd'],
                    ['jabatan' => 'Kaur Umum & Perencanaan', 'nama' => 'M. Ali Mustofa'],
                    ['jabatan' => 'Kaur Keuangan', 'nama' => 'Dwi Lestari Indrayani'],
                    ['jabatan' => 'Kepala Dusun', 'nama' => 'Moh Nasrul Jamil'],
                    ['jabatan' => 'Kepala Dusun', 'nama' => 'M. Zaenal Roziqin'],
                    ['jabatan' => 'Kepala Dusun', 'nama' => 'Putri Dini Andani, S.Bns'],
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($perangkat as $p)
                    <div class="p-4 bg-slate-50 rounded-none border border-slate-200 text-center space-y-1 hover:border-brand-dark transition">
                        <div class="w-10 h-10 bg-brand-dark/10 text-brand-dark rounded-none flex items-center justify-center mx-auto text-sm font-bold">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block pt-1">{{ $p['jabatan'] }}</span>
                        <h4 class="text-xs md:text-sm font-bold text-slate-800">{{ $p['nama'] }}</h4>
                    </div>
                @endforeach
            </div>
            
            <p class="text-[10px] text-center text-slate-400 italic font-sans">
                * Data resmi Perangkat Desa Punjulharjo (dapat diperbarui berkala).
            </p>
        </div>
    </section>


    <!-- =========================================================================
         SECTION 11: LAYANAN KONTAK & LOKASI KANTOR DESA
         ========================================================================= -->
    <section id="kontak" class="py-16 md:py-24 bg-slate-50 border-t border-slate-200 px-6">
        <div class="max-w-6xl mx-auto space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-accent/15 text-brand-dark text-xs font-semibold uppercase tracking-wider border border-brand-accent/30">
                    <i class="fa-solid fa-map-location-dot text-brand-accent"></i> Layanan Kontak & Lokasi
                </div>
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

@endsection