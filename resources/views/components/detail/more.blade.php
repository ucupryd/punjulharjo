@props([
    'title' => 'Konten Lainnya',
    'items' => [],
    'backUrl' => '#',
    'backLabel' => 'Kembali'
])

@if(!empty($items))
<div class="mt-16 font-sans">
    <div class="border-b border-slate-200 pb-3 mb-6">
        <h3 class="text-xl font-bold text-brand-dark font-heading">{{ $title }}</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        @foreach($items as $item)
            <a href="{{ $item['url'] }}" class="group flex items-start gap-4 hover:bg-slate-50 p-2 -mx-2 transition duration-200 rounded-none">
                <div class="w-24 h-20 md:w-32 md:h-24 bg-slate-100 flex-shrink-0 overflow-hidden relative">
                    <img src="{{ $item['image'] }}" 
                         alt="{{ $item['title'] }}" 
                         class="w-full h-full object-cover rounded-none group-hover:scale-105 transition duration-300"
                         loading="lazy">
                </div>
                <div class="space-y-1 md:space-y-2">
                    <span class="text-[10px] uppercase font-bold text-sky-600 tracking-wider">{{ $item['label'] ?? 'Konten' }}</span>
                    <h4 class="text-sm font-semibold text-slate-800 group-hover:text-sky-700 transition duration-150 line-clamp-2 leading-snug">
                        {{ $item['title'] }}
                    </h4>
                    <span class="text-[11px] text-slate-400 block">
                        {{ $item['date'] }}
                    </span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Tombol Kembali -->
    <div class="pt-8 border-t border-slate-100">
        <a href="{{ $backUrl }}" class="inline-flex items-center text-sm font-semibold text-sky-600 hover:text-sky-800 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> {{ $backLabel }}
        </a>
    </div>
</div>
@endif
