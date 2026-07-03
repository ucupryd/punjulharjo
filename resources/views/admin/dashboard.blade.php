@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-sky-700 mb-6">Selamat Datang di Dashboard Admin</h2>
        <p class="text-gray-700 mb-10">
            Kelola data dan konten Desa Wisata Punjulharjo dari satu tempat.
        </p>

        {{-- Statistik Utama --}}
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white shadow-lg rounded-xl p-6 text-center hover:shadow-xl transition">
                <h3 class="text-lg font-semibold text-sky-600 mb-2">📝 Artikel & Blog</h3>
                <p class="text-gray-700">Total postingan: <strong>{{ $totalBlog }}</strong></p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 text-center hover:shadow-xl transition">
                <h3 class="text-lg font-semibold text-sky-600 mb-2">🎥 Video Wisata</h3>
                <p class="text-gray-700">Total video: <strong>{{ $totalVideo }}</strong></p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 text-center hover:shadow-xl transition">
                <h3 class="text-lg font-semibold text-sky-600 mb-2">💬 Pesan Masuk</h3>
                <p class="text-gray-700">Jumlah pesan: <strong>{{ $totalMessage }}</strong></p>
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="grid md:grid-cols-2 gap-8 mt-12">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-sky-600 mb-4">🧑‍💻 Aktivitas Terbaru</h3>

                <ul class="space-y-3 text-gray-700 text-sm">
                    @forelse($latestBlogs as $blog)
                        <li>📰 Artikel baru: <strong>{{ $blog->title }}</strong>
                            <span class="text-gray-500">({{ $blog->created_at->diffForHumans() }})</span>
                        </li>
                    @empty
                        <li class="text-gray-500">Belum ada artikel terbaru.</li>
                    @endforelse

                    @forelse($latestVideos as $video)
                        <li>🎬 Video baru: <strong>{{ $video->title }}</strong>
                            <span class="text-gray-500">({{ $video->created_at->diffForHumans() }})</span>
                        </li>
                    @empty
                        <li class="text-gray-500">Belum ada video terbaru.</li>
                    @endforelse

                    @forelse($latestMessages as $msg)
                        <li>📩 Pesan dari <strong>{{ $msg->name }}</strong>
                            <span class="text-gray-500">({{ $msg->created_at->diffForHumans() }})</span>
                        </li>
                    @empty
                        <li class="text-gray-500">Belum ada pesan masuk.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection