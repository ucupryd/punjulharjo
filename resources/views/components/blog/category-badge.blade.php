@props(['category', 'linkable' => false, 'size' => 'sm'])

@php
    $sizeClasses = $size === 'md'
        ? 'px-2 py-0.5 text-[11px] min-h-[24px]'
        : 'px-1.5 py-0.5 text-[10px] min-h-[20px]';

    // Ganti rounded-full + ring menjadi label persegi tipis yang elegan dengan background putih transparan agar kontras di atas foto
    $classes = 'inline-flex items-center gap-1 rounded-sm font-bold uppercase tracking-widest bg-white/90 backdrop-blur-[2px] shadow-sm ' . $category->badgeClasses() . ' ' . $sizeClasses;
@endphp

@if($linkable)
    <a href="{{ route('pustaka', ['tab' => 'blog', 'kategori' => $category->slug]) }}"
       class="{{ $classes }} hover:opacity-80 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-1"
       aria-label="Filter artikel kategori {{ $category->name }}">
        @if($category->icon)
            <i class="fa-solid {{ $category->icon }}" aria-hidden="true"></i>
        @endif
        <span>{{ $category->name }}</span>
    </a>
@else
    <span class="{{ $classes }}">
        @if($category->icon)
            <i class="fa-solid {{ $category->icon }}" aria-hidden="true"></i>
        @endif
        <span>{{ $category->name }}</span>
    </span>
@endif
