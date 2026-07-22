@props([
    'image',                 // Wajib: URL/path gambar
    'title' => null,
    'titleAccent' => null,   // Penggalan judul berwarna / baris kedua
    'subtitle' => null,
    'eyebrow' => null,       // Teks kecil di atas judul
    'eyebrowIcon' => null,   // Kelas FontAwesome (opsional)
    'height' => 'min-h-[85vh]', // Default: hampir full layar
    'overlay' => 'bg-slate-950/60', // Dark overlay
    'variant' => 'default',  // 'default' (navy/amber) | 'green' (My Cemara)
    'waveColor' => 'text-white', // Warna gelombang bawah
    'hasWave' => false,      // Gelombang hanya untuk hero halaman utama subpage
])

@php
    $theme = $variant === 'green'
        ? [
            'badge' => 'bg-emerald-500/15 text-emerald-300 ring-1 ring-emerald-400/30', 
            'accent' => 'text-emerald-400',
            'wave1' => 'rgba(16, 185, 129, 0.3)',
            'wave2' => 'rgba(6, 59, 40, 0.4)',
          ]
        : [
            'badge' => 'bg-brand-accent/15 text-brand-accent ring-1 ring-brand-accent/30', 
            'accent' => 'text-brand-accent',
            'wave1' => 'rgba(116, 157, 178, 0.45)',
            'wave2' => 'rgba(13, 53, 94, 0.35)',
          ];

    // Menerjemahkan class waveColor ke warna HEX untuk SVG fill
    $waveFill = '#ffffff';
    if ($waveColor === 'text-slate-100') {
        $waveFill = '#f1f5f9';
    } elseif ($waveColor === 'text-slate-50') {
        $waveFill = '#f8fafc';
    } elseif ($waveColor === 'text-emerald-900') {
        $waveFill = '#064e3b';
    }
@endphp

<section {{ $attributes->merge(['class' => "relative w-full overflow-hidden fixed-window text-white z-10 flex flex-col justify-center {$height}"]) }}>
    <!-- Fixed Background Image (Full Viewport covering) -->
    <img src="{{ $image }}" class="fixed-window__img absolute inset-0 w-full h-full object-cover pointer-events-none z-0" alt="{{ $title }}" />
    
    <!-- Dark overlay -->
    <div class="absolute inset-0 {{ $overlay }} z-10"></div>

    <!-- Content Area (Dengan padding top untuk offset navbar fixed) -->
    <div class="relative z-20 mx-auto max-w-4xl px-6 pt-32 pb-24 md:pt-40 md:pb-32 text-center">
        @if($eyebrow)
            <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-semibold uppercase tracking-widest {{ $theme['badge'] }} backdrop-blur-md">
                @if($eyebrowIcon)<i class="{{ $eyebrowIcon }}"></i>@endif
                {{ $eyebrow }}
            </span>
        @endif

        @if($title)
            <h1 class="mt-6 font-title text-3xl sm:text-4xl md:text-6xl font-bold leading-tight drop-shadow-md">
                {{ $title }}
                @if($titleAccent)<br><span class="{{ $theme['accent'] }}">{{ $titleAccent }}</span>@endif
            </h1>
        @endif
 
        @if($subtitle)
            <p class="mx-auto mt-5 max-w-2xl text-sm sm:text-base md:text-lg text-white/80 font-sans leading-relaxed drop-shadow">{{ $subtitle }}</p>
        @endif

        @if(trim($slot))
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                {{ $slot }}
            </div>
        @endif
    </div>

    @if($hasWave)
        <!-- Multi-layered Aesthetic Wave Divider (Tumpang Tindih seperti Beranda) -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-30 pointer-events-none translate-y-[2px]">
            <svg class="relative block w-full h-[60px] md:h-[145px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- Layer 1: Back Wave (Translucent Light) -->
                <path d="M0,10 C150,40,350,0,600,25 C850,50,1050,15,1200,20 L1200,120 L0,120 Z" fill="{{ $theme['wave1'] }}"></path>
                <!-- Layer 2: Middle Wave (Translucent Dark) -->
                <path d="M0,40 C240,60,380,30,700,50 C1000,70,1080,40,1200,45 L1200,120 L0,120 Z" fill="{{ $theme['wave2'] }}"></path>
                <!-- Layer 3: Front Wave (Solid White/Slate) -->
                <path d="M0,70 C320,90,420,55,740,70 C1040,85,1120,65,1200,75 L1200,120 L0,120 Z" fill="{{ $waveFill }}"></path>
            </svg>
        </div>
    @endif
</section>
