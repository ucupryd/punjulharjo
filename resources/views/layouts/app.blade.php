<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Punjulharjo</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-sky-600">Desa Punjulharjo</a>
            <div class="space-x-6">
                <a href="/" class="text-gray-700 hover:text-sky-600">Beranda</a>
                <a href="{{ route('tentang') }}" class="text-gray-700 hover:text-sky-600">Tentang</a>
                <a href="{{ route('video.index') }}" class="text-gray-700 hover:text-sky-600">Video</a>
                <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-sky-600">Blog</a>
                <a href="{{ route('temukan') }}" class="text-gray-700 hover:text-sky-600">Temukan Kami</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-sky-600">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-t from-sky-200 to-sky-50 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-8 text-sm text-gray-700">
            <div>
                <p>📍 8C57+JW8, Jetakbelah, Punjulharjo, Kec. Rembang, Kabupaten Rembang, Jawa Tengah 59219</p>
            </div>
            <div>
                <h3 class="font-semibold mb-2">Halaman</h3>
                <ul class="space-y-1">
                    <li><a href="/" class="hover:text-sky-600">Beranda</a></li>
                    <li><a href="#tentang" class="hover:text-sky-600">Tentang</a></li>
                    <li><a href="#video" class="hover:text-sky-600">Kumpulan Video</a></li>
                    <li><a href="#blog" class="hover:text-sky-600">Blog</a></li>
                    <li><a href="#kontak" class="hover:text-sky-600">Kunjungi Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-2">Informasi Tambahan</h3>
                <a href="#" class="bg-sky-500 text-white px-4 py-2 rounded-md inline-block mb-3 hover:bg-sky-600">
                    Situs Perahu Kuno
                </a>
                <p>Lokasi Kami:</p>
                <iframe src="https://www.google.com/maps?q=Punjulharjo,Rembang&output=embed" width="250" height="200"
                    class="rounded-lg border-none mt-2">
                </iframe>
            </div>
        </div>
        <div class="text-center text-gray-500 py-4 border-t">
            © {{ date('Y') }} Desa Wisata Punjulharjo. Semua hak dilindungi.
        </div>
    </footer>

</body>

</html>