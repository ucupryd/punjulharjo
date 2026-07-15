@extends('layouts.app')

@section('content')
<div x-data="{ activeTab: 'ebook' }" class="pt-24 bg-slate-100 min-h-screen font-sans">
    
    <!-- Hero / Header Section -->
    <section class="py-12 bg-gradient-to-r from-brand-dark to-slate-900 text-white px-6">
        <div class="max-w-6xl mx-auto text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-brand-accent/20 text-brand-accent text-sm font-semibold uppercase tracking-wider border border-brand-accent/30">
                <i class="fa-solid fa-photo-film"></i> Pustaka Media Desa
            </div>
            <h1 class="text-4xl md:text-5xl font-heading tracking-wide">Pustaka Digital & Dokumentasi</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-sm md:text-base font-sans">
                Telusuri koleksi buku panduan wisata interaktif kami dan saksikan kumpulan video dokumentasi keindahan Desa Wisata Punjulharjo.
            </p>
        </div>
    </section>

    <!-- Navigation Tabs -->
    <div class="max-w-6xl mx-auto px-4 md:px-6 mt-8 md:mt-12 flex overflow-x-auto whitespace-nowrap scrollbar-hide no-scrollbar">
        <div class="inline-flex p-1.5 bg-white shadow-sm border border-slate-200 gap-1.5 rounded-none min-w-max shrink-0 mx-auto">
            <button @click="activeTab = 'ebook'" 
                    :class="activeTab === 'ebook' ? 'bg-brand-dark text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'"
                    class="px-4 py-2 md:px-6 md:py-2.5 text-xs md:text-sm font-semibold transition flex items-center gap-2 grow justify-center">
                <i class="fa-solid fa-book-open"></i> E-Book Panduan
            </button>
            <button @click="activeTab = 'video'" 
                    :class="activeTab === 'video' ? 'bg-brand-dark text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'"
                    class="px-4 py-2 md:px-6 md:py-2.5 text-xs md:text-sm font-semibold transition flex items-center gap-2 grow justify-center">
                <i class="fa-solid fa-circle-play"></i> Video Dokumentasi
            </button>
            <button @click="activeTab = 'blog'" 
                    :class="activeTab === 'blog' ? 'bg-brand-dark text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'"
                    class="px-4 py-2 md:px-6 md:py-2.5 text-xs md:text-sm font-semibold transition flex items-center gap-2 grow justify-center">
                <i class="fa-solid fa-newspaper"></i> Artikel & Blog
            </button>
        </div>
    </div>

    <!-- E-BOOK TAB PANEL -->
    <div x-show="activeTab === 'ebook'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="max-w-6xl mx-auto px-6 py-12">
        <div class="text-center max-w-2xl mx-auto mb-10 space-y-3">
            <h2 class="text-3xl font-heading text-brand-dark">Buku Panduan Desa Wisata</h2>
            <p class="text-slate-500 text-sm">Buka lembaran interaktif di bawah ini untuk menjelajahi potensi keindahan alam, sejarah nusantara, dan kebudayaan di Desa Wisata Punjulharjo.</p>
            
            @auth
                @if($ebooks->isEmpty())
                    <div class="mt-4">
                        <button onclick="document.getElementById('add-ebook-modal').classList.remove('hidden')" 
                                class="inline-flex items-center gap-2 bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark transition-colors font-semibold px-5 py-2.5 rounded-none text-xs shadow">
                            <i class="fa-solid fa-plus"></i> Upload E-Book PDF Baru
                        </button>
                    </div>
                @endif
            @endauth
        </div>

        @if($ebooks->isNotEmpty() || Auth::check())
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8 py-4 justify-items-center">
                @auth
                    <div onclick="document.getElementById('add-ebook-modal').classList.remove('hidden')" 
                          class="group border-2 border-dashed border-brand-muted hover:border-brand-accent rounded-none flex flex-col items-center justify-center p-4 md:p-8 w-full max-w-[340px] min-h-[220px] md:min-h-[385px] cursor-pointer bg-white/50 hover:bg-brand-muted/10 shadow-sm hover:shadow transition-all duration-300 text-center">
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-none bg-brand-muted/20 group-hover:bg-brand-accent/20 flex items-center justify-center mb-2 md:mb-4 transition duration-300">
                            <i class="fa-solid fa-plus text-xl md:text-2xl text-brand-muted group-hover:text-brand-dark"></i>
                        </div>
                        <span class="text-xs md:text-sm font-semibold text-brand-dark font-sans">Tambah Ebook</span>
                        <p class="text-[10px] md:text-xs text-slate-400 mt-1 md:mt-2 font-sans max-w-[150px] md:max-w-[200px]">Upload PDF buku panduan baru</p>
                    </div>
                @endauth

                @if($ebooks->isNotEmpty())
                    @foreach($ebooks as $ebook)
                        <div class="w-full max-w-[340px] flex justify-center animate-fade-in">
                            <div class="main relative w-full" onclick="openEbookModal('{{ Storage::url($ebook->pdf_path) }}')">
                                @auth
                                    <div class="absolute top-3 right-3 z-30 flex gap-2" onclick="event.stopPropagation();">
                                        <button onclick="openEditEbookModal({{ json_encode($ebook) }})" 
                                                class="bg-white/90 hover:bg-white text-slate-700 w-8 h-8 rounded-none shadow-sm flex items-center justify-center border border-slate-100 transition duration-200" title="Edit Ebook">
                                            <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                        </button>
                                        <form action="{{ route('admin.ebook.destroy', $ebook->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus e-book ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-white/90 hover:bg-red-50 text-red-600 w-8 h-8 rounded-none shadow-sm flex items-center justify-center border border-slate-100 transition duration-200" title="Hapus Ebook">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endauth

                                <div class="card">
                                    <div class="fl">
                                        <div class="fullscreen">
                                            <svg viewBox="0 0 100 100" class="fullscreen_svg"><path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57(3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z" /></svg>
                                        </div>
                                    </div>
                                    @if($ebook->cover_path)
                                        <div class="card_content bg-slate-900 overflow-hidden flex items-center justify-center">
                                            <img src="{{ Storage::url($ebook->cover_path) }}" class="w-full h-full object-cover" alt="{{ $ebook->title }}">
                                        </div>
                                    @else
                                        <div class="card_content">
                                            <div class="absolute left-0 top-0 bottom-0 w-3.5 bg-sky-600 shadow-md"></div>
                                            <i class="fa-solid fa-book-open text-amber-400 text-4xl mb-2 filter drop-shadow"></i>
                                            <span class="text-[9px] font-extrabold uppercase tracking-widest text-amber-300 font-sans">GUIDEBOOK</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="data select-none">
                                    <div class="flex flex-col items-center justify-center border-2 border-yellow-500 text-yellow-500 w-12 h-14 shrink-0 bg-transparent rounded-none select-none">
                                        <span class="text-xl font-bold leading-none">{{ $ebook->created_at->format('d') }}</span>
                                        <span class="text-xs font-medium uppercase leading-none mt-1">{{ $ebook->created_at->format('M') }}</span>
                                    </div>
                                    <div class="text text-left">
                                        <div class="text_m leading-snug">{{ $ebook->title }}</div>
                                        <div class="text_s text-slate-400 mt-0.5 leading-tight">{{ Str::limit($ebook->description ?? 'Buku Panduan Desa Wisata', 28) }}</div>
                                    </div>
                                </div>

                                <div class="btns select-none">
                                    @php
                                        $likesVal = (int)($ebook->id * 7 + 15) % 89 + 12;
                                        $commentsVal = (int)($ebook->id * 3 + 8) % 43 + 4;
                                        $viewsVal = (int)($ebook->id * 43 + 124) % 890 + 112;
                                    @endphp
                                    <div class="likes">
                                        <svg class="likes_svg" viewBox="-2 0 105 92"><path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z" /></svg><span class="likes_text">{{ $likesVal }}</span>
                                    </div>
                                    <div class="comments">
                                        <svg class="comments_svg" viewBox="-405.9 238 56.3 54.8" title="Comment"><path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z" /></svg><span class="comments_text">{{ $commentsVal }}</span>
                                    </div>
                                    <div class="views">
                                        <svg class="views_svg" viewBox="0 0 30.5 16.5" title="Views"><path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z" /></svg><span class="views_text">{{ $viewsVal }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @else
            <!-- Static 3D Flipbook component when empty/guest fallback -->
            <div class="flipbook-container">
                <div class="flipbook-viewport mb-6">
                    <div id="flipbook" class="flipbook-wrapper">
                        <div class="flipbook-page cover-page select-none flex flex-col justify-between items-center text-center border-4 border-amber-500/30 rounded-lg p-8 h-full" data-density="hard">
                            <div class="w-full flex justify-between items-center border-b border-white/10 pb-4">
                                <span class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Desa Punjulharjo</span>
                                <i class="fa-solid fa-dharmachakra text-amber-400 text-lg"></i>
                            </div>
                            <div class="my-auto space-y-6">
                                <div class="w-20 h-20 mx-auto rounded-full bg-white/10 flex items-center justify-center border border-white/20 shadow-inner">
                                    <i class="fa-solid fa-map text-amber-400 text-3xl"></i>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-heading text-white tracking-wider leading-snug drop-shadow-lg">BUKU PANDUAN<br>WISATA</h3>
                                <p class="text-sm font-sans text-slate-300 max-w-xs mx-auto leading-relaxed uppercase tracking-wider">Panduan Lengkap Penjelajahan Alam, Sejarah & Budaya</p>
                            </div>
                            <div class="w-full border-t border-white/10 pt-4 flex flex-col items-center">
                                <span class="text-[10px] uppercase tracking-widest text-slate-400">Edisi Eksklusif</span>
                                <div class="text-amber-400/90 mt-1 flex gap-0.5 justify-center">
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Inside content pages -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Kata Pengantar</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-6">Selamat Datang</h3>
                                    <div class="space-y-4 text-sm text-slate-600 leading-relaxed text-justify">
                                        <p>Selamat datang di Desa Wisata Punjulharjo, Kabupaten Rembang. Buku panduan praktis ini dirancang untuk memudahkan Anda menjelajahi keindahan alam, menelusuri sejarah bahari nusantara, dan merasakan kehangatan budaya masyarakat pesisir kami.</p>
                                        <p>Kami berharap setiap lembar informasi di dalam e-book interaktif ini dapat menginspirasi dan membantu Anda merencanakan kunjungan yang tak terlupakan.</p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Daftar Isi & Sambutan</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pantai Karang Jahe -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Alam</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Pantai Karang Jahe</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=400&q=85" alt="Pantai Karang Jahe" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">Menawarkan hamparan pasir putih bersih yang membentang luas di sepanjang garis pantai utara Jawa, dihiasi ribuan pohon cemara laut yang rindang. Destinasi wisata keluarga yang teduh dan menenangkan.</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Pesona Bahari</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 2</span>
                                </div>
                            </div>
                        </div>

                        <!-- Situs Perahu Kuno -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Sejarah</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Situs Perahu Kuno</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?auto=format&fit=crop&w=400&q=85" alt="Situs Perahu Kuno" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">Penemuan arkeologi luar biasa berupa perahu kayu utuh dari abad ke-7 Masehi. Situs purbakala ini menjadi bukti nyata majunya teknologi perkapalan dan sejarah kemaritiman perdagangan nusantara.</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Warisan Maritim</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 3</span>
                                </div>
                            </div>
                        </div>

                        <!-- Batik Canting -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Edukasi</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Batik Canting Punjulharjo</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=400&q=85" alt="Batik Tulis" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">Melihat langsung dan belajar seni membatik tulis tradisional canting dengan motif pesisiran yang unik. Aktivitas edukatif ini memberdayakan pengrajin wanita desa dan melestarikan budaya bangsa.</p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Kreativitas Lokal</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 4</span>
                                </div>
                            </div>
                        </div>

                        <!-- Back cover -->
                        <div class="flipbook-page back-page select-none flex flex-col justify-between items-center text-center border-4 border-amber-500/30 rounded-lg p-8 h-full" data-density="hard">
                            <div class="w-full flex justify-between items-center border-b border-white/10 pb-4">
                                <i class="fa-solid fa-dharmachakra text-amber-400 text-lg"></i>
                                <span class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Sampai Jumpa</span>
                            </div>
                            <div class="my-auto space-y-4">
                                <h3 class="text-2xl font-heading text-white tracking-wider">KUNJUNGI KAMI</h3>
                                <p class="text-xs text-slate-300 max-w-xs mx-auto leading-relaxed">Mulai petualangan Anda hari ini dan rasakan pengalaman unik di setiap jengkal Desa Wisata Punjulharjo.</p>
                                <div class="text-[10px] text-amber-300 font-mono tracking-wider space-y-1 bg-white/5 py-3 px-4 rounded-xl border border-white/10">
                                    <div>Email: info@desapunjulharjo.id</div>
                                    <div>Instagram: @desawisatapunjulharjo</div>
                                    <div>Web: desapunjulharjo.id</div>
                                </div>
                            </div>
                            <div class="w-full border-t border-white/10 pt-4 flex flex-col items-center">
                                <span class="text-[10px] uppercase tracking-widest text-slate-400">Copyright © {{ date('Y') }}</span>
                                <span class="text-[9px] text-slate-500 mt-1">Desa Wisata Punjulharjo. All Rights Reserved.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <div class="mt-8 flex items-center justify-center gap-6 z-10 font-sans">
                    <button id="btn-prev" class="w-12 h-12 rounded-full bg-white hover:bg-sky-500 hover:text-white text-slate-700 shadow-md border border-slate-100 flex items-center justify-center transition-all duration-300 transform hover:-translate-x-1 hover:scale-105 active:scale-95 focus:outline-none" aria-label="Halaman Sebelumnya">
                        <i class="fa-solid fa-chevron-left text-lg"></i>
                    </button>
                    <span id="page-indicator" class="glass-panel px-6 py-2.5 rounded-full text-slate-700 font-semibold text-sm shadow-sm border border-slate-200">
                        Sampul Depan
                    </span>
                    <button id="btn-next" class="w-12 h-12 rounded-full bg-white hover:bg-sky-500 hover:text-white text-slate-700 shadow-md border border-slate-100 flex items-center justify-center transition-all duration-300 transform hover:translate-x-1 hover:scale-105 active:scale-95 focus:outline-none" aria-label="Halaman Berikutnya">
                        <i class="fa-solid fa-chevron-right text-lg"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- VIDEO TAB PANEL -->
    <div x-show="activeTab === 'video'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="max-w-6xl mx-auto px-6 py-12" style="display: none;">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 relative">
            <div class="text-center md:text-left space-y-2">
                <h2 class="text-3xl font-heading text-brand-dark">Kumpulan Video Wisata</h2>
                <p class="text-slate-500 text-sm">Saksikan ragam keindahan dokumentasi video pariwisata Desa Punjulharjo.</p>
            </div>
            @auth
                <div class="mt-4 md:mt-0">
                    <button onclick="document.getElementById('add-video-modal').classList.remove('hidden')" 
                            class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-none shadow transition-all flex items-center gap-2 text-sm font-semibold">
                        <i class="fa-solid fa-plus"></i> Tambah Video
                    </button>
                </div>
            @endauth
        </div>

        @php
            if (!function_exists('getYoutubeId')) {
                function getYoutubeId($url) {
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                    return $match[1] ?? null;
                }
            }
        @endphp
        @if($videos->count())
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                @foreach($videos as $video)
                    @php
                        $videoId = getYoutubeId($video->video_url);
                        $thumbnailUrl = $videoId 
                            ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
                            : ($video->thumbnail ? Storage::disk('public_direct')->url($video->thumbnail) : asset('images/default-video.jpg'));
                    @endphp
                    <a href="{{ route('video.show', $video->slug) }}" 
                       class="group block bg-white shadow-sm hover:shadow-md transition duration-300 border border-slate-200 overflow-hidden relative animate-fade-in">
                        
                        <div class="relative aspect-video w-full overflow-hidden bg-slate-900">
                            <img src="{{ $thumbnailUrl }}" 
                                 alt="{{ $video->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            
                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-sky-600 text-white flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-all duration-300">
                                    <i class="fa-solid fa-play text-xs md:text-xl ml-1"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-3 md:p-5 text-left">
                            <h3 class="text-xs md:text-base font-bold text-slate-800 group-hover:text-sky-600 transition duration-300 line-clamp-2 font-sans leading-snug">
                                {{ $video->title }}
                            </h3>
                            @if($video->description)
                                <p class="text-[10px] md:text-xs text-slate-400 mt-1 md:mt-2 line-clamp-2">{{ $video->description }}</p>
                            @endif
                        </div>

                        @auth
                            <div class="absolute top-3 right-3 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="openEditVideoModal(event, {{ json_encode($video) }})" 
                                        class="bg-white/90 hover:bg-white text-slate-800 p-2 rounded-none shadow border border-white/20 flex items-center justify-center">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endauth
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white border border-slate-200">
                <i class="fa-solid fa-film text-4xl text-slate-300 mb-3 block"></i>
                <p class="text-gray-600 text-sm">Belum ada video pariwisata yang tersedia.</p>
            </div>
        @endif
    </div>

    <!-- BLOG TAB PANEL -->
    <div x-show="activeTab === 'blog'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="max-w-6xl mx-auto px-6 py-12" style="display: none;">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 relative">
            <div class="text-center md:text-left space-y-2">
                <h2 class="text-3xl font-heading text-brand-dark">Artikel & Berita Desa</h2>
                <p class="text-slate-500 text-sm">Temukan artikel menarik seputar kegiatan, budaya, dan pengumuman Desa Wisata Punjulharjo.</p>
            </div>
            @auth
                <div class="mt-4 md:mt-0">
                    <button onclick="document.getElementById('add-blog-modal').classList.remove('hidden')" 
                            class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-none shadow transition-all flex items-center gap-2 text-sm font-semibold">
                        <i class="fa-solid fa-plus"></i> Tambah Artikel
                    </button>
                </div>
            @endauth
        </div>

        @if($blogs->count() > 0)
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-10">
                @foreach ($blogs as $blog)
                    <div class="bg-white shadow-sm rounded-none overflow-hidden hover:shadow transition duration-300 border border-slate-200 relative group flex flex-col justify-between animate-fade-in">
                         <div>
                             @if($blog->image)
                                 <img src="{{ Storage::url($blog->image) }}" 
                                      alt="{{ $blog->title }}" 
                                      class="w-full h-32 md:h-52 object-cover">
                             @else
                                 <img src="https://via.placeholder.com/400x250?text=Desa+Punjulharjo" 
                                      class="w-full h-32 md:h-52 object-cover">
                             @endif
                             <div class="p-3 md:p-6 text-left">
                                 <h3 class="text-xs md:text-lg font-heading text-sky-600 mb-1 line-clamp-2 leading-snug" title="{{ $blog->title }}">{{ $blog->title }}</h3>
                                 <p class="text-gray-600 text-[10px] md:text-sm line-clamp-2 md:line-clamp-3">
                                     {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 100) }}
                                 </p>
                             </div>
                         </div>
                         <div class="p-3 pt-0 md:p-6 md:pt-0 text-left">
                             <a href="{{ route('blog.show', $blog->slug) }}" 
                                class="inline-block text-sky-500 hover:text-sky-700 text-[11px] md:text-sm font-medium transition">
                                 Baca Selengkapnya →
                             </a>
                         </div>
                         @auth
                             <!-- Floating Edit Button on Card Hover -->
                             <div class="absolute top-2 right-2 md:top-4 md:right-4 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                 <button onclick="openEditBlogModal(event, {{ json_encode($blog) }})" 
                                         class="bg-white/90 hover:bg-white text-slate-800 p-2 md:p-2.5 rounded-none shadow-sm border border-white/20 flex items-center justify-center">
                                     <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                 </button>
                             </div>
                         @endauth
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white border border-slate-200">
                <i class="fa-solid fa-newspaper text-4xl text-slate-300 mb-3 block"></i>
                <p class="text-gray-600 text-sm">Belum ada artikel yang tersedia.</p>
            </div>
        @endif
    </div>

