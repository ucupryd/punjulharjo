<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimProklim;

class TimProklimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records first to avoid duplicates
        TimProklim::truncate();

        $members = [
            [
                'nama' => 'Ir. H. Joko Susilo',
                'peran' => 'Penanggung Jawab',
                'foto' => null,
                'urutan' => 1,
            ],
            [
                'nama' => 'Supriyanto, S.Hut',
                'peran' => 'Ketua Tim ProKlim',
                'foto' => null,
                'urutan' => 2,
            ],
            [
                'nama' => 'Endang Setyowati',
                'peran' => 'Sekretaris',
                'foto' => null,
                'urutan' => 3,
            ],
            [
                'nama' => 'Rofiqul Anam',
                'peran' => 'Bendahara',
                'foto' => null,
                'urutan' => 4,
            ],
            [
                'nama' => 'Syafi\'i',
                'peran' => 'Divisi Aksi Konservasi',
                'foto' => null,
                'urutan' => 5,
            ],
            [
                'nama' => 'Siti Rahmawati',
                'peran' => 'Divisi Edukasi Lingkungan',
                'foto' => null,
                'urutan' => 6,
            ],
            [
                'nama' => 'Bambang Wijaya',
                'peran' => 'Divisi Pemeliharaan',
                'foto' => null,
                'urutan' => 7,
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'peran' => 'Divisi Publikasi & Logistik',
                'foto' => null,
                'urutan' => 8,
            ],
        ];

        foreach ($members as $member) {
            TimProklim::create($member);
        }
    }
}
