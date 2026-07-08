@extends('layouts.app')

@section('content')
<section class="bg-transparent pt-32 pb-20 px-6">
    <div class="max-w-5xl mx-auto bg-white/80 backdrop-blur-sm p-8 rounded-xl shadow-lg border border-slate-100">
        <h1 class="text-4xl font-heading text-sky-700 mb-6 text-center">{{ $video->title }}</h1>
        
        <div class="mb-8 flex justify-center">
            <iframe width="100%" height="480" src="{{ $video->video_url }}" 
                    title="{{ $video->title }}" frameborder="0" 
                    allowfullscreen class="rounded-xl shadow-lg"></iframe>
        </div>

        <p class="text-gray-600 leading-relaxed text-lg text-center mb-12">
            {{ $video->description ?? 'Tidak ada deskripsi untuk video ini.' }}
        </p>

        <div class="text-center">
            <a href="{{ route('video.index') }}" 
               class="inline-block bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg font-medium transition">
               ← Kembali ke Semua Video
            </a>
        </div>
    </div>
</section>
@endsection
