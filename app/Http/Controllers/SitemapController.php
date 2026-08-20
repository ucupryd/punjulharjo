<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Ebook;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Static pages
        $staticPages = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => Carbon::now()->format('Y-m-d')],
            ['loc' => route('tentang'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => Carbon::now()->format('Y-m-d')],
            ['loc' => route('adopsi.index'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => Carbon::now()->format('Y-m-d')],
            ['loc' => route('pustaka'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => Carbon::now()->format('Y-m-d')],
        ];

        foreach ($staticPages as $page) {
            $urls[] = $page;
        }

        // Destinations (Pantai Karang Jahe & Situs Perahu Kuno)
        $destinations = [
            ['loc' => route('destinasi.pantai-karang-jahe'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => Carbon::now()->format('Y-m-d')],
            ['loc' => route('destinasi.situs-perahu-kuno'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => Carbon::now()->format('Y-m-d')],
        ];

        foreach ($destinations as $dest) {
            $urls[] = $dest;
        }

        // Dynamic: Blog
        $blogs = Blog::where(function ($q) {
            $q->whereNull('published_at')
              ->orWhere('published_at', '<=', now());
        })->get();

        foreach ($blogs as $blog) {
            $rawDate = $blog->published_at ?? $blog->updated_at ?? $blog->created_at;
            $lastmod = \Carbon\Carbon::parse($rawDate)->format('Y-m-d');
            $urls[] = [
                'loc' => route('blog.show', $blog->slug),
                'priority' => '0.7',
                'changefreq' => 'weekly',
                'lastmod' => $lastmod,
            ];
        }

        // Dynamic: Video
        $videos = Video::all();
        foreach ($videos as $video) {
            $rawDate = $video->updated_at ?? $video->created_at;
            $lastmod = \Carbon\Carbon::parse($rawDate)->format('Y-m-d');
            $urls[] = [
                'loc' => route('video.show', $video->slug),
                'priority' => '0.7',
                'changefreq' => 'weekly',
                'lastmod' => $lastmod,
            ];
        }

        // Dynamic: Ebook
        $ebooks = Ebook::all();
        foreach ($ebooks as $ebook) {
            $rawDate = $ebook->updated_at ?? $ebook->created_at;
            $lastmod = \Carbon\Carbon::parse($rawDate)->format('Y-m-d');
            $urls[] = [
                'loc' => route('ebook.show', $ebook->id),
                'priority' => '0.7',
                'changefreq' => 'weekly',
                'lastmod' => $lastmod,
            ];
        }

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }
        
        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
