<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Halaman utama — menampilkan 3 konten promo per jenis (terbaru atau unggulan)
    public function home()
    {
        $promoBlog  = $this->promoItems('blog',  \App\Models\Blog::class);
        $promoVideo = $this->promoItems('video', \App\Models\Video::class);
        $promoEbook = $this->promoItems('ebook', \App\Models\Ebook::class);

        $destinationVideos = \App\Models\DestinationVideo::active()
            ->ordered()
            ->get()
            ->map(function ($dv) {
                return [
                    'id'      => $dv->id,
                    'judul'   => $dv->judul,
                    'caption' => $dv->caption ?? '',
                    'src'     => str_starts_with($dv->video, 'http')
                        ? $dv->video
                        : Storage::disk('public_direct')->url($dv->video),
                ];
            })
            ->values();

        return view('welcome', compact('promoBlog', 'promoVideo', 'promoEbook', 'destinationVideos'));
    }

    /**
     * Ambil maks. 3 item promo untuk satu jenis konten.
     * Mengembalikan array ['items' => Collection, 'mode' => 'terbaru'|'unggulan'].
     * 'mode' adalah mode EFEKTIF: kalau unggulan tapi kosong, jatuh ke 'terbaru'.
     */
    private function promoItems(string $key, string $class): array
    {
        $mode = \App\Models\SiteSetting::getValue('beranda_mode_' . $key, 'terbaru');

        $base = fn () => $class::with('categories');

        // Hanya sembunyikan artikel bertanggal masa depan.
        // published_at NULL dianggap sudah terbit (kolom baru, artikel lama nilainya NULL).
        $applyPublished = function ($q) use ($key) {
            if ($key === 'blog') {
                $q->where(function ($qq) {
                    $qq->whereNull('published_at')
                       ->orWhere('published_at', '<=', now());
                });
            }
            return $q;
        };

        if ($mode === 'unggulan') {
            $ids = \App\Models\FeaturedItem::where('featurable_type', $class)
                ->orderBy('position')
                ->pluck('featurable_id')
                ->all();

            if (! empty($ids)) {
                $q = $applyPublished($base()->whereIn('id', $ids));
                $items = $q->get()
                    ->sortBy(fn ($m) => array_search($m->id, $ids))
                    ->values()
                    ->take(3);

                // Bila semua item unggulan tersaring habis, jatuh ke Terbaru.
                if ($items->isNotEmpty()) {
                    return ['items' => $items, 'mode' => 'unggulan'];
                }
            }
        }

        // Mode Terbaru, juga dipakai sebagai jaring pengaman.
        $q = $applyPublished($base());
        if ($key === 'blog') {
            $q->orderByRaw('COALESCE(published_at, created_at) DESC');
        } else {
            $q->latest();
        }

        return ['items' => $q->take(3)->get(), 'mode' => 'terbaru'];
    }

    // Halaman semua blog
    public function index()
    {
        $blogs = Blog::with('categories')->latest()->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    // Halaman detail blog
    public function show($slug)
    {
        $blog = Blog::with(['categories', 'author'])->where('slug', $slug)->firstOrFail();
        
        // Record unique view log
        $visitorToken = request()->cookie('visitor_token');
        if ($visitorToken) {
            try {
                \App\Models\ViewLog::create([
                    'viewable_type' => Blog::class,
                    'viewable_id' => $blog->id,
                    'visitor_token' => $visitorToken
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                // Silent ignore on duplicate index (already viewed)
            }
        }

        $beritaLain = Blog::with('categories')
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(4)
            ->get();

        $moreItems = $beritaLain->map(function ($b) {
            $firstCategory = $b->categories->first();

            return [
                'image' => $b->image ? \Illuminate\Support\Facades\Storage::url($b->image) : asset('images/blog-placeholder.png'),
                'label' => $firstCategory?->name ?? 'Berita Desa',
                'title' => $b->title,
                'excerpt' => $b->auto_excerpt,
                'date' => ($b->published_at ? \Carbon\Carbon::parse($b->published_at) : $b->created_at)->format('d M Y'),
                'url' => route('blog.show', $b->slug),
            ];
        })->toArray();

        $pantaiImg = \App\Models\SiteSetting::getValue('potensi_pantai_image');
        $pantaiImgUrl = (str_starts_with($pantaiImg, 'http') || str_contains($pantaiImg, 'storage/')) ? asset($pantaiImg) : \Illuminate\Support\Facades\Storage::url($pantaiImg);

        $situsImg = \App\Models\SiteSetting::getValue('potensi_situs_image');
        $situsImgUrl = (str_starts_with($situsImg, 'http') || str_contains($situsImg, 'storage/')) ? asset($situsImg) : \Illuminate\Support\Facades\Storage::url($situsImg);

        $cemaraImg = \App\Models\SiteSetting::getValue('potensi_cemara_image');
        $cemaraImgUrl = (str_starts_with($cemaraImg, 'http') || str_contains($cemaraImg, 'storage/')) ? asset($cemaraImg) : \Illuminate\Support\Facades\Storage::url($cemaraImg);

        $sidebarItems = [
            [
                'image' => $pantaiImgUrl,
                'title' => 'Pantai Karang Jahe (KJB)',
                'excerpt' => 'Hamparan pasir putih dan ribuan pohon cemara rindang yang menyejukkan.',
                'url' => route('destinasi.pantai-karang-jahe'),
                'ctaLabel' => 'Kunjungi Destinasi'
            ],
            [
                'image' => $situsImgUrl,
                'title' => 'Edu Park Situs Perahu Kuno',
                'excerpt' => 'Sisa peninggalan perahu kayu kuno termegah abad ke-7 hingga ke-8 di Asia Tenggara.',
                'url' => route('destinasi.situs-perahu-kuno'),
                'ctaLabel' => 'Pelajari Selengkapnya'
            ],
            [
                'image' => $cemaraImgUrl,
                'title' => 'Program Adopsi Cemara Laut',
                'excerpt' => 'Kontribusi menjaga kelestarian pesisir pantai desa dengan mengadopsi pohon cemara laut.',
                'url' => route('adopsi.index'),
                'ctaLabel' => 'Adopsi Sekarang'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                'title' => 'Kumpulan Video Wisata',
                'excerpt' => 'Tonton dokumentasi seru dan keindahan alam pesisir Pantai Punjulharjo secara langsung.',
                'url' => '/pustaka?tab=video',
                'ctaLabel' => 'Tonton Video'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                'title' => 'E-Book Panduan Wisata',
                'excerpt' => 'Unduh dan baca panduan lengkap tentang kebudayaan, sejarah, dan keindahan alam Punjulharjo.',
                'url' => '/pustaka?tab=ebook',
                'ctaLabel' => 'Buka E-Book'
            ]
        ];

        return view('blog.show', compact('blog', 'sidebarItems', 'moreItems'));
    }
}
