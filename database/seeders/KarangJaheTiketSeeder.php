<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KarangJaheTiket;

class KarangJaheTiketSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'komponen' => 'Tiket & Parkir Motor',
                'tarif' => 'Rp 5.000',
                'catatan' => null,
                'ikon' => 'fa-solid fa-motorcycle',
                'urutan' => 1,
            ],
            [
                'komponen' => 'Tiket & Parkir Mobil',
                'tarif' => 'Rp 15.000 – Rp 25.000',
                'catatan' => 'lebih tinggi saat weekend/libur',
                'ikon' => 'fa-solid fa-car',
                'urutan' => 2,
            ],
            [
                'komponen' => 'Bus / Rombongan Besar',
                'tarif' => 'Rp 25.000 – Rp 130.000',
                'catatan' => 'tergantung dimensi bus',
                'ikon' => 'fa-solid fa-bus',
                'urutan' => 3,
            ],
            [
                'komponen' => 'Estimasi Per Orang',
                'tarif' => '± Rp 10.000 – Rp 15.000',
                'catatan' => null,
                'ikon' => 'fa-solid fa-person',
                'urutan' => 4,
            ],
            [
                'komponen' => 'Perahu ke Pulau Gede',
                'tarif' => '± Rp 300.000 / Perahu',
                'catatan' => 'maksimal 10 orang',
                'ikon' => 'fa-solid fa-ship',
                'urutan' => 5,
            ],
            [
                'komponen' => 'Situs Perahu Kuno Tiket',
                'tarif' => 'Mulai ± Rp 2.000 – Rp 5.000',
                'catatan' => null,
                'ikon' => 'fa-solid fa-monument',
                'urutan' => 6,
            ],
        ];

        foreach ($data as $item) {
            KarangJaheTiket::updateOrCreate(
                ['komponen' => $item['komponen']],
                $item
            );
        }
    }
}
