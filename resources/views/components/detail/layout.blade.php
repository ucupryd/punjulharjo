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

    /* Styling overrides for WYSIWYG editor content */
    .prose h2 {
        font-size: 1.875rem !important; /* 30px */
        font-weight: 700 !important;
        line-height: 1.25 !important;
        margin-top: 2rem !important;
        margin-bottom: 0.75rem !important;
        color: #0d355e !important; /* brand-dark */
        font-family: 'Playfair Display', serif !important;
    }
    .prose h3 {
        font-size: 1.5rem !important; /* 24px */
        font-weight: 600 !important;
        line-height: 1.3 !important;
        margin-top: 1.75rem !important;
        margin-bottom: 0.5rem !important;
        color: #0d355e !important; /* brand-dark */
        font-family: 'Playfair Display', serif !important;
    }
    .prose h4 {
        font-size: 1.25rem !important; /* 20px */
        font-weight: 600 !important;
        line-height: 1.4 !important;
        margin-top: 1.5rem !important;
        margin-bottom: 0.5rem !important;
        color: #1e293b !important;
        font-family: 'Playfair Display', serif !important;
    }
    .prose p {
        margin-bottom: 1.25rem !important;
        line-height: 1.75 !important;
        color: #334155 !important; /* slate-700 */
    }
    .prose img {
        max-width: 100% !important;
        height: auto !important;
        margin: 2rem auto !important;
        border-radius: 0px !important; /* Siku corners */
    }
    
    /* Lists formatting - override Tailwind Preflight reset */
    .prose ul {
        list-style-type: disc !important;
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
        padding-left: 1.5rem !important;
    }
    .prose ol {
        list-style-type: decimal !important;
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
        padding-left: 1.5rem !important;
    }
    .prose li {
        margin-bottom: 0.5rem !important;
        line-height: 1.6 !important;
        color: #334155 !important; /* slate-700 */
    }
    
    /* Centering images when wrapped in styled blocks */
    .prose [style*="text-align: center"] {
        text-align: center !important;
    }
    .prose [style*="text-align: center"] img {
        display: inline-block !important;
    }
    .prose [style*="text-align: right"] {
        text-align: right !important;
    }
    .prose [style*="text-align: right"] img {
        display: inline-block !important;
    }
</style>
