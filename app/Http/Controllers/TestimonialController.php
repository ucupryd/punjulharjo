<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Halaman list testimoni publik & visualisasi grafik
    public function index()
    {
        if (auth()->check()) {
            $testimonials = \App\Models\Testimonial::latest()->get();
        } else {
            $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->get();
        }

        // 1. Data Destinasi Terpopuler (Donut Chart)
        $allDestinations = ['Pantai Karang Jahe', 'Situs Perahu Kuno', 'Wisata Kuliner', 'Desa Edukasi'];
        $destQuery = \App\Models\Testimonial::where('is_approved', true)
            ->select('favorite_destination', \DB::raw('count(*) as total'))
            ->groupBy('favorite_destination')
            ->pluck('total', 'favorite_destination')
            ->toArray();

        $destinationData = [];
        foreach ($allDestinations as $dest) {
            $destinationData[$dest] = $destQuery[$dest] ?? 0;
        }

        // 2. Indeks Kepuasan Pengunjung (Radial Chart / Rata-rata)
        $totalTestimonials = \App\Models\Testimonial::where('is_approved', true)->count();
        $averageRating = \App\Models\Testimonial::where('is_approved', true)->avg('rating') ?? 0;
        $averageRating = round($averageRating, 1);

        $fiveStarCount = \App\Models\Testimonial::where('is_approved', true)->where('rating', 5)->count();
        $fiveStarPercentage = $totalTestimonials > 0 ? round(($fiveStarCount / $totalTestimonials) * 100) : 0;

        return view('testimoni.index', compact(
            'testimonials',
            'destinationData',
            'averageRating',
            'fiveStarPercentage',
            'totalTestimonials'
        ));
    }

    // Tampilan pengisian form testimonial oleh pengunjung (Mobile First)
    public function create()
    {
        return view('testimoni.create');
    }

    // Proses penyimpanan data testimonial baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'origin_city' => 'required|string|max:50',
            'favorite_destination' => 'required|string|in:Pantai Karang Jahe,Situs Perahu Kuno,Wisata Kuliner,Desa Edukasi',
            'companion' => 'required|string|in:Keluarga,Pasangan,Teman/Rombongan,Sendiri',
            'rating' => 'required|integer|min:1|max:5',
            'one_word' => 'required|string|max:20',
            'review' => 'required|string|max:250',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $testimonial = new \App\Models\Testimonial($request->except('photo'));

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $tempPath = $file->getRealPath();
            $storageDir = public_path('storage/testimonials');
            $targetPath = $storageDir . '/' . $fileName;

            if (!\Illuminate\Support\Facades\File::exists($storageDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($storageDir, 0755, true);
            }

            // Kompresi dan center-crop menggunakan library PHP GD
            $resized = $this->resizeImage($tempPath, $targetPath);

            if ($resized) {
                $testimonial->photo_path = 'testimonials/' . $fileName;
            } else {
                // Fallback jika proses GD gagal
                $file->move($storageDir, $fileName);
                $testimonial->photo_path = 'testimonials/' . $fileName;
            }
        }

        $testimonial->is_approved = false; // Default: pending moderasi
        $testimonial->save();

        return redirect()->route('testimoni.create')->with('success', 'Kesan keseruan Anda berhasil dikirim! Ulasan Anda akan tampil di website setelah divalidasi oleh Admin.');
    }

    // Halaman moderasi admin ulasan pengunjung
    public function adminIndex()
    {
        $testimonials = \App\Models\Testimonial::latest()->paginate(15);
        return view('admin.testimoni', compact('testimonials'));
    }

    // Validasi & Moderasi: Ubah status persetujuan
    public function approve($id)
    {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        $testimonial->is_approved = !$testimonial->is_approved;
        $testimonial->save();

        $status = $testimonial->is_approved ? 'ditampilkan ke publik' : 'ditangguhkan';
        return back()->with('success', "Testimoni dari {$testimonial->name} berhasil {$status}!");
    }

    // Hapus ulasan dari database
    public function destroy($id)
    {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        if ($testimonial->photo_path) {
            \Illuminate\Support\Facades\Storage::disk('public_direct')->delete($testimonial->photo_path);
        }
        $testimonial->delete();

        return back()->with('success', "Testimoni dari {$testimonial->name} berhasil dihapus!");
    }

    // Method Helper: Resize dan Crop Gambar Menggunakan GD Library PHP
    private function resizeImage($filePath, $targetPath, $width = 500, $height = 500)
    {
        if (!extension_loaded('gd') || !function_exists('imagecreatefromjpeg')) {
            return false;
        }

        list($origWidth, $origHeight, $imageType) = @getimagesize($filePath);
        
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = @imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = @imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_WEBP:
                $sourceImage = @imagecreatefromwebp($filePath);
                break;
            default:
                return false;
        }

        if (!$sourceImage) {
            return false;
        }

        $targetImage = imagecreatetruecolor($width, $height);
        
        // Transparansi untuk PNG/WEBP
        if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_WEBP) {
            imagealphablending($targetImage, false);
            imagesavealpha($targetImage, true);
            $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
            imagefilledrectangle($targetImage, 0, 0, $width, $height, $transparent);
        }

        // Hitung aspek rasio untuk center cropping
        $origRatio = $origWidth / $origHeight;
        $targetRatio = $width / $height;

        if ($origRatio > $targetRatio) {
            $cropHeight = $origHeight;
            $cropWidth = (int)($origHeight * $targetRatio);
            $cropX = (int)(($origWidth - $cropWidth) / 2);
            $cropY = 0;
        } else {
            $cropWidth = $origWidth;
            $cropHeight = (int)($origWidth / $targetRatio);
            $cropX = 0;
            $cropY = (int)(($origHeight - $cropHeight) / 2);
        }

        imagecopyresampled(
            $targetImage,
            $sourceImage,
            0, 0,
            $cropX, $cropY,
            $width, $height,
            $cropWidth, $cropHeight
        );

        $dir = dirname($targetPath);
        if (!file_exists($dir)) {
            @mkdir($dir, 0755, true);
        }

        $saved = @imagejpeg($targetImage, $targetPath, 85);

        imagedestroy($sourceImage);
        imagedestroy($targetImage);

        return $saved;
    }
}
