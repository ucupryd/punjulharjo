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

    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bulletproof Latar Belakang & Font Face menggunakan Laravel helper -->
    <style>
        @font-face {
            font-family: 'The Last Trunks';
            src: url("{{ asset('fonts/The-Last-Trunks.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        .page-frame-inner {
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.25)), 
                url("{{ asset('images/beach-bg.png') }}") !important;
            background-size: cover !important;
            background-position: center !important;
            background-attachment: scroll !important;
        }
    </style>

    @vite('resources/css/app.css')
    
    <!-- FontAwesome (icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#edf2f7] min-h-screen antialiased">

    <!-- Page Frame Wrapper (creates the premium white rounded border aesthetic) -->
    <div class="page-frame-container">
        <div class="page-frame-inner">

            <!-- Navbar -->
            <div class="fixed top-6 left-0 w-full z-50 px-4 md:px-12">
                <nav class="glass-nav shadow-lg rounded-xl max-w-6xl mx-auto py-3 px-6 flex justify-between items-center transition duration-300">
                    <a href="/" class="text-xl font-extrabold bg-gradient-to-r from-sky-400 via-sky-100 to-white bg-clip-text text-transparent hover:scale-105 transition duration-300">
                        Desa Punjulharjo
                    </a>
                    
                    <!-- Desktop Navigation Sliding Tabs Switcher -->
                    <div class="hidden md:block nav-radio-tabs-wrapper">
                        <div class="nav-wrap">
                            <input type="radio" id="nav-rd-1" name="nav-radio" class="nav-rd-1" {{ Route::is('home') ? 'checked' : '' }} hidden />
                            <a href="{{ route('home') }}" class="nav-label"><span>Beranda</span></a>
                            
                            <input type="radio" id="nav-rd-2" name="nav-radio" class="nav-rd-2" {{ Route::is('tentang') ? 'checked' : '' }} hidden />
                            <a href="{{ route('tentang') }}" class="nav-label"><span>Tentang</span></a>
                            
                            <input type="radio" id="nav-rd-3" name="nav-radio" class="nav-rd-3" {{ Route::is('video.*') ? 'checked' : '' }} hidden />
                            <a href="{{ route('video.index') }}" class="nav-label"><span>Video</span></a>
                            
                            <input type="radio" id="nav-rd-4" name="nav-radio" class="nav-rd-4" {{ Route::is('blog.*') ? 'checked' : '' }} hidden />
                            <a href="{{ route('blog.index') }}" class="nav-label"><span>Blog</span></a>
                            
                            <input type="radio" id="nav-rd-5" name="nav-radio" class="nav-rd-5" {{ Route::is('temukan') ? 'checked' : '' }} hidden />
                            <a href="{{ route('temukan') }}" class="nav-label"><span>Temukan Kami</span></a>
                            
                            <div class="nav-bar"></div>
                            <div class="nav-slidebar"></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="hidden sm:inline-block bg-gradient-to-r from-sky-500 to-indigo-500 hover:from-sky-600 hover:to-indigo-600 text-white px-5 py-2 rounded-full text-sm font-semibold shadow-md transition duration-300 transform hover:scale-105">
                            Login Admin
                        </a>
                        
                        <!-- Hamburger Menu Button -->
                        <button id="mobile-menu-toggle" class="md:hidden text-slate-700 hover:text-sky-600 focus:outline-none" aria-label="Toggle Menu">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </</button>
                    </div>
                </nav>
            </div>

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
                            <a href="{{ route('video.index') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Video</a>
                            <a href="{{ route('blog.index') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Blog</a>
                            <a href="{{ route('temukan') }}" class="text-slate-700 hover:text-sky-600 text-lg transition">Temukan Kami</a>
                        </div>
                    </div>
                    <div class="pt-6 border-t">
                        <a href="{{ route('login') }}" class="block text-center bg-gradient-to-r from-sky-500 to-indigo-500 text-white py-3 rounded-full font-semibold shadow-md">
                            Login Admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-slate-50 border-t border-slate-100">
                <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-3 gap-12 text-sm text-slate-600">
                    <div class="space-y-4">
                        <h3 class="font-extrabold text-lg text-slate-800">Desa Wisata Punjulharjo</h3>
                        <p class="leading-relaxed">📍 8C57+JW8, Jetakbelah, Punjulharjo, Kec. Rembang, Kabupaten Rembang, Jawa Tengah 59219</p>
                        <div class="flex space-x-4 pt-2">
                            <a href="https://facebook.com" target="_blank" class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center hover:bg-sky-600 hover:text-white transition duration-300"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://instagram.com" target="_blank" class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center hover:bg-sky-600 hover:text-white transition duration-300"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://youtube.com" target="_blank" class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center hover:bg-sky-600 hover:text-white transition duration-300"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-base mb-4">Navigasi Halaman</h3>
                        <ul class="space-y-3 font-medium">
                            <li><a href="/" class="hover:text-sky-600 transition">Beranda</a></li>
                            <li><a href="{{ route('tentang') }}" class="hover:text-sky-600 transition">Tentang Kami</a></li>
                            <li><a href="{{ route('video.index') }}" class="hover:text-sky-600 transition">Galeri Video</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-sky-600 transition">Artikel & Blog</a></li>
                            <li><a href="{{ route('temukan') }}" class="hover:text-sky-600 transition">Hubungi & Temukan Kami</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-base mb-4">Peta Lokasi</h3>
                        <div class="rounded-2xl overflow-hidden shadow-md border border-slate-100">
                            <iframe src="https://www.google.com/maps?q=Punjulharjo,Rembang&output=embed" width="100%" height="150"
                                class="border-none">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="text-center text-slate-400 py-6 border-t border-slate-100 text-xs">
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
</body>

</html>