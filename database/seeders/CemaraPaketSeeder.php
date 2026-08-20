<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CemaraPaket;

class CemaraPaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CemaraPaket::updateOrCreate(
            ['kode' => 'A'],
            [
                'nama' => 'Paket A — 2 Bibit Cemara',
                'jumlah_bibit' => 2,
                'harga' => 150000,
                'jenis_pohon' => 'Cemara Laut (Casuarina equisetifolia)',
                'deskripsi' => 'Program adopsi 2 bibit cemara laut yang akan ditanam di pesisir Pantai Karangjahe oleh tim ProKlim.',
                'bonus' => 'Kode pohon unik + Sertifikat Digital & Unduh Word',
                'aktif' => true,
            ]
        );

        CemaraPaket::updateOrCreate(
            ['kode' => 'B'],
            [
                'nama' => 'Paket B — 1 Bibit Cemara',
                'jumlah_bibit' => 1,
                'harga' => 100000,
                'jenis_pohon' => 'Cemara Laut (Casuarina equisetifolia)',
                'deskripsi' => 'Program adopsi 1 bibit cemara laut yang akan ditanam di pesisir Pantai Karangjahe oleh tim ProKlim.',
                'bonus' => 'Kode pohon unik + Sertifikat Digital & Unduh Word',
                'aktif' => true,
            ]
        );

        CemaraPaket::updateOrCreate(
            ['kode' => 'C'],
            [
                'nama' => 'Paket C - Donasi Bebas Nominal',
                'deskripsi' => 'Donasi Bebas',
                'jenis_pohon' => 'Cemara Laut (Casuarina equisetifolia)',
                'jumlah_bibit' => 1,
                'harga' => 0,
                'bonus' => 'Jumlah Bibit Disesuaikan sesuai nominal donasi diterima',
                'aktif' => true,
                'is_donasi' => true,
            ]
        );
    }
}
