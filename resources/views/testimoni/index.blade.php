@extends('layouts.app')

@section('content')
<div class="pt-24 bg-slate-50 min-h-screen font-sans">
    <!-- Top Hero Header -->
    <section class="py-12 bg-gradient-to-r from-brand-dark to-slate-900 text-white px-6">
        <div class="max-w-6xl mx-auto text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-brand-accent/20 text-brand-accent text-sm font-semibold uppercase tracking-wider border border-brand-accent/30">
                <i class="fa-solid fa-heart-circle-check"></i> Kesan Pengunjung
            </div>
            <h1 class="text-4xl md:text-5xl font-heading tracking-wide">Cerita & Senyum Pengunjung</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-sm md:text-base font-sans">
                Terima kasih atas kunjungan Anda di Desa Wisata Punjulharjo. Berikut adalah statistik kebahagiaan dan potret keceriaan langsung dari pengunjung kami.
            </p>
            <div class="pt-3">
                <a href="{{ route('testimoni.create') }}" class="inline-flex items-center gap-2 bg-brand-accent hover:bg-white hover:text-brand-dark text-brand-dark font-bold px-6 py-3 transition shadow duration-300">
                    <i class="fa-solid fa-camera-retro"></i> Bagikan Ceritamu Disini
                </a>
            </div>
        </div>
    </section>

    <!-- STATISTICS & CHARTS SECTION -->
    <section class="py-10 md:py-16 px-4 md:px-6 max-w-6xl mx-auto">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
            <!-- Radial Bar: Satisfaction Rating -->
            <div class="bg-white border border-slate-200 shadow-sm p-3 md:p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-slate-800 font-bold text-xs md:text-lg mb-0.5 md:mb-1 flex items-center gap-1.5 md:gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-xs md:text-base"></i> Indeks Kepuasan
                    </h3>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-tight">Persentase pengunjung yang memberikan rating bintang 5</p>
                </div>
                <div class="my-2 md:my-4 flex items-center justify-center">
                    <div id="radialSatisfactionChart" class="w-full"></div>
                </div>
                <div class="border-t border-slate-100 pt-2 md:pt-3 text-center">
                    <span class="text-xl md:text-3xl font-extrabold text-brand-dark">{{ $averageRating }}</span>
                    <span class="text-slate-400 font-bold text-[9px] md:text-sm">/ 5.0 Rata-rata Rating</span>
                </div>
            </div>

            <!-- Donut Chart: Favorite Destination -->
            <div class="bg-white border border-slate-200 shadow-sm p-3 md:p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-slate-800 font-bold text-xs md:text-lg mb-0.5 md:mb-1 flex items-center gap-1.5 md:gap-2">
                        <i class="fa-solid fa-umbrella-beach text-sky-500 text-xs md:text-base"></i> Destinasi Terpopuler
                    </h3>
                    <p class="text-[9px] md:text-xs text-slate-500 leading-tight">Pembagian sebaran pilihan tempat wisata favorit hari ini</p>
                </div>
                <div class="my-2 md:my-4 flex items-center justify-center">
                    <div id="donutDestinationChart" class="w-full"></div>
                </div>
                <div class="border-t border-slate-100 pt-2 md:pt-3 text-center">
                    <span class="text-[9px] md:text-xs font-semibold text-slate-400">Diupdate otomatis berdasarkan data masuk</span>
                </div>
            </div>

            <!-- Static Quick Stats / Call To Action Card -->
            <div class="col-span-2 lg:col-span-1 bg-gradient-to-br from-brand-light to-brand-dark text-white p-5 md:p-6 shadow-sm flex flex-col justify-between relative overflow-hidden">
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
                    <div class="text-[10px] md:text-xs text-brand-accent font-bold uppercase tracking-widest mt-1">Ulasan Pengunjung Terverifikasi</div>
                </div>
                <div class="border-t border-white/20 pt-3 md:pt-4 flex items-center gap-3 md:gap-4">
                    <i class="fa-solid fa-qrcode text-3xl md:text-4xl text-white/90"></i>
                    <div>
                        <span class="text-xs font-bold block">Pindai Barcode di Lokasi!</span>
                        <span class="text-[9px] md:text-[10px] text-slate-200 block">Kirim ulasan instan lewat kamera HP</span>
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
            @auth
                <div>
                    <button onclick="openQrModal()" class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark font-bold px-4 py-2.5 text-xs transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-qrcode"></i> Cetak QR Standee
                    </button>
                </div>
            @endauth
        </div>

        @if($testimonials->isEmpty())
            <div class="text-center py-20 bg-white border border-slate-200 p-8">
                <i class="fa-solid fa-images text-5xl text-slate-300 mb-4 block"></i>
                <p class="text-slate-500 font-semibold">Belum ada ulasan terverifikasi untuk ditampilkan.</p>
                <p class="text-xs text-slate-400 mt-2">Jadilah pengunjung pertama yang membagikan momen seru Anda!</p>
            </div>
        @else
            <!-- Responsive Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
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
                                <!-- Star Rating Display -->
                                <div class="text-brand-accent text-[9px] md:text-xs flex gap-0.5 mb-1 md:mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $item->rating)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star text-slate-300"></i>
                                        @endif
                                    @endfor
                                </div>

                                <!-- One Word Highlight -->
                                <h4 class="text-brand-dark font-extrabold text-xs md:text-base font-sans tracking-wide leading-snug line-clamp-1 mb-1 md:mb-2">
                                    "{{ $item->one_word }}"
                                </h4>

                                <!-- Paragraph Kesan -->
                                <p class="text-slate-600 font-sans text-[10px] md:text-sm leading-relaxed text-justify line-clamp-3 md:line-clamp-4">
                                    {{ $item->review }}
                                </p>
                            </div>

                            <!-- Bottom Identity Info -->
                            <div class="border-t border-slate-100 pt-2 md:pt-3 flex items-center justify-between text-[9px] md:text-[11px] text-slate-400 font-sans">
                                <div>
                                    <span class="font-bold text-slate-700 block text-[10px] md:text-xs">{{ $item->name }}</span>
                                    <span>Asal: {{ $item->origin_city }}</span>
                                </div>
                                <span class="bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded-none text-[8px] md:text-[9px] font-medium shrink-0 ml-1">
                                    {{ $item->companion }}
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

