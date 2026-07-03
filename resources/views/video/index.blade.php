@extends('layouts.app')

@section('content')
<section class="bg-white py-20 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-sky-600 mb-12">Kumpulan Video Wisata</h1>

        @if($videos->count())
            <div class="grid md:grid-cols-3 gap-10">
                @foreach($videos as $video)
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition duration-300">
                        @if($video->thumbnail)
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" 
                                 alt="{{ $video->title }}" 
                                 class="w-full h-52 object-cover">
                        @else
                            <iframe width="100%" height="200" src="{{ $video->video_url }}" title="{{ $video->title }}" frameborder="0" allowfullscreen></iframe>
                        @endif

                        <div class="p-6 text-left">
                            <h3 class="text-xl font-semibold text-sky-600 mb-2 line-clamp-2">
                                {{ $video->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $video->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                            <a href="{{ route('video.show', $video->slug) }}" 
                               class="inline-block text-sky-500 hover:text-sky-700 font-medium transition">
                               Tonton Selengkapnya →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $videos->links() }}
            </div>
        @else
            <p class="text-gray-600">Belum ada video yang tersedia.</p>
        @endif
    </div>
</section>
@endsection
