<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Punjulharjo</title>
    
    <!-- Dynamic Favicon Override Logic:
         Checks if custom-favicon.png exists in public directory. 
         If yes, resolves to that. If no, defaults to the beautiful 2D vector-style blue coconut tree SVG inlined  as Base64. -->
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

<body class="bg-white min-h-screen flex flex-col antialiased">

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
                } elseif (request()->is('testimoni*')) {
                    $activeIndex = 4;
                } elseif (request()->is('adopsi*') || request()->is('member*')) {
                    $activeIndex = -1;
                }

                $hasTransparentHeader = (request()->is('/') || request()->is('tentang') || request()->is('destinasi*') || request()->is('pustaka*') || request()->is('testimoni*') || request()->is('adopsi*'));
            @endphp

            <!-- Nav Transparan (Absolute, scrolls away with hero) -->
            @if($hasTransparentHeader)
                <header x-data="{
                            hoverIndex: null,
                            activeIndex: {{ $activeIndex }},
                            scrolled: false,
                            hasTransparentHeader: true
                        }"
                        class="absolute top-0 left-0 w-full z-30 bg-transparent text-white">
                    <nav class="max-w-7xl mx-auto py-3 md:py-4 px-4 md:px-6 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-0 transition duration-300">
                        <!-- Top Row (Branding & Mobile Buttons) -->
                        <div class="w-full md:w-auto flex justify-between items-center shrink-0">
                            <!-- Left (Branding) -->
                            <a href="/" class="flex items-center hover:opacity-90 transition duration-300 mr-2 shrink-0">
                                <img src="{{ asset('images/Lambang_Kabupaten_Rembang.webp') }}" class="w-8 h-8 md:w-9 md:h-9 object-contain shrink-0 mr-2" alt="Logo Rembang">
                                <div class="flex flex-col text-left">
                                    <span class="font-bold text-xs md:text-sm leading-tight text-white font-heading">Desa Wisata Punjulharjo</span>
                                    <span class="text-[9px] md:text-[10px] font-sans leading-none mt-0.5 opacity-75 text-white">Kec. Rembang, Kab. Rembang</span>
                                </div>
                            </a>

                            <!-- Mobile Action Buttons -->
                            <div class="flex md:hidden items-center space-x-2 shrink-0">
                                <button id="mobile-menu-toggle-transparent" 
                                        class="focus:outline-none transition-colors duration-300 p-2 text-white"
                                        aria-label="Toggle Menu">
                                    <i class="fa-solid fa-bars text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Navigation Links Container (Pill Navbar) -->
                        <div class="hidden md:flex w-full md:w-auto overflow-x-auto whitespace-nowrap scrollbar-hide no-scrollbar max-w-full md:max-w-none md:overflow-visible justify-start md:justify-center items-center gap-2 py-1 md:py-0 px-2 md:px-0">
                            <x-partials.nav-links variant="transparent" />

                            <!-- Separate Standout My Cemara Button -->
                            <a href="{{ route('adopsi.index') }}" 
                               class="px-3 py-1.5 text-[9px] md:text-xs font-bold rounded-lg transition duration-300 shadow-sm border flex items-center gap-1.5 shrink-0 bg-emerald-500 hover:bg-emerald-600 text-white border-emerald-400/60 shadow-emerald-500/30">
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
                                            class="bg-white/10 text-white hover:bg-white hover:text-slate-800 px-4 py-2 text-xs font-semibold shadow-sm transition-colors duration-300 flex items-center gap-1.5 border border-white/20">
                                        <i class="fa-solid fa-right-to-bracket"></i> Login <i class="fa-solid fa-chevron-down text-[10px]"></i>
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
                        </div>
                    </nav>
                </header>
            @endif

            <!-- Nav Putih Sticky (Fixed, gets shown after hero sentinel or is immediately active) -->
            <header id="navSolid"
                    x-data="{
                        hoverIndex: null,
                        activeIndex: {{ $activeIndex }},
                        scrolled: true,
                        hasTransparentHeader: {{ $hasTransparentHeader ? 'true' : 'false' }}
                    }"
                    class="fixed top-0 left-0 w-full z-40 bg-white/95 shadow-md backdrop-blur transition-transform duration-300 ease-out will-change-transform"
                    :class="hasTransparentHeader ? '-translate-y-full' : 'translate-y-0'">
                <nav class="max-w-7xl mx-auto py-3 md:py-4 px-4 md:px-6 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-0 transition duration-300">
                    <!-- Top Row (Branding & Mobile Buttons) -->
                    <div class="w-full md:w-auto flex justify-between items-center shrink-0">
                        <!-- Left (Branding) -->
                        <a href="/" class="flex items-center hover:opacity-90 transition duration-300 mr-2 shrink-0">
                            <img src="{{ asset('images/Lambang_Kabupaten_Rembang.webp') }}" class="w-8 h-8 md:w-9 md:h-9 object-contain shrink-0 mr-2" alt="Logo Rembang">
                            <div class="flex flex-col text-left">
                                <span class="font-bold text-xs md:text-sm leading-tight text-brand-dark font-heading">Desa Wisata Punjulharjo</span>
                                <span class="text-[9px] md:text-[10px] font-sans leading-none mt-0.5 opacity-75 text-gray-500">Kec. Rembang, Kab. Rembang</span>
                            </div>
                        </a>

                        <!-- Mobile Action Buttons -->
                        <div class="flex md:hidden items-center space-x-2 shrink-0">
                            <button id="mobile-menu-toggle-solid" 
                                    class="focus:outline-none transition-colors duration-300 p-2 text-brand-dark"
                                    aria-label="Toggle Menu">
                                <i class="fa-solid fa-bars text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Navigation Links Container (Pill Navbar) -->
                    <div class="hidden md:flex w-full md:w-auto overflow-x-auto whitespace-nowrap scrollbar-hide no-scrollbar max-w-full md:max-w-none md:overflow-visible justify-start md:justify-center items-center gap-2 py-1 md:py-0 px-2 md:px-0">
                        <x-partials.nav-links variant="light" />

                        <!-- Separate Standout My Cemara Button -->
                        <a href="{{ route('adopsi.index') }}" 
                           class="px-3 py-1.5 text-[9px] md:text-xs font-bold rounded-lg transition duration-300 shadow-sm border flex items-center gap-1.5 shrink-0 bg-emerald-600 hover:bg-emerald-700 text-white border-emerald-600">
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
                                    <i class="fa-solid fa-right-to-bracket"></i> Login <i class="fa-solid fa-chevron-down text-[10px]"></i>
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
                            
                            <!-- Destinasi Dropdown Accordion -->
                            <div x-data="{ open: false }" class="w-full text-left">
                                <button @click="open = !open" class="w-full flex items-center justify-between text-slate-700 hover:text-sky-600 text-lg transition font-medium focus:outline-none">
                                    <span>Destinasi</span>
                                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                                </button>
                                <div x-show="open" x-transition.opacity class="pl-4 mt-2 space-y-2 border-l-2 border-slate-100 flex flex-col text-left">
                                    <a href="{{ route('destinasi') }}" class="text-slate-600 hover:text-sky-600 text-base py-1">Semua Destinasi</a>
                                    <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="text-slate-600 hover:text-sky-600 text-base py-1">Pantai Karang Jahe</a>
                                    <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="text-slate-600 hover:text-sky-600 text-base py-1">Situs Perahu Kuno</a>
                                </div>
                            </div>
                            
                            <!-- Pustaka Dropdown Accordion -->
                            <div x-data="{ open: false }" class="w-full text-left">
                                <button @click="open = !open" class="w-full flex items-center justify-between text-slate-700 hover:text-sky-600 text-lg transition font-medium focus:outline-none">
                                    <span>Pustaka</span>
                                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                                </button>
                                <div x-show="open" x-transition.opacity class="pl-4 mt-2 space-y-2 border-l-2 border-slate-100 flex flex-col text-left">
                                    <a href="{{ route('pustaka', ['tab' => 'ebook']) }}" class="text-slate-600 hover:text-sky-600 text-base py-1">E-Book Panduan</a>
                                    <a href="{{ route('pustaka', ['tab' => 'video']) }}" class="text-slate-600 hover:text-sky-600 text-base py-1">Video Dokumentasi</a>
                                    <a href="{{ route('pustaka', ['tab' => 'blog']) }}" class="text-slate-600 hover:text-sky-600 text-base py-1">Artikel & Blog</a>
                                </div>
                            </div>

                            <a href="{{ route('testimoni.index') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Kesan Pengunjung</a>
                            <a href="{{ route('adopsi.index') }}" class="text-emerald-700 hover:text-emerald-800 font-bold text-lg transition flex items-center gap-2">
                                <i class="fa-solid fa-tree"></i> My Cemara
                            </a>

                            <!-- Login Dropdown Accordion for Guest -->
                            @guest
                                <div x-data="{ open: false }" class="w-full text-left">
                                    <button @click="open = !open" class="w-full flex items-center justify-between text-slate-700 hover:text-sky-600 text-lg transition font-medium focus:outline-none">
                                        <span class="flex items-center gap-2">
                                            <i class="fa-solid fa-right-to-bracket text-sky-600"></i> Login
                                        </span>
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                                    </button>
                                    <div x-show="open" x-transition.opacity class="pl-4 mt-2 space-y-2 border-l-2 border-slate-100 flex flex-col text-left">
                                        <a href="{{ route('login.user') }}" class="text-emerald-600 hover:text-emerald-700 text-base py-1 font-bold flex items-center gap-1.5">
                                            <i class="fa-solid fa-tree text-xs"></i> Member / User
                                        </a>
                                        <a href="{{ route('login.admin') }}" class="text-slate-700 hover:text-slate-900 text-base py-1 font-bold flex items-center gap-1.5 border-t border-slate-100 mt-1">
                                            <i class="fa-solid fa-user-shield text-xs"></i> Admin Panel
                                        </a>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                    <div class="pt-6 border-t space-y-3">
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.moderasi.index') }}" 
                                   class="block w-full text-center bg-sky-700 hover:bg-sky-800 text-white py-3 rounded-lg font-semibold shadow">
                                    Pusat Moderasi Admin
                                </a>
                            @else
                                <a href="{{ route('member.adopsi.dashboard') }}" 
                                   class="block w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-semibold shadow">
                                    Dashboard Member
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold shadow">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1">
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
                <div class="max-w-7xl mx-auto px-5 py-8 md:px-6 md:py-16 grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-12 text-xs md:text-sm text-gray-600">
                    <div class="space-y-2 md:space-y-4">
                        <h3 class="font-extrabold text-sm sm:text-base md:text-lg text-slate-900 font-heading">Desa Wisata Punjulharjo</h3>
                        <div class="flex items-start gap-2 text-[10px] sm:text-xs md:text-sm text-slate-500 font-sans mt-2">
                            <i class="fa-solid fa-location-dot text-sky-600 mt-0.5 shrink-0"></i>
                            <p class="leading-relaxed">
                                <strong class="text-slate-700 font-semibold block text-[10px] sm:text-xs md:text-sm">Alamat Desa Wisata:</strong>
                                <a href="https://maps.app.goo.gl/jhFMynBy4wUFiuCA7" target="_blank" class="hover:text-sky-600 transition">Punjulharjo, Kec. Rembang, Kabupaten Rembang, Jawa Tengah 59219</a>
                            </p>
                        </div>
                        <div class="flex space-x-2 pt-1 md:pt-2">
                            <a href="https://www.instagram.com/desawisatapunjulharjo/" target="_blank" 
                               class="w-7 h-7 md:w-9 md:h-9 rounded-full bg-slate-50 hover:bg-[#e1306c] hover:text-white text-slate-500 flex items-center justify-center transition-all duration-300 shadow-sm border border-slate-100" 
                               title="Instagram">
                                <i class="fa-brands fa-instagram text-xs md:text-base"></i>
                            </a>
                            <a href="https://www.youtube.com/@desawisatapunjulharjo9639" target="_blank" 
                               class="w-7 h-7 md:w-9 md:h-9 rounded-full bg-slate-50 hover:bg-[#ff0000] hover:text-white text-slate-500 flex items-center justify-center transition-all duration-300 shadow-sm border border-slate-100" 
                               title="YouTube">
                                <i class="fa-brands fa-youtube text-xs md:text-base"></i>
                            </a>
                            <a href="https://www.tiktok.com/@desawisata.punjul" target="_blank" 
                               class="w-7 h-7 md:w-9 md:h-9 rounded-full bg-slate-50 hover:bg-black hover:text-white text-slate-500 flex items-center justify-center transition-all duration-300 shadow-sm border border-slate-100" 
                               title="TikTok">
                                <i class="fa-brands fa-tiktok text-xs md:text-base"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-[11px] sm:text-sm md:text-base uppercase tracking-wider text-slate-900 mb-2 md:mb-4">Navigasi Halaman</h4>
                        <ul class="grid grid-cols-2 md:grid-cols-1 gap-x-4 gap-y-2 md:space-y-3 font-semibold text-[10px] sm:text-xs md:text-sm text-slate-500">
                            <li><a href="/" class="hover:text-sky-600 transition flex items-center gap-1"><i class="fa-solid fa-chevron-right text-[7px] text-slate-400"></i> Beranda</a></li>
                            <li><a href="{{ route('tentang') }}" class="hover:text-sky-600 transition flex items-center gap-1"><i class="fa-solid fa-chevron-right text-[7px] text-slate-400"></i> Tentang Kami</a></li>
                            <li><a href="{{ route('video.index') }}" class="hover:text-sky-600 transition flex items-center gap-1"><i class="fa-solid fa-chevron-right text-[7px] text-slate-400"></i> Galeri Video</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-sky-600 transition flex items-center gap-1"><i class="fa-solid fa-chevron-right text-[7px] text-slate-400"></i> Artikel & Blog</a></li>
                            <li class="col-span-2 md:col-span-1"><a href="{{ route('temukan') }}" class="hover:text-sky-600 transition flex items-center gap-1"><i class="fa-solid fa-chevron-right text-[7px] text-slate-400"></i> Hubungi & Lokasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-[11px] sm:text-sm md:text-base uppercase tracking-wider text-slate-900 mb-2 md:mb-4">Peta Lokasi</h4>
                        <div class="rounded-lg overflow-hidden shadow-sm border border-slate-100 h-28 sm:h-36 md:h-48 w-full">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15855.531271081694!2d111.3857503757342!3d-6.685363393311915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e774775d710fa53%3A0xe54d6ea6a6c221a9!2sPunjulharjo%2C%20Kec.%20Rembang%2C%20Kabupaten%20Rembang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1720680000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none"></iframe>
                        </div>
                    </div>
                </div>
                <div class="text-center text-gray-400 py-6 border-t border-gray-200 text-xs">
                    © {{ date('Y') }} Desa Wisata Punjulharjo. Semua hak dilindungi.
                </div>
            </footer>

        </div>
    </div>

    <!-- Script for mobile menu navigation drawer & dual-navbar scroll logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const toggleBtns = document.querySelectorAll('[id^="mobile-menu-toggle"]');
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

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', openMenu);
            });
            closeBtn.addEventListener('click', closeMenu);
            menuDrawer.addEventListener('click', function(e) {
                if (e.target === menuDrawer) closeMenu();
            });

            // Dual Navbar scroll/sticky behavior
            const navSolid = document.getElementById('navSolid');
            const sentinel = document.getElementById('heroSentinel');

            if (navSolid) {
                const hasTransparent = {{ $hasTransparentHeader ? 'true' : 'false' }};
                
                if (hasTransparent && sentinel) {
                    let lastScroll = window.scrollY;
                    let pastHero = false;
                    let idleTimer;
                    let mouseNearTop = false;
                    let mouseOverNav = false;

                    const show = () => navSolid.classList.remove('-translate-y-full');
                    const hide = () => navSolid.classList.add('-translate-y-full');

                    // Check cursor near top of screen (clientY < 70)
                    window.addEventListener('mousemove', (e) => {
                        mouseNearTop = e.clientY < 70;
                        if (mouseNearTop && pastHero) {
                            show();
                        }
                    }, { passive: true });

                    // Check cursor hovering over the navigation bar itself
                    navSolid.addEventListener('mouseenter', () => {
                        mouseOverNav = true;
                        if (pastHero) {
                            show();
                        }
                    });

                    navSolid.addEventListener('mouseleave', () => {
                        mouseOverNav = false;
                    });

                    // intersection observer sentinel check
                    const observer = new IntersectionObserver(([entry]) => {
                        // pastHero is true when sentinel is completely out of view at the top of the viewport
                        pastHero = !entry.isIntersecting && entry.boundingClientRect.top < 0;
                        update();
                    }, { threshold: 0 });
                    
                    observer.observe(sentinel);

                    function update() {
                        const current = window.scrollY;
                        if (!pastHero) {
                            hide(); // Still in hero section → hide solid navbar
                        } else if (mouseNearTop || mouseOverNav || current < lastScroll) {
                            show(); // Near top, hovering, or scrolling up → show solid navbar
                        } else {
                            hide(); // Scrolling down and mouse not near top/hovering → hide
                        }
                        lastScroll = current;
                    }

                    window.addEventListener('scroll', () => {
                        update();
                        // Hide after 1500ms of inactivity when past hero, unless cursor is near top or hovering
                        clearTimeout(idleTimer);
                        idleTimer = setTimeout(() => {
                            if (pastHero && !mouseNearTop && !mouseOverNav) {
                                hide();
                            }
                        }, 1500);
                    }, { passive: true });
                } else {
                    // Non-hero page or sentinel not found: solid navbar is always visible
                    navSolid.classList.remove('-translate-y-full');
                    navSolid.classList.add('translate-y-0');
                }
            }
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