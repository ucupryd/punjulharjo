@extends('layouts.app')

@section('content')
<section class="bg-transparent pt-32 pb-20 px-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 relative">
            <h1 class="text-4xl font-heading text-sky-600 w-full text-center md:text-left">Semua Artikel & Blog</h1>
            @auth
                <div class="mt-4 md:mt-0">
                    <button onclick="document.getElementById('add-blog-modal').classList.remove('hidden')" 
                            class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-none shadow transition-all flex items-center gap-2 text-sm font-semibold">
                        <i class="fa-solid fa-plus"></i> Tambah Artikel
                    </button>
                </div>
            @endauth
        </div>

        @if($blogs->count() > 0)
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-10">
                @foreach ($blogs as $blog)
                    <div class="bg-white shadow-sm rounded-none overflow-hidden hover:shadow transition duration-300 border border-slate-200 relative group flex flex-col justify-between">
                        <div>
                            @if($blog->image)
                                <img src="{{ Storage::url($blog->image) }}" 
                                     alt="{{ $blog->title }}" 
                                     class="w-full h-32 md:h-52 object-cover">
                            @else
                                <img src="https://via.placeholder.com/400x250?text=Desa+Punjulharjo" 
                                     class="w-full h-32 md:h-52 object-cover">
                            @endif
                            <div class="p-3 md:p-6 text-left">
                                <h3 class="text-sm md:text-xl font-heading text-sky-600 mb-1 md:mb-2 line-clamp-1" title="{{ $blog->title }}">{{ $blog->title }}</h3>
                                <p class="text-gray-600 text-xs md:text-sm mb-2 md:mb-4 line-clamp-2 md:line-clamp-3">
                                    {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 100) }}
                                </p>
                            </div>
                        </div>
                        <div class="p-3 pt-0 md:p-6 md:pt-0 text-left">
                            <a href="{{ route('blog.show', $blog->slug) }}" 
                               class="inline-block text-sky-500 hover:text-sky-700 text-xs md:text-base font-medium transition">
                                Baca Selengkapnya →
                            </a>
                        </div>
                        @auth
                            <!-- Floating Edit Button on Card Hover -->
                            <div class="absolute top-2 right-2 md:top-4 md:right-4 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="openEditBlogModal(event, {{ json_encode($blog) }})" 
                                        class="bg-white/90 hover:bg-white text-slate-800 p-2 md:p-2.5 rounded-none shadow-sm border border-white/20 flex items-center justify-center">
                                    <i class="fa-solid fa-pencil text-xs text-sky-600"></i>
                                </button>
                            </div>
                        @endauth
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $blogs->links() }}
            </div>
        @else
            <p class="text-center text-gray-600">Belum ada artikel.</p>
        @endif
    </div>
</section>

@auth
    <!-- Add Blog Modal -->
    <div id="add-blog-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-none shadow max-w-lg w-full overflow-hidden border border-slate-100 text-left transform transition-all">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                <h3 class="text-lg font-heading text-slate-800">Tambah Artikel Baru</h3>
                <button type="button" onclick="document.getElementById('add-blog-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-4 max-h-[65vh] overflow-y-auto">
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Foto Sampul</label>
                        <input type="file" name="image" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Judul Artikel</label>
                        <input type="text" name="title" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Judul..." required>
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Kutipan Ringkas (Excerpt)</label>
                        <input type="text" name="excerpt" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Rangkuman artikel...">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Konten Artikel</label>
                        <textarea name="content" rows="6" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" placeholder="Konten utama..." required></textarea>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-blog-modal').classList.add('hidden')" 
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

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
