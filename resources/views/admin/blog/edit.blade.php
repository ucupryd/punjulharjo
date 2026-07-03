@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold text-sky-700 mb-6">Edit Artikel</h2>

<form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 max-w-3xl">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-medium text-gray-700 mb-2">Judul</label>
        <input type="text" name="title" value="{{ $blog->title }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-medium text-gray-700 mb-2">Ringkasan</label>
        <textarea name="excerpt" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="2">{{ $blog->excerpt }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-medium text-gray-700 mb-2">Isi Artikel</label>
        <textarea name="content" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="6" required>{{ $blog->content }}</textarea>
    </div>

    @if($blog->image)
        <div class="mb-4">
            <p class="text-gray-700 mb-2">Gambar Saat Ini:</p>
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="rounded-lg w-64 mb-2">
        </div>
    @endif

    <div class="mb-6">
        <label class="block font-medium text-gray-700 mb-2">Ganti Gambar (opsional)</label>
        <input type="file" name="image" class="block w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>

    <div class="flex space-x-4">
        <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg">Update</button>
        <a href="{{ route('admin.blog.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">Kembali</a>
    </div>
</form>
@endsection
