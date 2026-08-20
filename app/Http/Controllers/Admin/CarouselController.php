<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:4096',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'carousel_key' => 'nullable|string',
        ]);

        $key = $request->input('carousel_key', 'carousel_items');

        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $targetDir = public_path('storage/carousel');
        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }
        $file->move($targetDir, $fileName);
        $path = 'carousel/' . $fileName;

        $itemsJson = SiteSetting::getValue($key);
        $items = $itemsJson ? json_decode($itemsJson, true) : [];

        // Generate auto-incrementing ID
        $newId = count($items) > 0 ? max(array_column($items, 'id')) + 1 : 1;

        $items[] = [
            'id' => $newId,
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
        ];

        SiteSetting::setValue($key, json_encode($items));

        return back()->with('success', 'Aktivitas carousel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:4096',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'carousel_key' => 'nullable|string',
        ]);

        $key = $request->input('carousel_key', 'carousel_items');

        $itemsJson = SiteSetting::getValue($key);
        if ($itemsJson) {
            $items = json_decode($itemsJson, true);
        } else {
            // Default items fallback if the key is default carousel_items
            if ($key === 'carousel_items') {
                $items = [
                    [
                        'id' => 1,
                        'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Susur Pantai Karang Jahe',
                        'description' => 'Menikmati segarnya hembusan angin laut di bawah keteduhan ribuan cemara laut yang berjejer rapi.'
                    ],
                    [
                        'id' => 2,
                        'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Eksplorasi Perahu Abad ke-7',
                        'description' => 'Melihat langsung mahakarya arkeologis kapal kayu tertua di nusantara bukti peradaban bahari.'
                    ],
                    [
                        'id' => 3,
                        'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Wisata Mangrove & Tambak',
                        'description' => 'Menyusuri jalur trekking hutan bakau hijau dan edukasi budidaya garam lokal masyarakat.'
                    ],
                    [
                        'id' => 4,
                        'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Festival Budaya Pesisir',
                        'description' => 'Menyaksikan pagelaran tari tradisional dan sedekah laut tahunan khas warga pesisir.'
                    ],
                    [
                        'id' => 5,
                        'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Kuliner Seafood & Khas Rembang',
                        'description' => 'Menikmati masakan laut segar bumbu rempah tradisi di warung makan tepi pantai.'
                    ]
                ];
            } else {
                $items = [];
            }
        }

        $found = false;
        foreach ($items as &$item) {
            if ($item['id'] == $id) {
                if ($request->hasFile('image')) {
                    // Try to delete old image if it is stored locally
                    if (!str_starts_with($item['image'], 'http')) {
                        Storage::disk('public_direct')->delete($item['image']);
                    }
                    $file = $request->file('image');
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('storage/carousel');
                    if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
                        \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
                    }
                    $file->move($targetDir, $fileName);
                    $item['image'] = 'carousel/' . $fileName;
                }
                $item['title'] = $request->title;
                $item['description'] = $request->description;
                $found = true;
                break;
            }
        }

        if (!$found) {
            return back()->withErrors(['error' => 'Aktivitas tidak ditemukan.']);
        }

        SiteSetting::setValue($key, json_encode($items));

        return back()->with('success', 'Aktivitas carousel berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $key = $request->input('carousel_key', 'carousel_items');
        $itemsJson = SiteSetting::getValue($key);
        if ($itemsJson) {
            $items = json_decode($itemsJson, true);
        } else {
            if ($key === 'carousel_items') {
                $items = [
                    [
                        'id' => 1,
                        'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Susur Pantai Karang Jahe',
                        'description' => 'Menikmati segarnya hembusan angin laut di bawah keteduhan ribuan cemara laut yang berjejer rapi.'
                    ],
                    [
                        'id' => 2,
                        'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Eksplorasi Perahu Abad ke-7',
                        'description' => 'Melihat langsung mahakarya arkeologis kapal kayu tertua di nusantara bukti peradaban bahari.'
                    ],
                    [
                        'id' => 3,
                        'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Wisata Mangrove & Tambak',
                        'description' => 'Menyusuri jalur trekking hutan bakau hijau dan edukasi budidaya garam lokal masyarakat.'
                    ],
                    [
                        'id' => 4,
                        'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Festival Budaya Pesisir',
                        'description' => 'Menyaksikan pagelaran tari tradisional dan sedekah laut tahunan khas warga pesisir.'
                    ],
                    [
                        'id' => 5,
                        'image' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=800&q=80',
                        'title' => 'Kuliner Seafood & Khas Rembang',
                        'description' => 'Menikmati masakan laut segar bumbu rempah tradisi di warung makan tepi pantai.'
                    ]
                ];
            } else {
                $items = [];
            }
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

        SiteSetting::setValue($key, json_encode($filteredItems));

        return back()->with('success', 'Aktivitas carousel berhasil dihapus!');
    }
}
