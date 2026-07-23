@extends('layouts.app')

@section('content')
<div class="pt-24 bg-slate-100 font-sans">
    <div class="max-w-6xl mx-auto px-6 py-12">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-heading text-brand-dark">Moderasi Kesan Pengunjung</h2>
                <p class="text-slate-500 text-sm">Validasi ulasan dan foto selfie pengunjung sebelum dipublikasikan ke website resmi.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openQrModal()" class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark font-semibold px-4 py-2 text-sm transition flex items-center gap-1.5 shadow-sm">
                    <i class="fa-solid fa-qrcode"></i> Cetak QR Standee
                </button>
                <a href="{{ route('testimoni.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold px-4 py-2 text-sm transition">
                    <i class="fa-solid fa-eye mr-1.5"></i> Lihat Halaman Publik
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 text-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-emerald-500 mr-2 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-5 border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block">Total Masuk</span>
                    <span class="text-3xl font-extrabold text-slate-800">{{ $testimonials->total() }}</span>
                </div>
                <i class="fa-solid fa-comments text-slate-300 text-4xl"></i>
            </div>
            <div class="bg-white p-5 border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block">Disetujui</span>
                    <span class="text-3xl font-extrabold text-emerald-600">{{ \App\Models\Testimonial::where('is_approved', true)->count() }}</span>
                </div>
                <i class="fa-solid fa-circle-check text-emerald-200 text-4xl"></i>
            </div>
            <div class="bg-white p-5 border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block">Menunggu Moderasi</span>
                    <span class="text-3xl font-extrabold text-amber-600">{{ \App\Models\Testimonial::where('is_approved', false)->count() }}</span>
                </div>
                <i class="fa-solid fa-hourglass-half text-amber-200 text-4xl animate-pulse"></i>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase text-slate-500 tracking-wider">
                            <th class="p-4">Pengunjung</th>
                            <th class="p-4">Ulasan & Rating</th>
                            <th class="p-4">Destinasi & Aktivitas</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                        @forelse($testimonials as $item)
                            <tr class="hover:bg-slate-50 transition duration-150">
                                <!-- Visitor Identity -->
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-none overflow-hidden bg-slate-100 border shrink-0">
                                            @if($item->photo_path)
                                                <img src="{{ Storage::url($item->photo_path) }}" class="w-full h-full object-cover" alt="{{ $item->name }}">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-200">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block leading-tight">{{ $item->name }}</span>
                                            <span class="text-xs text-slate-400 block">{{ $item->origin_city }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Review & Rating Stars -->
                                <td class="p-4 max-w-xs">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-1.5 text-xs">
                                            <span class="text-[9px] text-slate-400 font-bold w-12">Puas:</span>
                                            <div class="flex text-amber-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $item->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-xs">
                                            <span class="text-[9px] text-slate-400 font-bold w-12">Bersih:</span>
                                            <div class="flex text-teal-500">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $item->cleanliness_rating ? 'text-teal-500' : 'text-slate-200' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-xs text-slate-600 leading-normal line-clamp-2" title="{{ $item->review }}">{{ $item->review }}</p>
                                        @if($item->suggestions)
                                            <p class="text-[10px] text-slate-400 italic font-medium leading-normal line-clamp-1" title="Saran: {{ $item->suggestions }}">Saran: {{ $item->suggestions }}</p>
                                        @endif
                                    </div>
                                </td>

                                <!-- Preference info -->
                                <td class="p-4">
                                    <span class="text-xs font-semibold text-slate-600 block"><i class="fa-solid fa-location-dot text-sky-500 mr-1"></i>{{ $item->favorite_destination }}</span>
                                    <span class="text-xs text-slate-500 block mt-0.5"><i class="fa-solid fa-person-running mr-1 text-slate-400"></i>{{ $item->activity }}</span>
                                    <span class="text-[10px] text-slate-400 block mt-0.5"><i class="fa-solid fa-magnifying-glass mr-1"></i>Tahu dari: {{ $item->referral_source }}</span>
                                </td>

                                <!-- Status Badge -->
                                <td class="p-4">
                                    @if($item->is_approved)
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs px-2 py-0.5 font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Publik
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-200 text-xs px-2 py-0.5 font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                        </span>
                                    @endif
                                </td>

                                <!-- Action buttons -->
                                <td class="p-4 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <!-- Approval patch toggle -->
                                        <form action="{{ route('admin.testimoni.approve', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            @if($item->is_approved)
                                                <button type="submit" class="bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 px-3 py-1.5 text-xs font-semibold transition" title="Tangguhkan Testimoni">
                                                    Tangguhkan
                                                </button>
                                            @else
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 text-xs font-semibold transition shadow-sm" title="Setujui Testimoni">
                                                    Setujui
                                                </button>
                                            @endif
                                        </form>

                                        <!-- Delete action -->
                                        <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 border border-red-100 text-red-600 p-1.5 text-xs transition" title="Hapus Ulasan">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">
                                    <i class="fa-solid fa-comments text-3xl mb-2 block"></i>
                                    Belum ada testimoni pengunjung yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination block -->
            @if($testimonials->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50 font-sans">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

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
@endsection
