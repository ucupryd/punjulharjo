@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-[80vh]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 bg-gradient-to-r from-emerald-800 to-slate-900 text-white">
                <span class="text-emerald-400 text-xs uppercase font-semibold tracking-wider">Form Pengajuan Adopsi</span>
                <h1 class="text-2xl font-bold font-heading mt-1">{{ $paket->nama }}</h1>
                <p class="text-slate-300 text-xs mt-1">Harga: Rp {{ number_format($paket->harga) }} per paket ({{ $paket->jumlah_bibit }} pohon)</p>
            </div>

            <form action="{{ route('member.adopsi.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" required value="{{ old('nama_pemesan', auth()->user()->name) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nama pada Sertifikat</label>
                    <input type="text" name="nama_sertifikat" required value="{{ old('nama_sertifikat', auth()->user()->name) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                           placeholder="Nama yang dicantumkan pada sertifikat digital">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nomor WhatsApp / Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                           placeholder="08123456789">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Jumlah Paket</label>
                    <input type="number" name="jumlah" min="1" max="50" value="1" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="pt-4 border-t border-slate-100 flex gap-4">
                    <button type="submit" class="flex-1 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition">
                        Lanjut ke Pembayaran <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                    <a href="{{ route('adopsi.index') }}" class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
