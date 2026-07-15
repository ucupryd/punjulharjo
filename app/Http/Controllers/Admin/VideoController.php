<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(8);
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($request->title);

        Video::create($validated);

        return back()->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $video->update($validated);

        return back()->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        if ($video->thumbnail) {
            Storage::disk('public_direct')->delete($video->thumbnail);
        }
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus!');
    }
}
