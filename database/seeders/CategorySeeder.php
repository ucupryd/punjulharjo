<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kegiatan', 'icon' => 'fa-calendar-day', 'color' => 'brand-accent'],
            ['name' => 'Budaya', 'icon' => 'fa-masks-theater', 'color' => 'brand-dark'],
            ['name' => 'Wisata', 'icon' => 'fa-umbrella-beach', 'color' => 'sky'],
            ['name' => 'Pengumuman', 'icon' => 'fa-bullhorn', 'color' => 'amber'],
            ['name' => 'Ekonomi', 'icon' => 'fa-store', 'color' => 'emerald'],
            ['name' => 'Lingkungan', 'icon' => 'fa-leaf', 'color' => 'emerald'],
            ['name' => 'Edukasi', 'icon' => 'fa-book-open', 'color' => 'brand-light'],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(
                ['name' => $data['name']],
                [
                    'slug' => \Illuminate\Support\Str::slug($data['name']),
                    'icon' => $data['icon'],
                    'color' => $data['color'],
                ]
            );
        }
    }
}
