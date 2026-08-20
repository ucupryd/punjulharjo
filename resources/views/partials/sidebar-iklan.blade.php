@php
    $pantaiImg = \App\Models\SiteSetting::getValue('potensi_pantai_image', 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80');
    $pantaiImgUrl = (str_starts_with($pantaiImg, 'http') || str_contains($pantaiImg, 'storage/')) ? asset($pantaiImg) : Storage::url($pantaiImg);

    $situsImg = \App\Models\SiteSetting::getValue('potensi_situs_image', 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80');
    $situsImgUrl = (str_starts_with($situsImg, 'http') || str_contains($situsImg, 'storage/')) ? asset($situsImg) : Storage::url($situsImg);

    $cemaraImg = \App\Models\SiteSetting::getValue('potensi_cemara_image', 'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=800&q=80');
    $cemaraImgUrl = (str_starts_with($cemaraImg, 'http') || str_contains($cemaraImg, 'storage/')) ? asset($cemaraImg) : Storage::url($cemaraImg);

    // Ebook & Video match the hero of their page
    $heroPustakaImg = 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80';
@endphp

<div class="divide-y divide-slate-200 space-y-4">
    <!-- Item 1: Pantai Karang Jahe -->
    <div class="flex items-start gap-4 pb-4">
        <div class="w-24 h-16 bg-slate-100 flex-shrink-0 overflow-hidden rounded-none">
            <img src="{{ $pantaiImgUrl }}" alt="Pantai Karang Jahe" class="w-full h-full object-cover rounded-none" loading="lazy">
        </div>
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-bold font-heading text-brand-dark leading-snug">
                Pantai Karang Jahe (KJB)
            </h4>
            <p class="text-xs text-slate-500 font-sans line-clamp-2">
                Hamparan pasir putih dan ribuan pohon cemara rindang yang menyejukkan.
            </p>
            <a href="{{ route('destinasi.pantai-karang-jahe') }}" 
               class="inline-block text-xs font-bold text-sky-600 hover:text-sky-800 transition duration-150">
                Kunjungi Destinasi &rarr;
            </a>
        </div>
    </div>

    <!-- Item 2: Situs Perahu Kuno -->
    <div class="flex items-start gap-4 pt-4 pb-4">
        <div class="w-24 h-16 bg-slate-100 flex-shrink-0 overflow-hidden rounded-none">
            <img src="{{ $situsImgUrl }}" alt="Situs Perahu Kuno" class="w-full h-full object-cover rounded-none" loading="lazy">
        </div>
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-bold font-heading text-brand-dark leading-snug">
                Edu Park Situs Perahu Kuno
            </h4>
            <p class="text-xs text-slate-500 font-sans line-clamp-2">
                Sisa peninggalan perahu kayu kuno termegah abad ke-7 hingga ke-8 di Asia Tenggara.
            </p>
            <a href="{{ route('destinasi.situs-perahu-kuno') }}" 
               class="inline-block text-xs font-bold text-sky-600 hover:text-sky-800 transition duration-150">
                Pelajari Selengkapnya &rarr;
            </a>
        </div>
    </div>

    <!-- Item 3: Dokumen Desa -->
    <div class="flex items-start gap-4 pt-4 pb-4">
        <div class="w-24 h-16 bg-slate-100 flex-shrink-0 overflow-hidden rounded-none">
            <img src="{{ $heroPustakaImg }}" alt="Dokumen Desa" class="w-full h-full object-cover rounded-none" loading="lazy">
        </div>
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-bold font-heading text-brand-dark leading-snug">
                Dokumen Desa
            </h4>
            <p class="text-xs text-slate-500 font-sans line-clamp-2">
                Unduh dan baca dokumen resmi, regulasi, SK, serta paket wisata Desa Wisata Punjulharjo.
            </p>
            <a href="/pustaka?tab=ebook" 
               class="inline-block text-xs font-bold text-sky-600 hover:text-sky-800 transition duration-150">
                Buka Dokumen &rarr;
            </a>
        </div>
    </div>

    <!-- Item 4: Kumpulan Video Wisata -->
    <div class="flex items-start gap-4 pt-4 pb-4">
        <div class="w-24 h-16 bg-slate-100 flex-shrink-0 overflow-hidden rounded-none">
            <img src="{{ $heroPustakaImg }}" alt="Kumpulan Video Wisata" class="w-full h-full object-cover rounded-none" loading="lazy">
        </div>
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-bold font-heading text-brand-dark leading-snug">
                Kumpulan Video Wisata
            </h4>
            <p class="text-xs text-slate-500 font-sans line-clamp-2">
                Tonton dokumentasi seru dan keindahan alam pesisir Pantai Punjulharjo secara langsung.
            </p>
            <a href="/pustaka?tab=video" 
               class="inline-block text-xs font-bold text-sky-600 hover:text-sky-800 transition duration-150">
                Tonton Video &rarr;
            </a>
        </div>
    </div>

    <!-- Item 5: Cemara Laut Program -->
    <div class="flex items-start gap-4 pt-4 pb-4">
        <div class="w-24 h-16 bg-slate-100 flex-shrink-0 overflow-hidden rounded-none">
            <img src="{{ $cemaraImgUrl }}" alt="Program Cemara Laut" class="w-full h-full object-cover rounded-none" loading="lazy">
        </div>
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-bold font-heading text-brand-dark leading-snug">
                Program Adopsi Cemara Laut
            </h4>
            <p class="text-xs text-slate-500 font-sans line-clamp-2">
                Kontribusi menjaga kelestarian pesisir pantai desa dengan mengadopsi pohon cemara laut.
            </p>
            <a href="{{ route('adopsi.index') }}" 
               class="inline-block text-xs font-bold text-sky-600 hover:text-sky-800 transition duration-150">
                Adopsi Sekarang &rarr;
            </a>
        </div>
    </div>
</div>
