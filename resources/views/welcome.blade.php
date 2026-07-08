@extends('layouts.app')

@section('content')
    @php
        // Fetch hero background image from SiteSetting dynamically, with default fallback set to the original scenic background photo
        $heroBg = \App\Models\SiteSetting::getValue('hero_background', 'storage/hero/9qTbqw7WY7alzKqM8aK4duA1mPisHBiavO5ARCGB.jpg');
    @endphp

    <!-- SECTION A: Hero Section -->
    <section class="relative w-full min-h-[92vh] flex flex-col justify-center items-center text-center px-6 overflow-hidden bg-transparent">
        <!-- Edge-to-edge Background Image with darkened overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-[10000ms] hover:scale-105"
             style="background-image: url('{{ asset($heroBg) }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>

        <div class="relative z-10 max-w-4xl mx-auto mt-32 md:mt-40 pb-20">
            <!-- Main Title in THE LAST TRUNKS Font -->
            <h1 id="hero-title" class="text-5xl md:text-7xl lg:text-8xl font-heading text-white mb-6 tracking-wide drop-shadow-xl min-h-[2em] md:min-h-[1.2em]"></h1>
            
            <!-- Subtitle in Poppins Font -->
            <p class="text-lg md:text-xl lg:text-2xl text-slate-100 font-sans max-w-3xl mx-auto leading-relaxed drop-shadow-md mb-12 opacity-90">
                Memadukan potensi wisata alam, wisata sejarah, dan wisata edukasi dalam satu kawasan yang saling melengkapi.
            </p>
            
            <!-- CTA Button Jelajahi Desa -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#tentang" 
                   class="inline-flex items-center justify-center bg-gradient-to-r from-sky-500 to-indigo-500 hover:from-sky-600 hover:to-indigo-600 text-white font-semibold px-8 py-4 rounded-full text-lg shadow-lg hover:shadow-sky-500/30 transition duration-300 transform hover:-translate-y-1 hover:scale-105">
                    Jelajahi Desa
                    <i class="fa-solid fa-arrow-down ml-3 text-sm animate-bounce"></i>
                </a>
            </div>

            <!-- Floating Translucent Badges (from the design guide) -->
            <div class="mt-12 flex flex-wrap gap-4 justify-center opacity-80">
                <span class="glass-panel px-5 py-2.5 rounded-full text-slate-800 text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-gem text-amber-500 text-xs"></i> Wisata Alam
                </span>
                <span class="glass-panel px-5 py-2.5 rounded-full text-slate-800 text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-gem text-amber-500 text-xs"></i> Wisata Sejarah
                </span>
                <span class="glass-panel px-5 py-2.5 rounded-full text-slate-800 text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-gem text-amber-500 text-xs"></i> Wisata Edukasi
                </span>
            </div>
        </div>
        
        <!-- Multi-layered Aesthetic Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[80px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- Layer 1: Back Wave (Translucent Sky-Blue) -->
                <path d="M0,90 C320,130,420,40,740,70 C1040,95,1120,60,1200,80 L1200,120 L0,120 Z" fill="rgba(14, 165, 233, 0.2)"></path>
                <!-- Layer 2: Middle Wave (Translucent White) -->
                <path d="M0,60 C240,90,380,30,700,60 C1000,85,1080,45,1200,55 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.35)"></path>
                <!-- Layer 3: Front Wave (Translucent White/Cream) -->
                <path d="M0,30 C150,60,350,10,600,40 C850,70,1050,30,1200,40 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.5)"></path>
            </svg>
        </div>
    </section>


    <!-- SECTION B: About Us (Tentang Desa) -->
    <section id="tentang" class="bg-transparent py-24 md:py-32 px-6 md:px-12 relative overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-12 gap-16 items-center">
                <!-- Text Block Left with custom radio tabs -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider">
                        <i class="fa-solid fa-feather-pointed"></i> Sekilas Profil
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-heading text-slate-800 tracking-wide leading-tight">
                        Tentang Desa Wisata
                    </h2>
                    
                    <!-- Radio tab switcher layout -->
                    <div class="radio-tabs-wrapper">
                        <div class="wrap">
                            <input checked type="radio" id="rd-1" name="radio" class="rd-1" hidden />
                            <label for="rd-1" class="label" style="--index: 0;"><span>Profil Desa</span></label>
                            <input type="radio" id="rd-2" name="radio" class="rd-2" hidden />
                            <label for="rd-2" class="label" style="--index: 1;"><span>Visi & Misi</span></label>
                            <input type="radio" id="rd-3" name="radio" class="rd-3" hidden />
                            <label for="rd-3" class="label" style="--index: 2;"><span>Potensi</span></label>
                            <div class="bar"></div>
                            <div class="slidebar"></div>
                        </div>
                    </div>

                    <!-- Tab Contents Panel -->
                    <div id="tab-content-1" class="tab-content-panel space-y-4 animate-fade-in">
                        <p class="text-slate-600 font-sans text-base md:text-lg leading-relaxed text-justify">
                            Desa Punjulharjo merupakan salah satu desa pesisir yang terletak di Kabupaten Rembang, Jawa Tengah. Secara geografis, Punjulharjo berada di kawasan pesisir utara Jawa yang memiliki hubungan erat dengan kehidupan bahari. Letaknya yang berada di wilayah pantai menjadikan desa ini memiliki sumber daya alam yang khas. Keindahan pantainya, kekayaan sejarah maritimnya, serta kehidupan masyarakat pesisir yang masih kuat dengan nilai kebersamaan menjadikan Punjulharjo sebagai desa yang memiliki daya tarik tersendiri.
                        </p>
                    </div>
                    
                    <div id="tab-content-2" class="tab-content-panel hidden space-y-4 animate-fade-in">
                        <div class="p-5 bg-sky-50/50 backdrop-blur-sm rounded-2xl border border-sky-100">
                            <h4 class="font-bold text-sky-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Visi
                            </h4>
                            <p class="text-slate-700 text-sm md:text-base leading-relaxed">
                                Menjadi desa wisata unggulan berbasis budaya dan kearifan lokal yang berkelanjutan, serta menjadi inspirasi bagi pengembangan desa wisata lainnya di Indonesia.
                            </p>
                        </div>
                        <div class="p-5 bg-indigo-50/50 backdrop-blur-sm rounded-2xl border border-indigo-100">
                            <h4 class="font-bold text-indigo-700 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="12" r="6" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg>
                                Misi
                            </h4>
                            <ul class="list-disc list-inside text-slate-700 text-sm md:text-base leading-relaxed space-y-1">
                                <li>Melestarikan warisan budaya dan sejarah desa.</li>
                                <li>Mendorong partisipasi masyarakat dalam pengelolaan wisata.</li>
                                <li>Mengembangkan potensi ekonomi kreatif berbasis wisata.</li>
                                <li>Menjaga kelestarian lingkungan dan keaslian alam desa.</li>
                            </ul>
                        </div>
                    </div>

                    <div id="tab-content-3" class="tab-content-panel hidden space-y-4 animate-fade-in">
                        <p class="text-slate-600 font-sans text-base md:text-lg leading-relaxed text-justify">
                            Punjulharjo menyajikan perpaduan wisata alam pantai yang mempesona dan wisata sejarah maritim Nusantara:
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-sky-50/50 backdrop-blur-sm rounded-2xl border border-sky-100">
                                <span class="font-bold text-slate-800 text-sm md:text-base flex items-center gap-2">
                                    <svg class="w-5 h-5 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 12h-20a10 10 0 0 1 20 0Z" />
                                        <path d="M12 12v10" />
                                        <path d="M12 21a2 2 0 0 0 2-2" />
                                    </svg>
                                    Pantai Karang Jahe
                                </span>
                                <p class="text-xs text-slate-500 mt-1">Hamparan pasir putih bersih & ribuan pohon cemara yang rindang.</p>
                            </div>
                            <div class="p-4 bg-sky-50/50 backdrop-blur-sm rounded-2xl border border-sky-100">
                                <span class="font-bold text-slate-800 text-sm md:text-base flex items-center gap-2">
                                    <svg class="w-5 h-5 text-sky-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="5" r="3" />
                                        <path d="M12 22V8" />
                                        <path d="M5 12H2a10 10 0 0 0 20 0h-3" />
                                    </svg>
                                    Situs Perahu Kuno
                                </span>
                                <p class="text-xs text-slate-500 mt-1">Bukti arkeologis pelayaran Nusantara dari abad ke-7 Masehi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Graphic/Photo Block Right -->
                <div class="lg:col-span-5 relative">
                    <!-- Background aesthetic soft blob shape -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-sky-400/20 to-indigo-400/20 rounded-[3rem] blur-2xl z-0"></div>
                    
                    <div class="cyber-card-container aspect-[4/3] w-full relative z-10">
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
                                <img src="https://images.unsplash.com/photo-1540805513758-2943743a4e2b?auto=format&fit=crop&w=800&q=80" 
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


    <!-- SECTION C: Top Destinations (Destinasi Unggulan) -->
    <section class="bg-transparent py-24 md:py-32 px-6 md:px-12 relative">
        <div class="max-w-6xl mx-auto">
            <div class="text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider">
                    <i class="fa-solid fa-map-location-dot"></i> Eksplorasi Wisata
                </div>
                <h2 class="text-4xl md:text-5xl font-heading text-slate-800 tracking-wide">
                    Destinasi Unggulan
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto">
                    Kunjungi tempat wisata favorit di Punjulharjo yang memiliki daya tarik tersendiri bagi wisatawan.
                </p>
            </div>

            <!-- Destinasi Grid Layout with no harsh borders -->
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Card 1: Pantai Karang Jahe -->
                <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="group relative bg-white rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col justify-between h-full transform hover:-translate-y-2">
                    <div class="overflow-hidden aspect-[16/10] relative">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" 
                             alt="Pantai Karang Jahe" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Floating Glassmorphic Tag -->
                        <span class="absolute top-4 left-4 glass-panel px-4 py-1.5 rounded-full text-slate-800 text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-20a10 10 0 0 1 20 0Z" />
                                <path d="M12 12v10" />
                                <path d="M12 21a2 2 0 0 0 2-2" />
                            </svg>
                            Wisata Pantai
                        </span>
                    </div>
                    
                    <div class="p-8 space-y-4 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-800 font-sans group-hover:text-sky-600 transition duration-300 flex items-center justify-between">
                                Pantai Karang Jahe
                                <i class="fa-solid fa-arrow-right text-sky-500 text-lg opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:translate-x-1"></i>
                            </h3>
                            <p class="text-slate-600 font-sans text-sm md:text-base leading-relaxed text-justify mt-3">
                                Pantai Karang Jahe merupakan salah satu destinasi wisata paling dikenal di Desa Punjulharjo. Menghadirkan suasana rekreasi yang nyaman dengan panorama pesisir yang menenangkan, hamparan pasir putih yang lembut, dan air laut yang relatif tenang. Nama Karang Jahe sendiri berasal dari bentuk karang-karang kecil di kawasan pantai yang dianggap menyerupai jahe.
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Situs Perahu Kuno -->
                <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="group relative bg-white rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col justify-between h-full transform hover:-translate-y-2">
                    <div class="overflow-hidden aspect-[16/10] relative">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80" 
                             alt="Situs Perahu Kuno" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Floating Glassmorphic Tag -->
                        <span class="absolute top-4 left-4 glass-panel px-4 py-1.5 rounded-full text-slate-800 text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="5" r="3" />
                                <path d="M12 22V8" />
                                <path d="M5 12H2a10 10 0 0 0 20 0h-3" />
                            </svg>
                            Wisata Sejarah
                        </span>
                    </div>
                    
                    <div class="p-8 space-y-4 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-800 font-sans group-hover:text-sky-600 transition duration-300 flex items-center justify-between">
                                Situs Perahu Kuno
                                <i class="fa-solid fa-arrow-right text-indigo-500 text-lg opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:translate-x-1"></i>
                            </h3>
                            <p class="text-slate-600 font-sans text-sm md:text-base leading-relaxed text-justify mt-3">
                                Selain pantai, Punjulharjo juga memiliki Situs Perahu Kuno yang diperkirakan berasal dari abad ke-7 Masehi. Situs ini menyimpan nilai sejarah tinggi sebagai peninggalan arkeologis yang sangat penting bagi pemahaman sejarah maritim Indonesia, menjadi bukti bahwa masyarakat Nusantara telah memiliki kemampuan pelayaran yang maju sejak berabad-abad lalu.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>


    <!-- SECTION D: Aesthetic Photo Gallery -->
    <section class="bg-transparent py-24 md:py-32 px-6 md:px-12">
        <div class="max-w-6xl mx-auto">
            <div class="text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider">
                    <i class="fa-regular fa-images"></i> Galeri Visual
                </div>
                <h2 class="text-4xl md:text-5xl font-heading text-slate-800 tracking-wide">
                    Potret Punjulharjo
                </h2>
                <p class="text-slate-500 font-sans max-w-xl mx-auto">
                    Koleksi sudut-sudut keindahan alam, budaya, dan momen di sepanjang pesisir pantai desa kami.
                </p>
            </div>

            <!-- Asymmetric Grid Gallery with rounded borders and hover zoom animation -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Img 1: Tall -->
                <div class="cyber-card-container aspect-[3/4] md:row-span-2 relative group">
                    <div class="cyber-card-canvas">
                        <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div><div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div><div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div><div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div><div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                        <div class="cyber-3d-card relative overflow-hidden rounded-3xl shadow-md cursor-pointer w-full h-full select-none">
                            <div class="card-glare"></div>
                            <div class="glowing-elements">
                                <div class="glow-1"></div>
                                <div class="glow-2"></div>
                                <div class="glow-3"></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80" 
                                 alt="Keindahan Alam" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6 z-10 pointer-events-none">
                                <span class="text-white font-medium text-lg">Pesona Pantai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Img 2: Wide -->
                <div class="cyber-card-container aspect-[4/3] md:col-span-2 relative group">
                    <div class="cyber-card-canvas">
                        <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div><div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div><div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div><div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div><div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                        <div class="cyber-3d-card relative overflow-hidden rounded-3xl shadow-md cursor-pointer w-full h-full select-none">
                            <div class="card-glare"></div>
                            <div class="glowing-elements">
                                <div class="glow-1"></div>
                                <div class="glow-2"></div>
                                <div class="glow-3"></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1000&q=80" 
                                 alt="Kehidupan Bahari" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6 z-10 pointer-events-none">
                                <span class="text-white font-medium text-lg">Kehidupan Pantai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Img 3 -->
                <div class="cyber-card-container aspect-square relative group">
                    <div class="cyber-card-canvas">
                        <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div><div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div><div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div><div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div><div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                        <div class="cyber-3d-card relative overflow-hidden rounded-3xl shadow-md cursor-pointer w-full h-full select-none">
                            <div class="card-glare"></div>
                            <div class="glowing-elements">
                                <div class="glow-1"></div>
                                <div class="glow-2"></div>
                                <div class="glow-3"></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80" 
                                 alt="Perahu Nelayan" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6 z-10 pointer-events-none">
                                <span class="text-white font-medium text-lg">Bahari Tradisional</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Img 4 -->
                <div class="cyber-card-container aspect-square relative group">
                    <div class="cyber-card-canvas">
                        <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div><div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div><div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div><div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div><div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                        <div class="cyber-3d-card relative overflow-hidden rounded-3xl shadow-md cursor-pointer w-full h-full select-none">
                            <div class="card-glare"></div>
                            <div class="glowing-elements">
                                <div class="glow-1"></div>
                                <div class="glow-2"></div>
                                <div class="glow-3"></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80" 
                                 alt="Sunset Punjulharjo" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6 z-10 pointer-events-none">
                                <span class="text-white font-medium text-lg">Sunset Pesisir</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Img 5 -->
                <div class="cyber-card-container aspect-[4/3] relative group">
                    <div class="cyber-card-canvas">
                        <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div><div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div><div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div><div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div><div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                        <div class="cyber-3d-card relative overflow-hidden rounded-3xl shadow-md cursor-pointer w-full h-full select-none">
                            <div class="card-glare"></div>
                            <div class="glowing-elements">
                                <div class="glow-1"></div>
                                <div class="glow-2"></div>
                                <div class="glow-3"></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80" 
                                 alt="Ekosistem Laut" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6 z-10 pointer-events-none">
                                <span class="text-white font-medium text-lg">Ekosistem Pantai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Img 6: Wide -->
                <div class="cyber-card-container aspect-[16/9] group md:col-span-2 relative">
                    <div class="cyber-card-canvas">
                        <div class="tracker tr-1"></div><div class="tracker tr-2"></div><div class="tracker tr-3"></div><div class="tracker tr-4"></div><div class="tracker tr-5"></div><div class="tracker tr-6"></div><div class="tracker tr-7"></div><div class="tracker tr-8"></div><div class="tracker tr-9"></div><div class="tracker tr-10"></div><div class="tracker tr-11"></div><div class="tracker tr-12"></div><div class="tracker tr-13"></div><div class="tracker tr-14"></div><div class="tracker tr-15"></div><div class="tracker tr-16"></div><div class="tracker tr-17"></div><div class="tracker tr-18"></div><div class="tracker tr-19"></div><div class="tracker tr-20"></div><div class="tracker tr-21"></div><div class="tracker tr-22"></div><div class="tracker tr-23"></div><div class="tracker tr-24"></div><div class="tracker tr-25"></div>
                        <div class="cyber-3d-card relative overflow-hidden rounded-3xl shadow-md cursor-pointer w-full h-full select-none">
                            <div class="card-glare"></div>
                            <div class="glowing-elements">
                                <div class="glow-1"></div>
                                <div class="glow-2"></div>
                                <div class="glow-3"></div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1000&q=80" 
                                 alt="Masyarakat Gotong Royong" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6 z-10 pointer-events-none">
                                <span class="text-white font-medium text-lg">Aktivitas Gotong Royong</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- SECTION E: Culture & Community (Kehidupan Budaya) -->
    <section class="bg-slate-50/40 backdrop-blur-[2px] py-24 md:py-32 px-6 md:px-12 relative">
        <!-- Subtle background shapes -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-indigo-200/20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-sky-200/20 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Photo Card Left -->
                <div class="order-2 lg:order-1 relative">
                    <div class="absolute -inset-4 bg-gradient-to-br from-indigo-500/10 to-sky-500/10 rounded-[3rem] blur-xl z-0"></div>
                    
                    <div class="cyber-card-container aspect-[4/3] w-full relative z-10">
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
                                <img src="https://images.unsplash.com/photo-1540805513758-2943743a4e2b?auto=format&fit=crop&w=800&q=80" 
                                     alt="Budaya Desa Punjulharjo" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Text Block Right -->
                <div class="order-1 lg:order-2 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50 text-indigo-600 text-sm font-semibold uppercase tracking-wider">
                        <i class="fa-solid fa-people-group"></i> Harmoni Sosial
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-heading text-slate-800 tracking-wide leading-tight">
                        Kehidupan Budaya & Tradisi
                    </h2>
                    
                    <p class="text-slate-600 font-sans text-base md:text-lg leading-relaxed text-justify">
                        Masyarakat Desa Punjulharjo dikenal memiliki kehidupan sosial yang erat dengan semangat gotong royong. Sebagai desa pesisir, warga setempat terbiasa hidup berdampingan dengan alam. Aktivitas masyarakat mencerminkan adaptasi terhadap lingkungan pantai, sementara budaya lokal dan tradisi tetap dijaga sebagai bagian dari identitas desa yang kuat.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- SECTION EE: Interactive Flipbook (Buku Panduan Desa) -->
    <section class="bg-transparent py-24 md:py-32 px-6 md:px-12 relative">
        <!-- Background decorative elements matching design guide -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-sky-200/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-200/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider">
                    <i class="fa-solid fa-book-open"></i> E-Book Panduan
                </div>
                <h2 class="text-4xl md:text-5xl font-heading text-slate-800 tracking-wide leading-tight">
                    Buku Panduan Desa Wisata
                </h2>
                <p class="text-slate-600 font-sans text-base md:text-lg max-w-2xl mx-auto">
                    Buka lembaran interaktif di bawah ini untuk menjelajahi potensi keindahan alam, sejarah nusantara, dan kebudayaan di Desa Wisata Punjulharjo.
                </p>
            </div>

            <!-- Flipbook Component Container -->
            <div class="flipbook-container">
                <div class="flipbook-viewport mb-6">
                    <div id="flipbook" class="flipbook-wrapper">
                        <!-- PAGE 1: COVER -->
                        <div class="flipbook-page cover-page select-none flex flex-col justify-between items-center text-center border-4 border-amber-500/30 rounded-lg p-8 h-full" data-density="hard">
                            <div class="w-full flex justify-between items-center border-b border-white/10 pb-4">
                                <span class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Desa Punjulharjo</span>
                                <i class="fa-solid fa-dharmachakra text-amber-400 text-lg"></i>
                            </div>
                            <div class="my-auto space-y-6">
                                <div class="w-20 h-20 mx-auto rounded-full bg-white/10 flex items-center justify-center border border-white/20 shadow-inner">
                                    <i class="fa-solid fa-map text-amber-400 text-3xl"></i>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-heading text-white tracking-wider leading-snug drop-shadow-lg">
                                    BUKU PANDUAN<br>WISATA
                                </h3>
                                <p class="text-sm font-sans text-slate-300 max-w-xs mx-auto leading-relaxed uppercase tracking-wider">
                                    Panduan Lengkap Penjelajahan Alam, Sejarah & Budaya
                                </p>
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

                        <!-- PAGE 2: WELCOME & CONTENTS -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Kata Pengantar</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-6">Selamat Datang</h3>
                                    <div class="space-y-4 text-sm text-slate-600 leading-relaxed text-justify">
                                        <p>
                                            Selamat datang di Desa Wisata Punjulharjo, Kabupaten Rembang. Buku panduan praktis ini dirancang untuk memudahkan Anda menjelajahi keindahan alam, menelusuri sejarah bahari nusantara, dan merasakan kehangatan budaya masyarakat pesisir kami.
                                        </p>
                                        <p>
                                            Kami berharap setiap lembar informasi di dalam e-book interaktif ini dapat menginspirasi dan membantu Anda merencanakan kunjungan yang tak terlupakan.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Daftar Isi & Sambutan</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 1</span>
                                </div>
                            </div>
                        </div>

                        <!-- PAGE 3: PANTAI KARANG JAHE -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Alam</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Pantai Karang Jahe</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=400&q=85" alt="Pantai Karang Jahe" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">
                                        Menawarkan hamparan pasir putih bersih yang membentang luas di sepanjang garis pantai utara Jawa, dihiasi ribuan pohon cemara laut yang rindang. Destinasi wisata keluarga yang teduh dan menenangkan.
                                    </p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Pesona Bahari</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 2</span>
                                </div>
                            </div>
                        </div>

                        <!-- PAGE 4: SITUS PERAHU KUNO -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Sejarah</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Situs Perahu Kuno</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?auto=format&fit=crop&w=400&q=85" alt="Situs Perahu Kuno" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">
                                        Penemuan arkeologi luar biasa berupa perahu kayu utuh dari abad ke-7 Masehi. Situs purbakala ini menjadi bukti nyata majunya teknologi perkapalan dan sejarah kemaritiman perdagangan nusantara.
                                    </p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Warisan Maritim</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 3</span>
                                </div>
                            </div>
                        </div>

                        <!-- PAGE 5: KERAJINAN BATIK TULIS -->
                        <div class="flipbook-page select-none">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h4 class="text-xs font-bold text-sky-600 uppercase tracking-widest mb-2">Wisata Edukasi</h4>
                                    <h3 class="text-2xl font-heading text-slate-800 mb-4">Batik Canting Punjulharjo</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm border border-slate-100 aspect-video mb-4 bg-slate-100">
                                        <img src="https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=400&q=85" alt="Batik Tulis" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed text-justify">
                                        Melihat langsung dan belajar seni membatik tulis tradisional canting dengan motif pesisiran yang unik. Aktivitas edukatif ini memberdayakan pengrajin wanita desa dan melestarikan budaya bangsa.
                                    </p>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-100 pt-4 mt-6">
                                    <span class="text-xs text-slate-400">Kreativitas Lokal</span>
                                    <span class="text-xs font-semibold text-slate-400">Hal. 4</span>
                                </div>
                            </div>
                        </div>

                        <!-- PAGE 6: BACK COVER -->
                        <div class="flipbook-page back-page select-none flex flex-col justify-between items-center text-center border-4 border-amber-500/30 rounded-lg p-8 h-full" data-density="hard">
                            <div class="w-full flex justify-between items-center border-b border-white/10 pb-4">
                                <i class="fa-solid fa-dharmachakra text-amber-400 text-lg"></i>
                                <span class="text-xs uppercase tracking-widest text-amber-400 font-semibold">Sampai Jumpa</span>
                            </div>
                            <div class="my-auto space-y-4">
                                <h3 class="text-2xl font-heading text-white tracking-wider">
                                    KUNJUNGI KAMI
                                </h3>
                                <p class="text-xs text-slate-300 max-w-xs mx-auto leading-relaxed">
                                    Mulai petualangan Anda hari ini dan rasakan pengalaman unik di setiap jengkal Desa Wisata Punjulharjo.
                                </p>
                                <div class="text-[10px] text-amber-300 font-mono tracking-wider space-y-1 bg-white/5 py-3 px-4 rounded-xl border border-white/10">
                                    <div>Email: info@desapunjulharjo.id</div>
                                    <div>Instagram: @wisatapunjulharjo</div>
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
                <div class="mt-8 flex items-center gap-6 z-10">
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
        </div>
    </section>


    <!-- SECTION EEE: 3D Coverflow Experience (Sorotan Aktivitas Desa) -->
    <section class="bg-transparent py-24 md:py-32 px-6 md:px-12 relative overflow-hidden">
        <!-- Background shapes matching the design system -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-sky-200/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-200/10 rounded-full blur-3xl z-0"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <!-- Header -->
            <div class="space-y-4 mb-16 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider">
                    <i class="fa-solid fa-compass"></i> Sorotan Pengalaman
                </div>
                <h2 class="text-4xl md:text-5xl font-heading text-slate-800 tracking-wide leading-tight">
                    Jelajahi Aktivitas Punjulharjo
                </h2>
                <p class="text-slate-600 font-sans text-base md:text-lg">
                    Klik kartu di kanan/kiri untuk memutar dan memfokuskan petualangan seru yang dapat Anda nikmati di desa kami.
                </p>
            </div>

            <!-- Viewport for 3D Carousel -->
            <div class="coverflow-viewport">
                <!-- Card 1 -->
                <div class="coverflow-card rounded-xl overflow-hidden shadow-2xl bg-slate-900 border border-white/10 flex flex-col justify-end p-6 md:p-8 select-none active">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" alt="Pantai Karang Jahe" class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none"></div>
                    <div class="relative z-20 text-left space-y-2 pointer-events-none">
                        <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">Susur Pantai Karang Jahe</h4>
                        <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">Menikmati segarnya hembusan angin laut di bawah keteduhan ribuan cemara laut yang berjejer rapi.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="coverflow-card rounded-xl overflow-hidden shadow-2xl bg-slate-900 border border-white/10 flex flex-col justify-end p-6 md:p-8 select-none right">
                    <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80" alt="Situs Perahu Kuno" class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none"></div>
                    <div class="relative z-20 text-left space-y-2 pointer-events-none">
                        <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">Eksplorasi Perahu Abad ke-7</h4>
                        <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">Melihat langsung mahakarya arkeologis kapal kayu tertua di nusantara bukti peradaban bahari.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="coverflow-card rounded-xl overflow-hidden shadow-2xl bg-slate-900 border border-white/10 flex flex-col justify-end p-6 md:p-8 select-none hidden-right">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80" alt="Ekowisata Mangrove" class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none"></div>
                    <div class="relative z-20 text-left space-y-2 pointer-events-none">
                        <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">Wisata Mangrove & Tambak</h4>
                        <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">Menyusuri jalur trekking hutan bakau hijau dan edukasi budidaya garam lokal masyarakat.</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="coverflow-card rounded-xl overflow-hidden shadow-2xl bg-slate-900 border border-white/10 flex flex-col justify-end p-6 md:p-8 select-none hidden-right">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80" alt="Festival Seni Budaya" class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none"></div>
                    <div class="relative z-20 text-left space-y-2 pointer-events-none">
                        <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">Festival Budaya Pesisir</h4>
                        <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">Menyaksikan pagelaran tari tradisional dan sedekah laut tahunan khas warga pesisir.</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="coverflow-card rounded-xl overflow-hidden shadow-2xl bg-slate-900 border border-white/10 flex flex-col justify-end p-6 md:p-8 select-none left">
                    <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=800&q=80" alt="Kuliner Seafood" class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none z-0" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10 pointer-events-none"></div>
                    <div class="relative z-20 text-left space-y-2 pointer-events-none">
                        <h4 class="text-xl md:text-2xl font-bold text-white font-sans drop-shadow-md">Kuliner Seafood & Khas Rembang</h4>
                        <p class="text-xs md:text-sm text-slate-200 font-sans leading-relaxed drop-shadow-sm opacity-90">Menikmati masakan laut segar bumbu rempah tradisi di warung makan tepi pantai.</p>
                    </div>
                </div>
            </div>

            <!-- Bullet indicators -->
            <div class="mt-8 flex justify-center items-center gap-2" id="coverflow-dots">
                <button class="h-2 rounded-full transition-all duration-300 bg-sky-500 w-6" aria-label="Slide 1"></button>
                <button class="h-2 rounded-full transition-all duration-300 bg-slate-300 w-2" aria-label="Slide 2"></button>
                <button class="h-2 rounded-full transition-all duration-300 bg-slate-300 w-2" aria-label="Slide 3"></button>
                <button class="h-2 rounded-full transition-all duration-300 bg-slate-300 w-2" aria-label="Slide 4"></button>
                <button class="h-2 rounded-full transition-all duration-300 bg-slate-300 w-2" aria-label="Slide 5"></button>
            </div>
        </div>
    </section>


    <!-- SECTION F: Final Call-to-Action (CTA) -->
    <section class="relative py-28 md:py-36 px-6 text-center text-white overflow-hidden bg-slate-900">
        <!-- Scenic Background Image with Dark/Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-40 transition-transform duration-[10000ms] hover:scale-105"
             style="background-image: url('{{ asset($heroBg) }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-950/80 via-slate-900/90 to-indigo-950/95"></div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-8">
            <h2 class="text-4xl md:text-6xl font-heading tracking-wide">
                Mulai Kunjungan Anda
            </h2>
            
            <p class="text-slate-200 font-sans text-lg md:text-xl leading-relaxed max-w-2xl mx-auto">
                Dengan potensi alam, sejarah, budaya, dan partisipasi masyarakat yang kuat, Punjulharjo layak diperkenalkan lebih luas sebagai desa wisata yang memiliki keindahan, pengetahuan, dan nilai kehidupan yang lengkap.
            </p>
            
            <div class="pt-4">
                <a href="#kontak-peta" 
                   onclick="document.querySelector('footer').scrollIntoView({ behavior: 'smooth' }); return false;"
                   class="inline-flex items-center justify-center bg-white text-indigo-900 font-bold px-8 py-4 rounded-full text-lg shadow-lg hover:shadow-white/20 transition duration-300 transform hover:-translate-y-1 hover:scale-105">
                    Lihat Peta Lokasi
                    <i class="fa-solid fa-map-location-dot ml-3"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Load page-flip library from jsdelivr CDN -->
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>

    <!-- Scripts for Tentang Desa Wisata custom radio tabs & StPageFlip Interactive Book -->
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

            // Interactive 3D Flipbook Initialization
            const flipContainer = document.getElementById('flipbook');
            if (flipContainer && typeof St !== 'undefined') {
                const pageFlip = new St.PageFlip(flipContainer, {
                    width: 550, // Base page width
                    height: 580, // Base page height (shorter to fit viewport heights and prevent bottom cut-offs)
                    size: "stretch",
                    minWidth: 280,
                    maxWidth: 1000,
                    minHeight: 295,
                    maxHeight: 1050,
                    maxShadowOpacity: 0.35,
                    showCover: true,
                    mobileScrollSupport: false, // Prevent page scrolling during drags on touch screens
                    usePortrait: true
                });

                // Load pages from elements inside the wrapper
                pageFlip.loadFromHTML(document.querySelectorAll('.flipbook-page'));

                const btnPrev = document.getElementById('btn-prev');
                const btnNext = document.getElementById('btn-next');
                const pageIndicator = document.getElementById('page-indicator');

                // Dynamic page indicator labeling based on orientation
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

                // Attach navigation listeners
                btnPrev.addEventListener('click', () => pageFlip.flipPrev());
                btnNext.addEventListener('click', () => pageFlip.flipNext());

                // Page flips listeners
                pageFlip.on('flip', () => {
                    updateIndicator();
                });

                pageFlip.on('changeOrientation', () => {
                    updateIndicator();
                });

                // Initial load indicator sync
                setTimeout(updateIndicator, 150);
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
                        const charNode = document.createTextNode(char);
                        heroTitle.insertBefore(charNode, cursorSpan);
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
@endsection