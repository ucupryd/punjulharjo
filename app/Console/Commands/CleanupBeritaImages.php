<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupBeritaImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'berita:cleanup-images {--dry-run : Menampilkan daftar kandidat hapus tanpa benar-benar menghapus}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus gambar yatim (tidak direferensikan di artikel manapun) di folder public/storage/berita dengan grace period 24 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $this->info($dryRun ? "Memulai audit gambar yatim (Dry Run)..." : "Memulai pembersihan gambar yatim...");

        // 1. Kumpulkan semua file gambar yang terikat di database (konten & cover)
        $blogs = \App\Models\Blog::all();
        $referencedFiles = [];

        foreach ($blogs as $blog) {
            if ($blog->image) {
                $referencedFiles[] = basename($blog->image);
            }

            preg_match_all('/src="[^"]*\/storage\/(berita\/[^"]+)"/i', $blog->content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $fullPath) {
                    $referencedFiles[] = basename($fullPath);
                }
            }
        }

        $referencedFiles = array_unique($referencedFiles);

        // 2. Ambil semua file di folder public/storage/berita
        $disk = \Illuminate\Support\Facades\Storage::disk('public_direct');
        if (!$disk->exists('berita')) {
            $this->info("Folder berita tidak ditemukan di storage.");
            return 0;
        }

        $allFiles = $disk->files('berita');
        $gracePeriodSeconds = 24 * 3600; // 24 jam
        $now = time();
        $deletedCount = 0;

        foreach ($allFiles as $file) {
            $filename = basename($file);
            if ($filename === '.htaccess') {
                continue;
            }

            // Jika file tidak direferensikan di database
            if (!in_array($filename, $referencedFiles)) {
                // Periksa grace period (buat kurang dari 24 jam yang lalu)
                $lastModified = $disk->lastModified($file);
                if (($now - $lastModified) < $gracePeriodSeconds) {
                    $this->line("Melewati (grace period): {$file}");
                    continue;
                }

                if ($dryRun) {
                    $this->warn("[Dry Run] Kandidat hapus: {$file}");
                } else {
                    $disk->delete($file);
                    $this->error("Menghapus gambar yatim: {$file}");
                }
                $deletedCount++;
            }
        }

        $message = "Pembersihan selesai. Total file " . ($dryRun ? "kandidat hapus" : "yang dihapus") . ": {$deletedCount}";
        $this->info($message);
        
        if (!$dryRun) {
            \Illuminate\Support\Facades\Log::info("Pembersihan gambar berita selesai: {$deletedCount} file dihapus.");
        }

        return 0;
    }
}
