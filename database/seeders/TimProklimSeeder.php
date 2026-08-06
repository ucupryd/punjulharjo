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
        // Bersihkan data lama jika ada
        TimProklim::truncate();

        $members = [
            ['nama' => 'M. Ali Mustofa', 'peran' => 'Ketua', 'foto' => null, 'urutan' => 1],
            ['nama' => 'Putri Dini Andani', 'peran' => 'Sekretaris I', 'foto' => null, 'urutan' => 2],
            ['nama' => 'Durrotun Ni\'mah', 'peran' => 'Sekretaris II', 'foto' => null, 'urutan' => 3],
            ['nama' => 'Siti Solikhah', 'peran' => 'Bendahara', 'foto' => null, 'urutan' => 4],
            ['nama' => 'Abdul Rosyid', 'peran' => 'Humas dan Pengembangan Jaringan', 'foto' => null, 'urutan' => 5],
            ['nama' => 'Mahmudi', 'peran' => 'Humas dan Pengembangan Jaringan', 'foto' => null, 'urutan' => 6],
            ['nama' => 'M. Nurul Anwar', 'peran' => 'Humas dan Pengembangan Jaringan', 'foto' => null, 'urutan' => 7],
            ['nama' => 'Sri Utami', 'peran' => 'Humas dan Pengembangan Jaringan', 'foto' => null, 'urutan' => 8],
            ['nama' => 'Ubaidillah', 'peran' => 'Edukasi, Penelitian dan Pengembangan Sumber Daya', 'foto' => null, 'urutan' => 9],
            ['nama' => 'Dwi Lestari Indrayani', 'peran' => 'Edukasi, Penelitian dan Pengembangan Sumber Daya', 'foto' => null, 'urutan' => 10],
            ['nama' => 'Ira Mafiani', 'peran' => 'Edukasi, Penelitian dan Pengembangan Sumber Daya', 'foto' => null, 'urutan' => 11],
            ['nama' => 'Rafi Inko Pramana', 'peran' => 'Edukasi, Penelitian dan Pengembangan Sumber Daya', 'foto' => null, 'urutan' => 12],
            ['nama' => 'Hadi Cahyono', 'peran' => 'Penguatan Aksi Adaptasi dan Mitigasi', 'foto' => null, 'urutan' => 13],
            ['nama' => 'A. Syahir', 'peran' => 'Penguatan Aksi Adaptasi dan Mitigasi', 'foto' => null, 'urutan' => 14],
            ['nama' => 'Akhsan', 'peran' => 'Penguatan Aksi Adaptasi dan Mitigasi', 'foto' => null, 'urutan' => 15],
            ['nama' => 'M. Zainul Roziqin', 'peran' => 'Penguatan Aksi Adaptasi dan Mitigasi', 'foto' => null, 'urutan' => 16],
            ['nama' => 'Rifa\'i', 'peran' => 'Penguatan Aksi Adaptasi dan Mitigasi', 'foto' => null, 'urutan' => 17],
            ['nama' => 'Poni', 'peran' => 'Penguatan Aksi Adaptasi dan Mitigasi', 'foto' => null, 'urutan' => 18],
            ['nama' => 'Muhammad Iqbal Dzulfikar', 'peran' => 'Media dan Publikasi', 'foto' => null, 'urutan' => 19],
            ['nama' => 'M. Shokafi', 'peran' => 'Media dan Publikasi', 'foto' => null, 'urutan' => 20],
            ['nama' => 'M. Farhan Tamami', 'peran' => 'Media dan Publikasi', 'foto' => null, 'urutan' => 21],
            ['nama' => 'Ferdinal Ferdi Efendi', 'peran' => 'Media dan Publikasi', 'foto' => null, 'urutan' => 22],
        ];

        foreach ($members as $member) {
            TimProklim::create($member);
        }
    }
}
