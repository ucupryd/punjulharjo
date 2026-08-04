@props([
    'categories' => collect(),
    'selected' => [],
    'label' => 'Kategori',
    'inputIdPrefix' => 'cat',
])

<div>
    <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
        <label class="block text-slate-700 font-sans text-sm font-medium">{{ $label }}</label>
        <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-800 transition">
            Kelola Kategori &rarr;
        </a>
    </div>

    @if($categories->isEmpty())
        <p class="text-xs text-slate-500 bg-slate-50 border border-slate-200 rounded-none px-3 py-2">
            Belum ada kategori. <a href="{{ route('admin.categories.create') }}" class="text-sky-600 font-semibold hover:underline">Tambah kategori</a> terlebih dahulu.
        </p>
    @else
        <div class="grid grid-cols-2 gap-2">
            @foreach($categories as $category)
                <label class="flex items-center gap-2 px-3 py-1.5 border border-slate-200 rounded-none cursor-pointer hover:bg-slate-50 transition has-[:checked]:border-sky-500 has-[:checked]:bg-sky-50/30">
                    <input type="checkbox"
                           name="categories[]"
                           id="{{ $inputIdPrefix }}-{{ $category->id }}"
                           value="{{ $category->id }}"
                           @checked(in_array($category->id, $selected))
                           class="rounded-none border-slate-300 text-sky-600 focus:ring-sky-500 w-4 h-4 shrink-0">
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-700">
                        @if($category->icon)
                            <i class="fa-solid {{ $category->icon }} text-slate-400 text-[10px]" aria-hidden="true"></i>
                        @endif
                        {{ $category->name }}
                    </span>
                </label>
            @endforeach
        </div>
    @endif
</div>
