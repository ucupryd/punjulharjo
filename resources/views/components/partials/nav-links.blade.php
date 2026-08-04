@props(['variant' => 'light'])

@php
    $isTransparent = $variant === 'transparent';
@endphp

<ul class="relative flex items-center px-1 py-0.5 rounded-lg select-none mx-auto md:mx-0 font-exo"
    @mouseleave="hoverIndex = null">
    
    <!-- The Sliding Background Pill (slidebar) -->
    <div x-show="(hoverIndex !== null ? hoverIndex : activeIndex) !== null && (hoverIndex !== null ? hoverIndex : activeIndex) >= 0"
         class="absolute h-[calc(100%-8px)] w-[58px] md:w-[82px] rounded-md z-0"
         :class="hasTransparentHeader && !scrolled ? 'bg-white/20' : 'bg-gray-300/50'"
         :style="'transform: translateX(' + ((hoverIndex !== null ? hoverIndex : activeIndex) * 100) + '%); transition: transform 0.5s cubic-bezier(0.33, 0.83, 0.99, 0.98);'"></div>

    <!-- The Active Page Bar (garis atas-bawah diam di page yang dipilih) -->
    <div x-show="activeIndex !== null && activeIndex >= 0"
         class="absolute h-full w-[58px] md:w-[82px] z-0 pointer-events-none"
         :style="'transform: translateX(' + (activeIndex * 100) + '%); transition: transform 0.5s cubic-bezier(0.33, 0.83, 0.99, 0.98);'">
         <div class="absolute top-0 left-0 w-full h-[3px] rounded-b-full bg-current"></div>
         <div class="absolute bottom-0 left-0 w-full h-[3px] rounded-t-full bg-current"></div>
     </div>

    <!-- Links (0 to 4) -->
    <li @mouseenter="hoverIndex = 0" @mouseleave="hoverIndex = null" class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
        <a href="{{ route('home') }}" class="block py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current">Beranda</a>
    </li>
    <li @mouseenter="hoverIndex = 1; profilDropdown = true" 
        @mouseleave="hoverIndex = null; profilDropdown = false" 
        @keyup.escape.window="profilDropdown = false"
        x-data="{ profilDropdown: false }"
        class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
        <a href="{{ route('tentang') }}#hero" 
           @focus="hoverIndex = 1; profilDropdown = true"
           @blur="setTimeout(() => { if (! $el.contains(document.activeElement)) profilDropdown = false }, 100)"
           class="py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current flex items-center justify-center gap-0.5">
            <span>Profil</span>
            <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="{ 'rotate-180': profilDropdown }"></i>
        </a>

        <!-- Dropdown Menu Profil -->
        <div x-show="profilDropdown"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
             @mouseenter="profilDropdown = true"
             @mouseleave="profilDropdown = false"
             class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-44 bg-white text-slate-800 rounded-xl shadow-xl border border-slate-200 py-1.5 text-left z-[1000] overflow-hidden"
             style="display: none;">
            <a href="{{ route('tentang') }}#hero" @click="profilDropdown = false"
               class="profile-sub-link flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                <i class="fa-solid fa-circle-info text-emerald-600 text-xs"></i>
                <span>Sekilas Tentang Desa</span>
            </a>
            <a href="{{ route('tentang') }}#visi-misi" @click="profilDropdown = false"
               class="profile-sub-link flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-bullseye text-emerald-600 text-xs"></i>
                <span>Visi & Misi</span>
            </a>
            <a href="{{ route('tentang') }}#pemerintahan" @click="profilDropdown = false"
               class="profile-sub-link flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-users text-emerald-600 text-xs"></i>
                <span>Pemerintahan Desa</span>
            </a>
            <a href="{{ route('tentang') }}#potensi" @click="profilDropdown = false"
               class="profile-sub-link flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-star text-emerald-600 text-xs"></i>
                <span>Potensi Unggulan</span>
            </a>
            <a href="{{ route('tentang') }}#ekonomi-budaya" @click="profilDropdown = false"
               class="profile-sub-link flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-leaf text-emerald-600 text-xs"></i>
                <span>Ekonomi & Budaya</span>
            </a>
            <a href="{{ route('tentang') }}#kontak" @click="profilDropdown = false"
               class="profile-sub-link flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-envelope text-emerald-600 text-xs"></i>
                <span>Kontak</span>
            </a>
        </div>
    </li>
    <li @mouseenter="hoverIndex = 2; destinasiDropdown = true" 
        @mouseleave="hoverIndex = null; destinasiDropdown = false" 
        x-data="{ destinasiDropdown: false }"
        class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
        <a href="{{ route('destinasi') }}" 
           @click.prevent="destinasiDropdown = !destinasiDropdown"
           class="py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current flex items-center justify-center gap-0.5">
            <span>Destinasi</span>
            <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="{ 'rotate-180': destinasiDropdown }"></i>
        </a>

        <!-- Dropdown Menu Destinasi -->
        <div x-show="destinasiDropdown"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
             @mouseenter="destinasiDropdown = true"
             @mouseleave="destinasiDropdown = false"
             class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-44 bg-white text-slate-800 rounded-xl shadow-xl border border-slate-200 py-1.5 text-left z-[1000] overflow-hidden"
             style="display: none;">
            <a href="{{ route('destinasi.pantai-karang-jahe') }}" 
               class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                <i class="fa-solid fa-umbrella-beach text-emerald-600 text-xs"></i>
                <span>Pantai Karang Jahe</span>
            </a>
            <a href="{{ route('destinasi.situs-perahu-kuno') }}" 
               class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-ship text-emerald-600 text-xs"></i>
                <span>Situs Perahu Kuno</span>
            </a>
        </div>
    </li>
    <li @mouseenter="hoverIndex = 3; pustakaDropdown = true" 
        @mouseleave="hoverIndex = null; pustakaDropdown = false" 
        x-data="{ pustakaDropdown: false }"
        class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
        <a href="{{ route('pustaka') }}" 
           @click.prevent="pustakaDropdown = !pustakaDropdown"
           class="py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current flex items-center justify-center gap-0.5">
            <span>Pustaka</span>
            <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="{ 'rotate-180': pustakaDropdown }"></i>
        </a>

        <!-- Dropdown Menu Pustaka -->
        <div x-show="pustakaDropdown"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
             @mouseenter="pustakaDropdown = true"
             @mouseleave="pustakaDropdown = false"
             class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-44 bg-white text-slate-800 rounded-xl shadow-xl border border-slate-200 py-1.5 text-left z-[1000] overflow-hidden"
             style="display: none;">
            <a href="{{ route('pustaka', ['tab' => 'ebook']) }}" 
               class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                <i class="fa-solid fa-book-open text-emerald-600 text-xs"></i>
                <span>E-Book Panduan</span>
            </a>
            <a href="{{ route('pustaka', ['tab' => 'video']) }}" 
               class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-circle-play text-emerald-600 text-xs"></i>
                <span>Video Dokumentasi</span>
            </a>
            <a href="{{ route('pustaka', ['tab' => 'blog']) }}" 
               class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition border-t border-slate-100">
                <i class="fa-solid fa-newspaper text-emerald-600 text-xs"></i>
                <span>Artikel & Blog</span>
            </a>
        </div>
    </li>
    <li @mouseenter="hoverIndex = 4" @mouseleave="hoverIndex = null" class="relative z-10 w-[58px] md:w-[82px] text-center shrink-0">
        <a href="{{ route('testimoni.index') }}" class="block py-1.5 md:py-2 text-[9px] md:text-xs font-bold text-current">Kesan</a>
    </li>
</ul>
