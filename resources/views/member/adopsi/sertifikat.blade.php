@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-100 min-h-[90vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Action bar -->
        <div class="flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
            <a href="{{ route('member.adopsi.dashboard') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('member.pohon.sertifikat.download', $pohon) }}" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-emerald-600/30 transition flex items-center gap-2">
                <i class="fa-solid fa-file-word"></i> Unduh Dokumen (.doc)
            </a>
        </div>

        <!-- Certificate View Canvas -->
        <div class="bg-white p-10 md:p-16 rounded-3xl shadow-2xl border-8 border-emerald-900 relative overflow-hidden text-center">
            <div class="absolute -top-16 -right-16 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl"></div>

            <div class="border-2 border-emerald-600/30 p-8 md:p-12 rounded-2xl relative z-10">
                <!-- Header -->
                <div class="w-16 h-16 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                    <i class="fa-solid fa-award"></i>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold font-heading text-emerald-950 tracking-wider uppercase">SERTIFIKAT ADOPSI POHON</h1>
                <p class="text-emerald-700 text-sm md:text-base font-semibold mt-2 tracking-wide uppercase">My Cemara &mdash; Pantai Karangjahe, Desa Punjulharjo</p>

                <div class="my-8 w-24 h-1 bg-gradient-to-r from-emerald-400 via-emerald-600 to-emerald-400 mx-auto rounded-full"></div>

                <!-- Recipient -->
                <p class="text-slate-500 text-sm uppercase tracking-widest font-sans">Sertifikat Penghargaan Ini Diberikan Kepada:</p>
                <h2 class="text-2xl md:text-4xl font-bold font-heading text-slate-800 my-4 underline decoration-emerald-500 decoration-2 underline-offset-8">
                    {{ $pohon->nama_sertifikat }}
                </h2>

                <p class="text-slate-600 text-sm md:text-base max-w-2xl mx-auto leading-relaxed mt-4">
                    Atas kontribusi aktif dalam pelestarian dan penghijauan kawasan pesisir melalui adopsi bibit <span class="font-semibold text-emerald-800 font-sans">Cemara Laut (<em>Casuarina equisetifolia</em>)</span> di Pantai Karangjahe.
                </p>

                <!-- Metadata Tree Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8 p-4 bg-emerald-50/60 rounded-2xl border border-emerald-100 text-left text-xs text-slate-700">
                    <div>
                        <span class="text-slate-400 block uppercase font-bold text-[10px]">Kode Pohon Unik</span>
                        <span class="font-mono font-bold text-emerald-800 text-sm">{{ $pohon->kode_pohon }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block uppercase font-bold text-[10px]">Status Tanam</span>
                        <span class="font-semibold text-slate-800 text-sm">{{ ucfirst($pohon->status) }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block uppercase font-bold text-[10px]">Tanggal Penanaman</span>
                        <span class="font-semibold text-slate-800 text-sm">{{ $pohon->tanggal_tanam ? $pohon->tanggal_tanam->format('d M Y') : 'Dalam Pengawasan' }}</span>
                    </div>
                </div>

                <!-- Footer Signatures -->
                <div class="mt-12 flex justify-around items-end pt-6 border-t border-slate-200/60 text-center text-xs text-slate-600">
                    <div>
                        <div class="h-12 flex items-center justify-center font-serif text-emerald-800 font-bold text-base">Tim Pengelola Pesisir</div>
                        <div class="border-t border-slate-300 pt-1 font-semibold text-slate-800">Pokdarwis Karangjahe</div>
                    </div>
                    <div>
                        <div class="h-12 flex items-center justify-center font-serif text-emerald-800 font-bold text-base">Desa Punjulharjo</div>
                        <div class="border-t border-slate-300 pt-1 font-semibold text-slate-800">Pemerintah Desa</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
