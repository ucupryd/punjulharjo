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
                <label class="block text-gray-700 font-medium mb-2">Gambar Saat Ini:</label>
                <img src="{{ asset($heroImage) }}" class="w-full rounded-lg shadow mb-4">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Pilih Gambar Baru:</label>
                <input type="file" name="hero_background" accept="image/*"
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
    </div>
</div>
@endsection
