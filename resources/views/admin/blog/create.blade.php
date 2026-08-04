@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Formulir Artikel</span>
                <h1 class="text-2xl font-bold text-slate-800 font-title mt-0.5">Tambah Artikel Baru</h1>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl">
                &larr; Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl text-sm text-rose-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Judul Artikel</label>
                <input type="text" name="title" required value="{{ old('title') }}" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" placeholder="Masukkan judul artikel...">
            </div>

            <x-admin.blog-category-picker :categories="$categories" :selected="old('categories', [])" />

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Foto Sampul / Gambar Artikel</label>
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Publish</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Isi Konten Artikel</label>
                <textarea name="content" rows="10" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" placeholder="Tuliskan lengkap isi konten artikel di sini...">{{ old('content') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.blog.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-200">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm rounded-xl shadow transition">Simpan Artikel</button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: 'textarea[name="content"]',
            license_key: 'gpl',
            promotion: false,
            branding: false,
            height: 450,
            plugins: 'link image lists code table wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image blockquote | removeformat | code',
            
            // Whitelist elements to match server sanitization rules
            valid_elements: 'p[style],br,strong/b,em/i,u,h2[style],h3[style],h4[style],ul,ol,li,a[href|target|rel],blockquote,img[src|alt|width|height|loading|style],figure,figcaption',
            valid_styles: { '*': 'text-align' }, // Allow only text-align style
            paste_remove_styles_if_webkit: true,
            paste_as_text: false,
            paste_merge_formats: true,
            paste_data_images: false,
            
            // Paste postprocess to strip inline Word trash elements
            paste_postprocess: function(plugin, args) {
                args.node.querySelectorAll('span, [class], [style]').forEach(function(el) {
                    if (el.tagName.toLowerCase() === 'span') {
                        el.outerHTML = el.innerHTML;
                    } else {
                        el.removeAttribute('class');
                        const styleVal = el.getAttribute('style');
                        if (styleVal && styleVal.indexOf('text-align') !== -1) {
                            if (styleVal.indexOf('center') !== -1) {
                                el.setAttribute('style', 'text-align: center;');
                            } else if (styleVal.indexOf('right') !== -1) {
                                el.setAttribute('style', 'text-align: right;');
                            } else {
                                el.removeAttribute('style');
                            }
                        } else {
                            el.removeAttribute('style');
                        }
                    }
                });
            },
            
            // Upload handler using CSRF token
            automatic_uploads: true,
            images_upload_url: '{{ route("admin.berita.image.upload") }}',
            images_upload_handler: function(blobInfo) {
                return new Promise(function(resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '{{ route("admin.berita.image.upload") }}');
                    
                    var csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (csrfToken) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken.getAttribute('content'));
                    }
                    
                    xhr.onload = function() {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                reject(response.error || 'HTTP Error: ' + xhr.status);
                            } catch(e) {
                                reject('HTTP Error: ' + xhr.status);
                            }
                            return;
                        }
                        
                        try {
                            var json = JSON.parse(xhr.responseText);
                            if (!json || typeof json.location != 'string') {
                                reject('Format response salah: ' + xhr.responseText);
                                return;
                            }
                            resolve(json.location);
                        } catch(e) {
                            reject('Format response bukan JSON: ' + xhr.responseText);
                        }
                    };
                    
                    xhr.onerror = function() {
                        reject('Proses upload gagal karena masalah jaringan.');
                    };
                    
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    
                    xhr.send(formData);
                });
            }
        });
    });
</script>
@endsection
