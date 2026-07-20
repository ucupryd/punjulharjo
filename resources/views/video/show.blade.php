@extends('layouts.app')

@section('content')
@php
    if (!function_exists('getYoutubeId')) {
        function getYoutubeId($url) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            return $match[1] ?? null;
        }
    }
    $videoId = getYoutubeId($video->video_url);
    $embedUrl = $videoId ? "https://www.youtube.com/embed/{$videoId}" : $video->video_url;
@endphp
<section class="bg-transparent pt-32 pb-20 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-4xl font-heading text-sky-700 text-center sm:text-left">{{ $video->title }}</h1>
            @if(Auth::check() && Auth::user()->isAdmin())
                <button onclick="openEditVideoModal(event, {{ json_encode($video) }})" 
                        class="bg-white hover:bg-slate-100 text-slate-800 px-4 py-2 rounded-none border border-slate-200 shadow-sm text-xs font-semibold flex items-center gap-1.5 transition whitespace-nowrap">
                    <i class="fa-solid fa-pencil text-sky-600"></i> Edit Video
                </button>
            @endif
        </div>
        
        <div class="mb-8 flex justify-center">
            <iframe width="100%" height="480" src="{{ $embedUrl }}" 
                    title="{{ $video->title }}" frameborder="0" 
                    allowfullscreen class="rounded-none shadow-sm"></iframe>
        </div>

        <p class="text-gray-600 leading-relaxed text-lg text-center mb-12 font-sans">
            {{ $video->description ?? 'Tidak ada deskripsi untuk video ini.' }}
        </p>

        <div class="text-center">
            <a href="{{ route('video.index') }}" 
               class="inline-block bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-none font-medium transition">
               ← Kembali ke Semua Video
            </a>
        </div>
    </div>
</section>

@auth
    <!-- Edit Video Modal -->
    <div id="edit-video-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit Video</h3>
                <button type="button" onclick="document.getElementById('edit-video-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form id="edit-video-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">

                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Video</label>
                        <input type="text" id="edit-video-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">URL Video Embed (YouTube)</label>
                        <input type="text" id="edit-video-url" name="video_url" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Deskripsi</label>
                        <textarea id="edit-video-desc" name="description" rows="3" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm"></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                    <button type="button" onclick="confirmDeleteVideo()"
                            class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                        Hapus
                    </button>
                    
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('edit-video-modal').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-video-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function openEditVideoModal(e, video) {
            e.stopPropagation();
            const modal = document.getElementById('edit-video-modal');
            modal.querySelector('#edit-video-form').action = '/admin/video/' + video.id;
            modal.querySelector('#edit-video-title').value = video.title;
            modal.querySelector('#edit-video-url').value = video.video_url;
            modal.querySelector('#edit-video-desc').value = video.description || '';
            modal.querySelector('#delete-video-form').action = '/admin/video/' + video.id;
            modal.classList.remove('hidden');
        }

        function confirmDeleteVideo() {
            if (confirm('Apakah Anda yakin ingin menghapus video ini?')) {
                document.getElementById('delete-video-form').submit();
            }
        }
    </script>
@endauth
@endsection
