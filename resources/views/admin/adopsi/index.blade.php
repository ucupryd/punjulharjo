@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kelola Pesisir</span>
                <h1 class="text-2xl font-bold text-slate-800 font-title mt-0.5">🌲 Daftar Adopsi Pohon Cemara</h1>
                <p class="text-slate-500 text-sm mt-1">Verifikasi pembayaran transfer member & pantau perkembangan pohon cemara pesisir.</p>
            </div>
            <div class="flex gap-3">
                <span class="px-4 py-2 bg-sky-100 text-sky-800 font-bold rounded-xl text-sm">
                    Terverifikasi: {{ number_format($totalDiverifikasi) }}
                </span>
                <span class="px-4 py-2 bg-amber-100 text-amber-800 font-bold rounded-xl text-sm">
                    Perlu Verifikasi: {{ number_format($totalMenungguVerifikasi) }}
                </span>
            </div>
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

        <!-- Filter Tab -->
        <div class="flex gap-2 border-b border-slate-200 pb-2 text-sm font-semibold">
            <a href="{{ route('admin.adopsi.index') }}" class="px-4 py-2 rounded-xl {{ !$status ? 'bg-sky-700 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Semua</a>
            <a href="{{ route('admin.adopsi.index', ['status' => 'menunggu_verifikasi']) }}" class="px-4 py-2 rounded-xl {{ $status == 'menunggu_verifikasi' ? 'bg-amber-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Menunggu Verifikasi</a>
            <a href="{{ route('admin.adopsi.index', ['status' => 'diverifikasi']) }}" class="px-4 py-2 rounded-xl {{ $status == 'diverifikasi' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Diverifikasi</a>
            <a href="{{ route('admin.adopsi.index', ['status' => 'ditolak']) }}" class="px-4 py-2 rounded-xl {{ $status == 'ditolak' ? 'bg-rose-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Ditolak</a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs border-b border-slate-200">
                        <tr>
                            <th class="p-4">Kode Transaksi</th>
                            <th class="p-4">Member / Pemesan</th>
                            <th class="p-4">Nama Sertifikat</th>
                            <th class="p-4">Paket</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($adopsis as $adopsi)
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-mono font-bold text-slate-800">{{ $adopsi->kode_transaksi }}</td>
                                <td class="p-4">
                                    <span class="font-semibold text-slate-800 block">{{ $adopsi->nama_pemesan }}</span>
                                    <span class="text-xs text-slate-400 block">{{ $adopsi->telepon ?? '-' }}</span>
                                </td>
                                <td class="p-4 font-medium text-slate-700">{{ $adopsi->nama_sertifikat }}</td>
                                <td class="p-4">{{ $adopsi->paket->nama ?? '-' }} ({{ $adopsi->jumlah }}x)</td>
                                <td class="p-4 font-bold text-emerald-700">Rp {{ number_format($adopsi->total_harga) }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                        @if($adopsi->status == 'diverifikasi' || $adopsi->status == 'ditanam' || $adopsi->status == 'selesai') bg-emerald-100 text-emerald-800 
                                        @elseif($adopsi->status == 'menunggu_verifikasi') bg-amber-100 text-amber-800 
                                        @elseif($adopsi->status == 'ditolak') bg-rose-100 text-rose-800 
                                        @else bg-slate-100 text-slate-700 @endif">
                                        {{ str_replace('_', ' ', ucfirst($adopsi->status)) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('admin.adopsi.show', $adopsi) }}" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-xl shadow">
                                        Kelola & Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">Belum ada transaksi adopsi ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $adopsis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
