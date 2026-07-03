@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold text-sky-700 mb-6">Edit Video</h2>

<form action="{{ route('admin.video.update', $video->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 max-w-3xl">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-medium text-gray-700 mb-2">Judul Video</label>
        <input type="text" name="title" value="{{ $video->title }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-medium text-gray-700 mb-2">Deskripsi</label>
        <textarea name="description" class="w-full border border-gray-300 rounded-lg px-4 py-2" rows="3">{{ $video->description }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-medium text-gray-700 mb-2">Link YouTube / File Video</label>
        <input type="text" name="video_url" value="{{ $video->video_url }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
    </div>

    @if($video->thumbnail)
        <div class="mb-4">
            <p class="text-gray-700 mb-2">Thumbnail Saat Ini:</p>
            <img src="{{ asset('storage/' . $video->thumbnail) }}" class="rounded-lg w-64 mb-2">
        </div>
    @endif

    <div class="mb-6">
        <label class="block font-medium text-gray-700 mb-2">Ganti Thumbnail (opsional)</label>
        <input type="file" name="thumbnail" class="block w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>

    <div class="flex space-x-4">
        <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg">Update</button>
        <a href="{{ route('admin.video.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">Kembali</a>
    </div>
</form>
@endsection
