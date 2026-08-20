@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-[80vh]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 bg-gradient-to-r from-emerald-800 to-slate-900 text-white">
                <span class="text-emerald-400 text-xs uppercase font-semibold tracking-wider">Form Pengajuan Adopsi</span>
                <h1 class="text-2xl font-bold font-heading mt-1">{{ $paket->nama }}</h1>
                @if($paket->is_donasi)
                    <p class="text-slate-300 text-xs mt-1">Nominal Bebas (Jumlah pohon dikonversi oleh admin)</p>
                @else
                    <p class="text-slate-300 text-xs mt-1">Harga: Rp {{ number_format($paket->harga) }} per paket ({{ $paket->jumlah_bibit }} pohon)</p>
                @endif
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
                    <input type="text" name="telepon" required value="{{ old('telepon', auth()->user()->telepon) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                           placeholder="Contoh: 081234567890">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Alamat Email Aktif</label>
                    <input type="email" name="email_aktif" required value="{{ old('email_aktif', auth()->user()->email) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div x-data="{ statusPemesan: '{{ old('status_pemesan', 'Perorangan') }}' }">
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Status Pemesan</label>
                    <select name="status_pemesan" x-model="statusPemesan" required
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="Perorangan">Perorangan</option>
                        <option value="Sekolah">Sekolah</option>
                        <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                        <option value="Perusahaan Swasta">Perusahaan Swasta</option>
                        <option value="Perusahaan Daerah">Perusahaan Daerah</option>
                        <option value="Perusahaan Negara">Perusahaan Negara</option>
                        <option value="Lembaga Organisasi">Lembaga Organisasi</option>
                        <option value="Instansi Pemerintah">Instansi Pemerintah</option>
                    </select>
                    <div x-show="statusPemesan !== 'Perorangan'" x-transition class="mt-3">
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nama Institusi/Lembaga</label>
                        <input type="text" name="nama_institusi" :required="statusPemesan !== 'Perorangan'" value="{{ old('nama_institusi') }}"
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                               placeholder="Nama sekolah, perusahaan, instansi, dll">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Alamat Domisili</label>
                    <input type="text" name="alamat_domisili" required value="{{ old('alamat_domisili', auth()->user()->alamat_domisili) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                           placeholder="Contoh: Ds. Punjulharjo, Kec. Rembang">
                </div>

                @if($paket->is_donasi)
                    <div x-data="{
                        nominalRaw: '{{ old('nominal_donasi') }}',
                        nominalDisplay: '{{ old('nominal_donasi') ? 'Rp ' . number_format((float)old('nominal_donasi'), 0, ',', '.') : '' }}',
                        formatNominal(event) {
                            let raw = event.target.value.replace(/[^0-9]/g, '');
                            this.nominalRaw = raw;
                            this.nominalDisplay = raw ? 'Rp ' + Number(raw).toLocaleString('id-ID') : '';
                        },
                        setNominalSaran(val) {
                            this.nominalRaw = val.toString();
                            this.nominalDisplay = 'Rp ' + Number(val).toLocaleString('id-ID');
                        }
                    }">
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nominal Donasi</label>
                        <input type="text" inputmode="numeric" 
                               x-model="nominalDisplay" 
                               @input="formatNominal($event)"
                               placeholder="Rp 0" required
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('nominal_donasi') border-rose-500 @enderror">
                        <input type="hidden" name="nominal_donasi" :value="nominalRaw">
                        @error('nominal_donasi')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div class="flex flex-wrap gap-2 mt-2">
                            <button type="button" @click="setNominalSaran(50000)" class="px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold rounded-xl border border-emerald-200 transition">Rp50.000</button>
                            <button type="button" @click="setNominalSaran(100000)" class="px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold rounded-xl border border-emerald-200 transition">Rp100.000</button>
                            <button type="button" @click="setNominalSaran(200000)" class="px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold rounded-xl border border-emerald-200 transition">Rp200.000</button>
                        </div>
                        <p class="text-xs text-slate-400 mt-1.5">Nominal boleh diisi bebas (minimal Rp10.000), tombol di atas hanya saran.</p>
                    </div>
                @else
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Jumlah Paket</label>
                        <input type="number" name="jumlah" min="1" max="50" value="{{ old('jumlah', 1) }}" required
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('jumlah') border-rose-500 @enderror">
                        @error('jumlah')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

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
