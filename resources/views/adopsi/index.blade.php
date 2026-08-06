@extends('layouts.app')

@section('content')
<!-- Hanging Ribbon for My Cemara Logo -->
<div class="adopsi-hanging-ribbon-container">
    <a href="{{ url('/adopsi') }}" class="adopsi-hanging-ribbon" aria-label="My Cemara Pantai Karangjahe">
        <img src="{{ asset('images/logo-my-cemara.png.png') }}"
             alt="Logo My Cemara Pantai Karangjahe"
             class="adopsi-hanging-ribbon__logo">
    </a>
</div>

@php
    $customAdopsiAbout = \App\Models\SiteSetting::getValue('adopsi_about_image');
    $adopsiAboutImgUrl = $customAdopsiAbout 
        ? (str_starts_with($customAdopsiAbout, 'http') || str_contains($customAdopsiAbout, 'storage/') ? asset($customAdopsiAbout) : Storage::url($customAdopsiAbout)) 
        : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80';
@endphp
<!-- Section 1: Hero Section -->
<x-fixed-image-section variant="green"
    key="hero_adopsi"
    :image="'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1920&q=80'"
    eyebrow="PROGRAM KONSERVASI PESISIR DESA PUNJULHARJO" eyebrowIcon="fa-solid fa-leaf"
    title="MY CEMARA" titleAccent="PANTAI KARANGJAHE"
    waveColor="text-white"
    hasWave="true"
    height="min-h-[112vh]"
    maxWidth="max-w-7xl">
    
    <div class="w-full flex flex-col items-center">
        <!-- Capaian Konservasi Pesisir (Statistik Dinamis) -->
        <div class="w-full mt-8 md:mt-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 text-left">
                <!-- Card 1: Total Dana Terkumpul -->
                <div class="group relative bg-white/10 backdrop-blur-sm p-5 sm:p-8 rounded-2xl border border-white/20 hover:border-white/40 transition-all duration-500 shadow-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.25)] hover:-translate-y-1">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-2xl group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-500 shrink-0">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <div class="text-3xl lg:text-4xl font-extrabold text-white font-title tracking-tight">
                                Rp {{ number_format($stats['total_dana']) }}
                            </div>
                            <div class="text-xs font-sans text-white/80 mt-1 uppercase tracking-wider font-semibold">
                                Total Dana Terkumpul
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-emerald-800/40 flex items-center justify-between text-[11px] text-white/70">
                        <span class="flex items-center gap-1"><i class="fa-solid fa-shield-halved"></i> Transparan & Akuntabel</span>
                        <span class="font-bold text-white">100% Salur</span>
                    </div>
                </div>

                <!-- Card 2: Jumlah Pohon Tertanam -->
                <div class="group relative bg-white/10 backdrop-blur-sm p-5 sm:p-8 rounded-2xl border border-white/20 hover:border-white/40 transition-all duration-500 shadow-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.25)] hover:-translate-y-1">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-2xl group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-500 shrink-0">
                            <i class="fa-solid fa-tree"></i>
                        </div>
                        <div>
                            <div class="text-3xl lg:text-4xl font-extrabold text-white font-title tracking-tight">
                                {{ number_format($stats['pohon_tertanam']) }} <span class="text-lg font-normal text-white/90">Bibit</span>
                            </div>
                            <div class="text-xs font-sans text-white/80 mt-1 uppercase tracking-wider font-semibold">
                                Jumlah Pohon Tertanam
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-emerald-800/40 flex items-center justify-between text-[11px] text-white/70">
                        <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> Karangjahe Coast</span>
                        <span class="font-bold text-white">Cemara Laut</span>
                    </div>
                </div>

                <!-- Card 3: Member Adopsi -->
                <div class="group relative bg-white/10 backdrop-blur-sm p-5 sm:p-8 rounded-2xl border border-white/20 hover:border-white/40 transition-all duration-500 shadow-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.25)] hover:-translate-y-1">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-2xl group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-500 shrink-0">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <div class="text-3xl lg:text-4xl font-extrabold text-white font-title tracking-tight">
                                {{ number_format($stats['total_adopter']) }} <span class="text-lg font-normal text-white/90">Orang</span>
                            </div>
                            <div class="text-xs font-sans text-white/80 mt-1 uppercase tracking-wider font-semibold">
                                Member Adopsi Partisipatif
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-emerald-800/40 flex items-center justify-between text-[11px] text-white/70">
                        <span class="flex items-center gap-1"><i class="fa-solid fa-heart"></i> Komunitas Hijau</span>
                        <span class="font-bold text-white">Pahlawan Pesisir</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-fixed-image-section>

