<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimProklim;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TimProklimController extends Controller
{
    public function index()
    {
        $tim = TimProklim::orderBy('urutan')->get();
        return view('admin.tim-proklim.index', compact('tim'));
    }

    public function create()
    {
        return view('admin.tim-proklim.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'peran' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/proklim');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $fotoPath = 'proklim/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = TimProklim::count() + 1;
        }

        TimProklim::create([
            'nama' => $request->nama,
            'peran' => $request->peran,
            'foto' => $fotoPath,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.tim-proklim.index')->with('success', 'Anggota Tim ProKlim berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tim = TimProklim::findOrFail($id);
        return view('admin.tim-proklim.edit', compact('tim'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'peran' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $tim = TimProklim::findOrFail($id);

        $fotoPath = $tim->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($tim->foto && !Str::startsWith($tim->foto, 'http')) {
                Storage::disk('public_direct')->delete($tim->foto);
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/proklim');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $fotoPath = 'proklim/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = $tim->urutan;
        }

        $tim->update([
            'nama' => $request->nama,
            'peran' => $request->peran,
            'foto' => $fotoPath,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.tim-proklim.index')->with('success', 'Anggota Tim ProKlim berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tim = TimProklim::findOrFail($id);
        if ($tim->foto && !Str::startsWith($tim->foto, 'http')) {
            Storage::disk('public_direct')->delete($tim->foto);
        }
        $tim->delete();

        return redirect()->route('admin.tim-proklim.index')->with('success', 'Anggota Tim ProKlim berhasil dihapus!');
    }
}
