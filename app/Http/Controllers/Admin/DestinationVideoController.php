<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DestinationVideo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DestinationVideoController extends Controller
{
    public function index()
    {
        $videos = DestinationVideo::orderBy('urutan')->get();
        return view('admin.destination-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.destination-videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'video' => 'required|file|mimes:mp4,webm|max:20480',
            'urutan' => 'nullable|integer',
            'aktif' => 'nullable|boolean',
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/destinations');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $videoPath = 'destinations/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = DestinationVideo::count() + 1;
        }

        DestinationVideo::create([
            'judul' => $request->judul,
            'caption' => $request->caption,
            'video' => $videoPath,
            'urutan' => $urutan,
            'aktif' => $request->has('aktif') ? (bool)$request->aktif : true,
        ]);

        return redirect()->route('admin.destination-videos.index')->with('success', 'Video destinasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $video = DestinationVideo::findOrFail($id);
        return view('admin.destination-videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'video' => 'nullable|file|mimes:mp4,webm|max:20480',
            'urutan' => 'nullable|integer',
            'aktif' => 'nullable|boolean',
        ]);

        $video = DestinationVideo::findOrFail($id);

        $videoPath = $video->video;
        if ($request->hasFile('video')) {
            // Hapus video lama dari disk
            if ($video->video && !Str::startsWith($video->video, 'http')) {
                Storage::disk('public_direct')->delete($video->video);
            }

            $file = $request->file('video');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/destinations');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $videoPath = 'destinations/' . $fileName;
        }

        $urutan = $request->input('urutan');
        if (is_null($urutan)) {
            $urutan = $video->urutan;
        }

        $video->update([
            'judul' => $request->judul,
            'caption' => $request->caption,
            'video' => $videoPath,
            'urutan' => $urutan,
            'aktif' => $request->has('aktif') ? (bool)$request->aktif : false,
        ]);

        return redirect()->route('admin.destination-videos.index')->with('success', 'Video destinasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $video = DestinationVideo::findOrFail($id);
        if ($video->video && !Str::startsWith($video->video, 'http')) {
            Storage::disk('public_direct')->delete($video->video);
        }
        $video->delete();

        return redirect()->route('admin.destination-videos.index')->with('success', 'Video destinasi berhasil dihapus!');
    }
}
