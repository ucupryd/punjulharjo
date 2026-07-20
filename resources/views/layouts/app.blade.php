<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Punjulharjo</title>
    
    <!-- Dynamic Favicon Override Logic:
         Checks if custom-favicon.png exists in public directory. 
         If yes, resolves to that. If no, defaults to the beautiful 2D vector-style blue coconut tree SVG inlined as Base64. -->
    @php
        $customFaviconExists = file_exists(public_path('custom-favicon.png'));
        $defaultSvg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50 90 C 52 70, 48 40, 52 35 C 53 30, 55 25, 50 25 C 45 25, 47 30, 48 35 C 52 40, 48 70, 50 90 Z" fill="#0284c7" /><path d="M50 25 C 40 20, 25 22, 15 30 C 25 35, 40 30, 50 25 Z" fill="#0369a1" /><path d="M50 25 C 60 20, 75 22, 85 30 C 75 35, 60 30, 50 25 Z" fill="#0369a1" /><path d="M50 25 C 38 28, 28 38, 22 50 C 30 50, 40 40, 50 25 Z" fill="#0284c7" /><path d="M50 25 C 62 28, 72 38, 78 50 C 70 50, 60 40, 50 25 Z" fill="#0284c7" /><path d="M50 25 C 45 15, 35 8, 25 5 C 32 12, 42 18, 50 25 Z" fill="#075985" /><path d="M50 25 C 55 15, 65 8, 75 5 C 68 12, 58 18, 50 25 Z" fill="#075985" /><circle cx="46" cy="27" r="4" fill="#0c4a6e" /><circle cx="54" cy="27" r="4" fill="#0c4a6e" /><circle cx="50" cy="31" r="4.5" fill="#0c4a6e" /></svg>';
        $faviconUrl = $customFaviconExists ? asset('custom-favicon.png') : 'data:image/svg+xml;base64,' . base64_encode($defaultSvg);
        $faviconType = $customFaviconExists ? 'image/png' : 'image/svg+xml';
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">

    <!-- Google Fonts Poppins & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        .page-frame-inner {
            background-color: #ffffff !important;
        }
    </style>

    @vite('resources/css/app.css')
    
    <!-- FontAwesome (icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('styles')
</head>

<body class="bg-white min-h-screen antialiased">

    <!-- Page Frame Wrapper (Clean corporate theme) -->
    <div class="page-frame-container">
        <div class="page-frame-inner bg-white">

            <!-- Navbar (Full-width fixed top header) -->
            @php
                $activeIndex = 0;
                if (request()->is('tentang')) {
                    $activeIndex = 1;
                } elseif (request()->is('destinasi*')) {
                    $activeIndex = 2;
                } elseif (request()->is('pustaka*') || request()->is('blog*')) {
                    $activeIndex = 3;
                } elseif (request()->is('temukan*')) {
                    $activeIndex = 4;
                } elseif (request()->is('testimoni*')) {
                    $activeIndex = 5;
                } elseif (request()->is('adopsi*') || request()->is('member*')) {
                    $activeIndex = -1;
                }
            @endphp
            <header x-data="{
                        hoverIndex: null, 
                        activeIndex: {{ $activeIndex }}, 
                        isHome: {{ request()->is('/') ? 'true' : 'false' }}, 
                        scrolled: false,
                        navVisible: true,
                        lastScrollY: 0
                    }"
                    x-init="
                        scrolled = !isHome || window.pageYOffset > 50;
                        lastScrollY = window.pageYOffset;
                    "
                    @scroll.window="
                        let currentY = window.pageYOffset;
                        scrolled = !isHome || currentY > 50;
                        if (currentY <= 50) {
                            navVisible = true;
                        } else if (currentY > lastScrollY && currentY > 100) {
                            navVisible = false;
                        } else if (currentY < lastScrollY) {
                            navVisible = true;
                        }
                        lastScrollY = currentY;
                    "
                    @mousemove.window="if ($event.clientY < 70) navVisible = true"
                    @mouseenter="navVisible = true"
                    :class="{
                        'bg-white shadow-md text-brand-dark': scrolled,
                        'bg-transparent text-white': !scrolled,
                        '-translate-y-full': !navVisible,
                        'translate-y-0': navVisible
                    }"
                    class="fixed top-0 left-0 w-full z-[999] transition-transform duration-300 transform">
                <nav class="max-w-7xl mx-auto py-3 md:py-4 px-4 md:px-6 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-0 transition duration-300">
                    <!-- Top Row (Branding & Mobile Buttons) -->
                    <div class="w-full md:w-auto flex justify-between items-center shrink-0">
                        <!-- Left (Branding) -->
                        <a href="/" class="flex items-center hover:opacity-90 transition duration-300 mr-2 shrink-0">
                            <img src="{{ asset('images/Lambang_Kabupaten_Rembang.webp') }}" class="w-8 h-8 md:w-9 md:h-9 object-contain shrink-0 mr-2" alt="Logo Rembang">
                            <div class="flex flex-col text-left">
                                <span class="font-bold text-xs md:text-sm leading-tight">Desa Wisata Punjulharjo</span>
                                <span class="text-[9px] md:text-[10px] font-sans leading-none mt-0.5 opacity-75">Kec. Rembang, Kab. Rembang</span>
                            </div>
                        </a>

                        <!-- Mobile Action Buttons (Visible only on Mobile next to brand) -->
                        <div class="flex md:hidden items-center space-x-2 shrink-0">
                            @auth
                                @if(Auth::user()->isMember())
                                    <a href="{{ route('member.adopsi.dashboard') }}" class="bg-emerald-600 text-white px-2 py-1 rounded text-[10px] font-bold">
                                        <i class="fa-solid fa-tree"></i>
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-rose-600 text-white px-2 py-1 rounded text-[10px] font-bold">
                                            Logout
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-2 py-1.5 rounded-md text-[10px] font-bold shadow-sm transition duration-300">
                                            Logout Admin
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login.user') }}" class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark px-2.5 py-1.5 rounded-md text-[10px] font-bold shadow-sm transition duration-300" title="Login">
                                    <i class="fa-solid fa-right-to-bracket text-[11px]"></i>
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Navigation Links Container (Pill Navbar) -->
                    <div class="w-full md:w-auto overflow-x-auto whitespace-nowrap scrollbar-hide no-scrollbar max-w-full md:max-w-none md:overflow-visible flex justify-start md:justify-center items-center gap-2 py-1 md:py-0 px-2 md:px-0">
                        <ul class="relative flex items-center px-1 py-0.5 rounded-lg select-none mx-auto md:mx-0"
                            @mouseleave="hoverIndex = null">
                            
                            <!-- The Sliding Background Pill (slidebar) -->
                            <div x-show="(hoverIndex !== null ? hoverIndex : activeIndex) !== null && (hoverIndex !== null ? hoverIndex : activeIndex) >= 0"
                                 class="absolute h-[calc(100%-8px)] w-[58px] md:w-[82px] rounded-md z-0"
                                 :class="scrolled ? 'bg-gray-300/50' : 'bg-white/20'"
                                 :style="'transform: translateX(' + ((hoverIndex !== null ? hoverIndex : activeIndex) * 100) + '%); transition: transform 0.5s cubic-bezier(0.33, 0.83, 0.99, 0.98);'"></div>

                            <!-- The Active Page Bar (garis atas-bawah diam di page yang dipilih) -->
                            <div x-show="activeIndex !== null && activeIndex >= 0"
                                 class="absolute h-full w-[58px] md:w-[82px] z-0 pointer-events-none"
                                 :style="'transform: translateX(' + (activeIndex * 100) + '%); transition: transform 0.5s cubic-bezier(0.33, 0.83, 0.99, 0.98);'">
                                 <div class="absolute top-0 left-0 w-full h-[3px] rounded-b-full bg-current"></div>
                                 <div class="absolute bottom-0 left-0 w-full h-[3px] rounded-t-full bg-current"></div>
                             </div>

                            <!-- Links (0 to 5) -->
                            <li @mouseenter="hoverIndex = 0" @mouseleave="hoverIndex = null" class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
                                <a href="{{ route('home') }}" class="block py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current">Beranda</a>
                            </li>
                            <li @mouseenter="hoverIndex = 1" @mouseleave="hoverIndex = null" class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
                                <a href="{{ route('tentang') }}" class="block py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current">Tentang</a>
                            </li>
                            <li @mouseenter="hoverIndex = 2; destinasiDropdown = true" 
                                @mouseleave="hoverIndex = null; destinasiDropdown = false" 
                                x-data="{ destinasiDropdown: false }"
                                class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
                                <a href="{{ route('destinasi') }}" 
                                   @click="destinasiDropdown = !destinasiDropdown"
                                   class="py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current flex items-center justify-center gap-0.5">
                                    <span>Destinasi</span>
                                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="{ 'rotate-180': destinasiDropdown }"></i>
                                </a>

                                <!-- Dropdown Menu Destinasi -->
                                <div x-show="destinasiDropdown"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                     @mouseenter="destinasiDropdown = true"
                                     @mouseleave="destinasiDropdown = false"
                                     class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-44 bg-white text-slate-800 rounded-xl shadow-xl border border-slate-200 py-1.5 text-left z-[1000] overflow-hidden"
                                     style="display: none;">
                                    <a href="{{ route('destinasi') }}" 
                                       class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                        <i class="fa-solid fa-map-location-dot text-emerald-600 text-xs"></i>
                                        <span>Semua Destinasi</span>
                                    </a>
                                    <a href="{{ route('destinasi.pantai-karang-jahe') }}" 
                                       class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                                        <i class="fa-solid fa-umbrella-beach text-emerald-600 text-xs"></i>
                                        <span>Pantai Karang Jahe</span>
                                    </a>
                                    <a href="{{ route('destinasi.situs-perahu-kuno') }}" 
                                       class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                                        <i class="fa-solid fa-ship text-emerald-600 text-xs"></i>
                                        <span>Situs Perahu Kuno</span>
                                    </a>
                                </div>
                            </li>
                            <li @mouseenter="hoverIndex = 3; pustakaDropdown = true" 
                                @mouseleave="hoverIndex = null; pustakaDropdown = false" 
                                x-data="{ pustakaDropdown: false }"
                                class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
                                <a href="{{ route('pustaka') }}" 
                                   @click="pustakaDropdown = !pustakaDropdown"
                                   class="py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current flex items-center justify-center gap-0.5">
                                    <span>Pustaka</span>
                                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="{ 'rotate-180': pustakaDropdown }"></i>
                                </a>

                                <!-- Dropdown Menu Pustaka -->
                                <div x-show="pustakaDropdown"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                     @mouseenter="pustakaDropdown = true"
                                     @mouseleave="pustakaDropdown = false"
                                     class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-44 bg-white text-slate-800 rounded-xl shadow-xl border border-slate-200 py-1.5 text-left z-[1000] overflow-hidden"
                                     style="display: none;">
                                    <a href="{{ route('pustaka', ['tab' => 'ebook']) }}" 
                                       class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                        <i class="fa-solid fa-book-open text-emerald-600 text-xs"></i>
                                        <span>E-Book Panduan</span>
                                    </a>
                                    <a href="{{ route('pustaka', ['tab' => 'video']) }}" 
                                       class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                                        <i class="fa-solid fa-circle-play text-emerald-600 text-xs"></i>
                                        <span>Video Dokumentasi</span>
                                    </a>
                                    <a href="{{ route('pustaka', ['tab' => 'blog']) }}" 
                                       class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                                        <i class="fa-solid fa-newspaper text-emerald-600 text-xs"></i>
                                        <span>Artikel & Blog</span>
                                    </a>
                                </div>
                            </li>
                            <li @mouseenter="hoverIndex = 4" @mouseleave="hoverIndex = null" class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
                                <a href="{{ route('temukan') }}" class="block py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current">Lokasi</a>
                            </li>
                            <li @mouseenter="hoverIndex = 5" @mouseleave="hoverIndex = null" class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
                                <a href="{{ route('testimoni.index') }}" class="block py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current">Kesan</a>
                            </li>
                        </ul>

                        <!-- Separate Standout My Cemara Button -->
                        <a href="{{ route('adopsi.index') }}" 
                           class="px-3 py-1.5 text-[9px] md:text-xs font-bold rounded-lg transition duration-300 shadow-sm border flex items-center gap-1.5 shrink-0"
                           :class="scrolled ? 'bg-emerald-600 hover:bg-emerald-700 text-white border-emerald-600' : 'bg-emerald-500 hover:bg-emerald-600 text-white border-emerald-400/60 shadow-emerald-500/30'">
                            <i class="fa-solid fa-tree text-[11px]"></i>
                            <span>My Cemara</span>
                        </a>
                    </div>
                    
                    <!-- Desktop Actions (Hidden on Mobile) -->
                    <div class="hidden md:flex items-center space-x-3 shrink-0">
                        @auth
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-xs font-semibold shadow-sm transition duration-300">
                                    Logout
                                </button>
                            </form>
                        @else
                            <div x-data="{ openLoginDrop: false }" class="relative inline-block text-left">
                                <button @click="openLoginDrop = !openLoginDrop" @click.away="openLoginDrop = false" type="button"
                                        class="bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark px-4 py-2 text-xs font-semibold shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                    <i class="fa-solid fa-right-to-bracket"></i> Login / Akses <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </button>
                                <div x-show="openLoginDrop" x-transition
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-[1000] text-slate-800 text-xs font-semibold py-1">
                                    <a href="{{ route('login.user') }}" class="block px-4 py-2 hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-2">
                                        <i class="fa-solid fa-tree text-emerald-600"></i> Login User / Member
                                    </a>
                                    <a href="{{ route('login.admin') }}" class="block px-4 py-2 hover:bg-sky-50 hover:text-sky-700 flex items-center gap-2 border-t border-slate-100">
                                        <i class="fa-solid fa-user-shield text-sky-600"></i> Login Admin Panel
                                    </a>
                                </div>
                            </div>
                        @endauth
                        
                        <!-- Hamburger Menu Button -->
                        <button id="mobile-menu-toggle" 
                                class="md:hidden focus:outline-none transition-colors duration-300"
                                aria-label="Toggle Menu">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </button>
                    </div>
                </nav>
            </header>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="hidden fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-md transition-opacity duration-300 flex justify-end">
                <div class="w-72 bg-white h-full p-6 shadow-2xl flex flex-col justify-between transform translate-x-full transition-transform duration-300">
                    <div>
                        <div class="flex justify-between items-center pb-6 border-b">
                            <span class="text-xl font-bold bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text text-transparent">Menu</span>
                            <button id="mobile-menu-close" class="text-slate-500 hover:text-slate-800">
                                <i class="fa-solid fa-xmark text-2xl"></i>
                            </button>
                        </div>
                        <div class="flex flex-col space-y-4 mt-8 font-medium">
                            <a href="/" class="text-slate-700 hover:text-sky-600 text-lg transition">Beranda</a>
                            <a href="{{ route('tentang') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Tentang</a>
                            <a href="{{ route('destinasi') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Destinasi</a>
                            <a href="{{ route('pustaka') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Pustaka</a>
                            <a href="{{ route('blog.index') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Blog</a>
                            <a href="{{ route('temukan') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Lokasi</a>
                            <a href="{{ route('testimoni.index') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Kesan Pengunjung</a>
                        </div>
                    </div>
                    <div class="pt-6 border-t space-y-3">
                        @auth
                            <a href="{{ route('admin.testimoni.index') }}" 
                               class="block w-full text-center bg-slate-800 hover:bg-slate-700 text-white py-3 rounded-none font-semibold shadow">
                                Moderasi Testimoni
                            </a>
                            <button onclick="document.getElementById('messages-modal').classList.remove('hidden')" 
                                    class="block w-full text-center bg-slate-800 hover:bg-slate-700 text-white py-3 rounded-none font-semibold shadow">
                                Pesan
                            </button>
                            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white py-3 rounded-none font-semibold shadow">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block text-center bg-sky-600 hover:bg-sky-700 text-white py-3 rounded-none font-semibold shadow">
                                Login Admin
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-grow">
                <!-- Global Alerts (Floating Toast) -->
                @if(session('success') || $errors->any())
                    <div class="fixed top-28 right-6 z-[9999] max-w-md w-full space-y-3 pointer-events-auto">
                        @if(session('success'))
                            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow-lg flex items-center justify-between font-sans text-sm" role="alert" x-data="{ show: true }" x-show="show">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                                    <span>{{ session('success') }}</span>
                                </div>
                                <button type="button" @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition ml-4">
                                    <i class="fa-solid fa-xmark text-sm"></i>
                                </button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 shadow-lg flex flex-col font-sans text-sm" role="alert" x-data="{ show: true }" x-show="show">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2 font-semibold">
                                        <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                                        <span>Terdapat beberapa kesalahan:</span>
                                    </div>
                                    <button type="button" @click="show = false" class="text-rose-500 hover:text-rose-700 transition">
                                        <i class="fa-solid fa-xmark text-sm"></i>
                                    </button>
                                </div>
                                <ul class="list-disc list-inside space-y-1 text-xs opacity-90 pl-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="max-w-7xl mx-auto px-4 py-8 md:px-6 md:py-16 grid md:grid-cols-3 gap-8 md:gap-12 text-sm text-gray-600">
                    <div class="space-y-4">
                        <h3 class="font-extrabold text-lg text-gray-900">Desa Wisata Punjulharjo</h3>
                        <div class="space-y-2 font-sans text-xs">
                            <p class="leading-relaxed">
                                <strong class="text-gray-700 font-semibold">Alamat Desa Wisata:</strong><br>
                                📍 <a href="https://maps.app.goo.gl/jhFMynBy4wUFiuCA7" target="_blank" class="hover:text-sky-600 transition">Punjulharjo, Kec. Rembang, Kabupaten Rembang, Jawa Tengah 59219</a>
                            </p>
                        </div>
                        <div class="flex space-x-3 pt-2">
                            <a href="https://www.instagram.com/desawisatapunjulharjo/" target="_blank" 
                               class="w-9 h-9 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:bg-[#e1306c] hover:text-white transition-all duration-300 shadow-sm" 
                               title="Instagram">
                                <i class="fa-brands fa-instagram text-base"></i>
                            </a>
                            <a href="https://www.youtube.com/@desawisatapunjulharjo9639" target="_blank" 
                               class="w-9 h-9 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:bg-[#ff0000] hover:text-white transition-all duration-300 shadow-sm" 
                               title="YouTube">
                                <i class="fa-brands fa-youtube text-base"></i>
                            </a>
                            <a href="https://www.tiktok.com/@desawisata.punjul" target="_blank" 
                               class="w-9 h-9 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:bg-black hover:text-white transition-all duration-300 shadow-sm" 
                               title="TikTok">
                                <i class="fa-brands fa-tiktok text-base"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-base mb-4">Navigasi Halaman</h3>
                        <ul class="space-y-3 font-medium">
                            <li><a href="/" class="hover:text-sky-600 transition">Beranda</a></li>
                            <li><a href="{{ route('tentang') }}" class="hover:text-sky-600 transition">Tentang Kami</a></li>
                            <li><a href="{{ route('video.index') }}" class="hover:text-sky-600 transition">Galeri Video</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-sky-600 transition">Artikel & Blog</a></li>
                            <li><a href="{{ route('temukan') }}" class="hover:text-sky-600 transition">Hubungi & Lokasi Kami</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-base mb-4">Peta Lokasi</h3>
                        <div class="rounded-none overflow-hidden shadow border border-gray-200">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15855.531271081694!2d111.3857503757342!3d-6.685363393311915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e774775d710fa53%3A0xe54d6ea6a6c221a9!2sPunjulharjo%2C%20Kec.%20Rembang%2C%20Kabupaten%20Rembang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1720680000000!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none"></iframe>
                        </div>
                    </div>
                </div>
                <div class="text-center text-gray-400 py-6 border-t border-gray-200 text-xs">
                    © {{ date('Y') }} Desa Wisata Punjulharjo. Semua hak dilindungi.
                </div>
            </footer>

        </div>
    </div>

    <!-- Script for mobile menu navigation drawer -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('mobile-menu-toggle');
            const closeBtn = document.getElementById('mobile-menu-close');
            const menuDrawer = document.getElementById('mobile-menu');
            const menuContent = menuDrawer.querySelector('div');

            function openMenu() {
                menuDrawer.classList.remove('hidden');
                setTimeout(() => {
                    menuContent.classList.remove('translate-x-full');
                }, 10);
            }

            function closeMenu() {
                menuContent.classList.add('translate-x-full');
                setTimeout(() => {
                    menuDrawer.classList.add('hidden');
                }, 300);
            }

            toggleBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            menuDrawer.addEventListener('click', function(e) {
                if (e.target === menuDrawer) closeMenu();
            });
        });
    </script>

    @auth
        <!-- Messages Modal -->
        <div id="messages-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-2xl w-full max-h-[85vh] flex flex-col overflow-hidden border border-slate-100 transform transition-all">
                <!-- Modal Header -->
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-inbox text-sky-600 text-xl"></i>
                        <h3 class="text-xl font-heading text-slate-800">Pesan Masuk (Hubungi Kami)</h3>
                    </div>
                    <button onclick="document.getElementById('messages-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6 overflow-y-auto space-y-4 flex-grow max-h-[60vh] bg-slate-50">
                    @php
                        $contactMessages = \App\Models\ContactMessage::latest()->take(30)->get();
                    @endphp

                    @if($contactMessages->count() > 0)
                        @foreach($contactMessages as $msg)
                            <div class="bg-white p-5 rounded-none border border-slate-100 shadow-sm space-y-3">
                                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 border-b border-slate-100 pb-2">
                                    <div>
                                        <h4 class="font-semibold text-slate-800 text-sm sm:text-base">{{ $msg->name }}</h4>
                                        <p class="text-xs text-sky-600">{{ $msg->email }}</p>
                                    </div>
                                    <span class="text-[10px] text-slate-400 bg-slate-50 px-2 py-1 rounded-none">
                                        {{ $msg->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm text-slate-600 whitespace-pre-line leading-relaxed font-sans">{{ $msg->message }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12 text-slate-400 font-sans">
                            <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                            <p>Belum ada pesan masuk.</p>
                        </div>
                    @endif
                </div>

                </div>
            </div>
        </div>
    @endauth

    <!-- Floating Action Button (FAB) for Logged in Member & Admin -->
    @auth
        @if(auth()->user()->isMember())
            <a href="{{ route('member.adopsi.dashboard') }}" title="Dashboard My Cemara"
               class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white shadow-2xl flex items-center justify-center text-xl transition-all duration-300 transform hover:scale-110 border-2 border-white">
                <i class="fa-solid fa-tree"></i>
            </a>
        @endif
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.moderasi.index') }}" title="Halaman Moderasi Gabungan"
               class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-sky-700 hover:bg-sky-800 text-white shadow-2xl flex items-center justify-center text-xl transition-all duration-300 transform hover:scale-110 border-2 border-white">
                <i class="fa-solid fa-shield-halved"></i>
            </a>
        @endif
    @endauth

    @stack('scripts')
</body>

</html>