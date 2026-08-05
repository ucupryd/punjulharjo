@props([
    'categories' => collect(),
    'activeCategory' => null,
])

@php
    $activeTab = request()->query('tab', 'blog');
@endphp

<nav aria-label="Filter kategori artikel" class="mb-8 -mx-1">
    <div class="flex flex-wrap gap-2 sm:gap-2.5">
        @php
            $allActive = empty($activeCategory);
            $allClasses = $allActive
                ? 'bg-brand-dark text-white shadow-sm'
                : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-slate-50 hover:text-brand-dark';
        @endphp
        <a href="{{ route('pustaka', ['tab' => $activeTab]) }}"
           class="inline-flex items-center justify-center min-h-[36px] px-4 py-1.5 rounded-sm text-xs font-bold uppercase tracking-widest transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 {{ $allClasses }}"
           @if($allActive) aria-current="page" @endif>
            Semua
        </a>

        @foreach($categories as $category)
            @php
                $isActive = $activeCategory === $category->slug;
                $chipClasses = $isActive
                    ? 'bg-brand-dark text-white shadow-sm'
                    : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-slate-50 hover:text-brand-dark';
            @endphp
            <a href="{{ route('pustaka.kategori', ['slug' => $category->slug, 'tab' => $activeTab]) }}"
               class="inline-flex items-center justify-center gap-1.5 min-h-[36px] px-4 py-1.5 rounded-sm text-xs font-bold uppercase tracking-widest transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 {{ $chipClasses }}"
               @if($isActive) aria-current="page" @endif>
                @if($category->icon)
                    <i class="fa-solid {{ $category->icon }} text-[11px]" aria-hidden="true"></i>
                @endif
                <span>{{ $category->name }}</span>
            </a>
        @endforeach
    </div>
</nav>
