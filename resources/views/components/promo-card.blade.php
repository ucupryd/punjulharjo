@props([
    'title'      => '',
    'url'        => '#',
    'image'      => null,
    'date'       => null,
    'categories' => null,
    'typeLabel'  => '',
])

<a href="{{ $url }}"
   class="group flex flex-col no-underline text-current h-full">

    {{-- Gambar --}}
    <div class="relative w-full aspect-video overflow-hidden bg-slate-200 flex-shrink-0">
        @if($image)
            <img src="{{ $image }}"
                 alt="{{ $title }}"
                 loading="lazy"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                <i class="fa-regular fa-image text-3xl text-slate-300"></i>
            </div>
        @endif

        {{-- Badge kategori — overlay pojok kiri atas foto --}}
        @if(!empty($categories) && count($categories) > 0)
            <div class="absolute top-2 left-2 z-10 flex flex-wrap gap-1 max-w-[85%]">
                @foreach($categories as $cat)
                    <x-blog.category-badge :category="$cat" />
                @endforeach
            </div>
        @endif
    </div>

    {{-- Isi --}}
    <div class="flex flex-col flex-1 pt-4 gap-2">



        {{-- Judul --}}
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
