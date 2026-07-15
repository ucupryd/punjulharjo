<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'required|file|mimes:pdf|max:15360',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $pdfFile = $request->file('pdf');
        $pdfName = time() . '_' . uniqid() . '.' . $pdfFile->getClientOriginalExtension();
        $pdfDir = public_path('storage/ebooks');
        if (!\Illuminate\Support\Facades\File::exists($pdfDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($pdfDir, 0755, true);
        }
        $pdfFile->move($pdfDir, $pdfName);
        $path = 'ebooks/' . $pdfName;
        
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverFile = $request->file('cover');
            $coverName = time() . '_' . uniqid() . '.' . $coverFile->getClientOriginalExtension();
            $coverDir = public_path('storage/ebooks/covers');
            if (!\Illuminate\Support\Facades\File::exists($coverDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($coverDir, 0755, true);
            }
            $coverFile->move($coverDir, $coverName);
            $coverPath = 'ebooks/covers/' . $coverName;
        }

        Ebook::create([
            'title' => $request->title,
            'description' => $request->description,
            'pdf_path' => $path,
            'cover_path' => $coverPath,
        ]);

        return back()->with('success', 'Ebook baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:15360',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $ebook = Ebook::findOrFail($id);

        $pdfPath = $ebook->pdf_path;
        if ($request->hasFile('pdf')) {
            // Delete old PDF file
            Storage::disk('public_direct')->delete($ebook->pdf_path);
            $pdfFile = $request->file('pdf');
            $pdfName = time() . '_' . uniqid() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfDir = public_path('storage/ebooks');
            if (!\Illuminate\Support\Facades\File::exists($pdfDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($pdfDir, 0755, true);
            }
            $pdfFile->move($pdfDir, $pdfName);
            $pdfPath = 'ebooks/' . $pdfName;
        }

        $coverPath = $ebook->cover_path;
        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($ebook->cover_path) {
                Storage::disk('public_direct')->delete($ebook->cover_path);
            }
            $coverFile = $request->file('cover');
            $coverName = time() . '_' . uniqid() . '.' . $coverFile->getClientOriginalExtension();
            $coverDir = public_path('storage/ebooks/covers');
            if (!\Illuminate\Support\Facades\File::exists($coverDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($coverDir, 0755, true);
            }
            $coverFile->move($coverDir, $coverName);
            $coverPath = 'ebooks/covers/' . $coverName;
        }

        $ebook->update([
            'title' => $request->title,
            'description' => $request->description,
            'pdf_path' => $pdfPath,
            'cover_path' => $coverPath,
        ]);

        return back()->with('success', 'Ebook berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);

        // Delete files
        Storage::disk('public_direct')->delete($ebook->pdf_path);
        if ($ebook->cover_path) {
            Storage::disk('public_direct')->delete($ebook->cover_path);
        }

        $ebook->delete();

        return back()->with('success', 'Ebook berhasil dihapus!');
    }
}