<!-- CDN Integrasi ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 1. CHART KEPUASAN (Radial Bar Chart)
        const satisfPercent = {{ $fiveStarPercentage }};
        const radialOptions = {
            chart: {
                height: window.innerWidth < 768 ? 160 : 240,
                type: 'radialBar',
            },
            series: [satisfPercent],
            colors: ['#fab831'], // Brand yellow accent
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: window.innerWidth < 768 ? '55%' : '70%',
                    },
                    dataLabels: {
                        name: {
                            show: window.innerWidth >= 768,
                            color: '#475569',
                            fontSize: '11px',
                            fontWeight: 600,
                            offsetY: -10
                        },
                        value: {
                            show: true,
                            color: '#0d355e',
                            fontSize: window.innerWidth < 768 ? '18px' : '32px',
                            fontWeight: 800,
                            offsetY: window.innerWidth < 768 ? 5 : 8,
                            formatter: function (val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            labels: ['Kepuasan Bintang 5'],
            stroke: {
                lineCap: 'round'
            }
        };

        const radialChart = new ApexCharts(document.querySelector("#radialSatisfactionChart"), radialOptions);
        radialChart.render();

        // 2. CHART DESTINASI FAVORIT (Donut Chart)
        const destKeys = {!! json_encode(array_keys($destinationData)) !!};
        const destValues = {!! json_encode(array_values($destinationData)) !!};

        const donutOptions = {
            chart: {
                height: window.innerWidth < 768 ? 180 : 250,
                type: 'donut',
            },
            series: destValues,
            labels: destKeys,
            colors: ['#0d355e', '#749db2', '#fab831', '#acb6bd'], // Palette Warna Brand
            legend: {
                show: true,
                position: 'bottom',
                fontSize: window.innerWidth < 768 ? '8px' : '11px',
                fontFamily: 'Inter, sans-serif',
                labels: {
                    colors: '#475569'
                },
                itemMargin: {
                    horizontal: window.innerWidth < 768 ? 2 : 5,
                    vertical: window.innerWidth < 768 ? 1 : 2
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: window.innerWidth < 768 ? '9px' : '12px'
                },
                formatter: function (val) {
                    return Math.round(val) + "%";
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%'
                    }
                }
            }
        };

        const donutChart = new ApexCharts(document.querySelector("#donutDestinationChart"), donutOptions);
        donutChart.render();
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
    function openQrModal() {
        document.getElementById('qrStandeeModal').classList.remove('hidden');
    }

    function closeQrModal() {
        document.getElementById('qrStandeeModal').classList.add('hidden');
    }

    function printQrStandee() {
        window.print();
    }
</script>

@push('styles')
<style>
    @media print {
        /* Hide all page components except the print standee */
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
