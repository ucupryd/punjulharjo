@props(['category', 'linkable' => false, 'size' => 'sm'])

@php
    $sizeClasses = $size === 'md'
        ? 'px-3 py-1.5 text-xs min-h-[44px]'
        : 'px-2.5 py-1 text-[10px] min-h-[28px]';

    $classes = 'inline-flex items-center gap-1.5 rounded-full font-semibold uppercase tracking-wider ring-1 ' . $category->badgeClasses() . ' ' . $sizeClasses;
@endphp

@if($linkable)
    <a href="{{ route('pustaka', ['tab' => 'blog', 'kategori' => $category->slug]) }}"
       class="{{ $classes }} hover:opacity-90 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2"
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
