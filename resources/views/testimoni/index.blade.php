@extends('layouts.app')

@section('content')
<x-fixed-image-section
    key="hero_testimoni"
    :image="'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=1920&q=80'"
    eyebrow="KESAN PENGUNJUNG" eyebrowIcon="fa-solid fa-comment-dots"
    title="CERITA & SENYUM PENGUNJUNG"
    subtitle="Terima kasih atas kunjungan Anda di Desa Wisata Punjulharjo. Berikut statistik kebahagiaan dan potret keceriaan langsung dari pengunjung kami."
    waveColor="text-slate-50"
    hasWave="true">
    <a href="{{ route('testimoni.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-accent px-6 py-3 font-semibold text-brand-dark hover:bg-white transition duration-300">
        <i class="fa-solid fa-camera-retro"></i> Bagikan Ceritamu Disini
    </a>
</x-fixed-image-section>

<div class="bg-slate-50 font-sans">

    <!-- STATISTICS & CHARTS SECTION -->
    <section class="py-10 md:py-16 px-4 md:px-6 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <!-- Column 1: Rating Kepuasan & Kebersihan (Tanpa Chart) -->
            <div class="flex flex-col gap-6">
                <!-- Card 1: Kepuasan Pengunjung -->
                <div class="bg-white border border-slate-200 shadow-sm p-5 flex flex-col justify-center items-center text-center flex-grow py-6">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                        <h3 class="text-slate-800 font-bold text-sm md:text-base font-heading">Kepuasan Pengunjung</h3>
                    </div>
                    <div class="my-3">
                        <span class="text-4xl md:text-5xl font-black text-brand-dark tracking-tight block">
                            {{ $averageRating }} <span class="text-lg md:text-xl text-slate-400 font-normal">/ 5.0</span>
                        </span>
                        <div class="flex gap-1 justify-center mt-2 text-brand-accent text-sm md:text-base">
                            @php $stars = round($averageRating); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $stars)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star text-slate-300"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="text-slate-400 font-semibold text-[10px] md:text-xs tracking-wider uppercase">Rata-rata Rating</div>
                </div>

                <!-- Card 2: Kebersihan Lokasi -->
                <div class="bg-white border border-slate-200 shadow-sm p-5 flex flex-col justify-center items-center text-center flex-grow py-6">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-leaf text-teal-500 text-lg"></i>
                        <h3 class="text-slate-800 font-bold text-sm md:text-base font-heading">Kebersihan Lokasi</h3>
                    </div>
                    <div class="my-3">
                        <span class="text-4xl md:text-5xl font-black text-brand-dark tracking-tight block">
                            {{ $averageCleanliness }} <span class="text-lg md:text-xl text-slate-400 font-normal">/ 5.0</span>
                        </span>
                        <div class="flex gap-1 justify-center mt-2 text-brand-light text-sm md:text-base">
                            @php $cStars = round($averageCleanliness); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $cStars)
                                    <i class="fa-solid fa-star text-[#749db2]"></i>
                                @else
                                    <i class="fa-regular fa-star text-slate-300"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="text-slate-400 font-semibold text-[10px] md:text-xs tracking-wider uppercase">Rata-rata Kebersihan</div>
                </div>
            </div>

            <!-- Column 2: Chart Aktivitas Yang Dilakukan (Modern 3D Pie Chart) -->
            <div class="bg-white border border-slate-200 shadow-sm p-4 md:p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-slate-800 font-bold text-sm md:text-lg mb-0.5 md:mb-1 flex items-center gap-1.5 md:gap-2">
                        <i class="fa-solid fa-person-running text-brand-dark text-sm md:text-base"></i> Aktivitas Wisatawan
                    </h3>
                    <p class="text-xs text-slate-500 leading-tight">Sebaran aktivitas pengunjung selama berwisata</p>
                </div>
                <div class="my-2 md:my-4 flex items-center justify-center w-full">
                    <div id="chartAktivitas" class="w-full h-64 md:h-72"></div>
                </div>
                <div class="border-t border-slate-100 pt-2 md:pt-3 text-center">
                    <span class="text-slate-400 font-semibold text-[10px] md:text-xs tracking-wider uppercase">Statistik Aktivitas Utama</span>
                </div>
            </div>

            <!-- Column 3: Static Quick Stats / Call To Action Card -->
            <div class="col-span-1 bg-gradient-to-br from-brand-light to-brand-dark text-white p-5 md:p-6 shadow-sm flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-white/10 rounded-full blur-2xl"></div>
                <div>
                    <h3 class="font-bold text-lg md:text-xl mb-1.5 md:mb-2 text-brand-accent flex items-center gap-2">
                        <i class="fa-solid fa-quote-left"></i> Total Partisipan
                    </h3>
                    <p class="text-xs md:text-sm text-slate-200 leading-relaxed">
                        Senyum, tawa, dan ulasan Anda sangat berarti bagi pengembangan pariwisata Desa Punjulharjo.
                    </p>
                </div>
                <div class="my-4 md:my-6">
                    <div class="text-3xl md:text-5xl font-black text-white tracking-tight">{{ $totalTestimonials }}</div>
                    <div class="text-xs md:text-xs text-brand-accent font-bold uppercase tracking-widest mt-1">Ulasan Pengunjung Terverifikasi</div>
                </div>
                <div class="border-t border-white/20 pt-3 md:pt-4 flex items-center gap-3 md:gap-4">
                    <i class="fa-solid fa-qrcode text-3xl md:text-4xl text-white/90"></i>
                    <div>
                        <span class="text-xs font-bold block">Pindai Barcode di Lokasi!</span>
                        <span class="text-xs text-slate-200 block">Kirim ulasan instan lewat HP</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL GALLERY SECTION -->
    <section class="py-12 px-6 max-w-6xl mx-auto border-t border-slate-200">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-heading text-brand-dark">Galeri Kebahagiaan</h2>
                <p class="text-slate-500 text-sm">Foto selfie dan ulasan jujur dari wisatawan Punjulharjo</p>
            </div>
            @if(Auth::check() && Auth::user()->isAdmin())
                <div>
                    <button onclick="openQrModal()" class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark font-bold px-4 py-2.5 text-xs transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-qrcode"></i> Cetak QR Standee
                    </button>
                </div>
            @endif
        </div>

        @if($testimonials->isEmpty())
            <div class="text-center py-20 bg-white border border-slate-200 p-8">
                <i class="fa-solid fa-images text-5xl text-slate-300 mb-4 block"></i>
                <p class="text-slate-500 font-semibold">Belum ada ulasan terverifikasi untuk ditampilkan.</p>
                <p class="text-xs text-slate-400 mt-2">Jadilah pengunjung pertama yang membagikan momen seru Anda!</p>
            </div>
        @else
            <!-- Responsive Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($testimonials as $item)
                    <!-- Testimonial Card Design -->
                    <div class="bg-white border {{ !$item->is_approved ? 'border-amber-400 bg-amber-50/20' : 'border-slate-200' }} shadow-sm flex flex-col justify-between hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                        
                        <!-- Top Image Section -->
                        <div class="aspect-square w-full relative overflow-hidden bg-slate-100">
                            @if(!$item->is_approved)
                                <span class="absolute top-2 left-2 md:top-3 md:left-3 bg-amber-500 text-white text-[8px] md:text-[9px] font-black uppercase tracking-wider px-1.5 py-0.5 md:px-2 md:py-0.5 shadow-sm rounded-sm z-10 flex items-center gap-0.5 md:gap-1">
                                    <i class="fa-solid fa-clock-rotate-left"></i> PENDING
                                </span>
                            @endif

                            @if($item->photo_path)
                                <img src="{{ Storage::url($item->photo_path) }}" 
                                     alt="Selfie {{ $item->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-brand-light/10 text-brand-light">
                                    <i class="fa-solid fa-user text-3xl md:text-5xl"></i>
                                </div>
                            @endif

                            <!-- Favorite Destination Badge -->
                            <span class="absolute bottom-2 left-2 md:bottom-3 md:left-3 bg-brand-dark/95 text-white text-[8px] md:text-[9px] font-bold uppercase tracking-wider px-1.5 py-0.5 md:px-2.5 md:py-1 flex items-center gap-1 shadow-sm">
                                <i class="fa-solid fa-location-dot text-brand-accent"></i> {{ $item->favorite_destination }}
                            </span>
                        </div>

                        <!-- Card Content Section -->
                        <div class="p-3 md:p-5 flex-grow flex flex-col justify-between space-y-2 md:space-y-4">
                            <div>
                                <!-- Star Rating Displays -->
                                <div class="space-y-1 mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase w-14">Puas:</span>
                                        <div class="text-brand-accent text-[9px] md:text-xs flex gap-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $item->rating)
                                                    <i class="fa-solid fa-star text-amber-400"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-slate-300"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase w-14">Bersih:</span>
                                        <div class="text-teal-500 text-[9px] md:text-xs flex gap-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $item->cleanliness_rating)
                                                    <i class="fa-solid fa-star text-teal-500"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-slate-300"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Activity Highlight -->
                                <h4 class="text-brand-dark font-extrabold text-xs md:text-sm font-sans tracking-wide leading-snug line-clamp-1 mb-1 md:mb-2">
                                    Aktivitas: {{ $item->activity }}
                                </h4>

                                <!-- Paragraph Kesan -->
                                <p class="text-slate-600 font-sans text-[10px] md:text-sm leading-relaxed text-justify line-clamp-3 md:line-clamp-4">
                                    {{ $item->review }}
                                </p>

                                @if($item->suggestions)
                                    <div class="mt-2 bg-slate-50 p-2 border-l-2 border-slate-300">
                                        <span class="text-[9px] font-bold text-slate-400 block uppercase">Saran:</span>
                                        <p class="text-slate-500 font-sans italic text-[9px] md:text-[11px] leading-relaxed">
                                            {{ $item->suggestions }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Bottom Identity Info -->
                            <div class="border-t border-slate-100 pt-2 md:pt-3 flex items-center justify-between text-[9px] md:text-[11px] text-slate-400 font-sans">
                                <div>
                                    <span class="font-bold text-slate-700 block text-[10px] md:text-xs">{{ $item->name }}</span>
                                    <span>Asal: {{ $item->origin_city }}</span>
                                </div>
                                <span class="bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded-none text-[8px] md:text-[9px] font-medium shrink-0 ml-1">
                                    {{ $item->referral_source }}
                                </span>
                            </div>

                            @auth
                                <!-- Action Buttons for Admin on Card -->
                                <div class="border-t border-slate-100 pt-2 md:pt-3 flex gap-1.5 md:gap-2 no-print">
                                    <!-- Toggle Approve Button -->
                                    <form action="{{ route('admin.testimoni.approve', $item->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('PATCH')
                                        @if($item->is_approved)
                                            <button type="submit" class="w-full text-center bg-slate-200 hover:bg-slate-300 text-slate-700 py-1 md:py-1.5 px-1.5 md:px-2 text-[8px] md:text-[10px] font-bold uppercase transition" title="Tangguhkan Testimoni">
                                                Tangguhkan
                                            </button>
                                        @else
                                            <button type="submit" class="w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white py-1 md:py-1.5 px-1.5 md:px-2 text-[8px] md:text-[10px] font-bold uppercase transition" title="Setujui Testimoni">
                                                Setujui
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')" class="shrink-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 border border-red-100 text-red-600 p-1 md:p-1.5 text-[10px] md:text-xs transition flex items-center justify-center h-[24px] w-[24px] md:h-[28px] md:w-[28px]" title="Hapus Ulasan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>

<!-- CDN Integrasi Google Charts untuk 3D Pie Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Load Google Charts
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // PHP values injection to Google Charts format
            const rawData = [
                ['Aktivitas', 'Jumlah Partisipan'],
                @foreach($activityData as $act => $count)
                    [{!! json_encode($act) !!}, {{ (int)$count }}],
                @endforeach
            ];

            // If there's no data yet, provide a fallback indicator row
            if (rawData.length === 1) {
                rawData.push(['Belum Ada Aktivitas', 1]);
            }

            const dataTable = google.visualization.arrayToDataTable(rawData);

            const options = {
                is3D: true,
                chartArea: {
                    left: '5%',
                    top: '5%',
                    width: '90%',
                    height: '85%'
                },
                legend: {
                    position: 'bottom',
                    textStyle: {
                        fontName: 'Poppins',
                        fontSize: 11,
                        color: '#475569'
                    }
                },
                pieSliceTextStyle: {
                    fontName: 'Poppins',
                    fontSize: 10,
                    color: '#fff',
                    bold: true
                },
                // Use brand colors
                colors: ['#0d355e', '#749db2', '#fab831', '#acb6bd', '#10b981', '#ef4444', '#f59e0b', '#3b82f6', '#ec4899', '#8b5cf6'],
                tooltip: {
                    textStyle: {
                        fontName: 'Poppins',
                        fontSize: 11
                    }
                },
                backgroundColor: 'transparent'
            };

            const chart = new google.visualization.PieChart(document.getElementById('chartAktivitas'));
            chart.draw(dataTable, options);

            // Responsive window resizing logic
            window.addEventListener('resize', function() {
                chart.draw(dataTable, options);
            });
        }
    });