<!-- Section 2: Gambaran Umum Program -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 font-title leading-tight">
                    Membangun Benteng Hijau Alami Pesisir Rembang
                </h2>
                <p class="text-slate-600 leading-relaxed font-sans">
                    <strong>My Cemara</strong> merupakan program penanaman dan pemeliharaan cemara laut, yang dikelola oleh ProKlim Desa Punjulharjo. Program ini mengajak warga desa, masyarakat umum, instansi, maupun komunitas untuk berpartisipasi dalam upaya pelestarian lingkungan pesisir dengan mengadopsi bibit cemara laut yang akan ditanam, dirawat, dan dipantau pertumbuhannya secara berkelanjutan. 
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                        <i class="fa-solid fa-water-rise text-emerald-600 text-2xl mb-2"></i>
                        <h4 class="font-bold text-slate-800 text-sm">Penahan Gelombang & Abrasi</h4>
                        <p class="text-slate-500 text-xs mt-1">Akar cemara laut mengikat pasir pantai dan menahan gempuran ombak laut Jawa.</p>
                    </div>
                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                        <i class="fa-solid fa-wind text-emerald-600 text-2xl mb-2"></i>
                        <h4 class="font-bold text-slate-800 text-sm">Peneduh Pesisir Tropis</h4>
                        <p class="text-slate-500 text-xs mt-1">Menciptakan rimbunan cemara yang sejuk bagi ekosistem dan wisatawan.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 relative group">
                @if(Auth::check() && Auth::user()->isAdmin())
                    <!-- Floating Edit Button on Hover -->
                    <div class="absolute top-4 right-4 z-[50] opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-auto">
                        <button type="button" onclick="document.getElementById('edit-custom-image-modal-adopsi_about_image').classList.remove('hidden')" 
                                class="bg-white/95 hover:bg-white text-slate-800 p-2.5 rounded-md shadow-md border border-slate-200/50 flex items-center justify-center" title="Edit Foto Gambaran Umum">
                            <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                        </button>
                    </div>
                @endif
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ $adopsiAboutImgUrl }}" 
                         alt="Pantai Karangjahe" 
                         class="w-full h-[400px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent flex items-end p-8">
                        <div class="text-white">
                            <span class="text-xs text-emerald-400 uppercase tracking-widest font-semibold block">Hutan Cemara Pesisir</span>
                            <h3 class="text-xl font-bold font-title">Pantai Karangjahe, Desa Punjulharjo</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section: Peta Sebaran Pohon Cemara -->
<div id="sebaran-peta" class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Sebaran Lokasi</span>
            <h2 class="text-3xl font-bold text-slate-800 font-title">Peta Sebaran Pohon Cemara</h2>
            <p class="text-slate-600 text-sm">
                Lihat lokasi penanaman pohon cemara laut secara langsung di sepanjang pesisir Pantai Karangjahe.
            </p>
        </div>

        <div class="relative bg-white p-4 rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div id="sebaran-map" class="w-full rounded-2xl" style="height: 450px;"></div>
            @if($pohonMap->isEmpty())
                <div class="absolute inset-0 bg-white/95 flex flex-col items-center justify-center text-center p-6 z-[1000]">
                    <i class="fa-solid fa-map-location-dot text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-600 font-semibold">Belum ada titik pohon yang tercatat</p>
                    <p class="text-xs text-slate-400 mt-1">Tim desa akan segera memperbarui titik lokasi setelah proses penanaman.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Section 3: Latar Belakang -->
