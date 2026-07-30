@props([
    'title' => 'Rekomendasi & Promo',
    'items' => []
])

<div>
    <div class="border-b border-slate-200 pb-2 mb-4">
        <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">{{ $title }}</h3>
    </div>
    
    <div class="divide-y divide-slate-200 space-y-4">
        @foreach($items as $item)
            <div class="flex items-start gap-4 {{ !$loop->first ? 'pt-4' : '' }} {{ !$loop->last ? 'pb-4' : '' }}">
                <div class="w-24 h-16 bg-slate-100 flex-shrink-0 overflow-hidden rounded-none">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover rounded-none" loading="lazy">
                </div>
                <div class="flex-1 space-y-1">
                    <h4 class="text-sm font-bold font-heading text-brand-dark leading-snug">
                        {{ $item['title'] }}
                    </h4>
                    <p class="text-xs text-slate-500 font-sans line-clamp-2">
                        {{ $item['excerpt'] }}
                    </p>
                    <a href="{{ $item['url'] }}" 
                       class="inline-block text-xs font-bold text-sky-600 hover:text-sky-800 transition duration-150">
                        {{ $item['ctaLabel'] ?? 'Selengkapnya' }} &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
