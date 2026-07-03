<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Desa Wisata Punjulharjo</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-sky-50 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-sky-600">Admin Panel</h2>
                <p class="text-sm text-gray-500">Desa Punjulharjo</p>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-md hover:bg-sky-100 text-gray-700 font-medium {{ request()->is('admin/dashboard') ? 'bg-sky-200 text-sky-800' : '' }}">
                    🏠 Dashboard
                </a>
                <a href="{{ route('admin.hero.edit') }}"
                    class="block px-4 py-2 rounded-md hover:bg-sky-100 text-gray-700 font-medium {{ request()->is('admin/hero*') ? 'bg-sky-200 text-sky-800 font-semibold' : '' }}">
                    🖼️ Ubah Background Hero
                </a>
                <a href="{{ route('admin.blog.index') }}"
                    class="block px-4 py-2 rounded-md hover:bg-sky-100 text-gray-700 font-medium {{ request()->is('admin/blog*') ? 'bg-sky-200 text-sky-800 font-semibold' : '' }}">
                    📝 Artikel & Blog
                </a>
                <a href="{{ route('admin.video.index') }}"
                    class="block px-4 py-2 rounded-md hover:bg-sky-100 text-gray-700 font-medium {{ request()->is('admin/video*') ? 'bg-sky-200 text-sky-800 font-semibold' : '' }}">
                    🎥 Video Wisata
                </a>
                <a href="{{ route('admin.pesan.index') }}"
                    class="block px-4 py-2 rounded-md hover:bg-sky-100 text-gray-700 font-medium {{ request()->is('admin/pesan*') ? 'bg-sky-200 text-sky-800 font-semibold' : '' }}">
                    💬 Pesan Masuk
                </a>
            </nav>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="p-4 border-t border-gray-200">
            @csrf
            <button type="submit"
                class="w-full text-left px-4 py-2 rounded-md bg-red-500 hover:bg-red-600 text-white font-medium">
                Keluar
            </button>
        </form>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-sky-700">Dashboard Admin</h1>
            <p class="text-gray-600">Halo, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></p>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>

</body>

</html>