<div id="latar-belakang" class="py-20 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
            <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Latar Belakang & Urgensi</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 font-title">Mengapa Harus Cemara Laut?</h2>
            <p class="text-slate-600 font-sans">
                Pesisir utara Jawa menghadapi ancaman perubahan iklim dan kenaikan permukaan air laut. Cemara Laut (<em>Casuarina equisetifolia</em>) adalah tanaman pesisir paling tangguh yang terbukti mampu beradaptasi dengan kadar garam tinggi dan angin kencang.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            <div class="bg-white p-5 sm:p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-base sm:text-lg font-title">Menyerap & Menyimpan Karbon</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Tajuk cemara yang lebat mampu mengikat karbon secara efektif dalam biomassanya, sekaligus membantu memperbaiki mikroiklim di kawasan pesisir.
                </p>
            </div>
            <div class="bg-white p-5 sm:p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-wind"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-base sm:text-lg font-title">Pemecah Angin Alami</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Tegakan cemara laut yang rapat berfungsi sebagai pemecah angin alami, membantu meredam kecepatan angin kencang yang menerpa kawasan pantai.
                </p>
            </div>
            <div class="bg-white p-5 sm:p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-shield-virus"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-base sm:text-lg font-title">Daya Tahan Tinggi</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Cemara laut tergolong spesies tangguh yang mampu tumbuh subur di tanah berpasir dengan kadar garam tinggi, sehingga banyak digunakan dalam program rehabilitasi kawasan pesisir.
                </p>
            </div>
            <div class="bg-white p-5 sm:p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-dove"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-base sm:text-lg font-title">Mendukung Ekosistem Pesisir</h3>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Vegetasi cemara laut turut menyediakan struktur habitat alami bagi berbagai organisme di sekitarnya, mulai dari burung hingga biota kecil pantai.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Fixed Image Reveal Feature Section: Hutan Cemara Laut (Gambar Pohon) -->
<x-fixed-image-section
    key="hero_adopsi_bottom"
    image="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1920&q=80"
    eyebrow="Konservasi Hutan Cemara Laut"
    title="Satu Pohon, Ribuan Manfaat Bagi Pesisir"
    subtitle="Setiap bibit cemara laut yang ditanam hari ini menjadi benteng hijau pelindung abrasi dan warisan alam untuk generasi mendatang."
    height="h-[65vh]"
    align="center">
    <a href="{{ route('member.adopsi.dashboard') }}" 
       class="inline-flex items-center gap-2 px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg transition duration-300 text-sm">
        <i class="fa-solid fa-tree"></i> Adopsi Pohon Sekarang &rarr;
    </a>
</x-fixed-image-section>

<!-- Section 4: Tata Cara & Alur (8 Langkah Ringkas) -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Panduan Partisipasi</span>
            <h2 class="text-3xl font-bold text-slate-800 font-title mt-1">Alur Adopsi Pohon Cemara</h2>
            <p class="text-slate-600 mt-2">Delapan langkah mudah berkontribusi dari mana saja.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">1</div>
                <h4 class="font-bold text-slate-800 text-base">Gambaran Paket</h4>
                <p class="text-slate-500 text-xs">Lihat gambaran paket adopsi lalu masuk ke dashboard member Anda.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">2</div>
                <h4 class="font-bold text-slate-800 text-base">Daftar / Login Member</h4>
                <p class="text-slate-500 text-xs">Buat akun member gratis tanpa kode keamanan khusus.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">3</div>
                <h4 class="font-bold text-slate-800 text-base">Transfer Pembayaran</h4>
                <p class="text-slate-500 text-xs">Transfer ke rekening Bank BRI / QRIS resmi BUMDes Punjulharjo.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">4</div>
                <h4 class="font-bold text-slate-800 text-base">Upload Bukti Bayar</h4>
                <p class="text-slate-500 text-xs">Unggah foto struk/bukti transfer dari dashboard member.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">5</div>
                <h4 class="font-bold text-slate-800 text-base">Verifikasi Tim Desa</h4>
                <p class="text-slate-500 text-xs">Tim ProKlim Desa Punjulharjo melakukan verifikasi dan menerbitkan kode pohon unik.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">6</div>
                <h4 class="font-bold text-slate-800 text-base">Penanaman Bibit</h4>
                <p class="text-slate-500 text-xs">Tim ProKlim Desa Punjulharjo menanam bibit cemara di area konservasi Karangjahe.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">7</div>
                <h4 class="font-bold text-slate-800 text-base">Sertifikat Digital</h4>
                <p class="text-slate-500 text-xs">Unduh sertifikat adopsi resmi.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">8</div>
                <h4 class="font-bold text-slate-800 text-base">Monitoring Pertumbuhan</h4>
                <p class="text-slate-500 text-xs">Pantau foto & catatan tinggi pohon secara berkala dari dashboard.</p>
            </div>
        </div>
    </div>
