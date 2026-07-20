@extends('layouts.app')

@section('content')
<!-- Section 1: Hero Section -->
<div class="relative bg-gradient-to-b from-slate-900 via-emerald-950 to-slate-900 text-white py-24 lg:py-32 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-4xl mx-auto space-y-6">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold uppercase tracking-wider">
                <i class="fa-solid fa-shield-cat"></i> Program Konservasi Pesisir Desa Punjulharjo
            </div>
            <h1 class="text-4xl sm:text-6xl font-bold tracking-tight font-title leading-tight">
                My Cemara <span class="text-emerald-400 block mt-2">Pantai Karangjahe</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed font-sans max-w-3xl mx-auto">
                Inisiatif partisipatif penghijauan pesisir untuk membentengi garis pantai Desa Punjulharjo dari ancaman abrasi laut Jawa melalui adopsi bibit Cemara Laut (<em>Casuarina equisetifolia</em>).
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-6">
                @auth
                    @if(auth()->user()->isMember())
                        <a href="{{ route('member.adopsi.dashboard') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/25 transition-all duration-300 flex items-center gap-2 text-base">
                            <i class="fa-solid fa-tree"></i> Adopsi via Dashboard Saya
                        </a>
                    @else
                        <a href="{{ route('admin.moderasi.index') }}" class="px-8 py-4 bg-sky-600 hover:bg-sky-700 text-white font-bold rounded-xl shadow-lg transition-all duration-300 flex items-center gap-2 text-base">
                            <i class="fa-solid fa-user-shield"></i> Pusat Moderasi Admin
                        </a>
                    @endif
                @else
                    <a href="{{ route('login.user') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/25 transition-all duration-300 flex items-center gap-2 text-base">
                        <i class="fa-solid fa-tree"></i> Mulai Adopsi (Login Member)
                    </a>
                @endauth
                <a href="#latar-belakang" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm transition-all border border-white/20 flex items-center gap-2 text-base">
                    Pelajari Selengkapnya &darr;
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Section 6: Counter / Stat Bar (Statistik Dinamis) -->
<div class="bg-emerald-900 text-emerald-100 py-12 border-y border-emerald-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6 rounded-xl bg-emerald-950/40 border border-emerald-700/50">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 font-title">Rp {{ number_format($stats['total_dana']) }}</div>
                <div class="text-xs font-sans text-emerald-200 mt-2 uppercase tracking-wider font-semibold">Total Dana Terkumpul</div>
            </div>
            <div class="p-6 rounded-xl bg-emerald-950/40 border border-emerald-700/50">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 font-title">{{ number_format($stats['pohon_tertanam']) }}</div>
                <div class="text-xs font-sans text-emerald-200 mt-2 uppercase tracking-wider font-semibold">Jumlah Pohon Tertanam</div>
            </div>
            <div class="p-6 rounded-xl bg-emerald-950/40 border border-emerald-700/50">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 font-title">{{ number_format($stats['total_adopter']) }}</div>
                <div class="text-xs font-sans text-emerald-200 mt-2 uppercase tracking-wider font-semibold">Member Adopsi</div>
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @foreach($pakets as $paket)
                <div class="border-2 border-emerald-500/20 hover:border-emerald-500 rounded-3xl p-8 bg-gradient-to-b from-white to-emerald-50/20 transition-all duration-300 shadow-md flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center text-xl font-bold mb-4">
                            <i class="fa-solid fa-tree"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 font-title">{{ $paket->nama }}</h3>
                        <p class="text-slate-500 text-sm mt-2 leading-relaxed">{{ $paket->deskripsi }}</p>

                        <div class="my-6">
                            <span class="text-4xl font-extrabold text-emerald-700 font-title">Rp {{ number_format($paket->harga) }}</span>
                            <span class="text-slate-400 text-sm">/ paket</span>
                        </div>

                        <ul class="space-y-2 border-t border-slate-200/60 pt-4 text-xs text-slate-700">
                            <li class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-emerald-600"></i>
                                <span><strong>{{ $paket->jumlah_bibit }} Bibit Cemara Laut</strong> (ditanam tim desa)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-emerald-600"></i>
                                <span>Kode pohon unik & Sertifikat Digital Word (.doc)</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-4 border-t border-slate-100">
                        @auth
                            @if(auth()->user()->isMember())
                                <a href="{{ route('member.adopsi.dashboard') }}" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 text-center block transition text-sm">
                                    Adopsi via Dashboard Member &rarr;
                                </a>
                            @else
                                <a href="{{ route('admin.moderasi.index') }}" class="w-full py-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl text-center block transition text-sm">
                                    Pusat Moderasi Admin
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login.user') }}" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 text-center block transition text-sm">
                                Login Member untuk Mengadopsi &rarr;
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
