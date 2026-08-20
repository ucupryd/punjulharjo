@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Detail Pesanan Adopsi</span>
                <h1 class="text-2xl font-bold text-slate-800 font-title mt-0.5">{{ $adopsi->kode_transaksi }}</h1>
            </div>
            <a href="{{ route('admin.adopsi.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                &larr; Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 bg-rose-100 border-l-4 border-rose-500 text-rose-800 rounded-xl text-sm">
                {{ session('warning') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Rincian Pesanan & Bukti Bayar -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                    <h3 class="font-bold text-slate-800 border-b border-slate-100 pb-2 font-title">Informasi Pemesan</h3>
                    <div class="text-sm space-y-2">
                        <div>
                            <span class="text-xs text-slate-400 block">Nama Pemesan</span>
                            <span class="font-semibold text-slate-800">{{ $adopsi->nama_pemesan }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">Nama Sertifikat</span>
                            <span class="font-semibold text-slate-800">{{ $adopsi->nama_sertifikat }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">Telepon / WhatsApp</span>
                            <span class="font-semibold text-slate-800">{{ $adopsi->telepon ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">Paket & Jumlah</span>
                            <span class="font-semibold text-slate-800">
                                {{ $adopsi->paket->nama }}
                                @if($adopsi->paket->is_donasi && $adopsi->jumlah == 0)
                                    <span class="text-amber-600">(Menunggu konversi admin)</span>
                                @else
                                    ({{ $adopsi->jumlah }}x)
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">Total Pembayaran</span>
                            <span class="font-bold text-emerald-700 text-lg font-title">Rp {{ number_format($adopsi->total_harga) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                    <h3 class="font-bold text-slate-800 border-b border-slate-100 pb-2 font-title">Bukti Pembayaran Transfer</h3>

                    @if($adopsi->bukti_bayar)
                        <a href="{{ asset('storage/' . $adopsi->bukti_bayar) }}" target="_blank" class="block">
                            <img src="{{ asset('storage/' . $adopsi->bukti_bayar) }}" alt="Bukti Transfer" class="w-full h-auto rounded-xl border border-slate-200 shadow-sm hover:opacity-90 transition">
                        </a>
                        <span class="text-xs text-slate-400 text-center block">Klik gambar untuk melihat ukuran penuh</span>
                    @else
                        <p class="text-xs text-slate-400 py-4 text-center">Member belum mengunggah bukti transfer.</p>
                    @endif

                    <!-- Aksi Verifikasi / Tolak -->
                    @if($adopsi->status == 'menunggu_verifikasi' || $adopsi->status == 'menunggu_pembayaran')
                        <div class="pt-4 border-t border-slate-100 space-y-3">
                            <form action="{{ route('admin.adopsi.verifikasi', $adopsi) }}" method="POST">
                                @csrf
                                @if($adopsi->paket->is_donasi)
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Jumlah Pohon Hasil Konversi Donasi</label>
                                        <input type="number" name="jumlah_konversi" min="1" max="100" required
                                               class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                               placeholder="Contoh: 3">
                                        <p class="text-[10px] text-slate-400 mt-1 italic">
                                            Total donasi: Rp {{ number_format($adopsi->total_harga) }}. Tentukan jumlah pohon cemara yang akan ditanam.
                                        </p>
                                    </div>
                                @endif
                                <button type="submit" onclick="return confirm('Verifikasi pembayaran dan generate kode pohon otomatis?')" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm shadow transition">
                                    ✓ Verifikasi & Auto-Generate Kode Pohon
                                </button>
                            </form>

                            <button onclick="document.getElementById('tolak-modal').classList.remove('hidden')" class="w-full py-2.5 bg-rose-100 hover:bg-rose-200 text-rose-700 font-semibold rounded-xl text-xs transition">
                                ✕ Tolak Pembayaran
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Daftar Kode Pohon & Form Monitoring -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="font-bold text-slate-800 text-lg mb-4 font-title">Daftar Kode Pohon Dihasilkan ({{ $adopsi->pohons->count() }})</h3>

                    @if($adopsi->pohons->isEmpty())
                        <p class="text-slate-400 text-sm">Belum ada unit pohon. Verifikasi transaksi untuk menghasilkan kode pohon otomatis.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($adopsi->pohons as $pohon)
                                <div class="p-4 border border-slate-200 rounded-2xl bg-slate-50 space-y-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="font-mono font-bold text-emerald-800 bg-emerald-100 px-3 py-1 rounded-lg text-sm">{{ $pohon->kode_pohon }}</span>
                                            <span class="text-xs text-slate-500 block mt-1">
                                                Status: 
                                                @switch($pohon->status)
                                                    @case('hidup') Hidup @break
                                                    @case('mati') Mati @break
                                                    @case('perlu_penyulaman') Perlu Penyulaman @break
                                                    @default Menunggu Tanam
                                                @endswitch
                                                | Tanam: {{ $pohon->tanggal_tanam ? $pohon->tanggal_tanam->format('d M Y') : '-' }}
                                            </span>
                                            @if($pohon->status === 'mati')
                                                <div class="mt-2 text-xs">
                                                    @if($pohon->tindakan_bibit_mati)
                                                        <span class="text-emerald-700 font-semibold">Keputusan Adopter: {{ $pohon->tindakan_bibit_mati === 'ganti' ? 'Lokasi tanam ganti' : 'Lokasi tanam sama' }}</span>
                                                        <span class="text-slate-400">({{ $pohon->tindakan_dikonfirmasi_at->format('d/m/Y') }})</span>
                                                    @else
                                                        <span class="text-amber-700 font-semibold"><i class="fa-solid fa-clock"></i> Menunggu keputusan tindak lanjut dari adopter</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <button onclick="openMonitoringModal({{ $pohon->id }}, '{{ $pohon->lat }}', '{{ $pohon->lng }}')" class="px-3 py-1.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-xl shadow">
                                            + Catat Perkembangan
                                        </button>
                                    </div>

                                    <!-- Riwayat Monitoring -->
                                    @if($pohon->monitorings->isNotEmpty())
                                        <div class="pt-2 border-t border-slate-200 text-xs text-slate-600 space-y-2">
                                            <span class="font-bold text-slate-700 block">Riwayat Perkembangan:</span>
                                            @foreach($pohon->monitorings as $mon)
                                                <div class="p-2.5 bg-white rounded-xl border border-slate-200 flex justify-between items-center">
                                                    <div>
                                                        <span class="font-semibold text-slate-800">{{ $mon->tanggal->format('d/m/Y') }}</span>
                                                        <span class="text-slate-400">| Petugas: {{ $mon->nama_petugas ?? '-' }}</span>
                                                        <div class="mt-1 grid grid-cols-2 gap-x-4 gap-y-0.5 text-[11px]">
                                                            <div>Tinggi: <span class="font-medium text-slate-700">{{ $mon->perkiraan_tinggi ?? ($mon->tinggi_cm ? $mon->tinggi_cm . ' cm' : '-') }}</span></div>
                                                            <div>Daun: <span class="font-medium text-slate-700">{{ $mon->kondisi_daun ?? ($mon->jumlah_daun ? $mon->jumlah_daun . ' helai' : '-') }}</span></div>
                                                            <div>Cabang Baru: <span class="font-medium text-slate-700">{{ $mon->cabang_baru ?? '-' }}</span></div>
                                                            <div>Kerusakan: <span class="font-medium text-slate-700">{{ $mon->kerusakan ?? '-' }}</span></div>
                                                        </div>
                                                        @if($mon->tindakan_bibit_mati)
                                                            <div class="mt-1 text-[11px] text-rose-600 font-bold">Tindakan Bibit Mati: Lokasi tanam {{ $mon->tindakan_bibit_mati }}</div>
                                                        @endif
                                                        <p class="text-slate-500 text-[11px] mt-1 italic">{{ $mon->catatan }}</p>
                                                    </div>
                                                    @if($mon->foto)
                                                        <a href="{{ asset('storage/' . $mon->foto) }}" target="_blank" class="text-sky-600 font-semibold text-[11px] hover:underline">Foto</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Modal Form Monitoring for this Pohon -->
                                <div id="monitoring-modal-{{ $pohon->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
                                    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 text-left space-y-4">
                                        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                                            <h3 class="font-bold text-slate-800 font-title">Catat Perkembangan - {{ $pohon->kode_pohon }}</h3>
                                            <button type="button" onclick="closeMonitoringModal({{ $pohon->id }})" class="text-slate-400 hover:text-slate-600">&times;</button>
                                        </div>

                                        <form action="{{ route('admin.adopsi.monitoring.store', $pohon) }}" method="POST" 
                                              enctype="multipart/form-data" class="space-y-3 text-sm" 
                                              x-data="{ statusHidup: '', tinggiCustom: '' }">
                                            @csrf
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Kode/ID Bibit</label>
                                                <input type="text" value="{{ $pohon->kode_pohon }}" readonly 
                                                       class="w-full border border-slate-300 rounded-xl px-3 py-2 bg-slate-100 font-mono text-xs">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nama Petugas</label>
                                                <input type="text" name="nama_petugas" required value="{{ old('nama_petugas') }}" 
                                                       placeholder="Nama petugas yang memantau" 
                                                       class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Update</label>
                                                <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" 
                                                       class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Status Hidup</label>
                                                <select name="status_pohon" x-model="statusHidup" required 
                                                        class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="hidup">Hidup</option>
                                                    <option value="mati">Mati</option>
                                                    <option value="perlu_penyulaman">Perlu Penyulaman</option>
                                                </select>
                                            </div>
                                            <div class="grid grid-cols-2 gap-3">
                                                <div x-data="{ tinggiMode: '' }">
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Perkiraan Tinggi</label>
                                                    <select x-model="tinggiMode" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="<30 cm">&lt;30 cm</option>
                                                        <option value="30-100 cm">30-100 cm</option>
                                                        <option value=">100 cm">&gt;100 cm</option>
                                                        <option value="custom">Lainnya (isi manual)</option>
                                                    </select>
                                                    <input x-show="tinggiMode === 'custom'" x-model="tinggiCustom" type="text"
                                                           placeholder="Isi manual, contoh: 45 cm"
                                                           class="w-full border border-slate-300 rounded-xl px-3 py-2 mt-2">
                                                    <input type="hidden" name="perkiraan_tinggi" :value="tinggiMode === 'custom' ? tinggiCustom : tinggiMode">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Kondisi Daun</label>
                                                    <select name="kondisi_daun" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Segar">Segar</option>
                                                        <option value="Hijau">Hijau</option>
                                                        <option value="Menguning Sebagian">Menguning Sebagian</option>
                                                        <option value="Layu">Layu</option>
                                                        <option value="Rontok">Rontok</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Cabang Baru</label>
                                                    <select name="cabang_baru" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Ada">Ada</option>
                                                        <option value="Tidak Ada">Tidak Ada</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Kerusakan</label>
                                                    <select name="kerusakan" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Tidak Ada">Tidak Ada</option>
                                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                                        <option value="Rusak Berat">Rusak Berat</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Latitude</label>
                                                    <input type="text" id="lat-{{ $pohon->id }}" name="lat" value="{{ $pohon->lat }}" readonly placeholder="Pilih di peta..." class="w-full border border-slate-300 rounded-xl px-3 py-2 bg-slate-100 font-mono text-xs">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Longitude</label>
                                                    <input type="text" id="lng-{{ $pohon->id }}" name="lng" value="{{ $pohon->lng }}" readonly placeholder="Pilih di peta..." class="w-full border border-slate-300 rounded-xl px-3 py-2 bg-slate-100 font-mono text-xs">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Lokasi Deskriptif (Opsional)</label>
                                                <input type="text" name="lokasi_teks" value="{{ $pohon->lokasi_teks }}" placeholder="Contoh: Dekat gazebo pantai, baris ke-3" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                            </div>

                                            <div>
                                                <div class="flex justify-between items-center mb-1">
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase">Titik Lokasi Peta</label>
                                                    <button type="button" id="btn-geo-{{ $pohon->id }}" onclick="useCurrentLocation({{ $pohon->id }})" class="text-xs font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1">
                                                        <i class="fa-solid fa-location-crosshairs"></i> Gunakan Lokasi Saat Ini
                                                    </button>
                                                </div>
                                                <div id="mini-map-{{ $pohon->id }}" class="mini-map"></div>
                                                <p class="text-[10px] text-slate-400 mt-1 italic">Klik titik pada peta di atas untuk memindahkan pin lokasi secara manual.</p>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Penanaman (jika baru ditanam)</label>
                                                <input type="date" name="tanggal_tanam" value="{{ $pohon->tanggal_tanam ? $pohon->tanggal_tanam->format('Y-m-d') : date('Y-m-d') }}" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Foto Perkembangan (Dokumentasi)</label>
                                                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Catatan Perkembangan</label>
                                                <textarea name="catatan" rows="2" placeholder="Catatan kondisi pohon..." 
                                                          class="w-full border border-slate-300 rounded-xl px-3 py-2"></textarea>
                                            </div>

                                            <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                                                <button type="button" onclick="closeMonitoringModal({{ $pohon->id }})" 
                                                        class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl">Batal</button>
                                                <button type="submit" class="px-4 py-2 bg-sky-600 text-white font-bold rounded-xl shadow">
                                                    Simpan & Konfirmasi
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak Pembayaran -->
<div id="tolak-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-left space-y-4">
        <h3 class="font-bold text-slate-800 text-lg font-title">Tolak Pembayaran Adopsi</h3>
        <form action="{{ route('admin.adopsi.tolak', $adopsi) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Alasan Penolakan</label>
                <textarea name="catatan_admin" required rows="3" class="w-full border border-slate-300 rounded-xl p-3 text-sm" placeholder="Contoh: Bukti transfer tidak terbaca / nominal tidak sesuai."></textarea>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('tolak-modal').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-rose-600 text-white font-bold rounded-xl text-sm">Tolak Pesanan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    .mini-map {
        height: 200px;
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 0.75rem;
        margin-top: 0.5rem;
        z-index: 10;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    let maps = {};
    let markers = {};

    function openMonitoringModal(pohonId, savedLat, savedLng) {
        const modal = document.getElementById('monitoring-modal-' + pohonId);
        if (!modal) return;
        
        modal.classList.remove('hidden');
        
        const mapContainerId = 'mini-map-' + pohonId;
        const latInput = document.getElementById('lat-' + pohonId);
        const lngInput = document.getElementById('lng-' + pohonId);
        
        const defaultLat = -6.685363;
        const defaultLng = 111.385750;
        
        const initialLat = savedLat ? parseFloat(savedLat) : (latInput.value ? parseFloat(latInput.value) : defaultLat);
        const initialLng = savedLng ? parseFloat(savedLng) : (lngInput.value ? parseFloat(lngInput.value) : defaultLng);
        const hasLocation = !!(savedLat || latInput.value);
        
        if (!maps[pohonId]) {
            setTimeout(function() {
                const map = L.map(mapContainerId).setView([initialLat, initialLng], hasLocation ? 16 : 14);
                const streetLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ'
                });
                const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
                });
                satelliteLayer.addTo(map);
                L.control.layers({ 'Peta Jalan': streetLayer, 'Foto Satelit': satelliteLayer }).addTo(map);
                
                maps[pohonId] = map;
                
                let marker;
                if (hasLocation) {
                    marker = L.marker([initialLat, initialLng]).addTo(map);
                    markers[pohonId] = marker;
                }
                
                map.on('click', function(e) {
                    const clickLat = e.latlng.lat.toFixed(7);
                    const clickLng = e.latlng.lng.toFixed(7);
                    
                    latInput.value = clickLat;
                    lngInput.value = clickLng;
                    
                    if (markers[pohonId]) {
                        markers[pohonId].setLatLng(e.latlng);
                    } else {
                        markers[pohonId] = L.marker(e.latlng).addTo(map);
                    }
                });
            }, 100);
        } else {
            setTimeout(function() {
                maps[pohonId].invalidateSize();
                if (hasLocation) {
                    maps[pohonId].setView([initialLat, initialLng], 16);
                    if (markers[pohonId]) {
                        markers[pohonId].setLatLng([initialLat, initialLng]);
                    } else {
                        markers[pohonId] = L.marker([initialLat, initialLng]).addTo(maps[pohonId]);
                    }
                } else {
                    maps[pohonId].setView([initialLat, initialLng], 14);
                }
            }, 100);
        }
    }

    function closeMonitoringModal(pohonId) {
        const modal = document.getElementById('monitoring-modal-' + pohonId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function useCurrentLocation(pohonId) {
        const latInput = document.getElementById('lat-' + pohonId);
        const lngInput = document.getElementById('lng-' + pohonId);
        const btn = document.getElementById('btn-geo-' + pohonId);
        
        if (!navigator.geolocation) {
            alert("Browser Anda tidak mendukung Geolocation.");
            return;
        }
        
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Mendapatkan Lokasi...';
        
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const currentLat = position.coords.latitude.toFixed(7);
                const currentLng = position.coords.longitude.toFixed(7);
                
                latInput.value = currentLat;
                lngInput.value = currentLng;
                
                const latlng = [currentLat, currentLng];
                
                if (maps[pohonId]) {
                    maps[pohonId].setView(latlng, 17);
                    if (markers[pohonId]) {
                        markers[pohonId].setLatLng(latlng);
                    } else {
                        markers[pohonId] = L.marker(latlng).addTo(maps[pohonId]);
                    }
                }
                
                btn.disabled = false;
                btn.innerHTML = originalText;
            },
            function(error) {
                alert("Gagal mendapatkan lokasi: " + error.message);
                btn.disabled = false;
                btn.innerHTML = originalText;
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    }
</script>
@endpush