</div>

<!-- Section 5: Galeri Foto Konservasi -->
<div class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Dokumentasi</span>
            <h2 class="text-3xl font-bold text-slate-800 font-title mt-1">Galeri Penghijauan Pesisir</h2>
            <p class="text-slate-600 mt-2">Aktivitas penanaman & keindahan cemara laut di Pantai Karangjahe.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="rounded-2xl overflow-hidden shadow-sm h-48 border border-slate-200">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri 1">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-sm h-48 border border-slate-200">
                <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri 2">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-sm h-48 border border-slate-200">
                <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri 3">
            </div>
            <div class="rounded-2xl overflow-hidden shadow-sm h-48 border border-slate-200">
                <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-105 transition duration-500" alt="Galeri 4">
            </div>
        </div>
    </div>
</div>

<!-- Section 7: Gambaran Ringkas Paket Adopsi -->
<div id="paket-adopsi" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Ringkasan Paket Adopsi</span>
            <h2 class="text-3xl font-bold text-slate-800 font-title mt-1">Gambaran Singkat Paket</h2>
            <p class="text-slate-600 mt-2">Pilih & pesan paket adopsi secara lengkap melalui Dashboard Member Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto py-2">
            @foreach($pakets as $paket)
                @php
                    $targetAction = auth()->check() 
                        ? (auth()->user()->isMember() ? route('member.adopsi.create', $paket) : route('admin.moderasi.index'))
                        : route('login.user');
                    $fiturs = [
                        '<strong>' . $paket->jumlah_bibit . ' Bibit Cemara Laut</strong> (ditanam tim desa)',
                        'Kode Pohon Unik & Sertifikat Digital (Word .docx)',
                    ];
                @endphp
                <x-adopsi-ticket
                    :kode="$paket->kode"
                    :nama="'Paket ' . $paket->kode"
                    :judul="$paket->jumlah_bibit . ' Bibit Cemara'"
                    :harga="$paket->harga"
                    :deskripsi="$paket->deskripsi"
                    :fitur="$fiturs"
                    :action="$targetAction"
                    method="GET"
                    :treeCode="'MYC-' . strtoupper($paket->kode) . '2026'" />
            @endforeach
        </div>
    </div>
</div>

   <!-- =========================================================================
        SECTION TIM PROKLIM
        ========================================================================= -->
   <section id="tim-proklim" class="scroll-mt-24 py-16 md:py-24 bg-white px-6">
       @if(Auth::check() && Auth::user()->isAdmin())
           <div class="max-w-6xl mx-auto flex justify-end mb-6">
               <a href="{{ route('admin.tim-proklim.index') }}"
                  class="inline-flex items-center gap-2 bg-emerald-700 text-white hover:bg-emerald-600 transition-colors font-semibold px-4 py-2 rounded-lg text-sm shadow">
                   <i class="fa-solid fa-pen"></i> Edit Tim ProKlim
               </a>
           </div>
       @endif
       <div class="max-w-6xl mx-auto space-y-10">
           <div class="text-center space-y-3 max-w-2xl mx-auto">
               <h2 class="text-3xl md:text-4xl font-heading text-emerald-800">Tim ProKlim</h2>
               <p class="text-slate-600 text-sm">Program Kampung Iklim (ProKlim) Desa Punjulharjo dijalankan oleh tim berikut.</p>
           </div>

           @php
               $proklim3dTotal = $timProklim->count();
               $proklim3dCardWidth = 170;
               $proklim3dCardHeight = 220;
               $proklim3dRadius = $proklim3dTotal > 0
                   ? round(($proklim3dCardWidth * $proklim3dTotal) / (2 * M_PI * 0.55))
                   : 190;
               $proklim3dRadius = max(190, $proklim3dRadius);
               $proklim3dStageSize = $proklim3dCardHeight + 110;
           @endphp

           @if($timProklim->isEmpty())
               <p class="text-center text-sm text-slate-400 italic">Belum ada data anggota Tim ProKlim.</p>
           @else
               <div class="proklim-3d-fullbleed">
                   <div class="proklim-3d-stage" style="height: {{ $proklim3dStageSize }}px;">
                       <div class="proklim-3d-ring" style="--total: {{ $proklim3dTotal }}; --radius: {{ $proklim3dRadius }}px;">
                           @foreach($timProklim as $index => $anggota)
                               <div class="proklim-3d-card" style="--i: {{ $index }};" tabindex="0">
                                   <div class="proklim-3d-card__face">
                                       @if($anggota->foto)
                                           <img src="{{ (str_starts_with($anggota->foto, 'http') || str_contains($anggota->foto, 'storage/')) ? asset($anggota->foto) : Storage::url($anggota->foto) }}" alt="Foto {{ $anggota->nama }}">
                                       @else
                                           <div class="proklim-3d-card__fallback">
                                               <i class="fa-solid fa-user-tie"></i>
                                           </div>
                                       @endif
                                   </div>
                                   <div class="proklim-3d-card__name-badge">{{ $anggota->nama }}</div>
                                   <div class="proklim-3d-card__overlay">
                                       <span class="proklim-3d-card__peran">{{ $anggota->peran }}</span>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   </div>
               </div>
           @endif
        </div>
    </section>