</div>

<!-- FULLSCREEN MODALS -->

@if($ebooks->isNotEmpty() || Auth::check())
    <!-- Fullscreen Backdrop Modal for Flipbook Viewer -->
    <div id="ebook-fullscreen-modal" class="hidden fixed inset-0 flex items-center justify-center bg-black/90 backdrop-blur-md" style="z-index: 999999 !important;">
        <div class="absolute inset-0 bg-transparent" onclick="closeEbookModal()"></div>
        <div class="relative w-full h-full md:w-11/12 md:max-w-7xl md:h-[88vh] flex flex-col items-center justify-center z-10" style="z-index: 1000000 !important;">
            <button onclick="closeEbookModal()" class="absolute top-4 right-4 text-white hover:text-white bg-black/60 hover:bg-black/80 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 shadow-md border border-white/20 focus:outline-none z-[1000002]" style="z-index: 1000002 !important;">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
            <div id="df-modal-flipbook" class="w-full h-full bg-transparent"></div>
        </div>
    </div>
@endif

@auth
    <!-- Add Ebook Modal -->
    <div id="add-ebook-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Upload E-Book PDF Baru</h3>
                <button type="button" onclick="document.getElementById('add-ebook-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.ebook.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Ebook</label>
                        <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Contoh: Ebook Panduan Desa Punjulharjo" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Jelaskan isi e-book ini secara ringkas..."></textarea>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih File PDF</label>
                        <input type="file" name="pdf" accept=".pdf" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                        <p class="text-xs text-slate-400 mt-1">Hanya file PDF. Ukuran maks: 15MB.</p>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Sampul Card Ebook (Opsional)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                        <p class="text-xs text-slate-400 mt-1">Format gambar. Ukuran maks: 5MB.</p>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-ebook-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Upload Ebook
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Ebook Modal -->
    <div id="edit-ebook-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit E-Book PDF</h3>
                <button type="button" onclick="document.getElementById('edit-ebook-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form id="edit-ebook-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Ebook</label>
                        <input type="text" id="edit-ebook-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Singkat</label>
                        <textarea id="edit-ebook-description" name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti File PDF (Opsional)</label>
                        <input type="file" name="pdf" accept=".pdf" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah file PDF.</p>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Sampul Card Ebook (Opsional)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah sampul.</p>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('edit-ebook-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Video Modal -->
    <div id="add-video-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Tambah Video Baru</h3>
                <button type="button" onclick="document.getElementById('add-video-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.video.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Video</label>
                        <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Judul..." required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">URL Video Embed (YouTube)</label>
                        <input type="text" name="video_url" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Contoh: https://www.youtube.com/watch?v=..." required>
                        <p class="text-xs text-slate-400 mt-1">Gunakan link watch YouTube standar.</p>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Deskripsi video..."></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-video-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Tambah Video
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Video Modal -->
    <div id="edit-video-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit Video</h3>
                <button type="button" onclick="document.getElementById('edit-video-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form id="edit-video-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Video</label>
                        <input type="text" id="edit-video-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">URL Video Embed (YouTube)</label>
                        <input type="text" id="edit-video-url" name="video_url" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi</label>
                        <textarea id="edit-video-desc" name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm"></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                    <button type="button" onclick="confirmDeleteVideo()"
                            class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                        Hapus
                    </button>
                    
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('edit-video-modal').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-video-form" action="" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <!-- Add Blog Modal -->
    <div id="add-blog-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-lg w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Tambah Artikel Baru</h3>
                <button type="button" onclick="document.getElementById('add-blog-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-4 max-h-[65vh] overflow-y-auto">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Foto Sampul</label>
                        <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Artikel</label>
                        <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Judul..." required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Kutipan Ringkas (Excerpt)</label>
                        <input type="text" name="excerpt" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Rangkuman artikel...">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Konten Artikel</label>
                        <textarea name="content" rows="6" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Konten utama..." required></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-blog-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Blog Modal -->
    <div id="edit-blog-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-lg w-full overflow-hidden border border-slate-100 text-left transform transition-all animate-fade-in">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit Artikel</h3>
                <button type="button" onclick="document.getElementById('edit-blog-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form id="edit-blog-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4 max-h-[65vh] overflow-y-auto">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto Sampul (opsional)</label>
                        <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Artikel</label>
                        <input type="text" id="edit-blog-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Kutipan Ringkas (Excerpt)</label>
                        <input type="text" id="edit-blog-excerpt" name="excerpt" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Konten Artikel</label>
                        <textarea id="edit-blog-content" name="content" rows="6" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                    <button type="button" onclick="confirmDeleteBlog()"
                            class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                        Hapus
                    </button>
                    
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('edit-blog-modal').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-blog-form" action="" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endauth

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/dflip/css/dflip.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dflip/css/themify-icons.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .main {
            width: 100%;
            background-color: #1b2230;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 0px;
            padding: 0.75em;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            position: relative;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        @media (min-width: 768px) {
            .main {
                width: 16.5em;
                padding: 1em;
            }
        }
        .main:hover {
            transform: translateY(-5px);
            background-color: #21293a;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            border-color: rgba(56, 189, 248, 0.3);
        }
        .card {
            width: 100%;
            height: 7em;
            background-color: #749db2;
            border-radius: 0px;
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        @media (min-width: 768px) {
            .card {
                height: 10em;
            }
        }
        .card_content {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease-in-out;
        }
        .card_content img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .fl {
            position: absolute;
            top: 0.5em;
            left: 0.5em;
            z-index: 10;
        }
        .fullscreen {
            width: 1.5em;
            height: 1.5em;
            border-radius: 0px;
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease-in-out;
        }
        .fullscreen_svg {
            width: 0.7em;
            fill: #f1f5f9;
        }
        .main:hover .fullscreen {
            background-color: #fab831;
        }
        .main:hover .fullscreen_svg {
            fill: #0d355e;
        }
        .data {
            margin-top: 0.5em;
            width: 100%;
        }
        @media (min-width: 768px) {
            .data {
                margin-top: 1em;
            }
        }
        .data {
            display: flex;
            gap: 1em;
        }
        .text {
            color: #f1f5f9;
            width: 100%;
        }
        .text_m {
            font-size: 0.9em;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            color: #f8fafc;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .text_s {
            font-size: 0.7em;
        }
        .btns {
            margin-top: 0.5em;
            display: flex;
            gap: 0.5em;
            width: 100%;
            font-size: 0.7em;
            font-weight: 700;
            color: #94a3b8;
        }
        @media (min-width: 768px) {
            .btns {
                margin-top: 1em;
                gap: 1em;
            }
        }
        .likes, .comments, .views {
            display: flex;
            align-items: center;
            gap: 0.3em;
        }
        .likes_svg, .comments_svg, .views_svg {
            width: 1.2em;
            fill: #94a3b8;
            transition: fill 0.3s;
        }
        .likes:hover .likes_svg { fill: #ef4444; }
        .likes:hover .likes_text { color: #ef4444; }
        .comments:hover .comments_svg { fill: #38bdf8; }
        .comments:hover .comments_text { color: #38bdf8; }
        .views:hover .views_svg { fill: #fab831; }
        .views:hover .views_text { color: #fab831; }
        
        /* Interactive 3D CSS Book animations */
        .flipbook-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            perspective: 2000px;
            padding: 2rem 0;
            position: relative;
            z-index: 10;
        }
        .flipbook-viewport {
            width: 100%;
            max-width: 900px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .flipbook-wrapper {
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.45);
            background: transparent;
            border-radius: 8px;
            overflow: visible;
        }
        .flipbook-page {
            background-color: #ffffff;
            color: #1e293b;
            box-shadow: inset 3px 0 20px rgba(0, 0, 0, 0.08);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            box-sizing: border-box;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }
        @media (min-width: 768px) {
            .flipbook-page {
                padding: 2.5rem;
            }
        }
        .flipbook-page p { color: #475569; }
        .cover-page, .back-page {
            background: linear-gradient(135deg, #0d355e 0%, #1e293b 100%);
            color: #ffffff;
            box-shadow: inset -3px 0 20px rgba(0, 0, 0, 0.25);
            border: none;
        }
        .cover-page p, .back-page p { color: #cbd5e1; }
        
        .df-container {
            border-radius: 8px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            background: rgba(15, 23, 42, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .df-ui-zoom-in, .df-ui-zoom-out, .df-ui-zoom, .df-zoom,
        .df-controls-top, .df-lightbox-controls, .df-lightbox-header, .df-share-title {
            display: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('vendor/dflip/js/dflip.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($ebooks->isNotEmpty() || Auth::check())
                window.dfFlipbookInstance = null;

                window.openEbookModal = function(pdfUrl) {
                    const modal = document.getElementById('ebook-fullscreen-modal');
                    if (modal) {
                        modal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }

                    if (window.dfFlipbookInstance) {
                        $("#df-modal-flipbook").empty();
                        window.dfFlipbookInstance = null;
                    }

                    setTimeout(function() {
                        var options = {
                            webgl: false,
                            height: '100%',
                            duration: 800,
                            soundEnable: true,
                            backgroundColor: "transparent"
                        };
                        window.dfFlipbookInstance = $("#df-modal-flipbook").flipBook(pdfUrl, options);
                    }, 100);
                };

                window.closeEbookModal = function() {
                    const modal = document.getElementById('ebook-fullscreen-modal');
                    if (modal) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                };
            @else
                const flipContainer = document.getElementById('flipbook');
                if (flipContainer && typeof St !== 'undefined') {
                    const pageFlip = new St.PageFlip(flipContainer, {
                        width: 550,
                        height: 580,
                        size: "stretch",
                        minWidth: 280,
                        maxWidth: 1000,
                        minHeight: 295,
                        maxHeight: 1050,
                        maxShadowOpacity: 0.35,
                        showCover: true,
                        mobileScrollSupport: false,
                        usePortrait: true
                    });

                    pageFlip.loadFromHTML(document.querySelectorAll('.flipbook-page'));

                    const btnPrev = document.getElementById('btn-prev');
                    const btnNext = document.getElementById('btn-next');
                    const pageIndicator = document.getElementById('page-indicator');

                    function updateIndicator() {
                        const total = pageFlip.getPageCount();
                        const current = pageFlip.getCurrentPageIndex();
                        
                        if (pageFlip.getOrientation() === 'portrait') {
                            if (current === 0) {
                                pageIndicator.textContent = "Sampul Depan";
                            } else if (current === total - 1) {
                                pageIndicator.textContent = "Sampul Belakang";
                            } else {
                                pageIndicator.textContent = `Halaman ${current} dari ${total - 2}`;
                            }
                        } else {
                            if (current === 0) {
                                pageIndicator.textContent = "Sampul Depan";
                            } else if (current === total - 1 || current === total - 2) {
                                pageIndicator.textContent = "Sampul Belakang";
                            } else {
                                const leftPage = current;
                                const rightPage = current + 1;
                                pageIndicator.textContent = `Halaman ${leftPage} & ${rightPage}`;
                            }
                        }
                    }

                    btnPrev.addEventListener('click', () => pageFlip.flipPrev());
                    btnNext.addEventListener('click', () => pageFlip.flipNext());

                    pageFlip.on('flip', () => { updateIndicator(); });
                    pageFlip.on('changeOrientation', () => { updateIndicator(); });

                    setTimeout(updateIndicator, 150);
                }
            @endif
        });

        @auth
            function openEditEbookModal(ebook) {
                const modal = document.getElementById('edit-ebook-modal');
                modal.querySelector('#edit-ebook-form').action = '/admin/ebook/' + ebook.id;
                modal.querySelector('#edit-ebook-title').value = ebook.title;
                modal.querySelector('#edit-ebook-description').value = ebook.description || '';
                modal.classList.remove('hidden');
            }

            function openEditVideoModal(e, video) {
                e.stopPropagation();
                const modal = document.getElementById('edit-video-modal');
                modal.querySelector('#edit-video-form').action = '/admin/video/' + video.id;
                modal.querySelector('#edit-video-title').value = video.title;
                modal.querySelector('#edit-video-url').value = video.video_url;
                modal.querySelector('#edit-video-desc').value = video.description || '';
                modal.querySelector('#delete-video-form').action = '/admin/video/' + video.id;
                modal.classList.remove('hidden');
            }

            function confirmDeleteVideo() {
                if (confirm('Apakah Anda yakin ingin menghapus video ini?')) {
                    document.getElementById('delete-video-form').submit();
                }
            }

            function openEditBlogModal(e, blog) {
                e.stopPropagation();
                const modal = document.getElementById('edit-blog-modal');
                modal.querySelector('#edit-blog-form').action = '/admin/blog/' + blog.id;
                modal.querySelector('#edit-blog-title').value = blog.title;
                modal.querySelector('#edit-blog-excerpt').value = blog.excerpt || '';
                modal.querySelector('#edit-blog-content').value = blog.content;
                modal.querySelector('#delete-blog-form').action = '/admin/blog/' + blog.id;
                modal.classList.remove('hidden');
            }

            function confirmDeleteBlog() {
                if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                    document.getElementById('delete-blog-form').submit();
                }
            }
        @endauth
    </script>
@endpush
@endsection
