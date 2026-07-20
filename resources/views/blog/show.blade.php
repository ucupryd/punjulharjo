@extends('layouts.app')

@section('content')
<section class="bg-transparent pt-32 pb-20 px-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-none shadow border border-gray-200">
        <div class="flex justify-between items-start mb-4">
            <h1 class="text-4xl font-heading text-sky-700">{{ $blog->title }}</h1>
            @if(Auth::check() && Auth::user()->isAdmin())
                <button onclick="openEditBlogModal(event, {{ json_encode($blog) }})" 
                        class="bg-white hover:bg-slate-100 text-slate-800 px-4 py-2 rounded-none border border-slate-200 shadow-sm text-xs font-semibold flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-pencil text-sky-600"></i> Edit Artikel
                </button>
            @endif
        </div>
        <p class="text-gray-500 mb-6">
            Dipublikasikan pada {{ $blog->created_at->format('d M Y') }} 
            oleh <strong>{{ $blog->author->name ?? 'Admin' }}</strong>
        </p>

        @if($blog->image)
            <img src="{{ Storage::url($blog->image) }}" 
                 alt="{{ $blog->title }}" 
                 class="rounded-none mb-8 w-full object-cover shadow-sm">
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

@auth
    <!-- Edit Blog Modal -->
    <div id="edit-blog-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-lg w-full overflow-hidden border border-slate-100 text-left transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Edit Artikel</h3>
                <button type="button" onclick="document.getElementById('edit-blog-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <form id="edit-blog-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4 max-h-[65vh] overflow-y-auto">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Ganti Foto Sampul (opsional)</label>
                        <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Artikel</label>
                        <input type="text" id="edit-blog-title" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Kutipan Ringkas (Excerpt)</label>
                        <input type="text" id="edit-blog-excerpt" name="excerpt" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Konten Artikel</label>
                        <textarea id="edit-blog-content" name="content" rows="6" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between">
                    <button type="button" onclick="confirmDeleteBlog()"
                            class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-none text-sm transition">
                        Hapus
                    </button>
                    
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('edit-blog-modal').classList.add('hidden')" 
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
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-blog-form" action="" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script>
        function openEditBlogModal(e, blog) {
            e.stopPropagation();
            const modal = document.getElementById('edit-blog-modal');
            modal.querySelector('#edit-blog-form').action = '/admin/blog/' + blog.id;
            modal.querySelector('#edit-blog-title').value = blog.title;
            modal.querySelector('#edit-blog-excerpt').value = blog.excerpt || '';
            modal.querySelector('#edit-blog-content').value = blog.content;
            modal.querySelector('#delete-blog-form').action = '/admin/blog/' + blog.id;
            modal.classList.remove('hidden');
        }

        function confirmDeleteBlog() {
            if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                document.getElementById('delete-blog-form').submit();
            }
        }
    </script>
@endauth
@endsection