<!-- Section 8: FAQ Seputar Adopsi Cemara -->
<div id="faq-adopsi" class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">FAQ Terkait</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 font-title mt-1">Adopsi Cemara</h2>
        </div>
        @php
            $faqsAdopsi = [
                [
                    'q' => 'Apakah saya bisa memantau perkembangan cemara yang saya adopsi?',
                    'a' => 'Ya, setelah proses adopsi selesai, informasi mengenai cemara yang Anda dukung dapat diakses melalui akun member. Pemantauan dapat dilihat melalui dokumentasi foto dan pembaruan data pertumbuhan yang tersedia pada dashboard adopter.',
                ],
                [
                    'q' => 'Apakah saya bisa memilih lokasi penanaman cemara?',
                    'a' => 'Penanaman dilakukan di kawasan pesisir Punjulharjo sesuai kondisi dan kebutuhan lokasi. Saat ini sistem belum menyediakan pilihan lokasi secara mandiri; titik penanaman ditentukan oleh pengelola program bersama Tim ProKlim.',
                ],
                [
                    'q' => 'Kapan saya mendapatkan sertifikat adopsi?',
                    'a' => 'Sertifikat adopsi diterbitkan setelah proses adopsi Anda dikonfirmasi, dan dapat diunduh langsung melalui akun adopter.',
                ],
                [
                    'q' => 'Ke mana kontribusi/dana adopsi cemara digunakan?',
                    'a' => 'Kontribusi adopsi digunakan sepenuhnya untuk mendukung kebutuhan penanaman dan pemeliharaan cemara dalam program ini.',
                ],
                [
                    'q' => 'Siapa yang merawat cemara setelah ditanam?',
                    'a' => 'Cemara yang telah ditanam dirawat oleh Tim Pengelola Desa (Pokdarwis Karangjahe) bersama Tim ProKlim, melalui kegiatan pemeliharaan dan pemantauan rutin.',
                ],
                [
                    'q' => 'Bagaimana jika cemara yang saya adopsi tidak tumbuh atau mati?',
                    'a' => 'Kondisi cemara diperbarui secara berkala melalui fitur Monitoring. Jika cemara mengalami kendala atau tidak dapat bertahan hidup, Anda dapat melihat status tersebut dan memilih tindakan lanjutan yang tersedia pada fitur Monitoring sesuai ketentuan program.',
                ],
                [
                    'q' => 'Apakah saya bisa mengunjungi lokasi cemara yang saya adopsi?',
                    'a' => 'Anda dapat mengetahui lokasi penanaman melalui fitur Monitoring. Untuk kunjungan langsung ke lokasi, silakan mengikuti ketentuan dan berkoordinasi terlebih dahulu dengan pengelola program melalui kontak yang tersedia.',
                ],
            ];
        @endphp
        <div x-data="{ activeFaq: null }" class="space-y-3">
            @foreach($faqsAdopsi as $index => $faq)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <button type="button"
                            @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between gap-4 text-left px-5 sm:px-6 py-4 sm:py-5 focus:outline-none">
                        <span class="font-bold text-slate-800 text-sm sm:text-base font-title">{{ $faq['q'] }}</span>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-sm transition-transform duration-200 shrink-0"
                           :class="{ 'rotate-180': activeFaq === {{ $index }} }"></i>
                    </button>
                    <div x-show="activeFaq === {{ $index }}" x-transition.opacity
                         class="px-5 sm:px-6 pb-4 sm:pb-5 text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="max-w-2xl mx-auto mt-8 bg-emerald-50 border border-emerald-200 rounded-xl p-5 text-center space-y-1">
            <p class="text-sm font-semibold text-emerald-800">Butuh bantuan seputar My Cemara / Adopsi Pohon?</p>
            <p class="text-sm text-slate-600">Hubungi kontak khusus ProKlim (a.n. M. Ali Mustofa):</p>
            <p class="text-sm text-emerald-700">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:proklimpunjulharjo@gmail.com" class="underline">proklimpunjulharjo@gmail.com</a>
            </p>
            <p class="text-sm text-emerald-700">
                <i class="fa-solid fa-phone"></i>
                <a href="https://wa.me/6281329427041" class="underline">+62 813-2942-7041</a>
            </p>
        </div>
    </div>
