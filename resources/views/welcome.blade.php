@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    @php
        $heroBg = \App\Models\SiteSetting::getValue('hero_background', asset('images/hero-bg.jpg'));
    @endphp

    <section
        class="relative bg-center bg-cover bg-no-repeat text-center min-h-screen flex flex-col justify-center items-center"
        style="background-image: url('{{ asset($heroBg) }}');">


        <!-- Overlay gelap agar teks kontras -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-40"></div>

        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 drop-shadow-lg whitespace-nowrap">
                Desa Wisata Punjulharjo
            </h1>
            <p class="text-lg md:text-xl text-gray-100 max-w-2xl mx-auto drop-shadow">
                Di mana warisan budaya bertemu keindahan alam pedesaan.
            </p>
            <a href="{{ route('tentang') }}"
                class="inline-block bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 mt-10 rounded-lg text-lg font-medium transition">
                Situs Perahu Kuno
            </a>
        </div>

        <!-- Optional: Tambah gradasi bawah biar transisi ke "Tentang Kami" halus -->
        <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-white/80 to-transparent"></div>
    </section>



    <!-- Tentang Kami -->
    <section id="tentang" class="bg-white py-20 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-sky-600 mb-6">Tentang Kami</h2>
            <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto">
                Desa Punjulharjo adalah sebuah desa yang terletak di Kecamatan Rembang, Kabupaten Rembang, Jawa Tengah.
                Desa ini semakin dikenal sebagai destinasi wisata menarik karena keindahan alam dan kekayaan budaya
                lokalnya. Tim KKN-T Undip Unisvet turut berkontribusi membangun desa ini dengan semangat kolaborasi
                dan inovasi.
            </p>

            <div class="grid md:grid-cols-2 gap-10 mt-12">
                <div class="p-6 bg-sky-50 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold mb-3">🚤 Situs Perahu Kuno</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Situs perahu kuno adalah jendela masa lalu yang memperlihatkan kehidupan maritim zaman dahulu.
                        Situs ini mengajarkan kita pentingnya menjaga kelestarian budaya bahari untuk generasi mendatang.
                    </p>
                </div>
                <div class="p-6 bg-sky-50 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold mb-3">🌅 Pantai Karang Jahe</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantai Karang Jahe di Rembang terkenal dengan pasir putihnya yang lembut, ombak tenang, dan
                        pemandangan matahari terbenam yang menakjubkan. Tempat ini menjadi primadona wisata keluarga dan
                        wisatawan lokal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video -->
    <section id="video" class="bg-sky-50 py-20 text-center px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-sky-600 mb-12">Kumpulan Video</h2>

            @php
                $videos = \App\Models\Video::latest()->take(3)->get();
            @endphp

            @if($videos->count())
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($videos as $video)
                        <div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden">
                            <iframe width="100%" height="200" src="{{ $video->video_url }}" title="{{ $video->title }}"
                                frameborder="0" allowfullscreen></iframe>
                            <div class="p-4 text-left">
                                <h3 class="text-lg font-semibold text-sky-600">{{ $video->title }}</h3>
                                <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $video->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">Belum ada video yang tersedia.</p>
            @endif
        </div>
        <a href="{{ route('video.index') }}"
            class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg font-medium transition">
            Lihat Semua Video
        </a>
    </section>


    <!-- Blog -->
    <section id="blog" class="bg-white py-20 text-center px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-sky-600 mb-12">Blog Terbaru</h2>

            @if($blogs->count() > 0)
                <div class="grid md:grid-cols-3 gap-10">
                    @foreach ($blogs as $blog)
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition duration-300">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    class="w-full h-52 object-cover">
                            @else
                                <img src="https://via.placeholder.com/400x250?text=Desa+Punjulharjo" alt="default"
                                    class="w-full h-52 object-cover">
                            @endif

                            <div class="p-6 text-left">
                                <h3 class="text-xl font-semibold text-sky-600 mb-2 line-clamp-2">
                                    {{ $blog->title }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 100) }}
                                </p>
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="inline-block text-sky-500 hover:text-sky-700 font-medium transition">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 mb-10">Belum ada artikel yang tersedia saat ini.</p>
            @endif

            <div class="mt-10">
                <a href="{{ route('blog.index') }}"
                    class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg font-medium transition">
                    Lihat Semua Blog
                </a>
            </div>
        </div>
    </section>

@endsection