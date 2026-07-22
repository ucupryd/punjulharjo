@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-sky-800 via-sky-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-sky-500/20 text-sky-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-sky-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">🛡️ Pusat Moderasi & Kelola Situs</h1>
                <p class="text-slate-300 text-sm mt-1">Peninjauan adopsi cemara, kesan pengunjung, pesan masuk, dan pintasan cepat kelola konten desa.</p>
            </div>
            <a href="{{ url('/') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm">
                <i class="fa-solid fa-globe"></i> Lihat Beranda Situs
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-xl text-sm shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tab Moderasi -->
        <div x-data="{ tab: '{{ $activeTab }}' }" class="space-y-6">
            <div class="flex border-b border-slate-200 space-x-2 text-sm font-semibold bg-white p-2 rounded-xl shadow-sm border border-slate-200 overflow-x-auto">
                <button @click="tab = 'adopsi'" :class="tab === 'adopsi' ? 'bg-sky-700 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-5 py-2.5 rounded-lg transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-tree"></i> Verifikasi Adopsi Pohon
                    @if($pendingAdopsis->count() > 0)
                        <span class="bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingAdopsis->count() }}</span>
                    @endif
                </button>
                <button @click="tab = 'testimoni'" :class="tab === 'testimoni' ? 'bg-sky-700 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-5 py-2.5 rounded-lg transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-comments"></i> Kesan / Testimoni
                    @if($pendingTestimonials->count() > 0)
                        <span class="bg-amber-400 text-slate-900 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingTestimonials->count() }}</span>
                    @endif
                </button>
                <button @click="tab = 'pesan'" :class="tab === 'pesan' ? 'bg-sky-700 text-white shadow' : 'text-slate-600 hover:bg-slate-100'" class="px-5 py-2.5 rounded-lg transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-envelope"></i> Pesan Masuk Kontak
                    @php $unread = $messages->filter(fn($m) => !$m->is_read)->count(); @endphp
                    @if($unread > 0)
                        <span class="bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unread }}</span>
                    @endif
                </button>
            </div>

            <!-- TAB 1: VERIFIKASI ADOPSI -->
            <div x-show="tab === 'adopsi'" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                    <h3 class="font-bold text-slate-800 text-lg font-title">Verifikasi Pembayaran Adopsi Pohon Cemara</h3>
                    <a href="{{ route('admin.adopsi.index') }}" class="text-xs text-sky-600 font-semibold hover:underline">Lihat Semua Adopsi &rarr;</a>
                </div>

                @if($pendingAdopsis->isEmpty())
                    <p class="text-slate-400 text-sm py-6 text-center">Tidak ada pembayaran adopsi yang menunggu verifikasi saat ini.</p>
                @else
                    <div class="divide-y divide-slate-100 space-y-4">
                        @foreach($pendingAdopsis as $adopsi)
                            <div class="pt-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <span class="font-mono font-bold text-emerald-800 bg-emerald-100 px-2.5 py-0.5 rounded text-xs">{{ $adopsi->kode_transaksi }}</span>
                                    <h4 class="font-bold text-slate-800 text-base mt-1">{{ $adopsi->nama_pemesan }} ({{ $adopsi->paket->nama }})</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Total: <strong class="text-emerald-700">Rp {{ number_format($adopsi->total_harga) }}</strong> | Sertifikat: {{ $adopsi->nama_sertifikat }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.adopsi.show', $adopsi) }}" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-lg shadow">
                                        Lihat Bukti Transfer & Verifikasi &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- TAB 2: MODERASI TESTIMONI / KESAN (DENGAN GAMBAR FOTO) -->
            <div x-show="tab === 'testimoni'" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
                <h3 class="font-bold text-slate-800 text-lg font-title">Moderasi Kesan & Testimoni Pengunjung</h3>

                @if($pendingTestimonials->isEmpty())
                    <p class="text-slate-400 text-sm py-6 text-center">Tidak ada testimoni pending yang perlu disetujui saat ini.</p>
                @else
                    <div class="divide-y divide-slate-100 space-y-4">
                        @foreach($pendingTestimonials as $item)
                            <div class="pt-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div class="flex items-start gap-4">
                                    @if($item->photo_path)
                                        <a href="{{ asset('storage/' . $item->photo_path) }}" target="_blank" class="shrink-0">
                                            <img src="{{ asset('storage/' . $item->photo_path) }}" class="w-16 h-16 object-cover rounded-lg border border-slate-200 shadow-sm hover:opacity-90 transition" alt="{{ $item->name }}">
                                        </a>
                                    @else
                                        <div class="w-12 h-12 bg-slate-100 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 text-lg shrink-0">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-slate-800">{{ $item->name }}</span>
                                            <span class="text-xs text-slate-400">({{ $item->origin_city ?? 'Pengunjung' }})</span>
                                            <span class="text-amber-500 text-xs font-bold">★ {{ $item->rating }}/5</span>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-0.5">Destinasi: <strong>{{ $item->favorite_destination ?? 'Pantai Karangjahe' }}</strong> | Kata: <em>"{{ $item->one_word }}"</em></p>
                                        <p class="text-sm text-slate-700 mt-1 italic">"{{ $item->review ?? $item->comment }}"</p>
                                        <span class="text-[11px] text-slate-400 mt-1 block">{{ $item->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-2 shrink-0">
                                    <form action="{{ route('admin.testimoni.approve', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow">
                                            <i class="fa-solid fa-check mr-1"></i> Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow">
                                            <i class="fa-solid fa-xmark mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- TAB 3: PESAN MASUK KONTAK (DENGAN AKSI TANDAI DIBACA) -->
            <div x-show="tab === 'pesan'" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                    <h3 class="font-bold text-slate-800 text-lg font-title">Pesan Masuk dari Formulir Kontak</h3>
                    @if($messages->where('is_read', false)->count() > 0)
                        <form action="{{ route('admin.pesan.read-all') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg border border-slate-200 flex items-center gap-1.5">
                                <i class="fa-solid fa-check-double text-sky-600"></i> Tandai Semua Dibaca
                            </button>
                        </form>
                    @endif
                </div>

                @if($messages->isEmpty())
                    <p class="text-slate-400 text-sm py-6 text-center">Belum ada pesan masuk.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                                <tr>
                                    <th class="p-3">Pengirim</th>
                                    <th class="p-3">Subjek</th>
                                    <th class="p-3">Pesan</th>
                                    <th class="p-3">Tanggal</th>
                                    <th class="p-3 text-center">Status / Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($messages as $msg)
                                    <tr class="hover:bg-slate-50 {{ !$msg->is_read ? 'bg-sky-50/40 font-semibold' : '' }}">
                                        <td class="p-3">
                                            <span class="font-bold text-slate-800 block">{{ $msg->name }}</span>
                                            <span class="text-xs text-slate-400 font-normal">{{ $msg->email }}</span>
                                        </td>
                                        <td class="p-3 text-slate-700">{{ $msg->subject ?? '-' }}</td>
                                        <td class="p-3 text-xs text-slate-600 max-w-md font-normal">{{ $msg->message }}</td>
                                        <td class="p-3 text-xs text-slate-400 font-normal whitespace-nowrap">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            @if(!$msg->is_read)
                                                <form action="{{ route('admin.pesan.read', $msg->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-2.5 py-1.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-lg shadow-sm transition flex items-center gap-1 mx-auto">
                                                        <i class="fa-solid fa-check"></i> Tandai Dibaca
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-slate-400 font-normal flex items-center justify-center gap-1">
                                                    <i class="fa-solid fa-circle-check text-emerald-500"></i> Dibaca
                                                </span>
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
</div>
@endsection
