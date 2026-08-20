@extends('layouts.app')

@section('content')
<x-fixed-image-section variant="green"
    key="hero_member_adopsi"
    :image="'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1920&q=80'"
    eyebrow="MEMBER AREA MY CEMARA" eyebrowIcon="fa-solid fa-tree"
    title="HALO, {{ auth()->user()->name }}!"
    subtitle="Selamat datang di dashboard pemantauan & adopsi pohon cemara Anda di Pantai Karangjahe. Terima kasih telah menjadi pahlawan kelestarian pesisir Punjulharjo."
    waveColor="text-slate-50"
    hasWave="true">
    <a href="#pilih-paket" class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 px-6 py-3 font-semibold text-white shadow-lg transition duration-300">
        <i class="fa-solid fa-tree"></i> Adopsi Pohon Baru
    </a>
</x-fixed-image-section>

<div class="py-10 bg-slate-50 min-h-[80vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Section: Pilihan Paket Adopsi Pohon Cemara -->
        <div id="pilih-paket" class="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 space-y-6">
            <div>
                <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Program Konservasi</span>
                <h2 class="text-2xl font-bold text-slate-800 font-title mt-0.5">Pilih Paket Adopsi Pohon Cemara</h2>
                <p class="text-slate-500 text-sm mt-1">Pilih paket adopsi di bawah ini untuk memulai kontribusi penghijauan pesisir Pantai Karangjahe.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto py-4">
                @foreach($pakets as $paket)
                    @php
                        $fiturs = [
                            $paket->is_donasi 
                                ? '<strong>Jumlah Bibit Disesuaikan</strong> sesuai nominal donasi diterima' 
                                : '<strong>' . $paket->jumlah_bibit . ' Bibit Cemara Laut</strong> (ditanam tim ProKlim)',
                            'Kode Pohon Unik & Sertifikat Digital (Word .docx)',
                            'Pemantauan Foto & Grafik Tinggi Pohon Berkala'
                        ];
                    @endphp
                    <x-adopsi-ticket
                        :kode="$paket->kode"
                        :nama="'Paket ' . $paket->kode"
                        :judul="$paket->is_donasi ? 'Donasi Bebas' : $paket->jumlah_bibit . ' Bibit Cemara'"
                        :harga="$paket->harga"
                        :deskripsi="$paket->deskripsi"
                        :fitur="$fiturs"
                        :action="route('member.adopsi.create', $paket)"
                        method="GET"
                        :treeCode="'MYC-' . strtoupper($paket->kode) . '2026'" />
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
                                        @if($pohon->status == 'hidup') bg-emerald-100 text-emerald-800
                                        @elseif($pohon->status == 'perlu_penyulaman') bg-amber-100 text-amber-800
                                        @elseif($pohon->status == 'mati') bg-rose-100 text-rose-800
                                        @else bg-slate-100 text-slate-600 @endif">
                                        @switch($pohon->status)
                                            @case('hidup') Hidup @break
                                            @case('mati') Mati @break
                                            @case('perlu_penyulaman') Perlu Penyulaman @break
                                            @default Menunggu Tanam
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            @if($pohon->status === 'mati' && !$pohon->tindakan_bibit_mati)
                                <div class="mt-3 p-4 rounded-xl bg-rose-50 border border-rose-200">
                                    <p class="text-sm font-bold text-rose-700 mb-1">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Pohon Anda Dinyatakan Mati
                                    </p>
                                    <p class="text-xs text-rose-600 mb-3">Petugas kami melaporkan pohon ini mati. Silakan pilih tindakan lanjutan:</p>
                                    <form action="{{ route('member.adopsi.tindakan', $pohon) }}" method="POST" class="space-y-2">
                                        @csrf
                                        <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                                            <input type="radio" name="tindakan_bibit_mati" value="ganti" required> Lokasi tanam ganti
                                        </label>
                                        <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                                            <input type="radio" name="tindakan_bibit_mati" value="sama" required> Lokasi tanam sama
                                        </label>
                                        <button type="submit" class="mt-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl shadow transition">
                                            Konfirmasi Tindakan
                                        </button>
                                    </form>
                                </div>
                            @elseif($pohon->status === 'mati' && $pohon->tindakan_bibit_mati)
                                <div class="mt-3 p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600">
                                    <i class="fa-solid fa-circle-check text-emerald-500 mr-1"></i>
                                    Anda telah memilih: <strong>{{ $pohon->tindakan_bibit_mati === 'ganti' ? 'Lokasi tanam ganti' : 'Lokasi tanam sama' }}</strong>
                                    pada {{ $pohon->tindakan_dikonfirmasi_at->format('d/m/Y H:i') }}. Tim kami akan segera menindaklanjuti.
                                </div>
                            @endif

                            <!-- Riwayat Perkembangan Pohon sebagai Tabel Menyamping -->
                            <div class="space-y-2">
                                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-chart-line text-emerald-600"></i> Riwayat Perkembangan Growth Pohon
                                </h4>
                                @if($pohon->monitorings->isNotEmpty())
                                    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
                                        <table class="min-w-[900px] w-full text-left text-xs text-slate-600">
                                            <thead class="bg-slate-100 text-slate-500 uppercase text-[11px] font-semibold border-b border-slate-200">
                                                <tr>
                                                    <th class="p-3">Tanggal Update</th>
                                                    <th class="p-3">Petugas</th>
                                                    <th class="p-3">Status</th>
                                                    <th class="p-3">Perkiraan Tinggi</th>
                                                    <th class="p-3">Kondisi Daun</th>
                                                    <th class="p-3">Cabang Baru</th>
                                                    <th class="p-3">Kerusakan</th>
                                                    <th class="p-3">Catatan</th>
                                                    <th class="p-3 text-center">Foto</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach($pohon->monitorings as $mon)
                                                    <tr class="hover:bg-slate-50">
                                                        <td class="p-3 font-semibold text-slate-800 whitespace-nowrap">{{ $mon->tanggal->format('d/m/Y') }}</td>
                                                        <td class="p-3 whitespace-nowrap">{{ $mon->nama_petugas ?? '-' }}</td>
                                                        <td class="p-3 whitespace-nowrap">
                                                            @switch($mon->pohon->status ?? null)
                                                                @case('hidup') <span class="text-emerald-700 font-semibold">Hidup</span> @break
                                                                @case('mati') <span class="text-rose-700 font-semibold">Mati</span> @break
                                                                @case('perlu_penyulaman') <span class="text-amber-700 font-semibold">Perlu Penyulaman</span> @break
                                                                @default <span class="text-slate-400">-</span>
                                                            @endswitch
                                                        </td>
                                                        <td class="p-3 whitespace-nowrap">{{ $mon->perkiraan_tinggi ?? '-' }}</td>
                                                        <td class="p-3 whitespace-nowrap">{{ $mon->kondisi_daun ?? '-' }}</td>
                                                        <td class="p-3 whitespace-nowrap">{{ $mon->cabang_baru ?? '-' }}</td>
                                                        <td class="p-3 whitespace-nowrap">{{ $mon->kerusakan ?? '-' }}</td>
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

        <!-- Section: Peta Lokasi Pohon Saya -->
        <div class="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 space-y-6">
            <div>
                <span class="text-emerald-600 font-semibold uppercase text-xs tracking-wider">Pemetaan Lokasi</span>
                <h2 class="text-xl font-bold text-slate-800 font-title flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot text-emerald-600"></i> Peta Lokasi Pohon Saya
                </h2>
                <p class="text-slate-500 text-sm mt-1">Titik persebaran geografis pohon cemara milik Anda di Pantai Karangjahe.</p>
            </div>

            <div class="relative bg-slate-50 p-3 rounded-2xl border border-slate-200 overflow-hidden">
                <div id="personal-map" class="w-full rounded-xl border border-slate-200" style="height: 400px; z-index: 1;"></div>
                @if($pohonMapUser->isEmpty())
                    <div class="absolute inset-0 bg-white/95 flex flex-col items-center justify-center text-center p-6 z-[1000]">
                        <i class="fa-solid fa-location-dot text-4xl text-slate-300 mb-3"></i>
                        <p class="text-slate-600 font-semibold">Anda belum memiliki pohon dengan titik lokasi tercatat</p>
                        <p class="text-xs text-slate-400 mt-1">Lokasi koordinat pohon Anda akan tampil setelah dipetakan oleh tim pengelola desa.</p>
                    </div>
                @endif
            </div>
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
                    <table class="min-w-[650px] lg:min-w-full w-full text-left text-sm text-slate-600">
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

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            initPersonalMap();
        });

        function initPersonalMap() {
            const defaultLat = -6.685363;
            const defaultLng = 111.385750;
            
            const mapEl = document.getElementById('personal-map');
            if (!mapEl) return;
            
            const map = L.map('personal-map').setView([defaultLat, defaultLng], 14);
            
            const streetLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ'
            });
            const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            });
            satelliteLayer.addTo(map);
            L.control.layers({ 'Peta Jalan': streetLayer, 'Foto Satelit': satelliteLayer }).addTo(map);
            
            const userTrees = @json($pohonMapUser->values());
            
            if (userTrees.length > 0) {
                const group = L.featureGroup();
                
                userTrees.forEach(function(tree) {
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
                        
                        const statusLabels = { hidup: 'Hidup', mati: 'Mati', perlu_penyulaman: 'Perlu Penyulaman', menunggu_tanam: 'Menunggu Tanam' };
                        const statusColors = { hidup: 'bg-emerald-50 text-emerald-800 border-emerald-100', mati: 'bg-rose-50 text-rose-800 border-rose-100', perlu_penyulaman: 'bg-amber-50 text-amber-800 border-amber-100', menunggu_tanam: 'bg-slate-50 text-slate-600 border-slate-100' };
                        const rawStatus = tree.status || 'hidup';
                        const statusFormatted = statusLabels[rawStatus] || rawStatus;
                        const statusColorClass = statusColors[rawStatus] || statusColors.hidup;
                        const lokasiDesc = tree.lokasi_teks || '-';
                        
                        const popupContent = `
                            <div class="font-sans text-xs space-y-1.5 p-1">
                                <div class="font-bold text-slate-800 border-b border-slate-100 pb-1 text-sm">${tree.kode_pohon}</div>
                                <div><span class="text-slate-400 font-medium">Jenis:</span> <span class="text-slate-700">${tree.jenis}</span></div>
                                <div><span class="text-slate-400 font-medium">Tgl Tanam:</span> <span class="text-slate-700">${tglTanam}</span></div>
                                <div><span class="text-slate-400 font-medium">Lokasi:</span> <span class="text-slate-700">${lokasiDesc}</span></div>
                                <div><span class="text-slate-400 font-medium">Status:</span> <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold ${statusColorClass}">${statusFormatted}</span></div>
                            </div>
                        `;
                        
                        const marker = L.marker([lat, lng]).bindPopup(popupContent);
                        marker.addTo(group);
                    }
                });
                
                group.addTo(map);
                map.fitBounds(group.getBounds(), { padding: [50, 50] });
            }
        }
    })();
</script>
@endpush
