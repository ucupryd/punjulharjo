@props([
    'key' => null,           // Kunci unik untuk SiteSetting
    'image',                 // Wajib: URL/path gambar fallback
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
    'maxWidth' => 'max-w-4xl', // Lebar kontainer isi hero
    'padding' => null,       // Custom padding classes
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

    // Resolve custom background if key is provided
    $bgImage = $image;
    if ($key) {
        $customBg = \App\Models\SiteSetting::getValue($key);
        if ($customBg) {
            $bgImage = (str_starts_with($customBg, 'http') || str_contains($customBg, 'storage/')) ? asset($customBg) : Storage::url($customBg);
        }
    }
@endphp

<section {{ $attributes->merge(['class' => "relative w-full overflow-hidden fixed-window text-white z-10 flex flex-col justify-center {$height}"]) }}>
    <!-- Fixed Background Image (Full Viewport covering) -->
    <img src="{{ $bgImage }}" class="fixed-window__img absolute inset-0 w-full h-full object-cover pointer-events-none z-0" alt="{{ $title }}" />
    
    <!-- Dark overlay -->
    <div class="absolute inset-0 {{ $overlay }} z-10"></div>

    <!-- Content Area (Dengan padding top untuk offset navbar fixed) -->
    <div class="relative z-20 mx-auto {{ $maxWidth }} px-6 {{ $padding ?? ($hasWave ? 'pt-24 pb-32 md:pt-32 md:pb-48' : 'pt-12 pb-24 md:pt-14 md:pb-32') }} text-center">


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
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-30 pointer-events-none translate-y-[4px] scale-y-[1.05] origin-bottom">
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

    @if(Auth::check() && Auth::user()->isAdmin() && $key)
        <!-- Floating Edit Button for Component Hero -->
        <div class="absolute top-28 right-8 z-30">
            <button onclick="document.getElementById('edit-hero-modal-{{ $key }}').classList.remove('hidden')" 
                    class="bg-white/80 hover:bg-white text-slate-800 px-4 py-2.5 rounded-none shadow border border-white/20 transition-all duration-300 flex items-center gap-2 text-xs font-semibold">
                <i class="fa-solid fa-pencil text-sky-600"></i> Edit Background Hero
            </button>
        </div>

        <!-- Edit Custom Hero Modal (Only Image, max 5MB) -->
        <div id="edit-hero-modal-{{ $key }}" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-none shadow max-w-md w-full overflow-hidden border border-slate-100 text-left transform transition-all text-slate-800">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-sky-50">
                    <h3 class="text-lg font-heading text-slate-800">Edit Background Hero</h3>
                    <button type="button" onclick="document.getElementById('edit-hero-modal-{{ $key }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.hero.update-custom') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hero_key" value="{{ $key }}">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Pilih Gambar Baru</label>
                            <input type="file" name="hero_image" accept="image/*" class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm" required>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 5MB.</p>
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('edit-hero-modal-{{ $key }}').classList.add('hidden')" 
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-none text-sm transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="bg-sky-600 hover:bg-sky-700 text-white font-medium px-5 py-2 rounded-none text-sm shadow transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
                @php
                    $backupBg = \App\Models\SiteSetting::getValue($key . '_backup');
                @endphp
                @if($backupBg)
                    <div class="p-6 border-t border-slate-100 bg-slate-50">
                        <p class="text-xs text-slate-500 mb-2 font-medium">Tersedia 1 gambar cadangan sebelumnya:</p>
                        <div class="flex items-center gap-3">
                            <img src="{{ (str_starts_with($backupBg, 'http') || str_contains($backupBg, 'storage/')) ? asset($backupBg) : Storage::url($backupBg) }}" class="w-16 h-10 object-cover border border-slate-200" alt="Preview Backup">
                            <form action="{{ route('admin.hero.restore') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="hero_key" value="{{ $key }}">
                                <button type="submit" class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold px-3 py-1.5 transition">
                                    <i class="fa-solid fa-rotate-left mr-1"></i> Undo ke Gambar Ini
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</section>
@if($hasWave)
    <div id="heroSentinel" aria-hidden="true" class="h-px w-full bg-transparent"></div>
@endif
