@php
    $colorOptions = [
        'brand-dark' => 'Navy (brand-dark)',
        'brand-accent' => 'Emas (brand-accent)',
        'brand-light' => 'Biru Muda (brand-light)',
        'sky' => 'Sky',
        'emerald' => 'Hijau',
        'amber' => 'Amber',
        'rose' => 'Rose',
    ];
@endphp

<form action="{{ $action }}" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="name" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nama Kategori</label>
        <input type="text"
               id="name"
               name="name"
               required
               pattern="\S+"
               title="Satu kata tanpa spasi"
               value="{{ old('name', $category?->name) }}"
               class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
               placeholder="Contoh: Kegiatan">
        <p class="text-xs text-slate-400 mt-1">Satu kata saja, tanpa spasi. Slug dibuat otomatis.</p>
    </div>

    <div>
        <label for="icon" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Ikon Font Awesome (Opsional)</label>
        <input type="text"
               id="icon"
               name="icon"
               value="{{ old('icon', $category?->icon) }}"
               class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
               placeholder="fa-calendar-day">
        <p class="text-xs text-slate-400 mt-1">Tanpa prefix <code>fa-solid</code>, cukup kelas seperti <code>fa-leaf</code>.</p>
    </div>

    <div>
        <label for="color" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Warna Badge (Opsional)</label>
        <select id="color" name="color" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">
            <option value="">Default (slate)</option>
            @foreach($colorOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('color', $category?->color) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="description" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Deskripsi (Opsional)</label>
        <textarea id="description"
                  name="description"
                  rows="3"
                  class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                  placeholder="Catatan internal tentang kategori ini...">{{ old('description', $category?->description) }}</textarea>
    </div>

    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
        <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-200">Batal</a>
        <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm rounded-xl shadow transition">{{ $submitLabel }}</button>
    </div>
</form>
