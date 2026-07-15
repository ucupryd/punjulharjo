<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Blog;
use App\Models\Ebook;
use App\Models\Testimonial;
use App\Models\Video;
use App\Models\SiteSetting;

class MigrateStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate files from storage/app/public to public/storage and clean up absolute/relative database paths';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceDir = storage_path('app/public');
        $targetDir = public_path('storage');

        $this->info("Starting storage migration...");

        // 1. Recursive copy of files/folders
        if (File::exists($sourceDir)) {
            $this->info("Copying files from {$sourceDir} to {$targetDir}...");
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            File::copyDirectory($sourceDir, $targetDir);
            $this->info("Assets copied successfully.");
        } else {
            $this->warn("Source public storage directory ({$sourceDir}) does not exist. Skipping file copy.");
        }

        // 2. Database path sanitization
        $this->info("Sanitizing database paths...");

        $this->sanitizeBlogs();
        $this->sanitizeEbooks();
        $this->sanitizeTestimonials();
        $this->sanitizeVideos();
        $this->sanitizeSiteSettings();

        $this->info("Migration completed successfully!");
    }

    /**
     * Helper to get relative path from a full path or raw url string.
     */
    private function cleanPath($path, $subfolder = '')
    {
        if (empty($path)) {
            return $path;
        }

        // If it's a full URL, we keep it as-is (e.g. Unsplash URL fallbacks)
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Clean absolute windows or linux paths (e.g. containing public/storage or storage/app/public)
        // Extract only the part after the storage directory
        $clean = str_replace('\\', '/', $path);
        
        if (preg_match('/storage\/(.*)$/i', $clean, $matches)) {
            $clean = $matches[1];
        } elseif (preg_match('/public\/(.*)$/i', $clean, $matches)) {
            $clean = $matches[1];
        }

        // Ensure we remove duplicate subfolder prefix if any
        if (!empty($subfolder)) {
            $subfolderClean = trim(str_replace('\\', '/', $subfolder), '/');
            if (str_starts_with($clean, $subfolderClean . '/')) {
                $clean = substr($clean, strlen($subfolderClean) + 1);
            }
            return $subfolderClean . '/' . trim($clean, '/');
        }

        return trim($clean, '/');
    }

    private function sanitizeBlogs()
    {
        $blogs = Blog::all();
        $count = 0;
        foreach ($blogs as $blog) {
            if ($blog->image) {
                $cleaned = $this->cleanPath($blog->image, 'blog-images');
                if ($cleaned !== $blog->image) {
                    $blog->image = $cleaned;
                    $blog->save();
                    $count++;
                }
            }
        }
        $this->info("Sanitized {$count} blog thumbnails.");
    }

    private function sanitizeEbooks()
    {
        $ebooks = Ebook::all();
        $countPdf = 0;
        $countCover = 0;
        foreach ($ebooks as $ebook) {
            if ($ebook->pdf_path) {
                $cleanedPdf = $this->cleanPath($ebook->pdf_path, 'ebooks');
                if ($cleanedPdf !== $ebook->pdf_path) {
                    $ebook->pdf_path = $cleanedPdf;
                    $ebook->save();
                    $countPdf++;
                }
            }
            if ($ebook->cover_path) {
                $cleanedCover = $this->cleanPath($ebook->cover_path, 'ebooks/covers');
                if ($cleanedCover !== $ebook->cover_path) {
                    $ebook->cover_path = $cleanedCover;
                    $ebook->save();
                    $countCover++;
                }
            }
        }
        $this->info("Sanitized {$countPdf} ebook PDFs and {$countCover} ebook covers.");
    }

    private function sanitizeTestimonials()
    {
        $testimonials = Testimonial::all();
        $count = 0;
        foreach ($testimonials as $testimonial) {
            if ($testimonial->photo_path) {
                $cleaned = $this->cleanPath($testimonial->photo_path, 'testimonials');
                if ($cleaned !== $testimonial->photo_path) {
                    $testimonial->photo_path = $cleaned;
                    $testimonial->save();
                    $count++;
                }
            }
        }
        $this->info("Sanitized {$count} testimonial visitor photos.");
    }

    private function sanitizeVideos()
    {
        $videos = Video::all();
        $count = 0;
        foreach ($videos as $video) {
            if ($video->thumbnail) {
                $cleaned = $this->cleanPath($video->thumbnail, 'video-thumbnails');
                if ($cleaned !== $video->thumbnail) {
                    $video->thumbnail = $cleaned;
                    $video->save();
                    $count++;
                }
            }
        }
        $this->info("Sanitized {$count} video thumbnails.");
    }

    private function sanitizeSiteSettings()
    {
        $settings = SiteSetting::all();
        $count = 0;
        foreach ($settings as $setting) {
            $key = $setting->key;
            $value = $setting->value;

            if (empty($value)) {
                continue;
            }

            if (in_array($key, ['hero_background', 'about_image', 'culture_image'])) {
                $cleaned = $this->cleanPath($value, $key === 'hero_background' ? 'hero' : ($key === 'about_image' ? 'about' : 'culture'));
                if ($cleaned !== $value) {
                    SiteSetting::setValue($key, $cleaned);
                    $count++;
                }
            } elseif (in_array($key, ['gallery_items', 'carousel_items'])) {
                $items = json_decode($value, true);
                if (is_array($items)) {
                    $changed = false;
                    foreach ($items as &$item) {
                        if (isset($item['image'])) {
                            $cleaned = $this->cleanPath($item['image'], $key === 'gallery_items' ? 'gallery' : 'carousel');
                            if ($cleaned !== $item['image']) {
                                $item['image'] = $cleaned;
                                $changed = true;
                            }
                        }
                    }
                    if ($changed) {
                        SiteSetting::setValue($key, json_encode($items));
                        $count++;
                    }
                }
            }
        }
        $this->info("Sanitized {$count} site setting assets.");
    }
}
