@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-sky-700 mb-6">🖼️ Ubah Background Hero</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl p-6">
        <form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Gambar/Video Saat Ini:</label>
                @php
                    $isVid = false;
                    if ($heroImage && (Str::endsWith(Str::lower($heroImage), ['.mp4', '.webm', '.mov', '.ogg']) || str_contains(Str::lower($heroImage), 'video/'))) {
                        $isVid = true;
                    }
                @endphp
                @if($isVid)
                    <video src="{{ (str_starts_with($heroImage, 'http') || str_contains($heroImage, 'storage/')) ? asset($heroImage) : Storage::url($heroImage) }}" class="w-full rounded-lg shadow mb-4" controls autoplay muted loop></video>
                @else
                    <img src="{{ (str_starts_with($heroImage, 'http') || str_contains($heroImage, 'storage/')) ? asset($heroImage) : Storage::url($heroImage) }}" class="w-full rounded-lg shadow mb-4">
                @endif
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Pilih File Baru:</label>
                <input type="file" name="hero_background"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-sky-300 outline-none" required>
                @error('hero_background')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg font-medium transition">
                Simpan Perubahan
            </button>
        </form>

        @php
            $welcomeBackup = \App\Models\SiteSetting::getValue('hero_background_backup');
        @endphp
        @if($welcomeBackup)
            <div class="mt-8 pt-6 border-t border-gray-100 text-gray-800">
                <p class="text-sm text-gray-500 mb-3 font-medium">Tersedia 1 berkas cadangan sebelumnya:</p>
                <div class="flex items-center gap-3">
                    @if(Str::endsWith(Str::lower($welcomeBackup), ['.mp4', '.webm', '.mov', '.ogg']))
                        <div class="w-24 h-16 border border-gray-200 bg-gray-100 flex items-center justify-center text-xs text-gray-500 font-bold">VIDEO</div>
                    @else
                        <img src="{{ (str_starts_with($welcomeBackup, 'http') || str_contains($welcomeBackup, 'storage/')) ? asset($welcomeBackup) : Storage::url($welcomeBackup) }}" class="w-24 h-16 object-cover border border-gray-200 rounded-lg">
                    @endif
                    <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="hero_key" value="hero_background">
                        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg transition">
                            <i class="fa-solid fa-rotate-left mr-1"></i> Kembalikan ke Gambar Ini
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
