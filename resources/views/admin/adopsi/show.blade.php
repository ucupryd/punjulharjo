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
                            <span class="font-semibold text-slate-800">{{ $adopsi->paket->nama }} ({{ $adopsi->jumlah }}x)</span>
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
                                            <span class="text-xs text-slate-500 block mt-1">Status: {{ ucfirst($pohon->status) }} | Tanam: {{ $pohon->tanggal_tanam ? $pohon->tanggal_tanam->format('d M Y') : '-' }}</span>
                                        </div>
                                        <button onclick="document.getElementById('monitoring-modal-{{ $pohon->id }}').classList.remove('hidden')" class="px-3 py-1.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-xl shadow">
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
                                                        <span class="font-semibold text-slate-800">{{ $mon->tanggal->format('d/m/Y') }}</span>: 
                                                        Tinggi {{ $mon->tinggi_cm ?? '-' }} cm, Daun: {{ $mon->jumlah_daun ?? '-' }} helai.
                                                        <p class="text-slate-500 text-[11px] italic">{{ $mon->catatan }}</p>
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
                                    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 text-left space-y-4">
                                        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                                            <h3 class="font-bold text-slate-800 font-title">Catat Perkembangan - {{ $pohon->kode_pohon }}</h3>
                                            <button type="button" onclick="document.getElementById('monitoring-modal-{{ $pohon->id }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">&times;</button>
                                        </div>

                                        <form action="{{ route('admin.adopsi.monitoring.store', $pohon) }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
                                            @csrf
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Pantau</label>
                                                <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                            </div>

                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tinggi (cm)</label>
                                                    <input type="number" name="tinggi_cm" min="0" placeholder="contoh: 45" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Jumlah Daun</label>
                                                    <input type="number" name="jumlah_daun" min="0" placeholder="contoh: 120" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Status Pohon</label>
                                                <select name="status_pohon" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                                    <option value="ditanam" {{ $pohon->status == 'ditanam' ? 'selected' : '' }}>Ditanam</option>
                                                    <option value="tumbuh" {{ $pohon->status == 'tumbuh' ? 'selected' : '' }}>Tumbuh Subur</option>
                                                    <option value="mati" {{ $pohon->status == 'mati' ? 'selected' : '' }}>Mati / Perlu Sulam</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Penanaman (jika baru ditanam)</label>
                                                <input type="date" name="tanggal_tanam" value="{{ $pohon->tanggal_tanam ? $pohon->tanggal_tanam->format('Y-m-d') : date('Y-m-d') }}" class="w-full border border-slate-300 rounded-xl px-3 py-2">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Foto Perkembangan</label>
                                                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Catatan Perkembangan</label>
                                                <textarea name="catatan" rows="2" placeholder="Catatan kondisi pohon..." class="w-full border border-slate-300 rounded-xl px-3 py-2"></textarea>
                                            </div>

                                            <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                                                <button type="button" onclick="document.getElementById('monitoring-modal-{{ $pohon->id }}').classList.add('hidden')" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl">Batal</button>
                                                <button type="submit" class="px-4 py-2 bg-sky-600 text-white font-bold rounded-xl shadow">Simpan</button>
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
