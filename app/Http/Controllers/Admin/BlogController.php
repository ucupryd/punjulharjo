<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(8);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/blog-images');
            if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $validated['image'] = 'blog-images/' . $fileName;
        }

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($request->title);

        Blog::create($validated);

        return back()->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public_direct')->delete($blog->image);
            }
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('storage/blog-images');
            if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $validated['image'] = 'blog-images/' . $fileName;
        }

        $validated['slug'] = Str::slug($request->title);
        $blog->update($validated);

        return back()->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public_direct')->delete($blog->image);
        }
        $blog->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }
}
