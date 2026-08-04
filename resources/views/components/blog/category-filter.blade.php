@props([
    'categories' => collect(),
    'activeCategory' => null,
])

<nav aria-label="Filter kategori artikel" class="mb-8 -mx-1">
    <div class="flex flex-wrap gap-2 sm:gap-2.5">
        @php
            $allActive = empty($activeCategory);
            $allClasses = $allActive
                ? 'bg-brand-dark text-white ring-brand-dark shadow-sm'
                : 'bg-white text-slate-600 ring-slate-200 hover:bg-slate-50 hover:text-brand-dark';
        @endphp
        <a href="{{ route('pustaka', ['tab' => 'blog']) }}"
           class="inline-flex items-center justify-center min-h-[44px] px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wide ring-1 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 {{ $allClasses }}"
           @if($allActive) aria-current="page" @endif>
            Semua
        </a>

        @foreach($categories as $category)
            @php
                $isActive = $activeCategory === $category->slug;
                $chipClasses = $isActive
                    ? 'bg-brand-dark text-white ring-brand-dark shadow-sm'
                    : 'bg-white text-slate-600 ring-slate-200 hover:bg-slate-50 hover:text-brand-dark';
            @endphp
            <a href="{{ route('pustaka', ['tab' => 'blog', 'kategori' => $category->slug]) }}"
               class="inline-flex items-center justify-center gap-1.5 min-h-[44px] px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wide ring-1 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 {{ $chipClasses }}"
               @if($isActive) aria-current="page" @endif>
                @if($category->icon)
                    <i class="fa-solid {{ $category->icon }} text-[11px]" aria-hidden="true"></i>
                @endif
                <span>{{ $category->name }}</span>
            </a>
        @endforeach
    </div>
</nav>
