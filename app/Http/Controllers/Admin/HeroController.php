<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        $heroImage = SiteSetting::getValue('hero_background', asset('images/hero-bg.jpg'));
        return view('admin.hero.edit', compact('heroImage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_background' => 'required|file|max:10240',
        ]);

        $file = $request->file('hero_background');
        $extension = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'mp4', 'webm', 'mov', 'qt', 'ogg'];

        if (!in_array($extension, $allowedExtensions)) {
            return back()->withErrors(['hero_background' => 'Format file tidak didukung. Gunakan gambar (jpg, jpeg, png, webp) atau video (mp4, webm, mov, ogg).']);
        }

        // Delete old background file if it exists and is local
        $oldPath = SiteSetting::getValue('hero_background');
        if ($oldPath && !str_starts_with($oldPath, 'http')) {
            Storage::disk('public_direct')->delete($oldPath);
        }

        // Simpan file ke storage
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/hero');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'hero/' . $fileName;

        // Simpan path ke database
        SiteSetting::setValue('hero_background', $path);

        return back()->with('success', 'Background hero berhasil diperbarui!');
    }

    public function updateAboutImage(Request $request)
    {
        $request->validate([
            'about_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('about_image');
        $oldPath = SiteSetting::getValue('about_image');
        if ($oldPath && !str_starts_with($oldPath, 'http')) {
            Storage::disk('public_direct')->delete($oldPath);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/about');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'about/' . $fileName;

        SiteSetting::setValue('about_image', $path);

        return back()->with('success', 'Foto tentang desa berhasil diperbarui!');
    }

    public function updateCultureImage(Request $request)
    {
        $request->validate([
            'culture_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('culture_image');
        $oldPath = SiteSetting::getValue('culture_image');
        if ($oldPath && !str_starts_with($oldPath, 'http')) {
            Storage::disk('public_direct')->delete($oldPath);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/culture');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'culture/' . $fileName;

        SiteSetting::setValue('culture_image', $path);

        return back()->with('success', 'Foto kehidupan budaya berhasil diperbarui!');
    }
}
