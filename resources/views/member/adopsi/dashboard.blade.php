@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[80vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-emerald-800 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-500/30">Member Area</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">Halo, {{ auth()->user()->name }}!</h1>
                <p class="text-slate-300 text-sm mt-1">Selamat datang di dashboard pemantauan & adopsi pohon cemara Anda di Pantai Karangjahe.</p>
            </div>
            <a href="#pilih-paket" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow transition flex items-center gap-2 text-sm">
                <i class="fa-solid fa-tree"></i> Adopsi Pohon Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl text-sm text-emerald-800 shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- === Banner Efek Fixed Image Reveal (Foto Diam, Kotak Jendela Scroll) === --}}
        <x-fixed-image-section
            :image="asset('images/beach-bg.png')"
            eyebrow="My Cemara Konservasi"
            title="Terima Kasih Telah Menjaga Pesisir"
            subtitle="Setiap pohon cemara yang Anda adopsi ditanam & dirawat langsung oleh tim pengelola desa di Pantai Karangjahe."
            height="h-[50vh]"
            class="rounded-xl shadow-lg border border-slate-200">
            <a href="#pilih-paket"
               class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow hover:bg-emerald-700 transition text-sm">
                <i class="fa-solid fa-tree"></i> Adopsi Pohon Baru
            </a>
        </x-fixed-image-section>

        <!-- Section: Pilihan Paket Adopsi Pohon Cemara -->
        <div id="pilih-paket" class="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 space-y-6">
            <div>
                <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Program Konservasi</span>
                <h2 class="text-2xl font-bold text-slate-800 font-title mt-0.5">Pilih Paket Adopsi Pohon Cemara</h2>
                <p class="text-slate-500 text-sm mt-1">Pilih paket adopsi di bawah ini untuk memulai kontribusi penghijauan pesisir Pantai Karangjahe.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($pakets as $paket)
                    <div class="border border-emerald-500/30 hover:border-emerald-500 rounded-xl p-6 bg-gradient-to-b from-white to-emerald-50/20 transition-all duration-300 shadow-sm flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-xl font-bold">
                                <i class="fa-solid fa-tree"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-slate-800 font-title">{{ $paket->nama }}</h3>
                                <p class="text-slate-600 text-sm mt-1 leading-relaxed">{{ $paket->deskripsi }}</p>
                            </div>

                            <div class="py-2 border-y border-slate-100">
                                <span class="text-3xl font-extrabold text-emerald-700 font-title">Rp {{ number_format($paket->harga) }}</span>
                                <span class="text-slate-400 text-xs">/ paket</span>
                            </div>

                            <ul class="space-y-2 text-xs text-slate-700">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600"></i>
                                    <span><strong>{{ $paket->jumlah_bibit }} Bibit Cemara Laut</strong> (ditanam tim pengelola desa)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600"></i>
                                    <span>Kode Pohon Unik & Sertifikat Digital (Word .doc)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600"></i>
                                    <span>Pemantauan Foto & Grafik Tinggi Pohon Berkala</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('member.adopsi.create', $paket) }}" 
                               class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow text-center block transition text-sm">
                                <i class="fa-solid fa-cart-shopping mr-1.5"></i> Pilih & Adopsi Paket Ini &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Section: List Pohon Cemara Saya (Horizontal Cards + Menyamping Table) -->
        <div class="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 space-y-6">
            <h2 class="text-xl font-bold text-slate-800 font-title flex items-center gap-2">
                <i class="fa-solid fa-tree text-emerald-600"></i> Pohon Cemara Saya ({{ $pohons->count() }})
            </h2>

            @if($pohons->isEmpty())
                <div class="text-center py-8 text-slate-500 space-y-2">
                    <p class="text-sm">Anda belum memiliki pohon cemara yang aktif ditanam.</p>
                    <p class="text-xs text-slate-400">Pilih salah satu paket adopsi di atas untuk memesan bibit cemara pertama Anda.</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($pohons as $pohon)
                        <div class="border border-slate-200 rounded-xl p-6 hover:border-emerald-500 transition shadow-sm bg-slate-50/50 space-y-4">
                            <!-- Card Header -->
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 border-b border-slate-200/80 pb-3">
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-mono font-bold text-emerald-800 bg-emerald-100 px-3 py-1 rounded-md">{{ $pohon->kode_pohon }}</span>
                                    <h3 class="font-bold text-slate-800 text-lg font-title">{{ $pohon->nama_sertifikat }}</h3>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-slate-500">
                                        <i class="fa-solid fa-calendar-day mr-1"></i> Tanam: {{ $pohon->tanggal_tanam ? $pohon->tanggal_tanam->format('d M Y') : 'Menunggu Jadwal' }}
                                    </span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($pohon->status == 'ditanam' || $pohon->status == 'tumbuh') bg-emerald-100 text-emerald-800 
                                        @elseif($pohon->status == 'mati') bg-rose-100 text-rose-800 
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ ucfirst($pohon->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Riwayat Perkembangan Pohon sebagai Tabel Menyamping -->
                            <div class="space-y-2">
                                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-chart-line text-emerald-600"></i> Riwayat Perkembangan Growth Pohon
                                </h4>
                                @if($pohon->monitorings->isNotEmpty())
                                    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
                                        <table class="w-full text-left text-xs text-slate-600">
                                            <thead class="bg-slate-100 text-slate-500 uppercase text-[11px] font-semibold border-b border-slate-200">
                                                <tr>
                                                    <th class="p-3">Tanggal Pantau</th>
                                                    <th class="p-3">Tinggi Pohon</th>
                                                    <th class="p-3">Jumlah Daun</th>
                                                    <th class="p-3">Catatan Pengelola</th>
                                                    <th class="p-3 text-center">Foto Perkembangan</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach($pohon->monitorings as $mon)
                                                    <tr class="hover:bg-slate-50">
                                                        <td class="p-3 font-semibold text-slate-800 whitespace-nowrap">{{ $mon->tanggal->format('d/m/Y') }}</td>
                                                        <td class="p-3 font-bold text-emerald-700 whitespace-nowrap">{{ $mon->tinggi_cm ?? '-' }} cm</td>
                                                        <td class="p-3 whitespace-nowrap">{{ $mon->jumlah_daun ?? '-' }} helai</td>
                                                        <td class="p-3 text-slate-600 italic">{{ $mon->catatan ?? '-' }}</td>
                                                        <td class="p-3 text-center whitespace-nowrap">
                                                            @if($mon->foto)
                                                                <a href="{{ asset('storage/' . $mon->foto) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-md border border-emerald-200 text-xs transition">
                                                                    <i class="fa-solid fa-image"></i> Lihat Foto
                                                                </a>
                                                            @else
                                                                <span class="text-slate-400 italic text-[11px]">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="p-4 rounded-lg bg-white border border-slate-200 text-xs text-slate-400 italic">
                                        <i class="fa-solid fa-info-circle mr-1 text-slate-400"></i> Belum ada catatan pemantauan pertumbuhan untuk pohon ini.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Section: Riwayat Transaksi Adopsi -->
        <div class="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 space-y-4">
            <h2 class="text-xl font-bold text-slate-800 font-title flex items-center gap-2">
                <i class="fa-solid fa-receipt text-slate-600"></i> Riwayat Adopsi Saya
            </h2>

            @if($adopsis->isEmpty())
                <p class="text-slate-500 text-sm text-center py-6">Belum ada transaksi adopsi.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                            <tr>
                                <th class="p-3">Kode Transaksi</th>
                                <th class="p-3">Paket</th>
                                <th class="p-3">Nama Sertifikat</th>
                                <th class="p-3">Total</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Aksi & Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($adopsis as $adopsi)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-3 font-mono font-semibold text-slate-800">{{ $adopsi->kode_transaksi }}</td>
                                    <td class="p-3">{{ $adopsi->paket->nama ?? '-' }}</td>
                                    <td class="p-3 font-medium text-slate-700">{{ $adopsi->nama_sertifikat }}</td>
                                    <td class="p-3 font-semibold text-emerald-700">Rp {{ number_format($adopsi->total_harga) }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($adopsi->status == 'diverifikasi' || $adopsi->status == 'ditanam' || $adopsi->status == 'selesai') bg-emerald-100 text-emerald-800 
                                            @elseif($adopsi->status == 'menunggu_pembayaran') bg-rose-100 text-rose-800 
                                            @elseif($adopsi->status == 'menunggu_verifikasi') bg-amber-100 text-amber-800 
                                            @else bg-slate-100 text-slate-700 @endif">
                                            {{ str_replace('_', ' ', ucfirst($adopsi->status)) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center space-x-2 whitespace-nowrap">
                                        @if($adopsi->status == 'menunggu_pembayaran')
                                            <a href="{{ route('member.adopsi.bayar', $adopsi) }}" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow">
                                                Bayar Sekarang
                                            </a>
                                        @else
                                            <a href="{{ route('member.adopsi.show', $adopsi) }}" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow">
                                                <i class="fa-solid fa-certificate mr-1"></i> Detail & Sertifikat
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
