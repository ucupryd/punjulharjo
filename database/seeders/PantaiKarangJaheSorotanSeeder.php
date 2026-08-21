<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PantaiKarangJaheSorotan;

class PantaiKarangJaheSorotanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Hutan Cemara Laut',
                'icon' => 'fa-solid fa-tree',
                'deskripsi' => 'Pohon cemara laut rindang sepanjang pantai; suasana teduh hasil konservasi abrasi.',
                'gambar' => null,
                'urutan' => 1,
            ],
            [
                'judul' => 'Sunset Estetik',
                'icon' => 'fa-solid fa-camera',
                'deskripsi' => 'Lanskap laut, pasir, dan cemara yang sangat elok; favorit prewedding.',
                'gambar' => null,
                'urutan' => 2,
            ],
            [
                'judul' => 'Karang Jahe',
                'icon' => 'fa-solid fa-gem',
                'deskripsi' => 'Bentuk karang pesisir menyerupai jahe yang menjadi asal nama pantai ini.',
                'gambar' => null,
                'urutan' => 3,
            ],
            [
                'judul' => 'Area Parkir Luas',
                'icon' => 'fa-solid fa-square-parking',
                'deskripsi' => 'Area parkir memadai untuk kendaraan roda dua dan roda empat.',
                'gambar' => null,
                'urutan' => 4,
            ],
            [
                'judul' => 'Toilet / MCK Umum',
                'icon' => 'fa-solid fa-restroom',
                'deskripsi' => 'Fasilitas toilet dan MCK umum yang bersih dan terawat.',
                'gambar' => null,
                'urutan' => 5,
            ],
            [
                'judul' => 'Musala Nurul Jannah',
                'icon' => 'fa-solid fa-mosque',
                'deskripsi' => 'Musala nyaman untuk beribadah selama berwisata.',
                'gambar' => null,
                'urutan' => 6,
            ],
            [
                'judul' => 'Warung Kuliner',
                'icon' => 'fa-solid fa-utensils',
                'deskripsi' => 'Beragam warung kuliner lokal di sekitar area pantai.',
                'gambar' => null,
                'urutan' => 7,
            ],
            [
                'judul' => 'Gazebo & Kursi',
                'icon' => 'fa-solid fa-umbrella',
                'deskripsi' => 'Gazebo dan kursi santai untuk beristirahat menikmati pemandangan.',
                'gambar' => null,
                'urutan' => 8,
            ],
        ];

        foreach ($data as $item) {
            PantaiKarangJaheSorotan::updateOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }
    }
}