</div>

@if(Auth::check() && Auth::user()->isAdmin())
    <!-- Edit Custom Image Modal for Adopsi About -->
    <div id="edit-custom-image-modal-adopsi_about_image" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all text-slate-800">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Foto Gambaran Umum</h3>
                <button type="button" onclick="document.getElementById('edit-custom-image-modal-adopsi_about_image').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.hero.update-custom') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="hero_key" value="adopsi_about_image">
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Gambar Baru</label>
                        <input type="file" name="hero_image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                        <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 5MB.</p>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('edit-custom-image-modal-adopsi_about_image').classList.add('hidden')" 
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
                $backupAdopsiAbout = \App\Models\SiteSetting::getValue('adopsi_about_image_backup');
            @endphp
            @if($backupAdopsiAbout)
                <div class="p-6 border-t border-slate-100 bg-slate-50">
                    <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                    <div class="flex items-center gap-3">
                        <img src="{{ (str_starts_with($backupAdopsiAbout, 'http') || str_contains($backupAdopsiAbout, 'storage/')) ? asset($backupAdopsiAbout) : Storage::url($backupAdopsiAbout) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                        <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="hero_key" value="adopsi_about_image">
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


@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #sebaran-map {
        z-index: 1;
    }

    .adopsi-hanging-ribbon-container {
        position: absolute;
        top: 0;
        left: 300px; /* digeser ke kanan agar melewati branding "Desa Wisata Punjulharjo" */
        width: 120px;
        height: 150px;
        z-index: 50; /* di atas navbar transparan z-30 dan navbar putih fixed z-40 */
        filter: drop-shadow(0 12px 18px rgba(0, 0, 0, 0.22)); /* shadow 3D mengikuti bentuk runcing clip-path */
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), filter 0.3s ease;
    }
    .adopsi-hanging-ribbon-container:hover {
        transform: translateY(-4px); /* Efek melayang 3D */
        filter: drop-shadow(0 20px 24px rgba(16, 185, 129, 0.22)) drop-shadow(0 8px 10px rgba(0, 0, 0, 0.15));
    }
    .adopsi-hanging-ribbon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(16, 185, 129, 0.35);
        padding: 12px;
        padding-top: 20px;
        padding-bottom: 24px;
        clip-path: polygon(0% 0%, 100% 0%, 100% 80%, 50% 100%, 0% 80%);
        overflow: hidden;
        outline: none;
    }
    .adopsi-hanging-ribbon:focus-visible {
        outline: 2px solid #10b981;
        outline-offset: 4px;
        border-radius: 4px;
    }
    .adopsi-hanging-ribbon__logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    @media (max-width: 768px) {
        .adopsi-hanging-ribbon-container {
            top: 0;
            left: 205px; /* digeser agar tidak menimpa branding versi mobile yang lebih pendek */
            width: 72px;
            height: 94px;
        }
        .adopsi-hanging-ribbon {
            padding: 8px;
            padding-top: 14px;
            padding-bottom: 16px;
        }
    }
    .proklim-3d-fullbleed {
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        width: 100vw;
    }
    .proklim-3d-stage {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 1200px;
        margin: 0 auto;
    }
    .proklim-3d-ring {
        position: relative;
        width: 170px;
        height: 220px;
        transform-style: preserve-3d;
        animation: proklim3dSpin 40s linear infinite;
    }
    .proklim-3d-ring:hover,
    .proklim-3d-ring:focus-within {
        animation-play-state: paused;
    }
    @keyframes proklim3dSpin {
        from { transform: rotateY(0deg); }
        to { transform: rotateY(360deg); }
    }
    .proklim-3d-card {
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
    .proklim-3d-card__face {
        width: 100%;
        height: 100%;
        background: #d1fae5;
    }
    .proklim-3d-card__face img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .proklim-3d-card__fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #065f46;
        background: rgba(6,95,70,0.08);
    }
    .proklim-3d-card__name-badge {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 0.4rem 0.35rem;
        background: rgba(6,78,59,0.85);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        text-align: center;
        line-height: 1.15;
        z-index: 2;
    }
    .proklim-3d-card__overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        text-align: center;
        padding: 0.5rem;
        padding-bottom: 2.2rem;
        background: rgba(6,78,59,0.55);
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 3;
    }
    .proklim-3d-card:hover .proklim-3d-card__overlay,
    .proklim-3d-card:focus .proklim-3d-card__overlay,
    .proklim-3d-card.is-active .proklim-3d-card__overlay {
        opacity: 1;
    }
    .proklim-3d-card__peran {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #a7f3d0;
        font-weight: 700;
    }
    @media (max-width: 768px) {
        .proklim-3d-ring { transform: scale(0.65); }
        .proklim-3d-ring:hover, .proklim-3d-ring:focus-within { transform: scale(0.65); animation-play-state: paused; }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const defaultLat = -6.685363;
        const defaultLng = 111.385750;
        
        const map = L.map('sebaran-map').setView([defaultLat, defaultLng], 14);
        
        const streetLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ'
        });
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });
        satelliteLayer.addTo(map);
        L.control.layers({ 'Peta Jalan': streetLayer, 'Foto Satelit': satelliteLayer }).addTo(map);
        
        const trees = @json($pohonMap);
        
        if (trees.length > 0) {
            const group = L.featureGroup();
            
            trees.forEach(function(tree) {
                const lat = parseFloat(tree.lat);
                const lng = parseFloat(tree.lng);
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    let tglTanam = '-';
                    if (tree.tanggal_tanam) {
                        const parts = tree.tanggal_tanam.split('-');
                        if (parts.length === 3) {
                            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                            const day = parseInt(parts[2], 10);
                            const monthIndex = parseInt(parts[1], 10) - 1;
                            const year = parts[0];
                            tglTanam = day + ' ' + (months[monthIndex] || '') + ' ' + year;
                        }
                    }
                    
                    const rawStatus = tree.status || 'ditanam';
                    const statusFormatted = rawStatus.charAt(0).toUpperCase() + rawStatus.slice(1);
                    
                    const popupContent = `
                        <div class="font-sans text-xs space-y-1.5 p-1">
                            <div class="font-bold text-slate-800 border-b border-slate-100 pb-1 text-sm">${tree.kode_pohon}</div>
                            <div><span class="text-slate-400 font-medium">Jenis:</span> <span class="text-slate-700">${tree.jenis}</span></div>
                            <div><span class="text-slate-400 font-medium">Tgl Tanam:</span> <span class="text-slate-700">${tglTanam}</span></div>
                            <div><span class="text-slate-400 font-medium">Status:</span> <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">${statusFormatted}</span></div>
                        </div>
                    `;
                    
                    const marker = L.marker([lat, lng]).bindPopup(popupContent);
                    marker.addTo(group);
                }
            });
            
            group.addTo(map);
            map.fitBounds(group.getBounds(), { padding: [50, 50] });
        }

        // 3D Carousel Tim ProKlim Click/Tap Handler
        document.querySelectorAll('.proklim-3d-card').forEach(function (card) {
            card.addEventListener('click', function (e) {
                const alreadyActive = card.classList.contains('is-active');
                document.querySelectorAll('.proklim-3d-card.is-active').forEach(function (c) {
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

