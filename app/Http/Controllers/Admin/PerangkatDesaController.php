<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerangkatDesa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $perangkat = PerangkatDesa::orderBy('urutan')->get();
        return view('admin.perangkat-desa.index', compact('perangkat'));
    }

    public function create()
    {
        return view('admin.perangkat-desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/perangkat');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $fotoPath = 'perangkat/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = PerangkatDesa::count() + 1;
        }

        PerangkatDesa::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.perangkat-desa.index')->with('success', 'Data Perangkat Desa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        return view('admin.perangkat-desa.edit', compact('perangkat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer',
        ]);

        $perangkat = PerangkatDesa::findOrFail($id);

        $fotoPath = $perangkat->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($perangkat->foto && !Str::startsWith($perangkat->foto, 'http')) {
                Storage::disk('public_direct')->delete($perangkat->foto);
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/perangkat');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $fotoPath = 'perangkat/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = $perangkat->urutan;
        }

        $perangkat->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.perangkat-desa.index')->with('success', 'Data Perangkat Desa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        if ($perangkat->foto && !Str::startsWith($perangkat->foto, 'http')) {
            Storage::disk('public_direct')->delete($perangkat->foto);
        }
        $perangkat->delete();

        return redirect()->route('admin.perangkat-desa.index')->with('success', 'Data Perangkat Desa berhasil dihapus!');
    }
}
