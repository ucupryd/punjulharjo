@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-sky-700">Daftar Artikel</h2>
    <a href="{{ route('admin.blog.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg">+ Tambah Artikel</a>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-sky-100 text-sky-700">
        <tr>
            <th class="py-3 px-4 text-left">Judul</th>
            <th class="py-3 px-4 text-left">Penulis</th>
            <th class="py-3 px-4 text-left">Tanggal</th>
            <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($blogs as $blog)
        <tr class="border-b hover:bg-sky-50">
            <td class="py-3 px-4">{{ $blog->title }}</td>
            <td class="py-3 px-4">{{ $blog->author->name ?? '-' }}</td>
            <td class="py-3 px-4">{{ $blog->created_at->format('d M Y') }}</td>
            <td class="py-3 px-4 text-center space-x-2">
                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="text-sky-600 hover:underline">Edit</a>
                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus artikel ini?')" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-6 text-gray-500">Belum ada artikel.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-6">
    {{ $blogs->links() }}
</div>
@endsection
