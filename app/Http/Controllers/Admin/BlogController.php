<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(8);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Normalisasi absolute local URLs ke root-relative paths & unduh gambar eksternal/base64
        $content = $this->localizeExternalImages($validated['content']);
        $content = preg_replace('/src="https?:\/\/[^\/]+\/storage\/(berita\/[^"]+)"/i', 'src="/storage/$1"', $content);

        // Sanitasi konten menggunakan purifier
        $validated['content'] = Purifier::clean($content, 'berita');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Simpan menggunakan disk public_direct
            $path = $file->storeAs('blog-images', $fileName, 'public_direct');
            $validated['image'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($request->title);
        $validated['published_at'] = $request->published_at ? Carbon::parse($request->published_at) : now();

        Blog::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Ambil daftar gambar lama dari content
        $oldImages = [];
        preg_match_all('/src="[^"]*\/storage\/(berita\/[^"]+)"/i', $blog->content, $oldMatches);
        if (!empty($oldMatches[1])) {
            $oldImages = $oldMatches[1];
        }

        // Normalisasi absolute local URLs ke root-relative paths & unduh gambar eksternal/base64
        $content = $this->localizeExternalImages($validated['content']);
        $content = preg_replace('/src="https?:\/\/[^\/]+\/storage\/(berita\/[^"]+)"/i', 'src="/storage/$1"', $content);

        // Sanitasi konten baru menggunakan purifier
        $validated['content'] = Purifier::clean($content, 'berita');

        // Ambil daftar gambar baru dari content yang disanitasi
        $newImages = [];
        preg_match_all('/src="[^"]*\/storage\/(berita\/[^"]+)"/i', $validated['content'], $newMatches);
        if (!empty($newMatches[1])) {
            $newImages = $newMatches[1];
        }

        // Hapus gambar yang tidak lagi direferensikan (rehabilitasi/rekonsiliasi)
        $removedImages = array_diff($oldImages, $newImages);
        foreach ($removedImages as $removedImage) {
            Storage::disk('public_direct')->delete($removedImage);
        }

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public_direct')->delete($blog->image);
            }
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Simpan menggunakan disk public_direct
            $path = $file->storeAs('blog-images', $fileName, 'public_direct');
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['published_at'] = $request->published_at ? Carbon::parse($request->published_at) : ($blog->published_at ?? now());

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Blog $blog)
    {
        // Hapus cover image
        if ($blog->image) {
            Storage::disk('public_direct')->delete($blog->image);
        }

        // Hapus semua inline images yang terikat di artikel ini
        preg_match_all('/src="[^"]*\/storage\/(berita\/[^"]+)"/i', $blog->content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $imagePath) {
                Storage::disk('public_direct')->delete($imagePath);
            }
        }

        $blog->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }

    private function localizeExternalImages($content)
    {
        preg_match_all('/<img[^>]+src="([^"]+)"/i', $content, $matches);
        if (empty($matches[1])) {
            return $content;
        }

        $appUrl = rtrim(config('app.url'), '/');
        $disk = Storage::disk('public_direct');
        $manager = new ImageManager(new Driver());

        foreach ($matches[1] as $src) {
            if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) {
                if (str_contains($src, $appUrl)) {
                    continue;
                }
                
                try {
                    $context = stream_context_create([
                        'http' => [
                            'timeout' => 5,
                            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
                        ]
                    ]);
                    $imageData = @file_get_contents($src, false, $context);
                    if (!$imageData) {
                        continue;
                    }

                    $image = $manager->read($imageData);
                    if ($image->width() > 1600) {
                        $image->scale(width: 1600);
                    }
                    $encoded = $image->encode(new WebpEncoder(80));
                    
                    $fileName = Str::uuid() . '.webp';
                    $path = 'berita/' . $fileName;
                    $disk->put($path, (string)$encoded);

                    $localUrl = '/storage/' . $path;
                    $content = str_replace($src, $localUrl, $content);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning("Gagal melokalkan gambar eksternal {$src}: " . $e->getMessage());
                }
            } elseif (str_starts_with($src, 'data:image/')) {
                try {
                    preg_match('/data:image\/(\w+);base64,(.+)/i', $src, $baseMatches);
                    if (count($baseMatches) === 3) {
                        $data = base64_decode($baseMatches[2]);
                        
                        $image = $manager->read($data);
                        if ($image->width() > 1600) {
                            $image->scale(width: 1600);
                        }
                        $encoded = $image->encode(new WebpEncoder(80));
                        
                        $fileName = Str::uuid() . '.webp';
                        $path = 'berita/' . $fileName;
                        $disk->put($path, (string)$encoded);

                        $localUrl = '/storage/' . $path;
                        $content = str_replace($src, $localUrl, $content);
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning("Gagal melokalkan gambar base64: " . $e->getMessage());
                }
            }
        }

        return $content;
    }
}
