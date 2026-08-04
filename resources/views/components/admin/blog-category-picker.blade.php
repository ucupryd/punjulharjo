@props([
    'categories',
    'selected' => [],
])

<div>
    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
        <label class="block text-xs font-semibold text-slate-600 uppercase">Kategori Artikel</label>
        <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-800 transition">
            Kelola Kategori &rarr;
        </a>
    </div>
    <p class="text-xs text-slate-400 mb-3">Pilih satu atau lebih kategori. Deskripsi kartu dihasilkan otomatis dari isi artikel.</p>

    @if($categories->isEmpty())
        <p class="text-sm text-slate-500 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
            Belum ada kategori. <a href="{{ route('admin.categories.create') }}" class="text-sky-600 font-semibold hover:underline">Tambah kategori</a> terlebih dahulu.
        </p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            @foreach($categories as $category)
                <label class="flex items-center gap-3 min-h-[44px] px-3 py-2 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition has-[:checked]:border-sky-400 has-[:checked]:bg-sky-50/50">
                    <input type="checkbox"
                           name="categories[]"
                           value="{{ $category->id }}"
                           @checked(in_array($category->id, old('categories', $selected)))
                           class="rounded border-slate-300 text-sky-600 focus:ring-sky-500 w-4 h-4 shrink-0">
                    <span class="inline-flex items-center gap-2 text-sm text-slate-700 font-medium">
                        @if($category->icon)
                            <i class="fa-solid {{ $category->icon }} text-sky-600 text-xs" aria-hidden="true"></i>
                        @endif
                        {{ $category->name }}
                    </span>
                </label>
            @endforeach
        </div>
    @endif
</div>
