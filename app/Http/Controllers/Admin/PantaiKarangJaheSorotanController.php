<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PantaiKarangJaheSorotan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PantaiKarangJaheSorotanController extends Controller
{
    public function index()
    {
        $sorotan = PantaiKarangJaheSorotan::orderBy('urutan')->get();
        return view('admin.karang-jahe-sorotan.index', compact('sorotan'));
    }

    public function create()
    {
        return view('admin.karang-jahe-sorotan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/karang-jahe-sorotan');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $gambarPath = 'karang-jahe-sorotan/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = PantaiKarangJaheSorotan::count() + 1;
        }

        PantaiKarangJaheSorotan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon,
            'gambar' => $gambarPath,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.karang-jahe-sorotan.index')->with('success', 'Sorotan Pantai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sorotan = PantaiKarangJaheSorotan::findOrFail($id);
        return view('admin.karang-jahe-sorotan.edit', compact('sorotan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $sorotan = PantaiKarangJaheSorotan::findOrFail($id);

        $gambarPath = $sorotan->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($sorotan->gambar && !Str::startsWith($sorotan->gambar, 'http')) {
                Storage::disk('public_direct')->delete($sorotan->gambar);
            }

            $file = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/karang-jahe-sorotan');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $gambarPath = 'karang-jahe-sorotan/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = $sorotan->urutan;
        }

        $sorotan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon,
            'gambar' => $gambarPath,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.karang-jahe-sorotan.index')->with('success', 'Sorotan Pantai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sorotan = PantaiKarangJaheSorotan::findOrFail($id);
        if ($sorotan->gambar && !Str::startsWith($sorotan->gambar, 'http')) {
            Storage::disk('public_direct')->delete($sorotan->gambar);
        }
        $sorotan->delete();

        return redirect()->route('admin.karang-jahe-sorotan.index')->with('success', 'Sorotan Pantai berhasil dihapus!');
    }
}
