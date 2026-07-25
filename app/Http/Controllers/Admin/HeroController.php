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

        // Simpan file ke storage
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/hero');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'hero/' . $fileName;

        // Simpan path ke database dengan sistem backup & hapus file 2 langkah ke belakang
        $this->updateSettingWithBackup('hero_background', $path);

        return back()->with('success', 'Background hero berhasil diperbarui!');
    }

    public function updateCustom(Request $request)
    {
        $request->validate([
            'hero_key' => 'required|string',
            'hero_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $key = $request->input('hero_key');
        $file = $request->file('hero_image');

        // Simpan file ke storage
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/hero');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'hero/' . $fileName;

        // Simpan path ke database dengan sistem backup & hapus file 2 langkah ke belakang
        $this->updateSettingWithBackup($key, $path);

        return back()->with('success', 'Background hero berhasil diperbarui!');
    }

    public function updateAboutImage(Request $request)
    {
        $request->validate([
            'about_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('about_image');

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/about');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'about/' . $fileName;

        // Simpan path ke database dengan sistem backup & hapus file 2 langkah ke belakang
        $this->updateSettingWithBackup('about_image', $path);

        return back()->with('success', 'Foto tentang desa berhasil diperbarui!');
    }

    public function updateCultureImage(Request $request)
    {
        $request->validate([
            'culture_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('culture_image');

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/culture');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'culture/' . $fileName;

        // Simpan path ke database dengan sistem backup & hapus file 2 langkah ke belakang
        $this->updateSettingWithBackup('culture_image', $path);

        return back()->with('success', 'Foto kehidupan budaya berhasil diperbarui!');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'hero_key' => 'required|string',
        ]);

        $key = $request->input('hero_key');

        $currentPath = SiteSetting::getValue($key);
        $backupPath = SiteSetting::getValue($key . '_backup');

        if ($backupPath) {
            // Swap them
            SiteSetting::setValue($key, $backupPath);
            SiteSetting::setValue($key . '_backup', $currentPath);

            return back()->with('success', 'Berhasil mengembalikan ke gambar sebelumnya!');
        }

        return back()->withErrors(['error' => 'Tidak ada gambar sebelumnya yang tersimpan.']);
    }

    private function updateSettingWithBackup($key, $newPath)
    {
        // 1. Dapatkan file backup lama (2 file ke belakang)
        $oldBackupPath = SiteSetting::getValue($key . '_backup');
        
        // 2. Dapatkan file saat ini (1 file sebelumnya)
        $currentPath = SiteSetting::getValue($key);

        // 3. Hapus file backup lama (2 file ke belakang)
        if ($oldBackupPath && !str_starts_with($oldBackupPath, 'http')) {
            Storage::disk('public_direct')->delete($oldBackupPath);
        }

        // 4. Pindahkan path saat ini ke backup jika ada
        if ($currentPath) {
            SiteSetting::setValue($key . '_backup', $currentPath);
        }

        // 5. Simpan path baru sebagai nilai utama
        SiteSetting::setValue($key, $newPath);
    }
}
