@props([
    'title'      => '',
    'url'        => '#',
    'image'      => null,
    'date'       => null,
    'categories' => null,
    'typeLabel'  => '',
])

<a href="{{ $url }}"
   class="group flex flex-col bg-white rounded-none shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden no-underline text-current h-full">

    {{-- Gambar kartu --}}
    <div class="relative w-full aspect-video overflow-hidden bg-slate-200 flex-shrink-0">
        @if($image)
            <img src="{{ $image }}"
                 alt="{{ $title }}"
                 loading="lazy"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            {{-- Fallback bila gambar kosong: kotak abu-abu berisi ikon --}}
            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                <i class="fa-regular fa-image text-3xl text-slate-300"></i>
            </div>
        @endif
    </div>

    {{-- Isi kartu --}}
    <div class="flex flex-col flex-1 p-5 gap-3">

        {{-- Label jenis konten --}}
        @if($typeLabel)
            <span class="text-[10px] font-bold uppercase tracking-widest text-sky-600">
                {{ $typeLabel }}
            </span>
        @endif

        {{-- Badge kategori --}}
        @if(!empty($categories) && count($categories) > 0)
            <div class="flex flex-wrap gap-1">
                @foreach($categories as $cat)
                    <x-blog.category-badge :category="$cat" />
                @endforeach
            </div>
        @endif

        {{-- Judul — dipotong maks. 2 baris --}}
        <h4 class="text-sm font-bold text-slate-800 leading-snug line-clamp-2 m-0
                    group-hover:text-sky-700 transition-colors duration-200">
            {{ $title }}
        </h4>

        {{-- Tanggal --}}
        @if($date)
            <p class="mt-auto text-xs text-slate-400 flex items-center gap-1.5">
                <i class="fa-regular fa-calendar text-slate-300"></i>
                {{ $date }}
            </p>
        @endif
    </div>
</a>
