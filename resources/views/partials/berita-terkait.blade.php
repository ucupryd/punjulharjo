@if(isset($beritaLain) && $beritaLain->isNotEmpty())
<div class="mt-16 font-sans">
    <div class="border-b border-slate-200 pb-3 mb-6">
        <h3 class="text-xl font-bold text-brand-dark font-heading">Baca Juga (Berita Lainnya)</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($beritaLain as $item)
            @php
                $itemImageUrl = $item->image ? Storage::url($item->image) : 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?auto=format&fit=crop&w=400&q=80';
            @endphp
            <a href="{{ route('blog.show', $item->slug) }}" class="group flex items-start gap-4 hover:bg-slate-50 p-2 -mx-2 transition duration-200 rounded-none">
                <div class="w-24 h-20 md:w-32 md:h-24 bg-slate-100 flex-shrink-0 overflow-hidden relative">
                    <img src="{{ $itemImageUrl }}" 
                         alt="{{ $item->title }}" 
                         class="w-full h-full object-cover rounded-none group-hover:scale-105 transition duration-300"
                         loading="lazy">
                </div>
                <div class="space-y-1 md:space-y-2">
                    @if($item->categories->isNotEmpty())
                        <div class="flex flex-wrap gap-1">
                            @foreach($item->categories->take(2) as $category)
                                <x-blog.category-badge :category="$category" />
                            @endforeach
                        </div>
                    @else
                        <span class="text-[10px] uppercase font-bold text-sky-600 tracking-wider">Berita Desa</span>
                    @endif
                    <h4 class="text-sm font-semibold text-slate-800 group-hover:text-sky-700 transition duration-150 line-clamp-2 leading-snug">
                        {{ $item->title }}
                    </h4>
                    <p class="text-xs text-slate-500 line-clamp-2">{{ $item->auto_excerpt }}</p>
                    <span class="text-[11px] text-slate-400 block">
                        {{ ($item->published_at ? \Carbon\Carbon::parse($item->published_at) : $item->created_at)->format('d M Y') }}
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif
