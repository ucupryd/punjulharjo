@props([
    'contextType' => 'berita'
])

<!-- Area Reaksi (Reaction & Like Bar) -->
<div class="border-t border-b border-slate-200 py-6 my-10 font-sans">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h4 class="text-sm font-semibold text-slate-800 uppercase tracking-wider mb-2">Reaksi Pembaca</h4>
            <div class="flex flex-wrap items-center gap-3">
                <!-- Tombol Like (Suka) -->
                <button type="button" 
                        class="flex items-center gap-2 bg-slate-50 hover:bg-rose-50 text-slate-700 hover:text-rose-600 border border-slate-200 hover:border-rose-200 px-4 py-2 text-sm font-medium transition duration-150 rounded-none group"
                        aria-label="Suka {{ $contextType }} ini">
                    <i class="fa-solid fa-heart group-hover:scale-110 transition duration-150"></i>
                    <span>Suka</span>
                    <span class="bg-slate-200 group-hover:bg-rose-100 text-slate-700 group-hover:text-rose-700 px-2 py-0.5 text-xs font-bold rounded-none">42</span>
                </button>

                <!-- Reaksi 1: Senang -->
                <button type="button" 
                        class="flex items-center gap-1.5 bg-slate-50 hover:bg-amber-50 text-slate-700 hover:text-amber-600 border border-slate-200 hover:border-amber-200 px-3 py-2 text-sm transition duration-150 rounded-none group"
                        aria-label="Reaksi Senang">
                    <span class="text-base group-hover:scale-110 transition duration-150">😆</span>
                    <span>Senang</span>
                    <span class="bg-slate-200 group-hover:bg-amber-100 text-slate-600 px-1.5 py-0.2 text-xs font-bold rounded-none">12</span>
                </button>

                <!-- Reaksi 2: Takjub -->
                <button type="button" 
                        class="flex items-center gap-1.5 bg-slate-50 hover:bg-sky-50 text-slate-700 hover:text-sky-600 border border-slate-200 hover:border-sky-200 px-3 py-2 text-sm transition duration-150 rounded-none group"
                        aria-label="Reaksi Takjub">
                    <span class="text-base group-hover:scale-110 transition duration-150">😮</span>
                    <span>Takjub</span>
                    <span class="bg-slate-200 group-hover:bg-sky-100 text-slate-600 px-1.5 py-0.2 text-xs font-bold rounded-none">8</span>
                </button>

                <!-- Reaksi 3: Sedih -->
                <button type="button" 
                        class="flex items-center gap-1.5 bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-600 border border-slate-200 hover:border-blue-200 px-3 py-2 text-sm transition duration-150 rounded-none group"
                        aria-label="Reaksi Sedih">
                    <span class="text-base group-hover:scale-110 transition duration-150">😢</span>
                    <span>Sedih</span>
                    <span class="bg-slate-200 group-hover:bg-blue-100 text-slate-600 px-1.5 py-0.2 text-xs font-bold rounded-none">1</span>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-4 text-xs text-slate-500">
            <span><i class="fa-solid fa-eye"></i> 1.2k Kali Dilihat</span>
            <span><i class="fa-solid fa-share-nodes"></i> Bagikan</span>
        </div>
    </div>
</div>

<!-- Area Komentar (Comments Section) -->
<div class="space-y-8 font-sans">
    <div class="flex items-center justify-between border-b border-slate-200 pb-3">
        <h3 class="text-lg font-bold text-brand-dark font-heading">Komentar (3)</h3>
        <span class="text-xs text-slate-500">Kebijakan Komentar: Sopan & Konstruktif</span>
    </div>

    <!-- Form Komentar (Frontend Dummy) -->
    <div class="bg-slate-50 p-5 border border-slate-200 rounded-none">
        <h4 class="text-sm font-semibold text-slate-800 mb-4">Kirim Komentar Anda</h4>
        <form onsubmit="event.preventDefault(); alert('Pesan komentar ini adalah demo antarmuka saja (static mockup).');" class="space-y-4">
            {{-- TODO: hubungkan ke backend nanti --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="comment-name" class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">Nama Lengkap</label>
                    <input type="text" id="comment-name" name="name" placeholder="Masukkan nama Anda" 
                           class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white" required>
                </div>
                <div>
                    <label for="comment-email" class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">Email (Opsional)</label>
                    <input type="email" id="comment-email" name="email" placeholder="nama@email.com" 
                           class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white">
                </div>
            </div>
            <div>
                <label for="comment-body" class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">Komentar</label>
                <textarea id="comment-body" name="comment" rows="4" placeholder="Tulis komentar Anda di sini..." 
                           class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-brand-dark hover:bg-sky-900 text-white text-xs font-bold py-2.5 px-6 rounded-none transition duration-150 uppercase tracking-wider shadow-sm">
                    Kirim Komentar
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Komentar Dummy -->
    <div class="space-y-6">
        <!-- Komentar 1 -->
        <div class="flex items-start gap-4 pb-6 border-b border-slate-100">
            <div class="flex-shrink-0 w-10 h-10 bg-sky-600 text-white flex items-center justify-center font-bold text-sm rounded-none">
                B
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <h5 class="text-sm font-semibold text-slate-800">Budi Santoso</h5>
                    <span class="text-[11px] text-slate-400">2 jam yang lalu</span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Sangat informatif! Pantai Karang Jahe memang selalu menjadi destinasi favorit keluarga kami kalau liburan ke Rembang. Tempatnya bersih dan rindang sekali.
                </p>
            </div>
        </div>

        <!-- Komentar 2 -->
        <div class="flex items-start gap-4 pb-6 border-b border-slate-100">
            <div class="flex-shrink-0 w-10 h-10 bg-emerald-600 text-white flex items-center justify-center font-bold text-sm rounded-none">
                R
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <h5 class="text-sm font-semibold text-slate-800">Rina Wijaya</h5>
                    <span class="text-[11px] text-slate-400">5 jam yang lalu</span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Wah, saya baru tahu kalau program adopsi cemara laut sudah berjalan secara digital seperti ini. Sangat menginspirasi desa wisata lainnya!
                </p>
            </div>
        </div>

        <!-- Komentar 3 -->
        <div class="flex items-start gap-4 pb-6">
            <div class="flex-shrink-0 w-10 h-10 bg-amber-500 text-white flex items-center justify-center font-bold text-sm rounded-none">
                A
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <h5 class="text-sm font-semibold text-slate-800">Ahmad Fauzi</h5>
                    <span class="text-[11px] text-slate-400">Kemarin</span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Situs Perahu Kuno wajib dikunjungi kalau suka sejarah. Penataannya bagus dan edukatif sekali buat anak-anak sekolah.
                </p>
            </div>
        </div>
    </div>
</div>
