@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-[80vh]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 bg-gradient-to-r from-emerald-800 to-slate-900 text-white">
                <span class="text-emerald-400 text-xs uppercase font-semibold tracking-wider">Instruksi Pembayaran Transfer</span>
                <h1 class="text-2xl font-bold font-heading mt-1">Kode Transaksi: {{ $adopsi->kode_transaksi }}</h1>
                <p class="text-slate-300 text-sm mt-1">Paket: {{ $adopsi->paket->nama }} ({{ $adopsi->jumlah }}x)</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Total Tagihan -->
                <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-200 text-center">
                    <span class="text-xs text-emerald-800 uppercase tracking-wider font-semibold block">Total Tagihan Transfer</span>
                    <span class="text-4xl font-extrabold text-emerald-700 font-heading block mt-1">Rp {{ number_format($adopsi->total_harga) }}</span>
                </div>

                <!-- Rekening Tujuan -->
                <div class="space-y-4">
                    <h3 class="font-bold text-slate-800 text-base">Rekening Tujuan Pembayaran Desa:</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                            <span class="text-xs font-bold text-slate-500 uppercase block">Bank BRI (BUMDes Punjulharjo)</span>
                            <span class="text-lg font-mono font-bold text-slate-800 block mt-1">0123-01-045678-50-9</span>
                            <span class="text-xs text-slate-500 block mt-1">a.n BUMDes Karangjahe Punjulharjo</span>
                        </div>
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                            <span class="text-xs font-bold text-slate-500 uppercase block">QRIS Statis Desa Wisata</span>
                            <span class="text-sm text-slate-600 block mt-1">Pindai kode QRIS di kasir/pos pengelolaan Pantai Karangjahe</span>
                        </div>
                    </div>
                </div>

                <!-- Upload Bukti Form -->
                <form action="{{ route('member.adopsi.bayar.upload', $adopsi) }}" method="POST" enctype="multipart/form-data" class="pt-6 border-t border-slate-100 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Unggah Foto Bukti Transfer</label>
                        <input type="file" name="bukti_bayar" required accept="image/*"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200">
                        <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maksimal: 3MB.</p>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition">
                        <i class="fa-solid fa-upload mr-2"></i> Unggah Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
