<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perangkat = [
            ['jabatan' => 'Kepala Desa', 'nama' => 'Moh. Akrom'],
            ['jabatan' => 'Sekretaris Desa', 'nama' => 'Ubaidillah'],
            ['jabatan' => 'Kasi Pemerintahan', 'nama' => 'Akhsan'],
            ['jabatan' => 'Kasi Kesejahteraan', 'nama' => 'Mulyo Santoso, SE'],
            ['jabatan' => 'Kasi Pelayanan', 'nama' => 'Sholihul Ma’arif, S.Pd'],
            ['jabatan' => 'Kaur Umum & Perencanaan', 'nama' => 'M. Ali Mustofa'],
            ['jabatan' => 'Kaur Keuangan', 'nama' => 'Dwi Lestari Indrayani'],
            ['jabatan' => 'Kepala Dusun', 'nama' => 'Moh Nasrul Jamil'],
            ['jabatan' => 'Kepala Dusun', 'nama' => 'M. Zaenal Roziqin'],
            ['jabatan' => 'Kepala Dusun', 'nama' => 'Putri Dini Andani, S.Bns'],
        ];

        foreach ($perangkat as $index => $p) {
            \App\Models\PerangkatDesa::create([
                'nama' => $p['nama'],
                'jabatan' => $p['jabatan'],
                'foto' => null,
                'urutan' => $index + 1,
            ]);
        }
    }
}
