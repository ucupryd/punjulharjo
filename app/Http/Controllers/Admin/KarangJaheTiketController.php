<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KarangJaheTiket;

class KarangJaheTiketController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.moderasi.index', ['tab' => 'tiket']);
    }

    public function create()
    {
        return view('admin.karang-jahe-tiket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'komponen' => 'required|string|max:150',
            'tarif' => 'required|string|max:150',
            'catatan' => 'nullable|string|max:200',
            'ikon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer',
        ]);

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = KarangJaheTiket::count() + 1;
        }

        KarangJaheTiket::create([
            'komponen' => $request->komponen,
            'tarif' => $request->tarif,
            'catatan' => $request->catatan,
            'ikon' => $request->ikon,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.moderasi.index', ['tab' => 'tiket'])->with('success', 'Tarif tiket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tiket = KarangJaheTiket::findOrFail($id);
        return view('admin.karang-jahe-tiket.edit', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'komponen' => 'required|string|max:150',
            'tarif' => 'required|string|max:150',
            'catatan' => 'nullable|string|max:200',
            'ikon' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer',
        ]);

        $tiket = KarangJaheTiket::findOrFail($id);

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = $tiket->urutan;
        }

        $tiket->update([
            'komponen' => $request->komponen,
            'tarif' => $request->tarif,
            'catatan' => $request->catatan,
            'ikon' => $request->ikon,
            'urutan' => $urutan,
        ]);

        return redirect()->route('admin.moderasi.index', ['tab' => 'tiket'])->with('success', 'Tarif tiket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tiket = KarangJaheTiket::findOrFail($id);
        $tiket->delete();

        return redirect()->route('admin.moderasi.index', ['tab' => 'tiket'])->with('success', 'Tarif tiket berhasil dihapus!');
    }
}
