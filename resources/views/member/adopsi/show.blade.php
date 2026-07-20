@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-[80vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 bg-gradient-to-r from-emerald-800 to-slate-900 text-white flex justify-between items-center">
                <div>
                    <span class="text-emerald-400 text-xs uppercase font-semibold tracking-wider">Detail Transaksi Adopsi</span>
                    <h1 class="text-2xl font-bold font-heading mt-1">{{ $adopsi->kode_transaksi }}</h1>
                </div>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white/20 text-white border border-white/30">
                    {{ str_replace('_', ' ', ucfirst($adopsi->status)) }}
                </span>
            </div>

            <div class="p-8 space-y-6">
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-emerald-800 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Paket Adopsi</span>
                        <span class="font-bold text-slate-800 text-lg block">{{ $adopsi->paket->nama }}</span>

                        <span class="text-xs text-slate-400 uppercase tracking-wider block mt-4">Nama Pemesan</span>
                        <span class="font-medium text-slate-800 block">{{ $adopsi->nama_pemesan }}</span>

                        <span class="text-xs text-slate-400 uppercase tracking-wider block mt-4">Nama pada Sertifikat</span>
                        <span class="font-medium text-slate-800 block">{{ $adopsi->nama_sertifikat }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Total Pembayaran</span>
                        <span class="font-bold text-emerald-700 text-2xl block">Rp {{ number_format($adopsi->total_harga) }}</span>

                        <span class="text-xs text-slate-400 uppercase tracking-wider block mt-4">Waktu Pemesanan</span>
                        <span class="text-sm text-slate-600 block">{{ $adopsi->created_at->format('d M Y H:i') }}</span>

                        @if($adopsi->catatan_admin)
                            <div class="mt-4 p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800">
                                <strong>Catatan Tim Pengelola:</strong> {{ $adopsi->catatan_admin }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Daftar Pohon Hasil Adopsi Ini -->
                <div class="pt-6 border-t border-slate-100">
                    <h3 class="font-bold text-slate-800 text-lg mb-4">Daftar Pohon Cemara Dihasilkan ({{ $adopsi->pohons->count() }})</h3>

                    @if($adopsi->pohons->isEmpty())
                        <p class="text-slate-500 text-sm">Kode pohon unik akan dibuat otomatis oleh admin setelah pembayaran diverifikasi.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($adopsi->pohons as $pohon)
                                <div class="p-4 border border-slate-200 rounded-xl bg-slate-50 flex justify-between items-center">
                                    <div>
                                        <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded">{{ $pohon->kode_pohon }}</span>
                                        <span class="block text-xs text-slate-500 mt-1">Status: {{ ucfirst($pohon->status) }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('member.pohon.sertifikat', $pohon) }}" class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-semibold rounded-lg shadow hover:bg-emerald-700">
                                            Sertifikat
                                        </a>
                                        <a href="{{ route('member.pohon.sertifikat.download', $pohon) }}" class="px-2.5 py-1.5 bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg hover:bg-slate-300" title="Unduh File Word (.doc)">
                                            <i class="fa-solid fa-file-word"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <a href="{{ route('member.adopsi.dashboard') }}" class="px-6 py-2.5 bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm hover:bg-slate-300">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
