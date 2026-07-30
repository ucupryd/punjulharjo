<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class BeritaImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            // 1. Validasi Input Gambar secara ketat
            $request->validate([
                'file' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:3072', // Maksimal 3MB
                    'dimensions:max_width=4000,max_height=4000'
                ],
            ]);

            $file = $request->file('file');

            // Hardening tambahan: Pastikan bukan SVG dan MIME type valid gambar
            $mime = $file->getMimeType();
            if (str_contains(strtolower($mime), 'svg') || !str_starts_with($mime, 'image/')) {
                return response()->json([
                    'error' => 'Format file tidak didukung. File SVG tidak diperbolehkan.'
                ], 400);
            }

            // 2. Inisialisasi Intervention Image (Gd Driver)
            $manager = new ImageManager(new Driver());
            $image = $manager->decode($file->getRealPath());

            // 3. Resize jika lebar melebihi 1600px
            if ($image->width() > 1600) {
                $image->scale(width: 1600);
            }

            // 4. Re-encode ke WebP dengan kualitas 80% (buang EXIF/payload otomatis)
            $encoded = $image->encode(new WebpEncoder(80));

            // 5. Simpan berkas ke disk public_direct di folder berita
            $fileName = Str::uuid() . '.webp';
            $path = 'berita/' . $fileName;
            
            Storage::disk('public_direct')->put($path, (string)$encoded);

            // 6. Dapatkan URL publik statis (root-relative agar tidak disaring oleh HTMLPurifier)
            $url = '/storage/' . $path;

            return response()->json([
                'location' => $url
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengunggah gambar: ' . $e->getMessage()
            ], 400);
        }
    }
}
