@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-800 via-emerald-900 to-slate-900 rounded-xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-500/30">Halaman Khusus Admin</span>
                <h1 class="text-2xl md:text-3xl font-bold font-title mt-2">🌱 Kelola Tim ProKlim</h1>
                <p class="text-slate-300 text-sm mt-1">Mengatur jajaran anggota tim ProKlim, peran, foto profil, dan urutan penampilan di halaman My Cemara.</p>
            </div>
            <a href="{{ route('adopsi.index') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition flex items-center gap-2 text-sm shrink-0">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman My Cemara
            </a>
        </div>

        <!-- Action Card -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pintasan Manajemen</span>
                <h2 class="text-lg font-bold text-slate-800 font-title mt-0.5">Daftar Anggota Tim</h2>
            </div>
            <div>
                <a href="{{ route('admin.tim-proklim.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition shadow">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Anggota
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-sm text-emerald-800 shadow-sm flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            @if($tim->isEmpty())
                <div class="text-center text-slate-500 py-16 px-4">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 text-xl mb-3">
                        <i class="fa-solid fa-user-slash"></i>
                    </div>
                    <p class="text-sm font-medium">Belum ada data anggota tim ProKlim. Silakan tambahkan anggota pertama.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-left">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-20">Foto</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider">Nama Anggota</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider">Peran</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider w-28">Urutan</th>
                                <th class="px-6 py-4 font-semibold text-slate-600 uppercase text-xs tracking-wider text-right w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($tim as $t)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4">
                                        @if($t->foto)
                                            <img src="{{ (str_starts_with($t->foto, 'http') || str_contains($t->foto, 'storage/')) ? asset($t->foto) : Storage::url($t->foto) }}" 
                                                 class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm" 
                                                 alt="Foto {{ $t->nama }}">
                                        @else
                                            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-sm font-bold border border-slate-200">
                                                <i class="fa-solid fa-user-tie text-base"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-slate-800">
                                        {{ $t->nama }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $t->peran }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-800">
                                            {{ $t->urutan }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.tim-proklim.edit', $t->id) }}"
                                               class="inline-flex items-center justify-center min-h-[38px] min-w-[38px] px-3 py-2 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-600 rounded-xl text-xs font-semibold transition"
                                               title="Edit {{ $t->nama }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.tim-proklim.destroy', $t->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus data anggota tim {{ $t->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center min-h-[38px] min-w-[38px] px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-xs font-semibold transition"
                                                        title="Hapus {{ $t->nama }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
