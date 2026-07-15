<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:4096',
            'title' => 'required|string|max:255',
            'aspect_class' => 'required|string',
        ]);

        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/gallery');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'gallery/' . $fileName;

        $itemsJson = SiteSetting::getValue('gallery_items');
        $items = $itemsJson ? json_decode($itemsJson, true) : [];

        // Generate auto-incrementing ID
        $newId = count($items) > 0 ? max(array_column($items, 'id')) + 1 : 1;

        $items[] = [
            'id' => $newId,
            'image' => $path,
            'title' => $request->title,
            'aspect_class' => $request->aspect_class,
        ];

        SiteSetting::setValue('gallery_items', json_encode($items));

        return back()->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:4096',
            'title' => 'required|string|max:255',
            'aspect_class' => 'required|string',
        ]);

        $itemsJson = SiteSetting::getValue('gallery_items');
        if ($itemsJson) {
            $items = json_decode($itemsJson, true);
        } else {
            $items = [
                [
                    'id' => 1,
                    'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Pesona Pantai',
                    'aspect_class' => 'aspect-[3/4] md:row-span-2'
                ],
                [
                    'id' => 2,
                    'image' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Kehidupan Pantai',
                    'aspect_class' => 'aspect-[4/3] md:col-span-2'
                ],
                [
                    'id' => 3,
                    'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Bahari Tradisional',
                    'aspect_class' => 'aspect-square'
                ],
                [
                    'id' => 4,
                    'image' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Sunset Pesisir',
                    'aspect_class' => 'aspect-square'
                ],
                [
                    'id' => 5,
                    'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Ekosistem Pantai',
                    'aspect_class' => 'aspect-[4/3]'
                ],
                [
                    'id' => 6,
                    'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Aktivitas Gotong Royong',
                    'aspect_class' => 'aspect-[16/9] md:col-span-2'
                ]
            ];
        }

        $found = false;
        foreach ($items as &$item) {
            if ($item['id'] == $id) {
                if ($request->hasFile('image')) {
                    if (!str_starts_with($item['image'], 'http')) {
                        Storage::disk('public_direct')->delete($item['image']);
                    }
                    $file = $request->file('image');
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('storage/gallery');
                    if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
                        \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
                    }
                    $file->move($targetDir, $fileName);
                    $item['image'] = 'gallery/' . $fileName;
                }
                $item['title'] = $request->title;
                $item['aspect_class'] = $request->aspect_class;
                $found = true;
                break;
            }
        }

        if (!$found) {
            return back()->withErrors(['error' => 'Foto tidak ditemukan.']);
        }

        SiteSetting::setValue('gallery_items', json_encode($items));

        return back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $itemsJson = SiteSetting::getValue('gallery_items');
        if ($itemsJson) {
            $items = json_decode($itemsJson, true);
        } else {
            $items = [
                [
                    'id' => 1,
                    'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Pesona Pantai',
                    'aspect_class' => 'aspect-[3/4] md:row-span-2'
                ],
                [
                    'id' => 2,
                    'image' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Kehidupan Pantai',
                    'aspect_class' => 'aspect-[4/3] md:col-span-2'
                ],
                [
                    'id' => 3,
                    'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Bahari Tradisional',
                    'aspect_class' => 'aspect-square'
                ],
                [
                    'id' => 4,
                    'image' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Sunset Pesisir',
                    'aspect_class' => 'aspect-square'
                ],
                [
                    'id' => 5,
                    'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80',
                    'title' => 'Ekosistem Pantai',
                    'aspect_class' => 'aspect-[4/3]'
                ],
                [
                    'id' => 6,
                    'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Aktivitas Gotong Royong',
                    'aspect_class' => 'aspect-[16/9] md:col-span-2'
                ]
            ];
        }

        $filteredItems = [];
        foreach ($items as $item) {
            if ($item['id'] == $id) {
                if (!str_starts_with($item['image'], 'http')) {
                    Storage::disk('public_direct')->delete($item['image']);
                }
            } else {
                $filteredItems[] = $item;
            }
        }

        SiteSetting::setValue('gallery_items', json_encode($filteredItems));

        return back()->with('success', 'Foto galeri berhasil dihapus!');
    }
}
