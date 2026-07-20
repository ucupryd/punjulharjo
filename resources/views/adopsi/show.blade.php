@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-[70vh]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 bg-gradient-to-r from-emerald-800 to-slate-900 text-white">
                <span class="text-emerald-400 font-semibold text-xs uppercase tracking-wider">Detail Paket Adopsi</span>
                <h1 class="text-3xl font-bold font-heading mt-1">{{ $paket->nama }}</h1>
                <p class="text-slate-300 text-sm mt-2">{{ $paket->deskripsi }}</p>
            </div>

            <div class="p-8 space-y-6">
                <div class="flex justify-between items-center pb-6 border-b border-slate-100">
                    <div>
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Harga Paket</span>
                        <span class="text-3xl font-bold text-emerald-700 font-heading">Rp {{ number_format($paket->harga) }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Jumlah Bibit</span>
                        <span class="text-xl font-bold text-slate-800">{{ $paket->jumlah_bibit }} Pohon</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-bold text-slate-800 text-base">Fasilitas & Layanan yang Diterima:</h3>
                    <ul class="space-y-3 text-slate-600 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-seedling text-emerald-600 mt-1"></i>
                            <span>Bibit tanaman Cemara Laut (<em>Casuarina equisetifolia</em>) pilihan berkualitas tinggi.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-hands-holding-circle text-emerald-600 mt-1"></i>
                            <span>Penanaman & perawatan profesional oleh kelompok pengelola pesisir Desa Punjulharjo.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-award text-emerald-600 mt-1"></i>
                            <span>Sertifikat Digital Penghargaan atas nama Anda / penerima yang dapat diunduh (PDF / Word).</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-qrcode text-emerald-600 mt-1"></i>
                            <span>Kode penanda pohon unik untuk pemantauan perkembangan secara berkala.</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-6 border-t border-slate-100 flex gap-4">
                    @auth
                        @if(auth()->user()->isMember())
                            <a href="{{ route('member.adopsi.create', $paket) }}" class="flex-1 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white text-center font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition">
                                Lanjutkan ke Pemesanan
                            </a>
                        @else
                            <a href="{{ route('admin.adopsi.index') }}" class="flex-1 py-3.5 bg-slate-800 text-white text-center font-bold rounded-xl">
                                Kelola di Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('member.register') }}" class="flex-1 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white text-center font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition">
                            Daftar Member untuk Mengadopsi
                        </a>
                    @endauth
                    <a href="{{ route('adopsi.index') }}" class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
