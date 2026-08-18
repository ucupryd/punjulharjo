@extends('layouts.app')

@section('content')
    @php
        $heroBg = \App\Models\SiteSetting::getValue('hero_background');
        $heroBgUrl = $heroBg 
            ? (str_starts_with($heroBg, 'http') || str_contains($heroBg, 'storage/') ? asset($heroBg) : Storage::url($heroBg)) 
            : asset('storage/hero/9qTbqw7WY7alzKqM8aK4duA1mPisHBiavO5ARCGB.jpg');

        // Fetch Carousel Items from SiteSetting or fallback to default
        $carouselItemsJson = \App\Models\SiteSetting::getValue('carousel_items');
        $carouselItems = $carouselItemsJson ? json_decode($carouselItemsJson, true) : [
            [
                'id' => 1,
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
                'title' => 'Susur Pantai Karang Jahe',
                'description' => 'Menikmati segarnya hembusan angin laut di bawah keteduhan ribuan cemara laut yang berjejer rapi.'
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                'title' => 'Eksplorasi Perahu Abad ke-7',
                'description' => 'Melihat langsung mahakarya arkeologis kapal kayu tertua di nusantara bukti peradaban bahari.'
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                'title' => 'Wisata Mangrove & Tambak',
                'description' => 'Menyusuri jalur trekking hutan bakau hijau dan edukasi budidaya garam lokal masyarakat.'
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                'title' => 'Festival Budaya Pesisir',
                'description' => 'Menyaksikan pagelaran tari tradisional dan sedekah laut tahunan khas warga pesisir.'
            ],
            [
                'id' => 5,
                'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=800&q=80',
                'title' => 'Kuliner Seafood & Khas Rembang',
                'description' => 'Menikmati masakan laut segar bumbu rempah tradisi di warung makan tepi pantai.'
            ]
        ];

        // Fetch Gallery Items from SiteSetting or fallback to default
        $galleryItemsJson = \App\Models\SiteSetting::getValue('gallery_items');
        $galleryItems = $galleryItemsJson ? json_decode($galleryItemsJson, true) : [
            [
                'id' => 1,
                'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80',
                'title' => 'Pesona Pantai',
                'aspect_class' => 'aspect-[3/4] md:row-span-2'
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Kehidupan Pantai',
                'aspect_class' => 'aspect-[4/3] md:col-span-2'
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80',
                'title' => 'Bahari Tradisional',
                'aspect_class' => 'aspect-square'
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80',
                'title' => 'Sunset Pesisir',
                'aspect_class' => 'aspect-square'
            ],
            [
                'id' => 5,
                'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80',
                'title' => 'Ekosistem Pantai',
                'aspect_class' => 'aspect-[4/3]'
            ],
            [
                'id' => 6,
                'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Aktivitas Gotong Royong',
                'aspect_class' => 'aspect-[16/9] md:col-span-2'
            ]
        ];
    @endphp



    {{-- ============================================================
         SECTION A2: Jelajahi Destinasi (Video Carousel Full-Lebar)
         ============================================================ --}}
    @if($destinationVideos->count() > 0)
    <section
        id="jelajahi-destinasi"
        class="relative w-full bg-slate-950 overflow-hidden"
        style="height: 115vh;"
        x-data="{
            videos: {{ Js::from($destinationVideos) }},
            activeIndex: 0,
            hoveredIndex: null,
            parallaxEnabled: false,
            offsetX: 0,
            offsetY: 0,
            inView: false,
            direction: 1,
            hoveringStage: false,
            get total() {
                return this.videos.length;
            },
            get nextIndex() {
                if (this.total < 2) return 0;
                return (this.activeIndex + 1) % this.total;
            },
            get leftIndex() {
                return (this.activeIndex - 1 + this.total) % this.total;
            },
            get rightIndex() {
                return (this.activeIndex + 1) % this.total;
            },
            get stageStyle() {
                const amplitude = 28;
                const scale = 1.08;
                return 'transform: translate3d(' + (this.offsetX * amplitude) + 'px, ' + (this.offsetY * amplitude) + 'px, 0) scale(' + scale + '); transition: transform 0.2s ease-out;';
            },
            init() {
                if (this.total === 0) return;
                const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
                const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                this.parallaxEnabled = finePointer && !reduceMotion;
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        this.inView = entry.isIntersecting;
                        if (entry.isIntersecting) {
                            this.playActive();
                        } else {
                            this.pauseAll();
                        }
                    });
                }, { threshold: 0.25 });
                observer.observe(this.$root);
            },
            currentVideoEl() {
                return this.$root.querySelector('video[data-index=\'' + this.activeIndex + '\']');
            },
            playActive() {
                const el = this.currentVideoEl();
                if (!el) { console.log('[DV] playActive: elemen video tidak ditemukan untuk index', this.activeIndex); return; }
                console.log('[DV] playActive index=' + this.activeIndex,
                    'readyState=' + el.readyState,
                    'networkState=' + el.networkState,
                    'paused=' + el.paused,
                    'muted=' + el.muted,
                    'src=' + el.currentSrc)
                el.muted = true;
                const p = el.play();
                if (p && typeof p.catch === 'function') {
                    p.catch((err) => console.error('[DV] PLAY FAILED index=' + this.activeIndex, err.name, err.message));
                }
            },
            pauseAll() {
                this.$root.querySelectorAll('video').forEach((el) => el.pause());
            },
            goTo(i) {
                console.log('[DV] goTo dipanggil, dari', this.activeIndex, 'ke', i)
                if (i === this.activeIndex) return;
                this.pauseAll();
                this.activeIndex = i;
                this.$nextTick(() => {
                    const el = this.currentVideoEl();
                    if (el) el.currentTime = 0;
                    if (this.inView) this.playActive();
                });
            },
            next() {
                this.direction = 1;
                if (this.total === 1) { this.restartCurrent(); return; }
                this.goTo((this.activeIndex + 1) % this.total);
            },
            prev() {
                this.direction = -1;
                if (this.total === 1) { this.restartCurrent(); return; }
                this.goTo((this.activeIndex - 1 + this.total) % this.total);
            },
            restartCurrent() {
                const el = this.currentVideoEl();
                if (!el) return;
                el.currentTime = 0;
                if (this.inView) this.playActive();
            },
            handleEnded() {
                if (this.total === 1) { this.restartCurrent(); return; }
                this.next();
            },
            onMouseMove(e) {
                if (!this.parallaxEnabled) return;
                const rect = this.$root.getBoundingClientRect();
                const nx = (e.clientX - rect.left) / rect.width - 0.5;
                const ny = (e.clientY - rect.top) / rect.height - 0.5;
                const amplitude = 6;
                this.offsetX = -nx * amplitude;
                this.offsetY = -ny * amplitude;
            },
            resetParallax() {
                this.offsetX = 0;
                this.offsetY = 0;
            }
        }"
        x-on:mousemove="onMouseMove($event)"
        x-on:mouseenter="hoveringStage = true"
        x-on:mouseleave="hoveringStage = false"
    >
        {{-- Frame video (Penuh Layar) --}}
        <div class="absolute inset-0 w-full h-full overflow-hidden">

            {{-- Gradient overlay top (gelap di atas) --}}
            <div class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-b from-black/70 via-black/20 to-transparent pointer-events-none z-15"></div>

            {{-- Header section + tombol admin (mengapung di atas video) --}}
            <div class="absolute left-0 right-0 top-[42%] -translate-y-1/2 z-30 flex justify-center px-6 pointer-events-none">
                <div class="max-w-4xl text-center">
                    <h1 id="hero-title" class="text-3xl md:text-5xl lg:text-6xl font-exo font-bold uppercase text-white mb-4 md:mb-6 tracking-wide drop-shadow-xl min-h-[2em] md:min-h-[1.2em]"></h1>
                    <p class="text-sm md:text-base lg:text-lg text-slate-100 font-sans max-w-2xl mx-auto leading-relaxed drop-shadow-md opacity-90">
                        Memadukan potensi wisata alam, wisata sejarah, dan wisata edukasi dalam satu kawasan yang saling melengkapi.
                    </p>
                </div>
            </div>
            @if(Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('admin.destination-videos.index') }}"
                   class="absolute top-24 md:top-28 right-6 md:right-12 z-30 bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-none shadow transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                    <i class="fa-solid fa-pen-to-square"></i> Kelola Destinasi
                </a>
            @endif

            {{-- Stage yang digeser parallax. Overscan di .dv-stage sehingga :style hanya handle transform. --}}
            <div class="dv-stage transition-[filter,transform] duration-300" :class="hoveringStage ? 'brightness-125 saturate-125 contrast-105' : ''" :style="stageStyle" x-ref="stage">
                <template x-for="(video, idx) in videos" :key="video.id">
                    <video
                        :data-index="idx"
                        :src="video.src"
                        :class="activeIndex === idx
                            ? 'opacity-100 z-10 pointer-events-auto'
                            : 'opacity-0 z-0 pointer-events-none'"
                        :preload="(activeIndex === idx || nextIndex === idx) ? 'auto' : 'metadata'"
                        muted
                        playsinline
                        class="absolute inset-0 h-full w-full object-cover transition-opacity duration-200"
                        x-on:ended="handleEnded()"
                    ></video>
                </template>
            </div>

            {{-- Overlay gradasi bawah (untuk teks caption/navigasi) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-black/10 pointer-events-none z-15"></div>

            {{-- Navigasi & Tombol Panah dalam Satu Baris Flex --}}
            <div class="absolute inset-x-0 bottom-20 md:bottom-40 z-30 flex items-center justify-center gap-3 md:gap-6 max-w-md md:max-w-2xl mx-auto px-4 pointer-events-none">
                {{-- Tombol panah kiri (prev) --}}
                <button
                    type="button"
                    x-on:click="prev()"
                    aria-label="Video sebelumnya"
                    class="pointer-events-auto text-white/50 hover:text-white transition-colors duration-300 focus:outline-none shrink-0 px-2 py-3"
                >
                    <i class="fa-solid fa-chevron-left text-sm md:text-base"></i>
                </button>

                {{-- Navigasi judul destinasi (3 slot tetap) --}}
                <div class="flex-1 pointer-events-auto min-w-0">
                    <div class="relative w-full">
                        {{-- Garis horizontal tipis --}}
                        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/25 to-transparent"></div>
                        {{-- Segitiga penunjuk, selalu di tengah --}}
                        <div class="absolute -top-[8px] left-1/2 -translate-x-1/2 w-0 h-0 border-l-[5px] border-l-transparent border-r-[5px] border-r-transparent border-t-[6px] border-t-white"></div>

                        <div class="pt-3 grid grid-cols-3 items-start gap-2 md:gap-4">
                            {{-- Slot kiri: video sebelumnya (looping) --}}
                            <div
                                class="text-center cursor-pointer select-none min-w-0"
                                x-show="total > 1"
                                x-on:click="prev()"
                            >
                                <h3
                                    class="truncate text-white/45 font-medium text-xs md:text-sm hover:text-white/75 transition-colors duration-300"
                                    x-effect="
                                        activeIndex;
                                        $el.classList.remove('dv-nav-anim-next', 'dv-nav-anim-prev');
                                        void $el.offsetWidth;
                                        $el.classList.add(direction === 1 ? 'dv-nav-anim-next' : 'dv-nav-anim-prev');
                                    "
                                    x-text="videos[leftIndex].judul"
                                ></h3>
                            </div>

                            {{-- Slot tengah: video aktif, judul selalu penuh --}}
                            <div
                                class="text-center min-w-0"
                                x-on:mouseenter="hoveredIndex = activeIndex"
                                x-on:mouseleave="hoveredIndex = null"
                            >
                                <h3
                                    class="text-white font-bold text-base md:text-xl leading-snug"
                                    x-effect="
                                        activeIndex;
                                        $el.classList.remove('dv-nav-anim-next', 'dv-nav-anim-prev');
                                        void $el.offsetWidth;
                                        $el.classList.add(direction === 1 ? 'dv-nav-anim-next' : 'dv-nav-anim-prev');
                                    "
                                    x-text="videos[activeIndex].judul"
                                ></h3>
                                <div
                                    class="overflow-hidden transition-all duration-500 ease-in-out mx-auto max-w-[200px]"
                                    :style="hoveredIndex === activeIndex ? 'max-height: 80px; opacity: 1; transform: translateY(0);' : 'max-height: 0px; opacity: 0; transform: translateY(-4px);'"
                                >
                                    <p
                                        class="text-white/70 text-[10px] md:text-xs mt-1 leading-relaxed"
                                        x-text="videos[activeIndex].caption"
                                    ></p>
                                </div>
                            </div>

                            {{-- Slot kanan: video berikutnya (looping) --}}
                            <div
                                class="text-center cursor-pointer select-none min-w-0"
                                x-show="total > 1"
                                x-on:click="next()"
                            >
                                <h3
                                    class="truncate text-white/45 font-medium text-xs md:text-sm hover:text-white/75 transition-colors duration-300"
                                    x-effect="
                                        activeIndex;
                                        $el.classList.remove('dv-nav-anim-next', 'dv-nav-anim-prev');
                                        void $el.offsetWidth;
                                        $el.classList.add(direction === 1 ? 'dv-nav-anim-next' : 'dv-nav-anim-prev');
                                    "
                                    x-text="videos[rightIndex].judul"
                                ></h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol panah kanan (next) --}}
                <button
                    type="button"
                    x-on:click="next()"
                    aria-label="Video berikutnya"
                    class="pointer-events-auto text-white/50 hover:text-white transition-colors duration-300 focus:outline-none shrink-0 px-2 py-3"
                >
                    <i class="fa-solid fa-chevron-right text-sm md:text-base"></i>
                </button>
            </div>

            {{-- Spotlight Overlay kustom yang mengikuti kursor --}}
            <div
                class="pointer-events-none absolute inset-0 z-20 transition-opacity duration-300"
                :class="hoveringStage ? 'opacity-100' : 'opacity-0'"
                :style="'background: radial-gradient(circle 380px at ' + (50 + offsetX * 40) + '% ' + (50 + offsetY * 40) + '%, rgba(255,255,255,0.18), transparent 70%);'"
            ></div>

            <!-- Multi-layered Aesthetic Wave Divider -->
            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
                <svg class="relative block w-full h-20 md:h-44" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <!-- Layer 1: Back Wave (Translucent Brand-Light) - Tall wave -->
                    <path d="M0,10 C150,40,350,0,600,25 C850,50,1050,15,1200,20 L1200,120 L0,120 Z" fill="rgba(116, 157, 178, 0.45)"></path>
                    <!-- Layer 2: Middle Wave (Translucent Brand-Dark) - Tall wave -->
                    <path d="M0,40 C240,60,380,30,700,50 C1000,70,1080,40,1200,45 L1200,120 L0,120 Z" fill="rgba(13, 53, 94, 0.35)"></path>
                    <!-- Layer 3: Front Wave (Solid White) - Tall wave, blends with content below -->
                    <path d="M0,70 C320,90,420,55,740,70 C1040,85,1120,65,1200,75 L1200,120 L0,120 Z" fill="#ffffff"></path>
                </svg>
            </div>
        </div>
    </section>
    <div id="heroSentinel" aria-hidden="true" class="h-px w-full bg-transparent"></div>
    @endif

    @if($destinationVideos->count() === 0 && Auth::check() && Auth::user()->isAdmin())
        <section class="px-6 md:px-12 py-12 bg-slate-50">
            <div class="max-w-2xl mx-auto rounded-xl border-2 border-dashed border-slate-300 p-10 text-center">
                <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 text-xl mb-4">
                    <i class="fa-solid fa-video-slash"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum ada video destinasi</h3>
                <p class="text-sm text-slate-500 mb-5">Section "Jelajahi Destinasi" akan muncul secara otomatis setelah Anda menambahkan minimal satu video.</p>
                <a href="{{ route('admin.destination-videos.create') }}"
                   class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition shadow">
                    <i class="fa-solid fa-plus"></i> Tambah Video Destinasi Pertama
                </a>
            </div>
        </section>
    @endif


    <!-- SECTION B: About Us (Tentang Desa) -->

    <section id="tentang" class="bg-transparent py-10 md:py-32 px-4 md:px-12 relative overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-12 gap-6 md:gap-8 lg:gap-16 items-center">
                <!-- Text Block Left with custom radio tabs -->
                <div class="lg:col-span-7 space-y-3 md:space-y-6">

                    
                    <div class="flex flex-col space-y-0">
                        <h2 class="text-base sm:text-lg md:text-2xl font-heading text-brand-dark tracking-wide leading-tight mb-0">
                            SELAMAT DATANG DI
                        </h2>
                        <h2 class="text-xl sm:text-2xl md:text-5xl font-heading text-brand-dark tracking-wide leading-none mt-0">PUNJULHARJO
                        </h2>
                    </div>
                    
                    <div class="space-y-3">
                        <p class="text-gray-600 font-sans text-xs sm:text-sm md:text-lg leading-relaxed text-justify">
                            Desa Punjulharjo merupakan salah satu desa pesisir yang terletak di Kabupaten Rembang, Jawa Tengah. Secara geografis, Punjulharjo berada di kawasan pesisir utara Jawa yang memiliki hubungan erat dengan kehidupan bahari. Letaknya yang berada di wilayah pantai menjadikan desa ini memiliki sumber daya alam yang khas. Keindahan pantainya, kekayaan sejarah maritimnya, serta kehidupan masyarakat pesisir yang masih kuat dengan nilai kebersamaan menjadikan Punjulharjo sebagai desa yang memiliki daya tarik tersendiri.
                        </p>
                    </div>
                </div>
                
                <!-- Graphic/Photo Block Right -->
                <div class="lg:col-span-5 relative">
                    <!-- Background aesthetic soft blob shape (Removed/Reset) -->
                    <div class="absolute -inset-4 bg-transparent z-0"></div>
                    
                    <div class="cyber-card-container aspect-[4/3] w-full relative z-10 group">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <!-- Floating Edit Button on Card Hover - Placed on top layer outside the 3D trackers -->
                            <div class="absolute top-4 right-4 z-[50] opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-auto">
                                <button type="button" onclick="event.stopPropagation(); document.getElementById('edit-about-modal').classList.remove('hidden')" 
                                        class="bg-white/95 hover:bg-white text-slate-800 p-2.5 rounded-md shadow-md border border-slate-200/50 flex items-center justify-center">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endif
                        <div class="cyber-card-canvas">
                            <!-- 25 Hover Trackers -->
                            <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div>
                            <div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div>
                            <div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div>
                            <div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div>
                            <div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                            
                            <!-- The Card -->
                            <div class="cyber-3d-card relative overflow-hidden rounded-none shadow bg-slate-100 w-full h-full cursor-pointer select-none">
                                <div class="card-glare"></div>
                                <div class="glowing-elements">
                                    <div class="glow-1"></div>
                                    <div class="glow-2"></div>
                                    <div class="glow-3"></div>
                                </div>
                                @php
                                    $aboutImg = \App\Models\SiteSetting::getValue('about_image');
                                    $aboutImgUrl = $aboutImg 
                                        ? (str_starts_with($aboutImg, 'http') ? $aboutImg : Storage::url($aboutImg)) 
                                        : 'https://images.unsplash.com/photo-1540805513758-2943743a4e2b?auto=format&fit=crop&w=800&q=80';
                                @endphp
                                <img src="{{ $aboutImgUrl }}" 
                                     alt="Desa Pesisir Punjulharjo" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-fixed-image-section
        key="hero_welcome_nature"
        image="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80"

        title="Keindahan Alam Punjulahrjo"
        subtitle="Dari keteduhan ribuan pohon cemara hingga pesona pantai pasir putih yang membentang luas di pesisir utara Jawa."
        height="h-[65vh]"
        align="center">
        <a href="{{ route('tentang') }}#wisata" 
           class="inline-flex items-center gap-2 px-5 py-3 md:px-8 md:py-3.5 bg-sky-600 hover:bg-sky-700 text-white font-bold rounded-xl shadow-lg transition duration-300 text-xs sm:text-sm">
            <i class="fa-solid fa-compass text-xs sm:text-sm"></i> Jelajahi Destinasi Wisata &rarr;
        </a>
    </x-fixed-image-section>

    <!-- SECTION D: Aesthetic Photo Gallery -->
    <section class="bg-white py-10 md:py-16 px-4 md:px-6">
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center space-y-2 md:space-y-4">

                <h2 class="text-xl sm:text-2xl md:text-5xl font-heading text-gray-900 tracking-wide">
                    Potret Punjulharjo
                </h2>
                <p class="text-gray-500 font-sans text-xs sm:text-sm md:text-base max-w-xl mx-auto">
                    Koleksi sudut-sudut keindahan alam, budaya, dan momen di sepanjang pesisir pantai desa kami.
                </p>
            </div>
            @if(Auth::check() && Auth::user()->isAdmin())
                <!-- Floating Add Button for Gallery -->
                <div class="absolute top-0 right-0">
                    <button onclick="document.getElementById('add-gallery-modal').classList.remove('hidden')" 
                            class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-none shadow transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                        <i class="fa-solid fa-plus"></i> Tambah Foto
                    </button>
                </div>
            @endif
        </div>
    </section>

    @php
        $gridClasses = [
            'col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-1',
            'col-span-1 row-span-1 md:col-span-1 md:row-span-2 md:col-start-1 md:row-start-3',
            'col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-1',
            'col-span-1 row-span-1 md:col-span-1 md:row-span-1 md:col-start-2 md:row-start-2',
            'col-span-2 row-span-1 md:col-span-2 md:row-span-2 md:col-start-3 md:row-start-1',
            'col-span-2 row-span-1 md:col-span-3 md:row-span-2 md:col-start-2 md:row-start-3',
        ];
    @endphp

    <section x-data="{ activePhoto: null }" class="relative">
        <div class="w-full h-auto md:h-[100vh] grid grid-cols-2 md:grid-cols-4 auto-rows-[120px] sm:auto-rows-[180px] md:auto-rows-auto md:grid-rows-4 gap-0 overflow-hidden bg-black">
            @foreach(array_slice($galleryItems, 0, 6) as $index => $item)
                @php
                    $imageUrl = str_starts_with($item['image'], 'http') ? $item['image'] : Storage::url($item['image']);
                @endphp
                <div @click="activePhoto = '{{ $imageUrl }}'" 
                     class="relative w-full h-full group {{ $gridClasses[$index] ?? 'hidden' }} overflow-hidden cursor-pointer">
                    <img src="{{ $imageUrl }}" 
                         alt="{{ $item['title'] }}" 
                         class="absolute inset-0 w-full h-full object-cover rounded-none">
                    
                    <!-- Flat Title Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 pointer-events-none z-10">
                        <span class="text-white font-medium text-lg leading-tight">{{ $item['title'] }}</span>
                    </div>

                    @if(Auth::check() && Auth::user()->isAdmin())
                        <!-- Floating Edit Button on top of everything -->
                        <div class="absolute top-4 right-4 z-[50] pointer-events-auto">
                            <button onclick="openEditGalleryModal(event, {{ json_encode($item) }})" 
                                    class="bg-white/95 hover:bg-white text-slate-800 p-2 rounded-md shadow border border-slate-200/50 flex items-center justify-center transition hover:scale-105 active:scale-95">
                                <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Photo Lightbox Modal -->
        <div x-show="activePhoto" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[1000] flex items-center justify-center bg-black/90 p-4"
             @click="activePhoto = null"
             style="display: none;"
             x-cloak>
            <button class="absolute top-6 right-6 text-white/70 hover:text-white transition text-3xl focus:outline-none" @click="activePhoto = null">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img :src="activePhoto" class="max-w-full max-h-[90vh] object-contain shadow-2xl rounded-none border border-white/10" @click.stop>
        </div>
    </section>

        @if(Auth::check() && Auth::user()->isAdmin())
            <!-- Add Gallery Modal -->
            <div id="add-gallery-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800">Tambah Foto Galeri</h3>
                        <button type="button" onclick="document.getElementById('add-gallery-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">File Foto</label>
                                <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Foto</label>
                                <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Contoh: Sunset di Karang Jahe" required>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ukuran / Layout Grid</label>
                                <select name="aspect_class" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                    <option value="aspect-square">Square (1:1)</option>
                                    <option value="aspect-[3/4] md:row-span-2">Tall Vertical (Potrait)</option>
                                    <option value="aspect-[4/3] md:col-span-2">Wide Horizontal (Landscape)</option>
                                    <option value="aspect-[16/9] md:col-span-2">Wide Cinema (Panoramik)</option>
                                    <option value="aspect-[4/3]">Medium Rectangle</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('add-gallery-modal').classList.add('hidden')" 
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

            <!-- Edit Gallery Modal -->
            <div id="edit-gallery-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800">Edit Foto Galeri</h3>
                        <button type="button" onclick="document.getElementById('edit-gallery-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="edit-gallery-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto (opsional)</label>
                                <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Foto</label>
                                <input type="text" id="edit-gallery-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ukuran / Layout Grid</label>
                                <select id="edit-gallery-aspect" name="aspect_class" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                    <option value="aspect-square">Square (1:1)</option>
                                    <option value="aspect-[3/4] md:row-span-2">Tall Vertical (Potrait)</option>
                                    <option value="aspect-[4/3] md:col-span-2">Wide Horizontal (Landscape)</option>
                                    <option value="aspect-[16/9] md:col-span-2">Wide Cinema (Panoramik)</option>
                                    <option value="aspect-[4/3]">Medium Rectangle</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                            <button type="button" onclick="confirmDeleteGallery()"
                                    class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                                Hapus
                            </button>
                            
                            <div class="flex gap-2">
                                <button type="button" onclick="document.getElementById('edit-gallery-modal').classList.add('hidden')" 
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

                    <form id="delete-gallery-form" action="" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            <script>
                function openEditGalleryModal(e, item) {
                    e.stopPropagation();
                    const modal = document.getElementById('edit-gallery-modal');
                    modal.querySelector('#edit-gallery-form').action = '/admin/gallery/' + item.id;
                    modal.querySelector('#edit-gallery-title').value = item.title;
                    modal.querySelector('#edit-gallery-aspect').value = item.aspect_class;
                    modal.querySelector('#delete-gallery-form').action = '/admin/gallery/' + item.id;
                    modal.classList.remove('hidden');
                }

                function confirmDeleteGallery() {
                    if (confirm('Apakah Anda yakin ingin menghapus foto galeri ini?')) {
                        document.getElementById('delete-gallery-form').submit();
                    }
                }
            </script>
        @endif


    <!-- SECTION E: Culture & Community (Kehidupan Budaya) -->
    <section class="bg-brand-muted/10 py-10 md:py-32 px-4 md:px-12 relative">
        <!-- Subtle background shapes -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-brand-light/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand-dark/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                <!-- Photo Card Left -->
                <div class="order-2 lg:order-1 relative">
                    <div class="absolute -inset-4 bg-gradient-to-br from-brand-light/10 to-brand-dark/10 rounded-[3rem] blur-xl z-0"></div>
                    
                    <div class="cyber-card-container aspect-[4/3] w-full relative z-10 group">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <!-- Floating Edit Button on Card Hover - Placed on top layer outside the 3D trackers -->
                            <div class="absolute top-4 right-4 z-[50] opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-auto">
                                <button type="button" onclick="event.stopPropagation(); document.getElementById('edit-culture-modal').classList.remove('hidden')" 
                                        class="bg-white/95 hover:bg-white text-slate-800 p-2.5 rounded-md shadow-md border border-slate-200/50 flex items-center justify-center">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endif
                        <div class="cyber-card-canvas">
                            <!-- 25 Hover Trackers -->
                            <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div>
                            <div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div>
                            <div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div>
                            <div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div>
                            <div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                            
                            <!-- The Card -->
                            <div class="cyber-3d-card relative overflow-hidden rounded-[2.5rem] shadow-2xl bg-slate-100 w-full h-full cursor-pointer select-none">
                                <div class="card-glare"></div>
                                <div class="glowing-elements">
                                    <div class="glow-1"></div>
                                    <div class="glow-2"></div>
                                    <div class="glow-3"></div>
                                </div>
                                @php
                                    $cultureImg = \App\Models\SiteSetting::getValue('culture_image');
                                    $cultureImgUrl = $cultureImg 
                                        ? (str_starts_with($cultureImg, 'http') ? $cultureImg : Storage::url($cultureImg)) 
                                        : 'https://images.unsplash.com/photo-1540805513758-2943743a4e2b?auto=format&fit=crop&w=800&q=80';
                                @endphp
                                <img src="{{ $cultureImgUrl }}" 
                                     alt="Budaya Desa Punjulharjo" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Text Block Right -->
                <div class="order-1 lg:order-2 space-y-3 md:space-y-6">

                    
                    <h2 class="text-xl sm:text-2xl md:text-5xl font-heading text-brand-dark tracking-wide leading-tight">
                        Kehidupan Budaya
                    </h2>
                    
                    <p class="text-slate-600 font-sans text-xs sm:text-sm md:text-lg leading-relaxed text-justify">
                        Masyarakat Desa Punjulharjo dikenal memiliki kehidupan sosial yang erat dengan semangat gotong royong. Sebagai desa pesisir, warga setempat terbiasa hidup berdampingan dengan alam. Aktivitas masyarakat mencerminkan adaptasi terhadap lingkungan pantai, sementara budaya lokal dan tradisi tetap dijaga sebagai bagian dari identitas desa yang kuat.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- SECTION EEE: 3D Coverflow Experience (Sorotan Aktivitas Desa) -->
    <section class="bg-transparent pt-10 pb-12 md:pt-32 md:pb-24 px-4 md:px-12 relative overflow-hidden">
        <!-- Background shapes matching the design system -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-sky-200/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-200/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <!-- Header -->
            <div class="space-y-2 md:space-y-4 mb-8 md:mb-16 max-w-3xl mx-auto relative">

                <h2 class="text-xl sm:text-2xl md:text-5xl font-heading text-gray-900 tracking-wide leading-tight">
                    Jelajahi Aktivitas
                </h2>
                <p class="text-gray-600 font-sans text-xs sm:text-sm md:text-lg">
                    Klik kartu di kanan/kiri untuk memutar dan memfokuskan petualangan seru yang dapat Anda nikmati di desa kami.
                </p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <!-- Floating Add Button for Carousel -->
                    <div class="absolute top-0 right-0">
                        <button onclick="document.getElementById('add-carousel-modal').classList.remove('hidden')" 
                                class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-none shadow transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                            <i class="fa-solid fa-plus"></i> Tambah Aktivitas
                        </button>
                    </div>
                @endif
            </div>

            <!-- Viewport for 3D Carousel -->
            <div class="coverflow-viewport">
                @foreach($carouselItems as $item)
                    <!-- Card -->
                    <div class="coverflow-card rounded-xl overflow-hidden shadow bg-slate-900 border border-white/10 flex flex-col justify-end p-5 md:p-8 select-none relative group/card">
                        <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : Storage::url($item['image']) }}" alt="{{ $item['title'] }}" class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0 transition-transform duration-700 group-hover/card:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none opacity-0 group-hover/card:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-20 text-left space-y-2 pointer-events-none opacity-0 translate-y-3 group-hover/card:opacity-100 group-hover/card:translate-y-0 transition-all duration-500">
                            <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">{{ $item['title'] }}</h4>
                            <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">{{ $item['description'] }}</p>
                        </div>
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <!-- Floating Edit Button on Card Hover -->
                            <div class="absolute top-4 right-4 z-30 opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                                <button onclick="openEditCarouselModal(event, {{ json_encode($item) }})" 
                                        class="bg-white/90 hover:bg-white text-slate-800 p-2.5 rounded-none shadow border border-white/20 flex items-center justify-center">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Bullet indicators -->
            <div class="mt-4 md:mt-8 flex justify-center items-center gap-2" id="coverflow-dots">
                @foreach($carouselItems as $index => $item)
                    <button class="h-2 transition-all duration-300 {{ $index === 0 ? 'bg-sky-500 w-6' : 'bg-slate-300 w-2' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        </div>

        @if(Auth::check() && Auth::user()->isAdmin())
            <!-- Add Carousel Modal -->
            <div id="add-carousel-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800">Tambah Aktivitas Carousel</h3>
                        <button type="button" onclick="document.getElementById('add-carousel-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Foto Aktivitas</label>
                                <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Aktivitas</label>
                                <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Contoh: Susur Pantai" required>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Ringkas</label>
                                <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Deskripsi aktivitas..." required></textarea>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('add-carousel-modal').classList.add('hidden')" 
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

            <!-- Edit About Image Modal -->
            <div id="edit-about-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Foto Tentang Desa</h3>
                        <button type="button" onclick="document.getElementById('edit-about-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.about-image.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto</label>
                                <input type="file" name="about_image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                <p class="text-xs text-slate-400 mt-1">Hanya format gambar (jpg, jpeg, png, webp) maks 5MB.</p>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('edit-about-modal').classList.add('hidden')" 
                                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark transition-colors font-semibold px-5 py-2 rounded-none text-sm shadow">
                                Simpan
                            </button>
                        </div>
                    </form>
                    @php
                        $backupAboutImage = \App\Models\SiteSetting::getValue('about_image_backup');
                    @endphp
                    @if($backupAboutImage)
                        <div class="p-6 border-t border-slate-100 bg-slate-50">
                            <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                            <div class="flex items-center gap-3">
                                <img src="{{ (str_starts_with($backupAboutImage, 'http') || str_contains($backupAboutImage, 'storage/')) ? asset($backupAboutImage) : Storage::url($backupAboutImage) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                                <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="hero_key" value="about_image">
                                    <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                        <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Edit Culture Image Modal -->
            <div id="edit-culture-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800 font-bold">Edit Foto Kehidupan Budaya</h3>
                        <button type="button" onclick="document.getElementById('edit-culture-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.culture-image.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto</label>
                                <input type="file" name="culture_image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                <p class="text-xs text-slate-400 mt-1">Hanya format gambar (jpg, jpeg, png, webp) maks 5MB.</p>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('edit-culture-modal').classList.add('hidden')" 
                                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark transition-colors font-semibold px-5 py-2 rounded-none text-sm shadow">
                                Simpan
                            </button>
                        </div>
                    </form>
                    @php
                        $backupCultureImage = \App\Models\SiteSetting::getValue('culture_image_backup');
                    @endphp
                    @if($backupCultureImage)
                        <div class="p-6 border-t border-slate-100 bg-slate-50">
                            <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                            <div class="flex items-center gap-3">
                                <img src="{{ (str_starts_with($backupCultureImage, 'http') || str_contains($backupCultureImage, 'storage/')) ? asset($backupCultureImage) : Storage::url($backupCultureImage) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                                <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="hero_key" value="culture_image">
                                    <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                        <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Edit Carousel Modal -->
            <div id="edit-carousel-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 text-left">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800">Edit Aktivitas Carousel</h3>
                        <button type="button" onclick="document.getElementById('edit-carousel-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="edit-carousel-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto (opsional)</label>
                                <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Aktivitas</label>
                                <input type="text" id="edit-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi Ringkas</label>
                                <textarea id="edit-description" name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required></textarea>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                            <button type="button" onclick="confirmDeleteCarousel()"
                                    class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                                Hapus
                            </button>
                            
                            <div class="flex gap-2">
                                <button type="button" onclick="document.getElementById('edit-carousel-modal').classList.add('hidden')" 
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

                    <form id="delete-carousel-form" action="" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            <script>
                function openEditCarouselModal(e, item) {
                    e.stopPropagation();
                    const modal = document.getElementById('edit-carousel-modal');
                    modal.querySelector('#edit-carousel-form').action = '/admin/carousel/' + item.id;
                    modal.querySelector('#edit-title').value = item.title;
                    modal.querySelector('#edit-description').value = item.description;
                    modal.querySelector('#delete-carousel-form').action = '/admin/carousel/' + item.id;
                    modal.classList.remove('hidden');
                }

                function confirmDeleteCarousel() {
                    if (confirm('Apakah Anda yakin ingin menghapus aktivitas carousel ini?')) {
                        document.getElementById('delete-carousel-form').submit();
                    }
                }
            </script>
        @endif
    </section>

    <!-- SECTION F: Final Call-to-Action (CTA) -->
    <section class="relative py-10 md:py-16 px-4 md:px-6 text-center text-white overflow-hidden bg-slate-900">
        <!-- Scenic Background Image with Dark/Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-40 transition-transform duration-[10000ms] hover:scale-105"
             style="background-image: url('{{ asset($heroBg) }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-950/80 via-slate-900/90 to-indigo-950/95"></div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-4 md:space-y-8">
            <h2 class="text-xl sm:text-2xl md:text-6xl font-heading tracking-wide">
                Mulai Kunjungan Anda
            </h2>
            
            <p class="text-slate-200 font-sans text-xs sm:text-sm md:text-xl leading-relaxed max-w-2xl mx-auto">
                Dengan potensi alam, sejarah, budaya, dan partisipasi masyarakat yang kuat, Punjulharjo layak diperkenalkan lebih luas sebagai desa wisata yang memiliki keindahan, pengetahuan, dan nilai kehidupan yang lengkap.
            </p>
            
            <div class="pt-2 md:pt-4">
                <a href="#kontak-peta" 
                   onclick="document.querySelector('footer').scrollIntoView({ behavior: 'smooth' }); return false;"
                   class="inline-flex items-center justify-center bg-white text-indigo-900 font-bold px-5 py-3 md:px-8 md:py-4 rounded-none text-xs sm:text-sm md:text-lg shadow hover:shadow-white/10 transition duration-300 transform hover:-translate-y-1">
                    Lihat Peta Lokasi
                    <i class="fa-solid fa-map-location-dot ml-2 md:ml-3"></i>
                </a>
            </div>
        </div>
    </section>



    {{-- ============================================================
         SECTION G — PROMO KONTEN PUSTAKA (BERITA, VIDEO, E-BOOK)
         Disisipkan di antara akhir Section F dan @push('scripts').
         JANGAN memindahkan blok ini ke dalam @push('scripts').
         ============================================================ --}}
    @php
        $promoSections = [
            ['label' => 'Berita',  'data' => $promoBlog,  'tab' => 'blog',  'type' => 'Berita'],
            ['label' => 'Video',   'data' => $promoVideo, 'tab' => 'video', 'type' => 'Video'],
            ['label' => 'E-Book',  'data' => $promoEbook, 'tab' => 'ebook', 'type' => 'E-Book'],
        ];
        $adaPromo = collect($promoSections)->contains(fn ($s) => $s['data']['items']->isNotEmpty());
    @endphp

    @if($adaPromo)
    <section class="bg-slate-50 py-20 border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Heading section --}}
            <div class="text-center mb-14">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-600 mb-3">
                    Pustaka Desa
                </span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-800 leading-tight">
                    Jelajahi Pustaka Desa
                </h2>
                <p class="mt-3 text-slate-500 text-sm md:text-base max-w-xl mx-auto">
                    Berita, video, dan bacaan terbaru dari Desa Punjulharjo.
                </p>
            </div>

            @foreach($promoSections as $s)
                @if($s['data']['items']->isNotEmpty())
                <div class="mb-16 last:mb-0">

                    {{-- Sub-heading per jenis konten --}}
                    <div class="flex items-center justify-between mb-6 gap-4">
                        <h3 class="text-lg md:text-xl font-bold text-slate-700 m-0 flex items-center gap-2">
                            @if($s['data']['mode'] === 'unggulan')
                                <i class="fa-solid fa-star text-amber-400 text-base"></i>
                                Pilihan {{ $s['label'] }}
                            @else
                                <i class="fa-solid fa-clock-rotate-left text-sky-400 text-base"></i>
                                {{ $s['label'] }} Terbaru
                            @endif
                        </h3>
                        <a href="{{ url('/pustaka?tab=' . $s['tab']) }}"
                           class="flex-shrink-0 text-xs font-semibold text-sky-600 hover:text-sky-800 underline underline-offset-2 transition-colors whitespace-nowrap">
                            Lihat Semua
                            <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                        </a>
                    </div>

                    {{-- Grid kartu --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($s['data']['items'] as $item)
                            @if($s['tab'] === 'blog')
                                @php
                                    $promoImg  = $item->image ? Storage::url($item->image) : null;
                                    $promoUrl  = route('blog.show', $item->slug);
                                    $promoDate = ($item->published_at
                                                    ? \Carbon\Carbon::parse($item->published_at)
                                                    : $item->created_at)->translatedFormat('d M Y');
                                @endphp
                            @elseif($s['tab'] === 'video')
                                @php
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $item->video_url, $_ym);
                                    $_vid = $_ym[1] ?? null;
                                    $promoImg  = $_vid
                                        ? "https://img.youtube.com/vi/{$_vid}/hqdefault.jpg"
                                        : ($item->thumbnail ? Storage::disk('public_direct')->url($item->thumbnail) : null);
                                    $promoUrl  = route('video.show', $item->slug);
                                    $promoDate = $item->created_at->translatedFormat('d M Y');
                                @endphp
                            @else {{-- ebook --}}
                                @php
                                    $promoImg  = $item->cover_path ? Storage::url($item->cover_path) : null;
                                    $promoUrl  = route('ebook.show', $item->id);
                                    $promoDate = $item->created_at->translatedFormat('d M Y');
                                @endphp
                            @endif

                            <x-promo-card
                                :title="$item->title"
                                :url="$promoUrl"
                                :image="$promoImg"
                                :date="$promoDate"
                                :categories="$item->categories"
                                :typeLabel="$s['type']"
                            />
                        @endforeach
                    </div>

                </div>
                @endif
            @endforeach

        </div>
    </section>
    @endif


    <!-- Scripts for Tentang Desa Wisata custom radio tabs & StPageFlip Interactive Book -->
    @push('scripts')

    {{-- CSS overscan stage: dipisah dari :style Alpine agar tidak ditimpa --}}
    <style>
    .dv-stage {
        position: absolute;
        inset: -20%;
        width: 140%;
        height: 140%;
    }
    @keyframes dvNavFromRight {
        from { opacity: 0; transform: translateX(14px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes dvNavFromLeft {
        from { opacity: 0; transform: translateX(-14px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .dv-nav-anim-next { animation: dvNavFromRight 0.35s ease-out; }
    .dv-nav-anim-prev { animation: dvNavFromLeft 0.35s ease-out; }
    </style>

    {{-- Script magnet/snap-scroll kustom untuk section Jelajahi Destinasi --}}
    <script>
        (function () {
            const section = document.getElementById('jelajahi-destinasi');
            if (!section) return;

            let scrollTimer = null;
            let isAutoScrolling = false;
            const ZONE = 0.6;           // rentang trigger (persen tinggi layar)
            const ALIGN_THRESHOLD = 4;  // px, toleransi dianggap "sudah pas"

            function waitForScrollEnd(callback) {
                let lastY = window.scrollY;
                let stableCount = 0;
                const interval = setInterval(() => {
                    const currentY = window.scrollY;
                    if (currentY === lastY) {
                        stableCount++;
                        if (stableCount >= 2) {
                            clearInterval(interval);
                            callback();
                        }
                    } else {
                        stableCount = 0;
                        lastY = currentY;
                    }
                }, 50);
                // Jaga-jaga supaya interval tidak jalan selamanya.
                setTimeout(() => clearInterval(interval), 2000);
            }

            function checkSnap() {
                if (isAutoScrolling) return;
                const rect = section.getBoundingClientRect();
                const vh = window.innerHeight;

                const isInZone = rect.top > -vh * ZONE && rect.top < vh * ZONE;
                const isAligned = Math.abs(rect.top) <= ALIGN_THRESHOLD;

                if (isInZone && !isAligned) {
                    isAutoScrolling = true;
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    waitForScrollEnd(() => { isAutoScrolling = false; });
                }
            }

            window.addEventListener('scroll', () => {
                if (isAutoScrolling) return;
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(checkSnap, 150);
            }, { passive: true });
        })();
    </script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Radio Tabs Content Switching
            const rd1 = document.getElementById('rd-1');
            const rd2 = document.getElementById('rd-2');
            const rd3 = document.getElementById('rd-3');
            
            const content1 = document.getElementById('tab-content-1');
            const content2 = document.getElementById('tab-content-2');
            const content3 = document.getElementById('tab-content-3');
            
            function updateTabs() {
                if (rd1.checked) {
                    content1.classList.remove('hidden');
                    content2.classList.add('hidden');
                    content3.classList.add('hidden');
                } else if (rd2.checked) {
                    content1.classList.add('hidden');
                    content2.classList.remove('hidden');
                    content3.classList.add('hidden');
                } else if (rd3.checked) {
                    content1.classList.add('hidden');
                    content2.classList.add('hidden');
                    content3.classList.remove('hidden');
                }
            }
            
            if (rd1 && rd2 && rd3) {
                rd1.addEventListener('change', updateTabs);
                rd2.addEventListener('change', updateTabs);
                rd3.addEventListener('change', updateTabs);
            }



            // ==========================================================================
            // 3D Coverflow Experience Carousel Logic
            // ==========================================================================
            const cfCards = document.querySelectorAll('.coverflow-card');
            const cfDots = document.querySelectorAll('#coverflow-dots button');
            let cfActiveIndex = 0;
            const cfTotal = cfCards.length;

            function updateCoverflow() {
                cfCards.forEach((card, index) => {
                    // Reset all position classes
                    card.classList.remove('active', 'left', 'right', 'hidden-left', 'hidden-right');

                    // Calculate distance in a circular list
                    let diff = index - cfActiveIndex;
                    
                    // Handle wrap-around distance properly
                    while (diff < -Math.floor(cfTotal / 2)) diff += cfTotal;
                    while (diff > Math.floor(cfTotal / 2)) diff -= cfTotal;

                    // Assign classes based on relative position
                    if (diff === 0) {
                        card.classList.add('active');
                    } else if (diff === -1) {
                        card.classList.add('left');
                    } else if (diff === 1) {
                        card.classList.add('right');
                    } else if (diff < 0) {
                        card.classList.add('hidden-left');
                    } else {
                        card.classList.add('hidden-right');
                    }
                });

                // Update dots active classes
                cfDots.forEach((dot, index) => {
                    if (index === cfActiveIndex) {
                        dot.className = "h-2 rounded-full transition-all duration-300 bg-sky-500 w-6";
                    } else {
                        dot.className = "h-2 rounded-full transition-all duration-300 bg-slate-300 w-2";
                    }
                });
            }

            // Click listener for cards
            cfCards.forEach((card, index) => {
                card.addEventListener('click', () => {
                    if (cfActiveIndex !== index) {
                        // Check if card is currently clickable (left or right side)
                        let diff = index - cfActiveIndex;
                        while (diff < -Math.floor(cfTotal / 2)) diff += cfTotal;
                        while (diff > Math.floor(cfTotal / 2)) diff -= cfTotal;
                        
                        if (Math.abs(diff) === 1) {
                            cfActiveIndex = index;
                            updateCoverflow();
                        }
                    }
                });
            });

            // Click listener for dots
            cfDots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    cfActiveIndex = index;
                    updateCoverflow();
                });
            });

            // Initial call to set active states
            updateCoverflow();

            // ==========================================================================
            // Typewriter Effect for Hero Title (Page Load Only)
            // ==========================================================================
            const heroTitle = document.getElementById('hero-title');
            if (heroTitle) {
                const text = "WONDERFUL PUNJULHARJO";
                heroTitle.innerHTML = "";
                let index = 0;
                
                // Append inline blinking cursor block scaling with font size
                const cursorSpan = document.createElement('span');
                cursorSpan.className = 'inline-block w-1.5 h-[0.9em] bg-white animate-pulse ml-2 align-middle';
                heroTitle.appendChild(cursorSpan);

                function typeText() {
                    if (index < text.length) {
                        const char = text.charAt(index);
                        if (char === ' ') {
                            const br = document.createElement('br');
                            heroTitle.insertBefore(br, cursorSpan);
                        } else {
                            const charNode = document.createTextNode(char);
                            heroTitle.insertBefore(charNode, cursorSpan);
                        }
                        index++;
                        setTimeout(typeText, 75); // Speed: 75ms per character
                    } else {
                        // After typing is complete, wait 1 second and fade out/remove cursor
                        setTimeout(() => {
                            cursorSpan.remove();
                        }, 1000);
                    }
                }
                // Delay writing start for page load layout setup stability
                setTimeout(typeText, 500);
            }
        });
    </script>
    @endpush
@endsection