@extends('layouts.app')

@section('content')
<section class="bg-white py-20 px-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-sky-600 mb-10 text-center">Semua Artikel & Blog</h1>

        @if($blogs->count() > 0)
            <div class="grid md:grid-cols-3 gap-10">
                @foreach ($blogs as $blog)
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition duration-300">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" 
                                 alt="{{ $blog->title }}" 
                                 class="w-full h-52 object-cover">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=Desa+Punjulharjo" 
                                 class="w-full h-52 object-cover">
                        @endif
                        <div class="p-6 text-left">
                            <h3 class="text-xl font-semibold text-sky-600 mb-2">{{ $blog->title }}</h3>
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

            <div class="mt-10">
                {{ $blogs->links() }}
            </div>
        @else
            <p class="text-center text-gray-600">Belum ada artikel.</p>
        @endif
    </div>
</section>
@endsection
