<section class="bg-transparent pt-32 pb-20 px-4 lg:px-6">
    <div class="max-w-6xl mx-auto">
        <!-- Grid Layout: Konten Utama (Kiri) + Sidebar (Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 detail-grid">
            
            <!-- Kolom Utama (Left - 8 Cols) -->
            <div class="lg:col-span-8 space-y-6">
                {{ $main }}
            </div>

            <!-- Kolom Kanan / Sidebar (Right - 4 Cols) -->
            <div class="lg:col-span-4 promo-wrapper">
                <div class="promo-inner space-y-6">
                    {{ $sidebar }}
                </div>
            </div>
            
        </div>
    </div>
</section>

<style>
    .promo-wrapper {
        align-self: start;
    }
    .promo-inner {
        will-change: min-height;
    }
</style>
