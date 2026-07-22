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

    <!-- SECTION A: Hero Section -->
    <section class="relative w-full h-[115vh] flex flex-col justify-center items-center text-center px-6 overflow-hidden bg-transparent">
        @if(Auth::check() && Auth::user()->isAdmin())
            <!-- Floating Edit Button for Hero Background -->
            <div class="absolute top-28 right-8 z-30">
                <button onclick="document.getElementById('edit-hero-modal').classList.remove('hidden')" 
                        class="bg-white/80 hover:bg-white text-slate-800 px-4 py-2.5 rounded-none shadow border border-white/20 transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                    <i class="fa-solid fa-pencil text-sky-600"></i> Edit Background Hero
                </button>
            </div>

            <!-- Edit Hero Modal -->
            <div id="edit-hero-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
                <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                        <h3 class="text-lg font-heading text-slate-800">Edit Background Hero</h3>
                        <button type="button" onclick="document.getElementById('edit-hero-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Foto atau Video Latar Belakang Baru</label>
                                <input type="file" name="hero_background" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                                <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP, MP4, WEBM, MOV, OGG. Ukuran maks: 10MB.</p>
                            </div>
                        </div>
                        <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('edit-hero-modal').classList.add('hidden')" 
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
        @endif
        <!-- Edge-to-edge Background Video/Image with darkened overlay -->
        @php
            $isVideo = false;
            $videoType = 'video/mp4';
            $lowerUrl = Str::lower($heroBgUrl);
            if (Str::endsWith($lowerUrl, '.mp4')) {
                $isVideo = true;
                $videoType = 'video/mp4';
            } elseif (Str::endsWith($lowerUrl, '.webm')) {
                $isVideo = true;
                $videoType = 'video/webm';
            } elseif (Str::endsWith($lowerUrl, '.mov') || Str::endsWith($lowerUrl, '.qt')) {
                $isVideo = true;
                $videoType = 'video/quicktime';
            } elseif (Str::endsWith($lowerUrl, '.ogg')) {
                $isVideo = true;
                $videoType = 'video/ogg';
            }
        @endphp

        @if($isVideo)
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                <source src="{{ $heroBgUrl }}" type="{{ $videoType }}">
            </video>
        @else
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[10000ms] hover:scale-105"
                 style="background-image: url('{{ $heroBgUrl }}');">
            </div>
        @endif

        <div class="relative z-10 max-w-4xl mx-auto pt-16 pb-16">
            <!-- Main Title in THE LAST TRUNKS Font -->
            <h1 id="hero-title" class="text-3xl md:text-5xl lg:text-6xl font-heading text-white mb-6 tracking-wide drop-shadow-xl min-h-[2em] md:min-h-[1.2em]"></h1>
            
            <!-- Subtitle in Poppins Font -->
            <p class="text-sm md:text-base lg:text-lg text-slate-100 font-sans max-w-2xl mx-auto leading-relaxed drop-shadow-md mb-10 opacity-90">
                Memadukan potensi wisata alam, wisata sejarah, dan wisata edukasi dalam satu kawasan yang saling melengkapi.
            </p>
            
            <!-- CTA Button Jelajahi Desa -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#tentang" 
                   class="inline-flex items-center justify-center bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark transition-colors font-semibold px-6 py-3 text-sm rounded-none shadow duration-300 transform hover:-translate-x-1 hover:scale-105">
                    Jelajahi Desa
                    <i class="fa-solid fa-arrow-down ml-3 text-xs animate-bounce"></i>
                </a>
            </div>
        </div>
        
        <!-- Multi-layered Aesthetic Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[60px] md:h-[145px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- Layer 1: Back Wave (Translucent Brand-Light) - Tall wave -->
                <path d="M0,10 C150,40,350,0,600,25 C850,50,1050,15,1200,20 L1200,120 L0,120 Z" fill="rgba(116, 157, 178, 0.45)"></path>
                <!-- Layer 2: Middle Wave (Translucent Brand-Dark) - Tall wave -->
                <path d="M0,40 C240,60,380,30,700,50 C1000,70,1080,40,1200,45 L1200,120 L0,120 Z" fill="rgba(13, 53, 94, 0.35)"></path>
                <!-- Layer 3: Front Wave (Solid White) - Tall wave, blends with content below -->
                <path d="M0,70 C320,90,420,55,740,70 C1040,85,1120,65,1200,75 L1200,120 L0,120 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>


    <!-- SECTION B: About Us (Tentang Desa) -->
    <section id="tentang" class="bg-transparent py-8 md:py-32 px-4 md:px-12 relative overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-12 gap-6 md:gap-8 lg:gap-16 items-center">
                <!-- Text Block Left with custom radio tabs -->
                <div class="lg:col-span-7 space-y-4 md:space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-none bg-brand-muted/10 text-brand-dark text-xs md:text-sm font-semibold uppercase tracking-wider border border-brand-muted/20">
                        <i class="fa-solid fa-feather-pointed"></i> Sekilas Profil
                    </div>
                    
                    <h2 class="text-2xl sm:text-3xl md:text-5xl font-heading text-brand-dark tracking-wide leading-tight">
                        Tentang Desa Wisata
                    </h2>
                    
                    <!-- Radio tab switcher layout -->
                    <div class="radio-tabs-wrapper [--w-label:95px] md:[--w-label:120px]">
                        <div class="wrap">
                            <input checked type="radio" id="rd-1" name="radio" class="rd-1" hidden />
                            <label for="rd-1" class="label text-[11px] md:text-sm py-2.5 px-2 md:py-3 md:px-4" style="--index: 0;"><span>Profil Desa</span></label>
                            <input type="radio" id="rd-2" name="radio" class="rd-2" hidden />
                            <label for="rd-2" class="label text-[11px] md:text-sm py-2.5 px-2 md:py-3 md:px-4" style="--index: 1;"><span>Visi & Misi</span></label>
                            <input type="radio" id="rd-3" name="radio" class="rd-3" hidden />
                            <label for="rd-3" class="label text-[11px] md:text-sm py-2.5 px-2 md:py-3 md:px-4" style="--index: 2;"><span>Potensi</span></label>
                            <div class="bar"></div>
                            <div class="slidebar"></div>
                        </div>
                    </div>

                    <!-- Tab Contents Panel -->
                    <div id="tab-content-1" class="tab-content-panel space-y-4 animate-fade-in">
                        <p class="text-gray-600 font-sans text-sm md:text-lg leading-relaxed text-justify">
                            Desa Punjulharjo merupakan salah satu desa pesisir yang terletak di Kabupaten Rembang, Jawa Tengah. Secara geografis, Punjulharjo berada di kawasan pesisir utara Jawa yang memiliki hubungan erat dengan kehidupan bahari. Letaknya yang berada di wilayah pantai menjadikan desa ini memiliki sumber daya alam yang khas. Keindahan pantainya, kekayaan sejarah maritimnya, serta kehidupan masyarakat pesisir yang masih kuat dengan nilai kebersamaan menjadikan Punjulharjo sebagai desa yang memiliki daya tarik tersendiri.
                        </p>
                    </div>
                    
                    <div id="tab-content-2" class="tab-content-panel hidden space-y-4 animate-fade-in">
                        <div class="p-5 bg-sky-50/50 backdrop-blur-sm rounded-none border border-sky-100">
                            <h4 class="font-bold text-sky-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Visi
                            </h4>
                            <p class="text-gray-700 text-sm md:text-base leading-relaxed">
                                Menjadi desa wisata unggulan berbasis budaya dan kearifan lokal yang berkelanjutan, serta menjadi inspirasi bagi pengembangan desa wisata lainnya di Indonesia.
                            </p>
                        </div>
                        <div class="p-5 bg-indigo-50/50 backdrop-blur-sm rounded-none border border-indigo-100">
                            <h4 class="font-bold text-indigo-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="12" r="6" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg>
                                Misi
                            </h4>
                            <ul class="list-disc list-inside text-gray-700 text-sm md:text-base leading-relaxed space-y-1">
                                <li>Melestarikan warisan budaya dan sejarah desa.</li>
                                <li>Mendorong partisipasi masyarakat dalam pengelolaan wisata.</li>
                                <li>Mengembangkan potensi ekonomi kreatif berbasis wisata.</li>
                                <li>Menjaga kelestarian lingkungan dan keaslian alam desa.</li>
                            </ul>
                        </div>
                    </div>

                    <div id="tab-content-3" class="tab-content-panel hidden space-y-4 animate-fade-in">
                        <p class="text-gray-600 font-sans text-sm md:text-lg leading-relaxed text-justify">
                            Punjulharjo menyajikan perpaduan wisata alam pantai yang mempesona dan wisata sejarah maritim Nusantara:
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-sky-50/50 backdrop-blur-sm rounded-none border border-sky-100">
                                <span class="font-bold text-gray-800 text-sm md:text-base flex items-center gap-2">
                                    <svg class="w-5 h-5 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 12h-20a10 10 0 0 1 20 0Z" />
                                        <path d="M12 12v10" />
                                        <path d="M12 21a2 2 0 0 0 2-2" />
                                    </svg>
                                    Pantai Karang Jahe
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Hamparan pasir putih bersih & ribuan pohon cemara yang rindang.</p>
                            </div>
                            <div class="p-4 bg-sky-50/50 backdrop-blur-sm rounded-none border border-sky-100">
                                <span class="font-bold text-gray-800 text-sm md:text-base flex items-center gap-2">
                                    <svg class="w-5 h-5 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="5" r="3" />
                                        <path d="M12 22V8" />
                                        <path d="M5 12H2a10 10 0 0 0 20 0h-3" />
                                    </svg>
                                    Situs Perahu Kuno
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Bukti arkeologis pelayaran Nusantara dari abad ke-7 Masehi.</p>
                            </div>
                        </div>
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

    <!-- SECTION C.5: Fixed Image Reveal Parallax Banner -->
    <x-fixed-image-section
        image="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80"
        eyebrow="Pesona Pesisir Rembang"
        title="Keindahan Alam & Harmoni Punjulharjo"
        subtitle="Dari keteduhan ribuan pohon cemara hingga pesona pantai pasir putih yang membentang luas di pesisir utara Jawa."
        height="h-[65vh]"
        align="center">
        <a href="{{ route('destinasi') }}" 
           class="inline-flex items-center gap-2 px-8 py-3.5 bg-sky-600 hover:bg-sky-700 text-white font-bold rounded-xl shadow-lg transition duration-300 text-sm">
            <i class="fa-solid fa-compass"></i> Jelajahi Destinasi Wisata &rarr;
        </a>
    </x-fixed-image-section>

    <!-- SECTION D: Aesthetic Photo Gallery -->
    <section class="bg-white py-10 md:py-16 px-4 md:px-6">
        <div class="max-w-6xl mx-auto relative">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-regular fa-images"></i> Galeri Visual
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-5xl font-heading text-gray-900 tracking-wide">
                    Potret Punjulharjo
                </h2>
                <p class="text-gray-500 font-sans max-w-xl mx-auto">
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
        <div class="w-full h-auto md:h-[100vh] grid grid-cols-2 md:grid-cols-4 auto-rows-[180px] md:auto-rows-auto md:grid-rows-4 gap-0 overflow-hidden bg-black">
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
    </section>


    <!-- SECTION E: Culture & Community (Kehidupan Budaya) -->
    <section class="bg-brand-muted/10 py-12 md:py-32 px-4 md:px-12 relative">
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
                <div class="order-1 lg:order-2 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-brand-muted/10 text-brand-dark text-sm font-semibold uppercase tracking-wider border border-brand-muted/20">
                        <i class="fa-solid fa-people-group"></i> Harmoni Sosial
                    </div>
                    
                    <h2 class="text-2xl sm:text-3xl md:text-5xl font-heading text-brand-dark tracking-wide leading-tight">
                        Kehidupan Budaya & Tradisi
                    </h2>
                    
                    <p class="text-slate-600 font-sans text-sm md:text-lg leading-relaxed text-justify">
                        Masyarakat Desa Punjulharjo dikenal memiliki kehidupan sosial yang erat dengan semangat gotong royong. Sebagai desa pesisir, warga setempat terbiasa hidup berdampingan dengan alam. Aktivitas masyarakat mencerminkan adaptasi terhadap lingkungan pantai, sementara budaya lokal dan tradisi tetap dijaga sebagai bagian dari identitas desa yang kuat.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- SECTION EEE: 3D Coverflow Experience (Sorotan Aktivitas Desa) -->
    <section class="bg-transparent pt-12 pb-24 md:pt-32 md:pb-44 px-4 md:px-12 relative overflow-hidden" style="padding-bottom: 220px !important;">
        <!-- Background shapes matching the design system -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-sky-200/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-200/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <!-- Header -->
            <div class="space-y-4 mb-16 max-w-3xl mx-auto relative">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-compass"></i> Sorotan Pengalaman
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-5xl font-heading text-gray-900 tracking-wide leading-tight">
                    Jelajahi Aktivitas Punjulharjo
                </h2>
                <p class="text-gray-600 font-sans text-sm md:text-lg">
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
            <div class="mt-8 flex justify-center items-center gap-2" id="coverflow-dots" style="margin-bottom: 120px !important;">
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


    <!-- SECTION F: Final Call-to-Action (CTA) -->
    <section class="relative py-16 md:py-36 px-4 md:px-6 text-center text-white overflow-hidden bg-slate-900">
        <!-- Scenic Background Image with Dark/Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-40 transition-transform duration-[10000ms] hover:scale-105"
             style="background-image: url('{{ asset($heroBg) }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-950/80 via-slate-900/90 to-indigo-950/95"></div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-8">
            <h2 class="text-2xl md:text-6xl font-heading tracking-wide">
                Mulai Kunjungan Anda
            </h2>
            
            <p class="text-slate-200 font-sans text-sm md:text-xl leading-relaxed max-w-2xl mx-auto">
                Dengan potensi alam, sejarah, budaya, dan partisipasi masyarakat yang kuat, Punjulharjo layak diperkenalkan lebih luas sebagai desa wisata yang memiliki keindahan, pengetahuan, dan nilai kehidupan yang lengkap.
            </p>
            
            <div class="pt-4">
                <a href="#kontak-peta" 
                   onclick="document.querySelector('footer').scrollIntoView({ behavior: 'smooth' }); return false;"
                   class="inline-flex items-center justify-center bg-white text-indigo-900 font-bold px-6 py-3 md:px-8 md:py-4 rounded-none text-sm md:text-lg shadow hover:shadow-white/10 transition duration-300 transform hover:-translate-y-1">
                    Lihat Peta Lokasi
                    <i class="fa-solid fa-map-location-dot ml-3"></i>
                </a>
            </div>
        </div>
    </section>



    <!-- Scripts for Tentang Desa Wisata custom radio tabs & StPageFlip Interactive Book -->
    @push('scripts')
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
                const text = "Wonderful Punjulharjo";
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