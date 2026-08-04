@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Manajemen Berita</span>
                <h1 class="text-2xl font-bold text-slate-800 font-title mt-0.5">Kategori Artikel</h1>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.blog.create') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                    &larr; Form Artikel
                </a>
                <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition">
                    <i class="fa-solid fa-plus mr-1"></i> Tambah Kategori
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            @if($categories->isEmpty())
                <p class="text-center text-slate-500 py-12 text-sm">Belum ada kategori. Tambahkan kategori pertama Anda.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-left">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-slate-600 uppercase text-xs tracking-wider">Kategori</th>
                                <th class="px-6 py-3 font-semibold text-slate-600 uppercase text-xs tracking-wider">Slug</th>
                                <th class="px-6 py-3 font-semibold text-slate-600 uppercase text-xs tracking-wider">Artikel</th>
                                <th class="px-6 py-3 font-semibold text-slate-600 uppercase text-xs tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($categories as $category)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <x-blog.category-badge :category="$category" />
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">{{ $category->slug }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $category->blogs_count }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                               class="inline-flex items-center justify-center min-h-[44px] min-w-[44px] px-3 py-2 bg-slate-100 hover:bg-sky-50 text-sky-700 rounded-xl text-xs font-semibold transition"
                                               title="Edit kategori {{ $category->name }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                                  onsubmit="return confirm('Hapus kategori {{ $category->name }}? Relasi artikel akan dilepas, artikel tidak dihapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center min-h-[44px] min-w-[44px] px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-xs font-semibold transition"
                                                        title="Hapus kategori {{ $category->name }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
