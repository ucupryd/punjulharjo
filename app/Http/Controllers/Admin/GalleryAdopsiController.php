<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryAdopsiController extends Controller
{
    private function getDefaultItems()
    {
        return [
            [
                'id' => 1,
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80',
                'title' => 'Penanaman Cemara',
                'aspect_class' => 'aspect-[3/4] md:row-span-2'
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&fit=crop&w=600&q=80',
                'title' => 'Tunas Cemara Laut',
                'aspect_class' => 'aspect-[4/3] md:col-span-2'
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80',
                'title' => 'Rimbun Cemara',
                'aspect_class' => 'aspect-square'
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80',
                'title' => 'Ekosistem Pesisir',
                'aspect_class' => 'aspect-square'
            ],
            [
                'id' => 5,
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80',
                'title' => 'Konservasi Pantai',
                'aspect_class' => 'aspect-[4/3]'
            ],
            [
                'id' => 6,
                'image' => 'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Pantai Karangjahe',
                'aspect_class' => 'aspect-[16/9] md:col-span-2'
            ]
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:4096',
            'title' => 'required|string|max:255',
            'aspect_class' => 'required|string',
        ]);

        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/gallery-adopsi');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'gallery-adopsi/' . $fileName;

        $itemsJson = SiteSetting::getValue('gallery_adopsi_items');
        $items = $itemsJson ? json_decode($itemsJson, true) : $this->getDefaultItems();

        // Generate auto-incrementing ID
        $newId = count($items) > 0 ? max(array_column($items, 'id')) + 1 : 1;

        $items[] = [
            'id' => $newId,
            'image' => $path,
            'title' => $request->title,
            'aspect_class' => $request->aspect_class,
        ];

        SiteSetting::setValue('gallery_adopsi_items', json_encode($items));

        return back()->with('success', 'Foto galeri adopsi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
            'title' => 'required|string|max:255',
            'aspect_class' => 'required|string',
        ]);

        $itemsJson = SiteSetting::getValue('gallery_adopsi_items');
        $items = $itemsJson ? json_decode($itemsJson, true) : $this->getDefaultItems();

        $found = false;
        foreach ($items as &$item) {
            if ($item['id'] == $id) {
                if ($request->hasFile('image')) {
                    if (!str_starts_with($item['image'], 'http')) {
                        Storage::disk('public_direct')->delete($item['image']);
                    }
                    $file = $request->file('image');
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('storage/gallery-adopsi');
                    if (!File::exists($targetDir)) {
                        File::makeDirectory($targetDir, 0755, true);
                    }
                    $file->move($targetDir, $fileName);
                    $item['image'] = 'gallery-adopsi/' . $fileName;
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

        SiteSetting::setValue('gallery_adopsi_items', json_encode($items));

        return back()->with('success', 'Foto galeri adopsi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $itemsJson = SiteSetting::getValue('gallery_adopsi_items');
        $items = $itemsJson ? json_decode($itemsJson, true) : $this->getDefaultItems();

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

        SiteSetting::setValue('gallery_adopsi_items', json_encode($filteredItems));

        return back()->with('success', 'Foto galeri adopsi berhasil dihapus!');
    }
}
