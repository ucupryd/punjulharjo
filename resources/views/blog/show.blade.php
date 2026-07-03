@extends('layouts.app')

@section('content')
<section class="bg-white py-20 px-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-sky-700 mb-4">{{ $blog->title }}</h1>
        <p class="text-gray-500 mb-6">
            Dipublikasikan pada {{ $blog->created_at->format('d M Y') }} 
            oleh <strong>{{ $blog->author->name ?? 'Admin' }}</strong>
        </p>

        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" 
                 alt="{{ $blog->title }}" 
                 class="rounded-xl mb-8 w-full object-cover shadow">
        @endif

        <div class="text-gray-800 leading-relaxed prose max-w-none">
            {!! nl2br(e($blog->content)) !!}
        </div>

        <div class="mt-10">
            <a href="{{ route('blog.index') }}" class="text-sky-500 hover:text-sky-700 font-medium">
                ← Kembali ke semua artikel
            </a>
        </div>
    </div>
</section>
@endsection
