@props([
    'image',                 // Wajib: URL/path gambar
    'title' => null,
    'subtitle' => null,
    'eyebrow' => null,       // Teks kecil di atas judul
    'height' => 'h-[80vh]',  // Tinggi jendela (Tailwind)
    'overlay' => 'bg-black/40',
    'align' => 'center',     // center | left
])

@php
    $alignClass = $align === 'left' ? 'items-center justify-start text-left' : 'items-center justify-center text-center';
@endphp

<section {{ $attributes->merge(['class' => "relative w-full {$height} overflow-hidden fixed-window"]) }}>
    <!-- Fixed Background Image (Foto Diam Pinned ke Viewport, Kotak Jadi Jendela Scroll) -->
    <div class="fixed-window__bg" style="background-image: url('{{ $image }}');"></div>
    <div class="absolute inset-0 {{ $overlay }}"></div>
    <div class="relative z-10 flex h-full {{ $alignClass }} px-6 md:px-12 text-white">
        <div class="max-w-2xl">
            @if($eyebrow)<p class="mb-2 font-semibold uppercase tracking-widest text-emerald-400 text-xs md:text-sm">{{ $eyebrow }}</p>@endif
            @if($title)<h2 class="font-title text-3xl md:text-5xl drop-shadow-lg leading-tight">{{ $title }}</h2>@endif
            @if($subtitle)<p class="mt-4 text-sm md:text-base text-white/90 leading-relaxed">{{ $subtitle }}</p>@endif
            @if(trim($slot)) <div class="mt-6">{{ $slot }}</div> @endif
        </div>
    </div>
</section>
