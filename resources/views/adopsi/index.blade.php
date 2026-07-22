@extends('layouts.app')

@section('content')
<!-- Section 1: Hero Section -->
<x-fixed-image-section variant="green"
    :image="'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1920&q=80'"
    eyebrow="Program Konservasi Pesisir Desa Punjulharjo" eyebrowIcon="fa-solid fa-leaf"
    title="My Cemara" titleAccent="Pantai Karangjahe"
    subtitle="Inisiatif partisipatif penghijauan pesisir untuk membentengi garis pantai Desa Punjulharjo dari ancaman abrasi laut Jawa melalui adopsi bibit Cemara Laut (Casuarina equisetifolia)."
    waveColor="text-emerald-900"
    hasWave="true">
    @auth
        @if(auth()->user()->isMember())
            <a href="{{ route('member.adopsi.dashboard') }}" class="rounded-lg bg-emerald-500 px-6 py-3 font-semibold text-white hover:bg-emerald-600 transition flex items-center gap-2">
                <i class="fa-solid fa-tree"></i> Adopsi via Dashboard Saya
            </a>
        @else
            <a href="{{ route('admin.moderasi.index') }}" class="rounded-lg bg-sky-600 px-6 py-3 font-semibold text-white hover:bg-sky-700 transition flex items-center gap-2">
                <i class="fa-solid fa-user-shield"></i> Pusat Moderasi Admin
            </a>
        @endif
    @else
        <a href="{{ route('login.user') }}" class="rounded-lg bg-emerald-500 px-6 py-3 font-semibold text-white hover:bg-emerald-600 transition flex items-center gap-2">
            <i class="fa-solid fa-tree"></i> Mulai Adopsi (Login Member)
        </a>
    @endauth
    <a href="#latar-belakang" class="rounded-lg bg-white/10 px-6 py-3 font-semibold text-white ring-1 ring-white/30 hover:bg-white/20 transition flex items-center gap-2">
        Pelajari Selengkapnya ↓
    </a>
</x-fixed-image-section>

<!-- Section 6: Counter / Stat Bar (Statistik Dinamis - Ultra Modern) -->
<div class="relative bg-gradient-to-b from-emerald-950 via-emerald-900 to-slate-950 text-white py-16 overflow-hidden border-y border-emerald-800/60">
    <!-- Ambient Glow Background effects -->
    <div class="absolute -top-24 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-1/4 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-300 text-xs font-semibold uppercase tracking-widest ring-1 ring-emerald-400/30 backdrop-blur-md">
                <i class="fa-solid fa-chart-line"></i> Dampak Real-time Program
            </span>
            <h2 class="text-2xl md:text-3xl font-heading font-bold text-white mt-3">Capaian Konservasi Pesisir</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <!-- Card 1: Total Dana Terkumpul -->
            <div class="group relative bg-emerald-950/60 backdrop-blur-xl p-8 rounded-2xl border border-emerald-500/20 hover:border-emerald-400/50 transition-all duration-500 shadow-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.25)] hover:-translate-y-1">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-2xl group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-500 shrink-0">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                    <div>
                        <div class="text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-emerald-300 via-teal-100 to-white bg-clip-text text-transparent font-title tracking-tight">
                            Rp {{ number_format($stats['total_dana']) }}
                        </div>
                        <div class="text-xs font-sans text-emerald-200/80 mt-1 uppercase tracking-wider font-semibold">
                            Total Dana Terkumpul
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-800/40 flex items-center justify-between text-[11px] text-emerald-400/80">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-shield-halved"></i> Transparan & Akuntabel</span>
                    <span class="font-bold text-emerald-300">100% Salur</span>
                </div>
            </div>

            <!-- Card 2: Jumlah Pohon Tertanam -->
            <div class="group relative bg-emerald-950/60 backdrop-blur-xl p-8 rounded-2xl border border-emerald-500/20 hover:border-emerald-400/50 transition-all duration-500 shadow-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.25)] hover:-translate-y-1">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-2xl group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-500 shrink-0">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <div>
                        <div class="text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-emerald-300 via-teal-100 to-white bg-clip-text text-transparent font-title tracking-tight">
                            {{ number_format($stats['pohon_tertanam']) }} <span class="text-lg font-normal text-emerald-300">Bibit</span>
                        </div>
                        <div class="text-xs font-sans text-emerald-200/80 mt-1 uppercase tracking-wider font-semibold">
                            Jumlah Pohon Tertanam
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-800/40 flex items-center justify-between text-[11px] text-emerald-400/80">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> Karangjahe Coast</span>
                    <span class="font-bold text-emerald-300">Cemara Laut</span>
                </div>
            </div>

            <!-- Card 3: Member Adopsi -->
            <div class="group relative bg-emerald-950/60 backdrop-blur-xl p-8 rounded-2xl border border-emerald-500/20 hover:border-emerald-400/50 transition-all duration-500 shadow-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.25)] hover:-translate-y-1">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/10 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-2xl group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-500 shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-emerald-300 via-teal-100 to-white bg-clip-text text-transparent font-title tracking-tight">
                            {{ number_format($stats['total_adopter']) }} <span class="text-lg font-normal text-emerald-300">Orang</span>
                        </div>
                        <div class="text-xs font-sans text-emerald-200/80 mt-1 uppercase tracking-wider font-semibold">
                            Member Adopsi Partisipatif
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-800/40 flex items-center justify-between text-[11px] text-emerald-400/80">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-heart"></i> Komunitas Hijau</span>
                    <span class="font-bold text-emerald-300">Pahlawan Pesisir</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 2: Gambaran Umum Program -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Gambaran Umum Program</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 font-title leading-tight">
                    Membangun Benteng Hijau Alami Pesisir Rembang
                </h2>
                <p class="text-slate-600 leading-relaxed font-sans">
                    <strong>My Cemara</strong> adalah wadah kolaborasi masyarakat, wisatawan, dan tim pengelola pesisir Desa Wisata Punjulharjo. Melalui program ini, siapa saja dapat berkontribusi langsung menjaga kelestarian Pantai Karangjahe tanpa harus hadir secara fisik untuk menanam.
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

            <div class="lg:col-span-6">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80" 
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-shield-virus"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg font-title">Daya Tahan Tinggi</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Dapat tumbuh subur di tanah berpasir kering dengan toleransi salinitas tinggi serta embusan angin pantai yang keras.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg font-title">Penyerap Karbon Efektif</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Tajuk cemara laut memiliki biomassa yang lebat, membantu menyerap emisi karbon serta memperbaiki mikroiklim pesisir.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                    <i class="fa-solid fa-people-roof"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg font-title">Pemberdayaan Masyarakat</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Bibit dipenyemaian lokal dan ditanam langsung oleh Tim Pengelola Desa (Pokdarwis Karangjahe), menggerakkan ekonomi warga.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Fixed Image Reveal Feature Section: Hutan Cemara Laut (Gambar Pohon) -->
<x-fixed-image-section
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
                <p class="text-slate-500 text-xs">Pengelola desa melakukan verifikasi dan menerbitkan kode pohon unik.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">6</div>
                <h4 class="font-bold text-slate-800 text-base">Penanaman Bibit</h4>
                <p class="text-slate-500 text-xs">Tim desa menanam bibit cemara di area konservasi Karangjahe.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-10 h-10 bg-emerald-600 text-white font-bold rounded-xl flex items-center justify-center text-base font-title">7</div>
                <h4 class="font-bold text-slate-800 text-base">Sertifikat Digital</h4>
                <p class="text-slate-500 text-xs">Unduh sertifikat adopsi resmi dalam format dokumen Word (.doc).</p>
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
@endsection
