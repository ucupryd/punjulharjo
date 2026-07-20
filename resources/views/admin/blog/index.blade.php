@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pengelolaan Konten</span>
                <h1 class="text-2xl font-bold text-slate-800 font-title mt-0.5">📝 Kelola Artikel & Blog</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola konten berita dan publikasi Desa Wisata Punjulharjo.</p>
            </div>
            <a href="{{ route('admin.blog.create') }}" class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Artikel Baru
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs border-b border-slate-200">
                        <tr>
                            <th class="p-4">Gambar</th>
                            <th class="p-4">Judul Artikel</th>
                            <th class="p-4">Ringkasan</th>
                            <th class="p-4">Tanggal Buat</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($blogs as $blog)
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 w-20">
                                    @if($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" class="w-16 h-12 object-cover rounded-lg border border-slate-200">
                                    @else
                                        <div class="w-16 h-12 bg-slate-100 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 text-xs">No img</div>
                                    @endif
                                </td>
                                <td class="p-4 font-semibold text-slate-800">{{ $blog->title }}</td>
                                <td class="p-4 text-xs text-slate-500 max-w-xs truncate">{{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 80) }}</td>
                                <td class="p-4 text-xs text-slate-400 whitespace-nowrap">{{ $blog->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-4 text-center whitespace-nowrap space-x-2">
                                    <a href="{{ route('admin.blog.edit', $blog) }}" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">Belum ada artikel blog ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