</script>

@auth
<!-- Modal Preview QR Standee -->
<div id="qrStandeeModal" class="hidden fixed inset-0 z-[9999] overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-start justify-center p-4 sm:p-10">
    <!-- Floating Close Button on screen -->
    <button type="button" onclick="closeQrModal()" class="fixed top-4 right-4 text-white hover:text-slate-200 transition bg-slate-800/80 hover:bg-slate-700/80 w-12 h-12 rounded-full flex items-center justify-center border border-white/10 z-[10000] no-print" title="Tutup Modal">
        <i class="fa-solid fa-xmark text-xl"></i>
    </button>

    <div class="bg-white max-w-xl w-full rounded-none shadow-2xl overflow-hidden border border-slate-200 text-left animate-fade-in no-print my-auto">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-qrcode text-brand-dark"></i> Preview QR Standee Pengunjung
            </h3>
            <button type="button" onclick="closeQrModal()" class="text-slate-400 hover:text-slate-600 transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        
        <div class="p-6 bg-slate-100 flex justify-center">
            <!-- Printable Standee Sheet Box (A4 proportion preview) -->
            <div id="qr-standee-print-area" class="w-[380px] min-h-[530px] bg-white border-8 border-brand-dark p-6 flex flex-col justify-between items-center text-center shadow-lg relative text-brand-dark">
                <!-- Top Ribbon -->
                <div class="w-full flex flex-col items-center border-b-2 border-brand-dark/20 pb-4">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/Lambang_Kabupaten_Rembang.webp') }}" class="w-8 h-8 object-contain" alt="Logo Rembang">
                        <div class="text-left font-sans">
                            <span class="text-[10px] uppercase font-bold tracking-widest text-slate-500 block leading-none">Desa Wisata</span>
                            <span class="text-sm font-black tracking-wide text-brand-dark block uppercase leading-none mt-1">Punjulharjo</span>
                        </div>
                    </div>
                </div>

                <!-- Middle Call to Action -->
                <div class="my-auto space-y-4">
                    <h4 class="text-xl font-black font-heading text-brand-dark tracking-wide uppercase leading-tight">
                        Bagikan Senyum &<br>Ceritamu disini!
                    </h4>
                    
                    <!-- QR Frame Container -->
                    <div class="p-3 border-4 border-dashed border-brand-accent bg-white flex items-center justify-center shadow-inner scale-105 my-4">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode(route('testimoni.create')) }}" 
                             class="w-48 h-48 object-contain" 
                             alt="QR Code Testimoni">
                    </div>

                    <p class="text-[11px] font-sans text-slate-500 leading-relaxed max-w-[280px] mx-auto uppercase tracking-wide">
                        Pindai QR Code di atas dengan Kamera HP Anda untuk mengirim ulasan & foto keseruan Anda!
                    </p>
                </div>

                <!-- Bottom Accent Ribbon -->
                <div class="w-full border-t border-brand-dark/20 pt-4 flex flex-col items-center">
                    <span class="text-[9px] uppercase tracking-widest text-brand-light font-black">
                        Dapatkan Kesempatan Tampil Di Website Resmi
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 mt-1">desapunjulharjo.id</span>
                </div>
            </div>
        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
            <button type="button" onclick="closeQrModal()" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold px-4 py-2 text-xs transition">
                Tutup
            </button>
            <button type="button" onclick="printQrStandee()" class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark font-bold px-5 py-2 text-xs shadow transition">
                <i class="fa-solid fa-print mr-1"></i> Cetak Standee
            </button>
        </div>
    </div>
</div>

<script>
    window.openQrModal = function() {
        document.getElementById('qrStandeeModal').classList.remove('hidden');
    }

    window.closeQrModal = function() {
        document.getElementById('qrStandeeModal').classList.add('hidden');
    }

    window.printQrStandee = function() {
        window.print();
    }
</script>

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #qrStandeeModal, #qr-standee-print-area, #qr-standee-print-area * {
            visibility: visible;
        }
        #qrStandeeModal {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        #qr-standee-print-area {
            border: 8px solid #0d355e !important;
            box-shadow: none !important;
            width: 100% !important;
            max-width: 500px !important;
            height: auto !important;
            min-height: 650px !important;
            padding: 2.5rem !important;
        }
        .no-print {
            display: none !important;
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
    }
</style>
@endpush
@endauth
@endsection
